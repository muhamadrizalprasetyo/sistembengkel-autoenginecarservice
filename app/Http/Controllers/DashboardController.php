<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\Expense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $prevMonthStart = $now->copy()->subMonth()->startOfMonth();
        $prevMonthEnd = $now->copy()->subMonth()->endOfMonth();

        // ── FINANCE: Revenue, Expense & Profit ─────────────────
        $monthlyRevenue = (int) Transaction::where('created_at', '>=', $monthStart)->sum('total_price');
        $prevMonthlyRevenue = (int) Transaction::whereBetween('created_at', [$prevMonthStart, $prevMonthEnd])->sum('total_price');

        $monthlyExpense = (int) Expense::where('date', '>=', $monthStart->toDateString())->sum('amount');
        $netProfit = $monthlyRevenue - $monthlyExpense;

        $revenueGrowth = 0;
        if ($prevMonthlyRevenue > 0) {
            $revenueGrowth = (($monthlyRevenue - $prevMonthlyRevenue) / $prevMonthlyRevenue) * 100;
        }

        $globalTransactions = (int) Transaction::count();
        $activeInventory = (int) Item::where('category', 'sparepart')->count();
        $criticalStockAlerts = (int) Item::where('category', 'sparepart')->where('stock', '<=', 3)->count();

        // ── CHARTS: Revenue Wave ──────────────────────
        $dailyRows = Transaction::selectRaw('DATE(created_at) as day, SUM(total_price) as total')
            ->whereDate('created_at', '>=', $now->copy()->subDays(6)->toDateString())
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $revenueWaveLabels = [];
        $revenueWaveData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $key = $date->toDateString();
            $revenueWaveLabels[] = $date->translatedFormat('D');
            $revenueWaveData[] = (int) ($dailyRows[$key]->total ?? 0);
        }

        // ── INTELLIGENCE: Best Selling Items (Velocity) ──
        $topSellingItems = \App\Models\TransactionDetail::select('item_name')
            ->selectRaw('SUM(qty) as total_qty')
            ->groupBy('item_name')
            ->orderByDesc('total_qty')
            ->limit(7)
            ->get();

        // ── ALERTS: Low Stock ─────────────────────────
        $operationalAlerts = Item::select(['name', 'stock'])
            ->where('category', 'sparepart')
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'name' => strtoupper($item->name),
                'stock' => (int) $item->stock,
            ]);

        $totalBookings = \App\Models\Booking::count();
        $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
        $totalFeedbacks = \App\Models\Feedback::count();
        $unreadFeedbacks = \App\Models\Feedback::where('is_read', false)->count();

        return view('welcome', [
            'monthly_revenue' => $monthlyRevenue,
            'formatted_monthly_revenue' => 'Rp' . number_format($monthlyRevenue, 0, ',', '.'),
            'monthly_expense' => $monthlyExpense,
            'formatted_monthly_expense' => 'Rp' . number_format($monthlyExpense, 0, ',', '.'),
            'net_profit' => $netProfit,
            'formatted_net_profit' => 'Rp' . number_format($netProfit, 0, ',', '.'),
            'revenue_growth' => round($revenueGrowth, 1),
            'global_transactions' => $globalTransactions,
            'active_inventory' => $activeInventory,
            'critical_stock_alerts' => $criticalStockAlerts,
            'revenue_wave_labels' => $revenueWaveLabels,
            'revenue_wave_data' => $revenueWaveData,
            'stock_velocity_labels' => $topSellingItems->pluck('item_name')->map(fn($v) => strtoupper($v))->values(),
            'stock_velocity_data' => $topSellingItems->pluck('total_qty')->map(fn($v) => (int) $v)->values(),
            'operational_alerts' => $operationalAlerts,
            'total_bookings' => $totalBookings,
            'pending_bookings' => $pendingBookings,
            'total_feedbacks' => $totalFeedbacks,
            'unread_feedbacks' => $unreadFeedbacks,
        ]);
    }
}

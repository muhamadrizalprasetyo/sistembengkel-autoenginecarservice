<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = now();
        $monthStart = $now->copy()->startOfMonth();

        $monthlyRevenue = (int) Transaction::where('created_at', '>=', $monthStart)->sum('total_price');
        $globalTransactions = (int) Transaction::count();
        $activeInventory = (int) Item::where('category', 'sparepart')->count();
        $criticalStockAlerts = (int) Item::where('category', 'sparepart')->where('stock', '<=', 3)->count();

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

        $stockVelocityRows = Item::select(['name', 'stock'])
            ->where('category', 'sparepart')
            ->orderBy('stock')
            ->limit(7)
            ->get();

        $operationalAlerts = Item::select(['name', 'stock'])
            ->where('category', 'sparepart')
            ->where('stock', '<=', 3)
            ->orderBy('stock')
            ->limit(10)
            ->get()
            ->map(fn ($item) => [
                'name' => strtoupper($item->name),
                'stock' => (int) $item->stock,
            ]);

        return view('welcome', [
            'formatted_monthly_revenue' => 'Rp' . number_format($monthlyRevenue, 0, ',', '.'),
            'global_transactions' => $globalTransactions,
            'active_inventory' => $activeInventory,
            'critical_stock_alerts' => $criticalStockAlerts,
            'revenue_wave_labels' => $revenueWaveLabels,
            'revenue_wave_data' => $revenueWaveData,
            'stock_velocity_labels' => $stockVelocityRows->pluck('name')->map(fn ($v) => strtoupper($v))->values(),
            'stock_velocity_data' => $stockVelocityRows->pluck('stock')->map(fn ($v) => (int) $v)->values(),
            'operational_alerts' => $operationalAlerts,
        ]);
    }
}

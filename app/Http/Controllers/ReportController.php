<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Expense;

class ReportController extends Controller
{
    public function index()
    {
        $grossRevenue = (int) Transaction::sum('total_price');
        $totalTransactions = (int) Transaction::count();

        // Actual Net calculation using Expense model
        $totalExpenses = (int) Expense::sum('amount');
        $netProfit = $grossRevenue - $totalExpenses;

        $topItems = TransactionDetail::query()
            ->selectRaw('item_name, SUM(qty) as total_qty, SUM(subtotal) as total_revenue')
            ->groupBy('item_name')
            ->orderByDesc('total_qty')
            ->limit(10)
            ->get();

        return view('reports.index', [
            'gross_revenue' => $grossRevenue,
            'total_expenses' => $totalExpenses,
            'net_profit' => $netProfit,
            'total_transactions' => $totalTransactions,
            'top_items' => $topItems,
        ]);
    }

    public function historyAndReceipt()
    {
        $transactions = Transaction::query()
            ->with('details')
            ->latest()
            ->paginate(50) // Added Pagination for performance
            ->through(function ($transaction) {
                $items = $transaction->details->take(5)->map(function ($detail) {
                    return strtoupper($detail->item_name) . ' (x' . (int) $detail->qty . ')';
                })->implode(', ');

                if ($transaction->details->count() > 5)
                    $items .= '...';

                $total = (int) $transaction->total_price;

                return [
                    'id' => $transaction->id,
                    'tanggal' => $transaction->created_at->format('d/m/Y H:i'),
                    'items' => $items ?: '-',
                    'total_harga' => $total,
                    'tunai' => (int) $transaction->amount_paid,
                    'kembalian' => (int) $transaction->change_amount,
                ];
            });

        return view('reports.history-struk', [
            'transactions' => $transactions,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;

class ReportController extends Controller
{
    public function index()
    {
        $grossRevenue = (int) Transaction::sum('total_price');
        $totalTransactions = (int) Transaction::count();
        $estimatedNet = (int) round($grossRevenue * 0.35);

        $topItems = TransactionDetail::query()
            ->selectRaw('item_name, SUM(qty) as total_qty, SUM(subtotal) as total_revenue')
            ->groupBy('item_name')
            ->orderByDesc('total_qty')
            ->limit(10)
            ->get();

        return view('reports.index', [
            'gross_revenue' => $grossRevenue,
            'estimated_net' => $estimatedNet,
            'total_transactions' => $totalTransactions,
            'top_items' => $topItems,
        ]);
    }

    public function historyAndReceipt()
    {
        $transactions = Transaction::query()
            ->with('details')
            ->latest()
            ->get()
            ->map(function ($transaction) {
                $items = $transaction->details->map(function ($detail) {
                    return strtoupper($detail->item_name) . ' (x' . (int) $detail->qty . ')';
                })->implode(', ');

                $total = (int) $transaction->total_price;

                return [
                    'id' => $transaction->id,
                    'tanggal' => $transaction->created_at->format('d/m/Y H:i'),
                    'items' => $items ?: '-',
                    'total_harga' => $total,
                    'tunai' => $total,
                    'kembalian' => 0,
                ];
            });

        return view('reports.history-struk', [
            'transactions' => $transactions,
        ]);
    }
}

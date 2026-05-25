<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('date', 'desc')->paginate(10);
        $totalAmount = Expense::sum('amount');

        return view('expenses.index', compact('expenses', 'totalAmount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'payment_method' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->back()->with('success', 'Pengeluaran berhasil dicatat.');
    }

    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; 
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    // Fungsi nampilin halaman kasir
    public function index()
    {
        $items = Item::query()
            ->select(['id', 'name', 'category', 'price', 'stock'])
            ->orderBy('name')
            ->get();

        return view('kasir', compact('items'));
    }

    public function store(Request $request) {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'item_id' => 'required|array',
            'qty' => 'nullable|array',
        ]);

        $imagePath = $request->hasFile('car_image') ? $request->file('car_image')->store('cars', 'public') : null;
    
        $transaction = Transaction::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'car_image' => $imagePath,
            'total_price' => 0
        ]);
    
        $total = 0;
        $manualCounter = 0; 
        $requestedIds = collect($request->item_id)
            ->filter(fn ($id) => $id !== 'manual' && !empty($id))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        $itemsById = Item::query()
            ->whereIn('id', $requestedIds)
            ->get()
            ->keyBy('id');
    
        foreach ($request->item_id as $key => $val) {
            if ($val === 'manual') {
                $name = $request->manual_name[$manualCounter] ?? 'Jasa Service';
                $price = (int) ($request->manual_price[$manualCounter] ?? 0);
                $qty = 1;
                $itemId = null;
                $manualCounter++; 
            } else {
                if (!$val) continue;
                $item = $itemsById->get((int) $val);
                if (!$item) continue;
    
                $name = $item->name;
                $price = (int) $item->price;
                $qty = max(1, (int) ($request->qty[$key] ?? 1));
                $itemId = $item->id;
                
                if ($item->category == 'sparepart' && $item->stock > 0) {
                    $safeQty = min($qty, (int) $item->stock);
                    $qty = max(1, $safeQty);
                    $item->decrement('stock', $qty);
                }
            }
    
            $subtotal = $price * $qty;
            $total += $subtotal;
    
            $transaction->details()->create([
                'item_id' => $itemId,
                'item_name' => $name,
                'qty' => $qty,
                'subtotal' => $subtotal
            ]);
        }
    
        $transaction->update(['total_price' => $total]);
        return redirect('/riwayat')->with('success', 'Transaksi Berhasil!');
    }  

    // Fungsi buat nampilin riwayat transaksi + Low Stock Alert
    public function history()
    {
        $transactions = Transaction::query()
            ->latest()
            ->withCount('details')
            ->get();
        
        $lowStockItems = Item::query()
            ->select(['id', 'name', 'stock'])
            ->where('category', 'sparepart')
            ->where('stock', '<=', 3)
            ->orderBy('stock')
            ->get();

        return view('riwayat', compact('transactions', 'lowStockItems'));
    }

    // Fungsi buat cetak struk
    public function cetak($id)
    {
        $transaction = Transaction::with('details')->findOrFail($id);
        $details = $transaction->details; 

        return view('struk', compact('transaction', 'details'));
    }
}
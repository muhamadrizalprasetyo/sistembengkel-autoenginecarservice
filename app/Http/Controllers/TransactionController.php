<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Item::query()
            ->select(['id', 'name', 'category', 'price', 'stock'])
            ->orderBy('name')
            ->get();

        // Untuk pre-fill dari booking
        $pendingBooking = null;
        if (request()->has('booking_id')) {
            $pendingBooking = Booking::find(request()->booking_id);
        }

        return view('kasir', compact('items', 'pendingBooking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'item_id' => 'required|array',
            'qty' => 'nullable|array',
            'amount_paid' => 'nullable|integer|min:0',
        ]);

        return DB::transaction(function () use ($request) {
            $imagePath = $request->hasFile('car_image')
                ? $request->file('car_image')->store('cars', 'public')
                : null;

            $invoiceNumber = Transaction::generateInvoiceNumber();
            $amountPaid = (int) ($request->amount_paid ?? 0);

            $transaction = Transaction::create([
                'invoice_number' => $invoiceNumber,
                'booking_id' => $request->booking_id ?: null,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'car_image' => $imagePath,
                'total_price' => 0,
                'payment_method' => $request->payment_method ?? 'tunai',
                'amount_paid' => $amountPaid,
                'change_amount' => 0,
            ]);

            $total = 0;
            $manualCounter = 0;

            // Optimization: Load items once
            $requestedIds = collect($request->item_id)
                ->filter(fn($id) => $id !== 'manual' && !empty($id))
                ->map(fn($id) => (int) $id)
                ->unique()
                ->values();

            $itemsById = Item::whereIn('id', $requestedIds)->get()->keyBy('id');

            foreach ($request->item_id as $key => $val) {
                if ($val === 'manual') {
                    $name = $request->manual_name[$manualCounter] ?? 'Jasa Service';
                    $price = (int) ($request->manual_price[$manualCounter] ?? 0);
                    $qty = 1;
                    $itemId = null;
                    $manualCounter++;
                } else {
                    if (!$val)
                        continue;
                    $item = $itemsById->get((int) $val);
                    if (!$item)
                        continue;

                    $name = $item->name;
                    $price = (int) $item->price;
                    $qty = max(1, (int) ($request->qty[$key] ?? 1));
                    $itemId = $item->id;

                    if ($item->category === 'sparepart' && $item->stock > 0) {
                        $qty = min($qty, (int) $item->stock);
                        $item->decrement('stock', $qty);
                    }
                }

                $subtotal = $price * $qty;
                $total += $subtotal;

                $transaction->details()->create([
                    'item_id' => $itemId,
                    'item_name' => $name,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ]);
            }

            // Validasi uang bayar (kecuali metode non-tunai mungkin beda kebijakan, tapi biasanya >= total)
            if ($amountPaid < $total && $request->payment_method === 'tunai') {
                throw new \Exception("Pembayaran tunai kurang! Total: Rp" . number_format($total));
            }

            $changeAmount = max(0, $amountPaid - $total);
            $transaction->update([
                'total_price' => $total,
                'amount_paid' => $amountPaid,
                'change_amount' => $changeAmount,
            ]);

            if ($request->booking_id) {
                Booking::where('id', $request->booking_id)->update(['status' => 'selesai']);
            }

            return redirect('/riwayat')->with('success', "Transaksi {$invoiceNumber} berhasil!");
        });
    }

    public function history()
    {
        $transactions = Transaction::query()
            ->latest()
            ->withCount('details')
            ->paginate(20);

        $lowStockItems = Item::query()
            ->select(['id', 'name', 'stock'])
            ->where('category', 'sparepart')
            ->where('stock', '<=', 3)
            ->orderBy('stock')
            ->get();

        return view('riwayat', compact('transactions', 'lowStockItems'));
    }

    public function cetak($id)
    {
        $transaction = Transaction::with('details')->findOrFail($id);
        $details = $transaction->details;

        return view('struk', compact('transaction', 'details'));
    }
}
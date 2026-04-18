<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index() {
        $items = Item::query()->select(['id', 'name', 'category', 'price', 'stock'])->orderBy('name')->get();
        return view('harga', compact('items'));
    }

    public function manage() {
        $items = Item::query()
            ->select(['id', 'name', 'category', 'price', 'stock'])
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        $criticalStockItems = Item::where('category', 'sparepart')->where('stock', '<=', 3)->count();

        return view('items.index', [
            'items' => $items,
            'critical_stock_items' => $criticalStockItems,
        ]);
    }

    public function store(Request $request) {
        // Ambil data dan pastikan price & stock masuk sebagai angka bersih
        $data = $request->only(['name', 'category', 'price', 'stock']);
        $data['price'] = (int) preg_replace('/[^0-9]/', '', $request->price);
        $data['stock'] = (int) ($request->stock ?? 0);

        Item::create($data);
        return redirect('/items')->with('success', 'Barang baru berhasil ditambah!');
    }

    public function edit($id) {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $item = Item::findOrFail($id);
        
        $data = $request->only(['name', 'category', 'price', 'stock']);
        $data['price'] = (int) preg_replace('/[^0-9]/', '', $request->price);
        $data['stock'] = (int) ($request->stock ?? 0);

        $item->update($data);
        return redirect('/items')->with('success', 'Data barang berhasil diupdate!');
    }
    
    public function bulkDelete(Request $request) {
        if (!$request->ids) {
            return back()->with('error', 'Pilih barang dulu, Zal!');
        }
        
        // Hapus semua yang ID-nya ada di dalam array ids
        Item::whereIn('id', $request->ids)->delete();
        
        return back()->with('success', count($request->ids) . ' barang berhasil dibantai!');
    }

    public function destroy($id) {
        Item::destroy($id);
        return redirect('/items')->with('success', 'Barang berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), "r");
        
        // Skip baris pertama (header)
        fgetcsv($handle); 

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // 🔥 PEMBERSIHAN DATA: Hapus titik/karakter aneh di harga
            $cleanPrice = preg_replace('/[^0-9]/', '', $data[2]); 

            \App\Models\Item::updateOrCreate(
                ['name' => $data[0]], // Cek berdasarkan nama biar gak duplikat
                [
                    'category' => $data[1],
                    'price'    => (int) $cleanPrice,
                    'stock'    => (int) ($data[3] ?? 0),
                ]
            );
        }

        fclose($handle);
        return back()->with('success', 'Data Sparepart Berhasil Diimpor!');
    }
}
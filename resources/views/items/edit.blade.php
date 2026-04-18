<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Edit Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-white p-10 font-sans">
    <div class="max-w-md mx-auto bg-zinc-900 p-8 rounded-xl border border-zinc-800">
        <h2 class="text-2xl font-bold mb-6 text-red-600 uppercase italic">Edit Item</h2>
        <form action="/items/update/{{ $item->id }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="text-xs text-zinc-500 uppercase">Nama Barang</label>
                <input type="text" name="name" value="{{ $item->name }}" class="w-full bg-zinc-800 border border-zinc-700 p-2 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="text-xs text-zinc-500 uppercase">Harga</label>
                <input type="number" name="price" value="{{ $item->price }}" class="w-full bg-zinc-800 border border-zinc-700 p-2 rounded mt-1">
            </div>
            <div class="mb-6">
                <label class="text-xs text-zinc-500 uppercase">Stok</label>
                <input type="number" name="stock" value="{{ $item->stock }}" class="w-full bg-zinc-800 border border-zinc-700 p-2 rounded mt-1">
            </div>
            <button type="submit" class="w-full bg-red-600 py-3 rounded font-bold uppercase italic">Simpan Perubahan</button>
            <a href="/items" class="block text-center mt-4 text-zinc-500 text-sm italic">Batal</a>
        </form>
    </div>
</body>
</html>
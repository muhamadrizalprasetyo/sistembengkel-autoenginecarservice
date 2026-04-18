<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Harga - Auto Engine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-white p-10 font-sans">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-red-600 mb-2 italic uppercase">Daftar Harga & Jasa</h1>
        <div class="h-1 w-20 bg-red-600 mb-8"></div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-lg overflow-hidden shadow-2xl">
            <table class="w-full text-left">
                <thead class="bg-black text-red-600 uppercase text-sm border-b border-zinc-800">
                    <tr>
                        <th class="p-4">Nama Item</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @foreach($items as $item)
                    <tr class="hover:bg-zinc-800 transition">
                        <td class="p-4 font-semibold">{{ $item->name }}</td>
                        <td class="p-4 uppercase text-xs">{{ $item->category }}</td>
                        <td class="p-4 text-green-500 font-mono">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-center">{{ $item->stock ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-8">
            <a href="/" class="text-zinc-400 hover:text-red-500 transition">&larr; Kembali ke Landing Page</a>
        </div>
    </div>
</body>
</html>
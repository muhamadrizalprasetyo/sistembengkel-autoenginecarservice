<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - {{ $transaction->customer_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; color: black; }
        }
        @font-face {
            font-family: 'Receipt';
            src: url('https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap');
        }
    </style>
</head>
<body class="bg-zinc-100 flex justify-center py-10 px-4">

    <div class="bg-white text-black w-full max-w-md p-8 shadow-2xl rounded-sm border-t-8 border-red-600">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black italic uppercase tracking-tighter">Auto <span class="text-red-600">Engine</span></h1>
            <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest leading-tight mt-1">
                Car Service & Spareparts<br>
                Tangerang, Indonesia
            </p>
        </div>

        <div class="border-y border-dashed border-zinc-300 py-4 mb-6 flex justify-between items-center text-[11px] font-bold uppercase tracking-wider">
            <div>
                <p class="text-zinc-400">Pelanggan:</p>
                <p>{{ $transaction->customer_name }}</p>
            </div>
            <div class="text-right">
                <p class="text-zinc-400">Tanggal:</p>
                <p>{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="space-y-4 mb-8">
        <div style="margin-bottom: 10px; border-bottom: 1px dashed #ccc; padding-bottom: 5px;">
    @foreach($details as $detail)
        <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 4px;">
            <span>{{ $detail->item_name }} (x{{ $detail->qty }})</span>
            <span>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
        </div>
    @endforeach
</div>
        </div>

        <div class="border-t-2 border-black pt-4 mb-8">
            <div class="flex justify-between items-center">
                <span class="text-sm font-black uppercase italic">Total Bayar</span>
                <span class="text-xl font-black font-mono tracking-tighter">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center">
            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-4 italic">*** Terima Kasih & Salam Gacor ***</p>
            
            <div class="no-print flex space-x-2">
                <button onclick="window.print()" class="flex-1 bg-red-600 text-white font-black py-3 rounded-xl uppercase text-[10px] tracking-widest shadow-lg shadow-red-200">
                    <i class="fas fa-print mr-2"></i> Cetak Struk
                </button>
                <a href="/" class="flex-1 bg-zinc-900 text-white font-black py-3 rounded-xl uppercase text-[10px] tracking-widest text-center">
                    Kembali Home
                </a>
            </div>
        </div>
    </div>

</body>
</html>
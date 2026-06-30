@extends('layouts.app')

@section('title', 'Riwayat Penjualan Kasir')

@section('content')
    <div class="flex justify-between items-center shrink-0 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Riwayat Penjualan</h1>
            <p class="text-sm text-gray-500">Klik pada baris transaksi untuk menampilkan lembar faktur digital asli</p>
        </div>
    </div>

    <div class="space-y-4 max-w-4xl mx-auto overflow-y-auto max-h-[calc(100vh-180px)] pr-2 custom-scroll">
        @foreach($salesHistory as $sale)
        <div onclick="bukaFaktur({{ json_encode($sale) }})" 
             class="bg-white border border-cyan-100/50 rounded-[24px] p-5 flex items-center justify-between gap-4 hover:shadow-md hover:border-[#00C2E8]/40 transition-all cursor-pointer transform active:scale-[0.99]">
            
            <div class="flex items-center gap-5 min-w-0 flex-1">
                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 shrink-0">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=150" class="w-full h-full object-cover" alt="Item">
                </div>
                
                <div class="min-w-0 space-y-1">
                    <div class="flex items-center gap-3 text-xs font-semibold text-gray-400 tracking-wide">
                        <span>{{ $sale['no_faktur'] }}</span>
                        <span>{{ $sale['tanggal'] }}</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 tracking-tight">{{ $sale['pelanggan'] }}</h3>
                    
                    <div class="flex flex-wrap gap-2 pt-1">
                        @foreach($sale['items'] as $item)
                        <span class="border border-cyan-300 text-cyan-600 bg-cyan-50/30 px-3 py-1 rounded-xl text-xs font-medium truncate max-w-[24px] sm:max-w-xs block">
                            {{ $item['nama'] }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="shrink-0 text-right pl-4">
                <p class="text-xs font-semibold text-gray-400">Total:</p>
                <p class="text-lg font-black text-gray-800 tracking-tight mt-0.5">{{ $sale['total'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div id="modalFaktur" onclick="tutupFaktur(event)" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        
        <div id="kertasFaktur" class="bg-white w-full max-w-2xl rounded-2xl p-8 shadow-2xl relative transform scale-95 transition-transform duration-300 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
            
            <div class="flex justify-between items-start border-b border-gray-100 pb-5">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-wide">Mandiri Jaya Diesel</h2>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mt-0.5">Spare Part Alat Berat & Press Selang</p>
                </div>
                <div class="text-right">
                    <h1 class="text-4xl font-light text-gray-300 tracking-widest uppercase">Faktur</h1>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 my-6 text-xs">
                <div class="space-y-1 text-gray-600">
                    <p><span class="font-bold text-gray-400 inline-block w-20">Pelanggan</span>: <span id="fakturPelanggan" class="font-extrabold text-gray-800"></span></p>
                    <p><span class="font-bold text-gray-400 inline-block w-20">Telp</span>: <span id="fakturTelp"></span></p>
                    <p><span class="font-bold text-gray-400 inline-block w-20">Alamat</span>: <span id="fakturAlamat" class="italic"></span></p>
                </div>
                <div class="space-y-1 text-gray-600 text-right">
                    <p><span class="font-bold text-gray-400">Nomor Faktur :</span> <span id="fakturNo" class="font-bold text-gray-800"></span></p>
                    <p><span class="font-bold text-gray-400">Tanggal :</span> <span id="fakturTanggal"></span></p>
                </div>
            </div>

            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-t border-b border-gray-200 bg-gray-50/50 text-gray-500 font-bold">
                        <th class="py-2 px-2 w-16">Kode</th>
                        <th class="py-2 px-2">Nama Produk</th>
                        <th class="py-2 px-2 w-12 text-center">Qty</th>
                        <th class="py-2 px-2 w-14">Unit</th>
                        <th class="py-2 px-2 w-24 text-right">Harga</th>
                        <th class="py-2 px-2 w-28 text-right">Total</th>
                    </tr>
                </thead>
                <tbody id="fakturTbody" class="divide-y divide-gray-100 text-gray-700 font-medium">
                    </tbody>
            </table>

            <div class="grid grid-cols-2 gap-6 items-end mt-8 border-t border-gray-100 pt-6 text-xs">
                <div>
                    <h4 class="font-bold text-gray-800 mb-1">Informasi Pembayaran</h4>
                    <p class="text-cyan-600 font-extrabold tracking-wide bg-cyan-50/50 inline-block px-3 py-1 rounded-lg">Qris</p>
                    <p id="fakturBayarText" class="text-[11px] text-gray-400 mt-1 font-medium"></p>
                </div>
                <div class="text-right space-y-1.5">
                    <div class="flex justify-between font-bold text-sm text-gray-800">
                        <span>Total</span>
                        <span id="fakturGrandTotal" class="text-base font-black"></span>
                    </div>
                    <div class="pt-8 text-center max-w-[160px] ml-auto">
                        <p class="text-[10px] text-gray-400 font-medium">Dengan Hormat,</p>
                        <div class="h-10"></div>
                        <p class="font-bold text-gray-800 border-t border-gray-200 pt-1">Mandiri Jaya Diesel</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('modalFaktur');
    const kertas = document.getElementById('kertasFaktur');

    // Fungsi Utama Membuka Pop-up & Menyuntikkan Data Transaksi
    function bukaFaktur(data) {
        document.getElementById('fakturPelanggan').innerText = data.pelanggan;
        document.getElementById('fakturTelp').innerText = data.telp;
        document.getElementById('fakturAlamat').innerText = data.alamat;
        document.getElementById('fakturNo').innerText = data.no_faktur;
        document.getElementById('fakturTanggal').innerText = data.tanggal;
        document.getElementById('fakturGrandTotal').innerText = data.total;
        document.getElementById('fakturBayarText').innerText = `Jumlah Dibayarkan : ${data.total}`;

        const tbody = document.getElementById('fakturTbody');
        tbody.innerHTML = '';
        
        data.items.forEach(item => {
            tbody.innerHTML += `
                <tr class="border-b border-gray-50">
                    <td class="py-3 px-2 text-gray-400 font-mono">${item.kode}</td>
                    <td class="py-3 px-2 font-semibold text-gray-800">${item.nama}</td>
                    <td class="py-3 px-2 text-center">${item.qty}</td>
                    <td class="py-3 px-2 text-gray-500">${item.unit}</td>
                    <td class="py-3 px-2 text-right">${item.harga}</td>
                    <td class="py-3 px-2 text-right font-bold text-gray-800">${item.subtotal}</td>
                </tr>
            `;
        });

        // Tampilkan modal dengan transisi CSS yang mulus
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            kertas.classList.remove('scale-95');
        }, 10);
    }

    // Fungsi Menutup Pop-up Ketika Mengklik Area Gelap (Luar Kertas)
    function tutupFaktur(event) {
        if (event.target === modal) {
            modal.classList.add('opacity-0');
            kertas.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }
</script>
@endpush
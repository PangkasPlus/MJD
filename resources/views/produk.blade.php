@extends('layouts.app')

@section('title', 'Manajemen Produk Suku Cadang')

@section('content')
    <div class="flex justify-between items-center shrink-0 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Daftar Produk Suku Cadang</h1>
            <p class="text-sm text-gray-500">Kelola stok, pantau kuantitas, dan hapus data inventaris toko</p>
        </div>
        <button class="bg-[#00C2E8] hover:bg-cyan-500 text-white px-5 py-2.5 rounded-2xl font-bold text-sm shadow-sm transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14m-7-7v14"/></svg>
            Tambah Produk
        </button>
    </div>

    <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 flex-1 overflow-y-auto custom-scroll">
        <div class="space-y-3 max-w-4xl mx-auto">
            
            @foreach($products as $product)
            <div id="product-row-{{ $product['id'] }}" class="flex items-center justify-between border border-cyan-500/100 bg-cyan-50/10 p-3 rounded-2xl hover:shadow-sm transition-all duration-300">
                
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-50 border border-gray-200 shrink-0 flex items-center justify-center">
                        <img src="{{ $product['gambar'] }}" alt="Suku Cadang MJD" class="w-full h-full object-cover">
                    </div>
                    <span class="font-semibold text-gray-700 text-sm md:text-base tracking-wide truncate pr-2">
                        {{ $product['nama'] }}
                    </span>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <div class="border border-[#00C2E8] px-5 py-2 rounded-xl bg-white min-w-[68px] text-center shadow-sm">
                        <span class="text-[#00C2E8] font-bold text-base">{{ $product['stok'] }}</span>
                    </div>

                    <button onclick="hapusProdukSimulasi({{ $product['id'] }})" class="border border-red-200 p-2.5 rounded-xl text-red-400 hover:bg-red-50 hover:text-red-500 transition-colors flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/xl" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3zm2 4h2v10h-2zm-4 0h2v10H7zm8 0h2v10h-2z"/>
                        </svg>
                    </button>
                </div>

            </div>
            @endforeach

        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Fungsi simulasi UI hapus langsung hilang dari baris
    function hapusProdukSimulasi(id) {
        if(confirm('Apakah Anda yakin ingin menghapus produk ini hingga hilang?')) {
            const row = document.getElementById(`product-row-${id}`);
            if(row) {
                row.style.opacity = '0';
                row.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    row.remove();
                }, 300);
            }
        }
    }
</script>
@endpush
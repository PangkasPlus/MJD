<header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-6 flex-shrink-0">
    <div class="text-gray-700 font-semibold text-lg">
        @if(request()->routeIs('dashboard')) Dashboard Utama
        @elseif(request()->routeIs('kategori.*')) Manajemen Kategori
        @elseif(request()->routeIs('produk.*')) Stok Produk Suku Cadang
        @elseif(request()->routeIs('penjualan.*')) Transaksi Penjualan
        @elseif(request()->routeIs('user.*')) Kelola Pengguna Aplikasi
        @endif
    </div>

    <div class="flex items-center space-x-4">
        <div class="text-right">
            <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->nama }}</div>
            @if(Auth::user()->role === 'admin')
                <span class="inline-block px-2 py-0.5 text-[10px] uppercase font-bold tracking-wider rounded-full bg-teal-100 text-teal-800">
                    Admin
                </span>
            @else
                <span class="inline-block px-2 py-0.5 text-[10px] uppercase font-bold tracking-wider rounded-full bg-purple-100 text-purple-800">
                    Kasir
                </span>
            @endif
        </div>

        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm" style="background-color: var(--primary);">
            {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
        </div>
    </div>
</header>
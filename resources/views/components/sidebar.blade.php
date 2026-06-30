<aside class="w-[200px] text-white flex flex-col flex-shrink-0 min-h-screen" style="background-color: var(--sidebar);">
    <div class="h-16 flex items-center px-6 border-b border-teal-800 font-bold text-sm tracking-wider uppercase">
        MJD SIM
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-cyan-500 text-white font-semibold' : 'text-teal-100 hover:bg-teal-800' }}">
            Dashboard
        </a>
        <a href="{{ route('kategori.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('kategori.*') ? 'bg-cyan-500 text-white font-semibold' : 'text-teal-100 hover:bg-teal-800' }}">
            Kategori
        </a>
        <a href="{{ route('produk.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('produk.*') ? 'bg-cyan-500 text-white font-semibold' : 'text-teal-100 hover:bg-teal-800' }}">
            Produk
        </a>
        <a href="{{ route('penjualan.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('penjualan.*') ? 'bg-cyan-500 text-white font-semibold' : 'text-teal-100 hover:bg-teal-800' }}">
            Penjualan
        </a>

        @if(Auth::user()->role === 'admin')
        <a href="{{ route('user.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('user.*') ? 'bg-cyan-500 text-white font-semibold' : 'text-teal-100 hover:bg-teal-800' }}">
            Kelola User
        </a>
        @endif
    </nav>

    <div class="p-4 border-t border-teal-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-red-300 hover:bg-red-900 hover:text-white transition-colors">
                Keluar
            </button>
        </form>
    </div>
</aside>
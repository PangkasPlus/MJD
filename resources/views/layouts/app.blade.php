<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandiri Jaya Diesel - @yield('title', 'Dashboard')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mjdBg: '#EAF2F6',       
                        mjdTeal: '#0A5C70',     
                        mjdCyan: '#00C2E8',     
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #EAF2F6; }
        .nav-item:hover { background-color: #00C2E8; font-weight: 600; color: white !important; }
    </style>
    @stack('styles')
</head>
<body class="flex h-screen w-screen overflow-hidden bg-[#EAF2F6]">

    <div class="w-64 bg-mjdTeal h-full flex flex-col justify-between text-white p-5 shrink-0 rounded-r-[32px] shadow-xl z-20">
        <div>
            <div class="px-2 py-4 text-left font-bold text-lg tracking-wide border-b border-cyan-800/50 mb-6">
                Mandiri Jaya Diesel
            </div>
            
            <nav class="space-y-2">
    <a href="{{ route('dashboard') }}" class="nav-item {{ Request::routeIs('dashboard') ? 'bg-mjdCyan text-white font-semibold' : 'text-cyan-100 hover:text-white font-medium' }} flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M5 12H3l9-9l9 9h-2M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7" />
              <path d="M9 21v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6" />
            </g>
        </svg> Beranda
    </a>

    <a href="{{ route('produk') }}" class="nav-item {{ Request::routeIs('produk') ? 'bg-mjdCyan text-white font-semibold' : 'text-cyan-100 hover:text-white font-medium' }} flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 48 48">
            <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                <path d="M44 14L24 4L4 14v20l20 10l20-10z" />
                <path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19" />
            </g>
        </svg> Produk
    </a>

    <a href="{{ route('penjualan') }}" class="nav-item {{ Request::routeIs('penjualan') ? 'bg-mjdCyan text-white font-semibold' : 'text-cyan-100 hover:text-white font-medium' }} flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 32 32">
            <path fill="currentColor" d="M10 18h8v2h-8zm0-5h12v2H10zm0 10h5v2h-5z" />
            <path fill="currentColor" d="M25 5h-3V4a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v1H7a2 2 0 0 0-2 2v21a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2M12 4h8v4h-8Zm13 24H7V7h3v3h12V7h3Z" />
        </svg> Penjualan
    </a>

    <a href="{{ route('kategori') }}" class="nav-item {{ Request::routeIs('kategori') ? 'bg-mjdCyan text-white font-semibold' : 'text-cyan-100 hover:text-white font-medium' }} flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <circle cx="17" cy="7" r="3" />
                <circle cx="7" cy="17" r="3" />
                <path d="M14 14h6v5a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zM4 4h6v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z" />
            </g>
        </svg> Kategori
    </a>
</nav>
        </div>

        <div class="flex flex-col items-start gap-4 w-full">
            <div class="flex flex-col gap-3 ml-2 relative">
                <div id="paymentGroup" class="flex flex-col gap-3 transition-all duration-300 transform scale-y-0 origin-bottom opacity-0 h-0 overflow-hidden">
                    <button class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg text-gray-700 hover:bg-gray-100 transition-transform active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M4 4h4V2H4c-1.1 0-2 .9-2 2v4h2zm0 12H2v4c0 1.1.9 2 2 2h4v-2H4zm16 4h-4v2h4c1.1 0 2-.9 2-2v-4h-2zm0-18h-4v2h4v4h2V4c0-1.1-.9-2-2-2m-10.5 3h-3C5.67 5 5 5.67 5 6.5v3c0 .83.67 1.5 1.5 1.5h3c.83 0 1.5-.67 1.5-1.5v-3c0-.83-.67-1.5-1.5-1.5M9 9H7V7h2zm.5 4h-3c-.83 0-1.5.67-1.5 1.5v3c0 .83.67 1.5 1.5 1.5h3c.83 0 1.5-.67 1.5-1.5v-3c0-.83-.67-1.5-1.5-1.5M9 17H7v-2h2zm5.5-6h3c.83 0 1.5-.67 1.5-1.5v-3c0-.83-.67-1.5-1.5-1.5h-3c-.83 0-1.5.67-1.5 1.5v3c0 .83.67 1.5 1.5 1.5m.5-4h2v2h-2zm-2 6h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z"/></svg>
                    </button>
                    <button class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg text-gray-700 hover:bg-gray-100 transition-transform active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 512 512"><path fill="currentColor" d="M432 64H16v320h416Zm-32 288H48V96h352Z"/><path fill="currentColor" d="M464 144v272H96v32h400V144zM224 302.46c39.7 0 72-35.137 72-78.326s-32.3-78.326-72-78.326s-72 35.136-72 78.326s32.3 78.326 72 78.326m0-124.652c22.056 0 40 20.782 40 46.326s-17.944 46.326-40 46.326s-40-20.782-40-46.326s17.944-46.326 40-46.326M80 136h32v176H80zm256 0h32v176h-32z"/></svg>
                    </button>
                </div>
                <button onclick="togglePaymentIcons()" class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg text-gray-700 hover:bg-gray-100 focus:outline-none transition-transform active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16"><path fill="currentColor" d="M10.5 10a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zM1 5.5A2.5 2.5 0 0 1 3.5 3h9A2.5 2.5 0 0 1 15 5.5v5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 10.5zM14 6v-.5A1.5 1.5 0 0 0 12.5 4h-9A1.5 1.5 0 0 0 2 5.5V6zM2 7v3.5A1.5 1.5 0 0 0 3.5 12h9a1.5 1.5 0 0 0 1.5-1.5V7z"/></svg>
                </button>
            </div>

            <form id="global-logout-form" action="{{ route('logout') }}" method="POST" class="w-full pt-4 border-t border-cyan-800/50">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 text-red-300 hover:text-red-400 font-semibold text-sm px-2 py-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 18.25a.75.75 0 0 0 0 1.5h6A1.75 1.75 0 0 0 19.75 18V6A1.75 1.75 0 0 0 18 4.25h-6a.75.75 0 0 0 0 1.5h6a.25.25 0 0 1 .25.25v12a.25.25 0 0 1-.25.25z"/><path fill="currentColor" fill-rule="evenodd" d="M14.503 14.365c.69 0 1.25-.56 1.25-1.25v-2.24c0-.69-.56-1.25-1.25-1.25H9.89l-.02-.22l-.054-.556a1.227 1.227 0 0 0-1.751-.988a15 15 0 0 0-4.368 3.164l-.099.103a1.253 1.253 0 0 0 0 1.734l.1.103a15 15 0 0 0 4.367 3.164a1.227 1.227 0 0 0 1.751-.988l.054-.556l.02-.22zm-5.308-1.5a.75.75 0 0 0-.748.704q-.028.435-.07.871l-.016.162a13.6 13.6 0 0 1-3.516-2.607a13.6 13.6 0 0 1 3.516-2.607l.016.162q.042.435.07.871a.75.75 0 0 0 .748.704h5.058v1.74z" clip-rule="evenodd"/></svg> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 h-full overflow-y-auto p-8 space-y-8 flex flex-col">
        @yield('content')
    </div>

    <script>
        let paymentOpen = false;
        function togglePaymentIcons() {
            const group = document.getElementById('paymentGroup');
            paymentOpen = !paymentOpen;
            if (paymentOpen) {
                group.style.height = "auto"; group.style.transform = "scaleY(1)"; group.style.opacity = "1"; group.style.marginBottom = "8px";
            } else {
                group.style.transform = "scaleY(0)"; group.style.opacity = "0"; group.style.height = "0"; group.style.marginBottom = "0px";
            }
        }

        const WAKTU_TUNGGU = 5 * 60 * 1000; 
        let timerInaktif;
        function lakukanLogoutOtomatis() {
            alert('Sesi Anda telah berakhir karena tidak ada aktivitas. Silakan masuk kembali.');
            document.getElementById('global-logout-form').submit();
        }
        function resetTimerAktivitas() {
            clearTimeout(timerInaktif);
            timerInaktif = setTimeout(lakukanLogoutOtomatis, WAKTU_TUNGGU);
        }
        window.onload = resetTimerAktivitas;
        window.onmousemove = resetTimerAktivitas;
        window.onmousedown = resetTimerAktivitas;
        window.ontouchstart = resetTimerAktivitas;
        window.onclick = resetTimerAktivitas;
        window.onkeydown = resetTimerAktivitas;
        window.addEventListener('scroll', resetTimerAktivitas, true);
    </script>
    @stack('scripts')
</body>
</html>
@extends('layouts.app')

@section('title', 'Dashboard Utama')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    </style>
@endpush

@section('content')
    <div class="flex justify-between items-center shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Utama</h1>
            <p class="text-sm text-gray-500">Selamat datang kembali di sistem Mandiri Jaya Diesel</p>
        </div>
        <button class="bg-white border border-cyan-100 text-gray-700 px-6 py-2.5 rounded-2xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-colors">
            Cetak Laporan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 shrink-0">
        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Produk</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">120</h3>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 text-xl">📦</div>
        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">12  </h3>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 text-xl">🏷️</div>
        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Transaksi Hari Ini</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">15</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 text-xl">🛒</div>
        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-red-100 bg-red-50/30 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-red-400 uppercase tracking-wider">Stok Kritis (&lt;= Minimum)</p>
                <h3 class="text-3xl font-bold text-red-600 mt-1">4</h3>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-500 text-xl">⚠️</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 lg:col-span-2">
            <div class="mb-4">
                <h3 class="text-base font-bold text-gray-800">Grafik Omset Penjualan Bulanan</h3>
                <p class="text-xs text-gray-400">Menampilkan tren pendapatan dari transaksi suku cadang</p>
            </div>
            <div class="h-64 relative w-full">
                <canvas id="chartOmset"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 h-full flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-bold text-gray-800">Pemberitahuan Stok</h3>
                    <button class="text-xs bg-emerald-500 text-white font-bold px-3 py-1 rounded-full hover:bg-emerald-600 transition-colors">Kelola Stok</button>
                </div>
                <div class="space-y-3 custom-scroll overflow-y-auto max-h-52 pr-1">
                    <div class="p-3 bg-red-50 border border-red-100 rounded-xl flex items-center justify-between">
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Filter Oli Cat 320D</h4>
                            <p class="text-[10px] text-red-500 font-medium mt-0.5">Kritis : Tersisa 3 Unit</p>
                        </div>
                        <span class="text-red-400 text-sm">⚠️</span>
                    </div>
                    <div class="p-3 bg-red-50 border border-red-100 rounded-xl flex items-center justify-between">
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Selang I Inc</h4>
                            <p class="text-[10px] text-red-500 font-medium mt-0.5">Kritis : Tersisa 1 Meter</p>
                        </div>
                        <span class="text-red-400 text-sm">⚠️</span>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 border-t border-gray-100 mt-4">
                <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                    <span>Pertumbuhan Pelanggan</span>
                    <span class="text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-md">46%</span>
                </div>
                <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-emerald-400 h-full w-[46%] rounded-full"></div>
                </div>
                <p class="text-[11px] text-gray-400 mt-1.5 font-medium">👥 143.157 (+32 user baru)</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full">
        
        <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 w-full">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-base font-bold text-gray-800">Analisis Suku Cadang Hose</h3>
                <div class="flex gap-2 text-gray-400 font-bold text-sm">
                    <button class="hover:text-gray-600">&lt;</button>
                    <button class="hover:text-gray-600">&gt;</button>
                </div>
            </div>
            <div class="h-[380px] relative w-full">
                <canvas id="chartHose"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 w-full flex flex-col">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-base font-bold text-gray-800 leading-tight">Kategori Penjualan<br>Produk</h3>
                <select class="bg-gray-100/80 text-[10px] font-semibold text-gray-500 px-2.5 py-1 rounded-md border-none outline-none cursor-pointer">
                    <option>1 Bulan Terakhir</option>
                </select>
            </div>

            <div class="space-y-4 flex-1 flex flex-col justify-center pb-4">
                @php
                    // Struktur data & style warna background sesuai visualisasi mockup figma Anda
                    $kategoriFigma = [
                        ['nama' => 'Maguro', 'persen' => 27, 'wClass' => 'w-[27%]', 'bg' => 'bg-indigo-50', 'active' => false],
                        ['nama' => 'Donaldson', 'persen' => 23, 'wClass' => 'w-[23%]', 'bg' => 'bg-cyan-50/60', 'active' => false],
                        ['nama' => 'Lieber', 'persen' => 20, 'wClass' => 'w-[35%]', 'bg' => 'bg-[#00C2E8]', 'active' => true], // Sorotan Utama Cyan
                        ['nama' => 'Cat', 'persen' => 15, 'wClass' => 'w-[15%]', 'bg' => 'bg-indigo-50', 'active' => false],
                        ['nama' => 'Zaxsis', 'persen' => 10, 'wClass' => 'w-[10%]', 'bg' => 'bg-cyan-50/60', 'active' => false],
                        ['nama' => 'CorelDRAW', 'persen' => 5, 'wClass' => 'w-[5%]', 'bg' => 'bg-indigo-50', 'active' => false],
                    ];
                @endphp

                @foreach($kategoriFigma as $item)
                <div class="grid grid-cols-12 items-center text-xs">
                    <div class="col-span-3 font-medium text-gray-500 text-left">
                        {{ $item['nama'] }}
                    </div>
                    
                    <div class="col-span-9 bg-cyan-50/20 h-14 rounded-xl flex items-center justify-center relative border border-dashed border-cyan-100/30">
                        <div class="h-10 rounded-lg flex items-center justify-center transition-all duration-500 {{ $item['wClass'] }} {{ $item['bg'] }} {{ $item['active'] ? 'shadow-md shadow-cyan-200' : '' }}">
                            <span class="text-xs font-bold {{ $item['active'] ? 'text-white' : 'text-gray-600' }}">
                                {{ $item['persen'] }}%
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Render Grafik Transaksi Penjualan Menggunakan ChartJS
        const ctx = document.getElementById('chartOmset').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: [220, 400, 520, 710, 380, 210, 880, 420, 910, 760, 230, 600],
                        backgroundColor: '#26DE81',
                        borderRadius: 6,
                    },
                    {
                        label: 'Pengeluaran',
                        data: [710, 510, 550, 680, 500, 390, 780, 720, 710, 610, 500, 410],
                        backgroundColor: '#FF6B6B',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                },
                scales: {
                    y: { beginAtZero: true, grid: { display: true, drawBorder: false }, ticks: { font: { size: 10 } } },
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });

        // Render Grafik Horizontal "Hose" Sesuai Struktur Figma
        const ctxHose = document.getElementById('chartHose').getContext('2d');
        new Chart(ctxHose, {
            type: 'bar',
            data: {
                labels: ['Maguro', 'Donaldson', 'Lieber', 'Cat', 'Zaxsis', 'CorelDRAW', 'InDesign', 'Canva', 'Webflow', 'Affinity', 'Marker', 'Figma'],
                datasets: [{
                    data: [77.68, 62.56, 60.78, 59.62, 59.34, 52.58, 52.42, 41.50, 29.49, 25.12, 21.54, 13.52],
                    backgroundColor: [
                        '#FF9F9F', '#9F9FFF', '#00C2E8', '#ECA1F5', '#F5D742', 
                        '#C2F542', '#F59F9F', '#79D7F5', '#3BF574', '#9F79F5', '#7982F5', '#79D7F5'
                    ],
                    borderRadius: 20,
                    borderSkipped: false,
                    barThickness: 12
                }]
            },
            options: {
                indexAxis: 'y', // Membalik chart menjadi horizontal
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { max: 100, grid: { borderDash: [4, 4] }, ticks: { font: { size: 10 } } },
                    y: { grid: { display: false }, ticks: { font: { size: 11, weight: 'bold' } } }
                }
            }
        });
    </script>
@endpush
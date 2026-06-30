<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Produk</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProduk }}</h3>
            </div>
            <div class="p-3 rounded-lg bg-teal-50 text-teal-600">
                📦
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalKategori }}</h3>
            </div>
            <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                🏷️
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Transaksi Hari Ini</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $transaksiHariIni }}</h3>
            </div>
            <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                🛒
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center justify-between {{ $stokKritis > 0 ? 'border-red-300 bg-red-50/50' : '' }}">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok Kritis (<= Minimum)</p>
                <h3 class="text-3xl font-bold {{ $stokKritis > 0 ? 'text-red-600' : 'text-gray-800' }} mt-1">{{ $stokKritis }}</h3>
            </div>
            <div class="p-3 rounded-lg {{ $stokKritis > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }}">
                ⚠️
            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <div class="mb-4">
            <h3 class="text-base font-bold text-gray-800">Grafik Omset Penjualan Bulanan</h3>
            <p class="text-xs text-gray-500">Menampilkan tren pendapatan dari transaksi suku cadang</p>
        </div>
        <div class="h-[300px] w-full">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            // Ambil data array dari PHP Controller
            const labels = {!! json_encode($labels) !!};
            const dataTotals = {!! json_encode($totals) !!};

            // Jika data kosong (karena proyek baru), pasang data dummy agar chart tidak kosong melongpong
            const finalLabels = labels.length > 0 ? labels : ['Juni 2026'];
            const finalData = dataTotals.length > 0 ? dataTotals :;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: finalLabels,
                    datasets: [{
                        label: 'Total Omset (Rp)',
                        data: finalData,
                        borderColor: '#534AB7', // Warna utama dari design system kamu
                        backgroundColor: 'rgba(83, 74, 183, 0.05)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#1D9E75' // Aksen sekunder untuk point chart
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
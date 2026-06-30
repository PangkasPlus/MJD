<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP - SIM Mandiri Jaya Diesel</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Menghilangkan arrow up/down bawaan browser di input type number */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="antialiased bg-[#1AD1FA] min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="bg-white rounded-[24px] shadow-2xl shadow-cyan-900/40 w-full max-w-[400px] p-6 md:p-8 relative flex flex-col transition-all">
        
        <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600 transition-colors mb-6 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>
        
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Cek Email</h2>
        <p class="text-xs text-gray-500 leading-relaxed mb-8">
            Kami telah mengirimkan kode ke <span class="font-bold text-gray-800">ahmad*******@gmail.com</span>, masukkan kode 5 digit yang disebutkan dalam email
        </p>
        
        @if ($errors->has('otp'))
            <div class="w-full bg-red-50 text-red-600 p-3 rounded-lg text-xs mb-4 border border-red-200 text-center">
                {{ $errors->first('otp') }}
            </div>
        @endif
        <form method="POST" action="{{ route('otp.verify') }}" class="w-full flex flex-col items-center">
            @csrf
            
            <div class="flex justify-between w-full gap-2 mb-8">
                <input type="number" name="otp[]" maxlength="1" oninput="moveNext(this, 'otp2')" id="otp1" class="w-12 h-12 md:w-14 md:h-14 text-center text-lg font-semibold border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] focus:border-[#1AD1FA] shadow-sm transition-all" required>
                <input type="number" name="otp[]" maxlength="1" oninput="moveNext(this, 'otp3')" id="otp2" class="w-12 h-12 md:w-14 md:h-14 text-center text-lg font-semibold border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] focus:border-[#1AD1FA] shadow-sm transition-all" required>
                <input type="number" name="otp[]" maxlength="1" oninput="moveNext(this, 'otp4')" id="otp3" class="w-12 h-12 md:w-14 md:h-14 text-center text-lg font-semibold border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] focus:border-[#1AD1FA] shadow-sm transition-all" required>
                <input type="number" name="otp[]" maxlength="1" oninput="moveNext(this, 'otp5')" id="otp4" class="w-12 h-12 md:w-14 md:h-14 text-center text-lg font-semibold border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] focus:border-[#1AD1FA] shadow-sm transition-all" required>
                <input type="number" name="otp[]" maxlength="1" id="otp5" class="w-12 h-12 md:w-14 md:h-14 text-center text-lg font-semibold border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] focus:border-[#1AD1FA] shadow-sm transition-all" required>
            </div>
            
            <button type="submit" class="w-full bg-[#00B4D8] hover:bg-[#0096B4] text-white py-3 rounded-xl font-medium text-sm text-center shadow-lg transition-all active:scale-[0.98] mb-6">
                Verifikasi
            </button>
            
            <p class="text-xs text-gray-500">
                Belum dapat Email? <a href="#" class="text-blue-500 hover:underline font-medium">Kirim Ulang</a>
            </p>
        </form>
    </div>

    <div id="error-overlay" class="error-overlay" style="display: none;">
    <div class="error-message">OTP Salah! Silakan coba lagi.</div>
</div>

<div id="success-overlay" class="success-overlay" style="display: none;">
    <div class="checkmark-circle">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark-circle-svg" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    </div>
</div>

<style>
/* --- STYLING LAYAR BIRU (OTP SALAH) --- */
.error-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #007bff; /* Biru cerah */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.error-message {
    color: #ff3333; /* Teks merah */
    font-size: 2rem;
    font-weight: bold;
    font-family: sans-serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* --- STYLING CENTANG POPPING OUT (OTP BENAR) --- */
.success-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(255, 255, 255, 0.8); /* Latar transparan agar fokus ke animasi */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.checkmark-circle {
    width: 100px;
    height: 100px;
    background-color: #007bff; /* Lingkaran biru cerah */
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    /* Animasi popout selama 1.5 detik sesuai dokumen */
    animation: popout 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; 
}
.checkmark {
    width: 60px;
    height: 60px;
    stroke: #ffffff; /* Warna centang putih di dalam lingkaran biru */
    stroke-width: 5;
    stroke-linecap: round;
    stroke-linejoin: round;
}

/* Keyframes untuk efek membesar dari tengah layar */
@keyframes popout {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2); /* Sedikit membesar melewati batas */
        opacity: 1;
    }
    100% {
        transform: scale(1); /* Kembali ke ukuran normal */
        opacity: 1;
    }
}
</style>

    <script>
        function moveNext(current, nextId) {
            if (current.value.length >= 1) {
                document.getElementById(nextId).focus();
            }
        }

        document.getElementById('otp-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah reload halaman bawaan form

    let formData = new FormData(this);
    let actionUrl = this.getAttribute('action');

    fetch(actionUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // 1. Munculkan overlay sukses
            document.getElementById('success-overlay').style.display = 'flex';
            
            // 2. Redirect otomatis ke dashboard setelah animasi selesai (1.5 detik)
            setTimeout(() => {
                window.location.href = data.redirect_url;
            }, 1500);
        } else {
            // 1. Munculkan overlay layar biru
            let errorOverlay = document.getElementById('error-overlay');
            errorOverlay.style.display = 'flex';
            
            // 2. Sembunyikan kembali setelah 2 detik agar user bisa mengulang input
            setTimeout(() => {
                errorOverlay.style.display = 'none';
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
    </script>
</body>
</html>
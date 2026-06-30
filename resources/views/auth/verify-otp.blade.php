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

        /* --- STYLING LAYAR BIRU (OTP SALAH) --- */
        .error-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #1AD1FA; /* Mengikuti warna background utama */
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .error-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }
        .error-text {
            color: #ff3333;
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 24px;
            line-height: 1.5;
        }
        .btn-retry {
            background-color: #1AD1FA;
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            width: 100%;
            transition: all 0.2s;
        }
        .btn-retry:hover {
            opacity: 0.9;
        }

        /* --- STYLING CENTANG POPPING OUT (OTP BENAR) --- */
        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #ffffff;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .checkmark-circle {
            width: 120px;
            height: 120px;
            background-color: #e6f0ff;
            border: 2px solid #a3c9ff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: popout 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; 
        }
        .checkmark-icon {
            font-size: 3.5rem;
            color: #3b82f6;
        }

        @keyframes popout {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>

<body class="antialiased bg-[#1AD1FA] min-h-screen flex items-center justify-center p-4 md:p-8">

    <div id="error-overlay" class="error-overlay">
        <div class="error-card">
            <p class="error-text">Kode yang dimasukkan salah.<br>Tolong coba lagi</p>
            <button type="button" class="btn-retry" onclick="closeOverlay()">Coba Lagi</button>
        </div>
    </div>

    <div id="success-overlay" class="success-overlay">
        <div class="checkmark-circle">
            <span class="checkmark-icon">&#10003;</span>
        </div>
    </div>

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

        <form id="formOtp" action="{{ route('otp.submit') }}" method="POST">
            @csrf
            <div class="otp-container flex gap-2.5 justify-center mb-6">
                <input type="text" class="otp-input w-12 h-12 md:w-14 md:h-14 text-center font-bold text-xl border-2 border-[#3bc5e7] rounded-xl focus:outline-none transition-colors" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" class="otp-input w-12 h-12 md:w-14 md:h-14 text-center font-bold text-xl border-2 border-gray-200 rounded-xl focus:outline-none transition-colors" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" class="otp-input w-12 h-12 md:w-14 md:h-14 text-center font-bold text-xl border-2 border-gray-200 rounded-xl focus:outline-none transition-colors" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" class="otp-input w-12 h-12 md:w-14 md:h-14 text-center font-bold text-xl border-2 border-gray-200 rounded-xl focus:outline-none transition-colors" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" class="otp-input w-12 h-12 md:w-14 md:h-14 text-center font-bold text-xl border-2 border-gray-200 rounded-xl focus:outline-none transition-colors" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
            </div>

            <input type="hidden" name="otp_code" id="hiddenOtp">

            <button type="submit" class="w-full bg-[#1AD1FA] text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-cyan-400/20 hover:bg-[#15b3d6] transition-colors text-center text-sm md:text-base mt-2">
                Verifikasi
            </button>
        </form>

        <div class="text-center mt-6">
            <p class="text-xs text-gray-500">Belum dapat Email? <a href="#" class="text-blue-500 font-medium hover:underline">Kirim Ulang</a></p>
        </div>
    </div>

    <script>
        // Jalankan script setelah seluruh DOM selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll('.otp-input');
            const hiddenOtp = document.getElementById('hiddenOtp');

            inputs.forEach((input, index) => {
                // Event saat mengetik angka
                input.addEventListener('input', (e) => {
                    if (!/^[0-9]$/.test(input.value)) {
                        input.value = '';
                        return;
                    }

                    // Reset semua border ke default dahulu, lalu beri warna biru untuk input aktif selanjutnya
                    if (input.value !== '' && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                        inputs.forEach(i => i.style.borderColor = '#e2e8f0');
                        inputs[index + 1].style.borderColor = '#3bc5e7';
                    }
                    
                    updateHiddenInput();
                });

                // Event saat menghapus mundur dengan Backspace
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace') {
                        if (input.value === '' && index > 0) {
                            inputs[index - 1].focus();
                            inputs.forEach(i => i.style.borderColor = '#e2e8f0');
                            inputs[index - 1].style.borderColor = '#3bc5e7';
                        } else {
                            input.value = '';
                        }
                        updateHiddenInput();
                    }
                });
            });

            function updateHiddenInput() {
                let code = '';
                inputs.forEach(input => {
                    code += input.value;
                });
                hiddenOtp.value = code;
            }

            // AJAX handling submit form
            document.getElementById('formOtp').addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const errorOverlay = document.getElementById('error-overlay');
                const successOverlay = document.getElementById('success-overlay');

                fetch(this.action || window.location.href, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        successOverlay.style.display = 'flex';
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    } else {
                        errorOverlay.style.display = 'flex';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        function closeOverlay() {
            document.getElementById('error-overlay').style.display = 'none';
            // Reset isi kotak otp ketika gagal agar user bisa mengetik ulang dengan bersih
            const inputs = document.querySelectorAll('.otp-input');
            inputs.forEach((input, index) => {
                input.value = '';
                input.style.borderColor = index === 0 ? '#3bc5e7' : '#e2e8f0';
            });
            if(inputs[0]) inputs[0].focus();
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - SIM Mandiri Jaya Diesel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="antialiased bg-[#1AD1FA] min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="bg-white rounded-[24px] shadow-2xl shadow-cyan-900/40 w-full max-w-[380px] md:max-w-[420px] p-6 md:p-8 relative flex flex-col items-center transition-all">
        
        <button class="absolute top-5 right-6 text-gray-400 hover:text-gray-600 transition-colors text-xl font-bold">&times;</button>
        
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 mb-6 md:mb-8 mt-2 tracking-wide text-center">Masuk</h2>
        
        @if ($errors->any())
            <div class="w-full bg-red-50 text-red-600 p-3 rounded-lg text-xs mb-4 border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}" class="w-full space-y-4">
            @csrf
            
            <div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus class="w-full px-4 py-2.5 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] transition-all">
            </div>
            
            <div class="relative">
                <input type="password" id="passwordField" name="password" placeholder="Passsword" required class="w-full px-4 py-2.5 pr-11 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1AD1FA] transition-all">
                
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center justify-center focus:outline-none">
                    <svg id="eyeIcon" class="w-5 h-5 text-[#5A0B1A]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3" fill="#5A0B1A"></circle>
                    </svg>
                </button>
            </div>
            
            <div class="pt-2 flex justify-center">
                <button type="submit" class="w-[180px] md:w-[200px] bg-[#00B4D8] hover:bg-[#0096B4] text-white py-2.5 rounded-full font-medium text-sm text-center shadow-lg transition-all active:scale-95">Masuk</button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>
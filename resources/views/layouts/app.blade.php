<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIM Mandiri Jaya Diesel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #534AB7;
            --secondary: #1D9E75;
            --bg-page: #F1EFE8;
            --sidebar: #1a5f6e;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-page);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex m-0 p-0 overflow-hidden">

    @include('components.sidebar')

    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        
        @include('components.topbar')

        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
@extends('layouts.app')

@section('title', 'Daftar Kategori Suku Cadang')

@section('content')
    <div class="shrink-0 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Kategori Produk</h1>
        <p class="text-sm text-gray-500">Daftar rumpun klasifikasi suku cadang aktif di sistem Mandiri Jaya Diesel</p>
    </div>

    <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 flex-1 overflow-y-auto custom-scroll">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto py-2">
            @foreach($categories as $category)
            <div class="bg-white border border-cyan-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:border-cyan-300 transition-all flex flex-col items-center p-4">
                
                <div class="w-full aspect-square max-h-[180px] bg-gray-50 rounded-xl overflow-hidden border border-gray-100 flex items-center justify-center">
                    <img src="{{ $category['gambar'] }}" alt="{{ $category['nama'] }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>

                <div class="w-full text-center pt-4 pb-1">
                    <span class="font-bold text-gray-700 text-sm md:text-base tracking-wide block truncate">
                        {{ $category['nama'] }}
                    </span>
                </div>

            </div>
            @endforeach
        </div>

    </div>
@endsection
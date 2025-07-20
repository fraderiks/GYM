@extends('gym')

@section('content')
{{-- Menambahkan warna latar belakang lembut untuk seluruh halaman --}}
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 leading-tight">Admin Dashboard</h1>
            <p class="text-gray-500 mt-1">Pilih salah satu bagian untuk dikelola.</p>
        </div>

        {{-- Menggunakan Grid untuk tata letak Card yang responsif --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Card untuk Kategori --}}
            <a href="{{ route('admin.category.index') }}" class="block p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        {{-- Ikon untuk Kategori --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Kelola Kategori</h3>
                        <p class="text-gray-500 text-sm">Tambah, edit, atau hapus kategori</p>
                    </div>
                </div>
            </a>

            {{-- Contoh Card lain (bisa ditambahkan di masa depan) --}}
            <div class="block p-6 bg-white rounded-xl shadow-md cursor-not-allowed opacity-50">
                 <div class="flex items-center">
                    <div class="bg-gray-100 p-3 rounded-lg">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Kelola Produk</h3>
                        <p class="text-gray-500 text-sm">Segera hadir...</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<!-- resources/views/admin/index.blade.php -->

@extends('gym') 

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center"> 
    <div class="container mx-auto px-4 sm:px-8 py-12 max-w-5xl"> 
        <div class="mb-10 text-center"> 
            <h1 class="text-4xl font-extrabold text-gray-800 leading-tight">Admin Dashboard</h1> 
            <p class="text-gray-600 mt-2 text-lg">Pilih salah satu bagian untuk dikelola.</p> 
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8"> 


            <a href="{{ route('admin.edit_programs') }}" class="block p-10 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1"> {{-- Increased padding, shadow, and added hover effect --}}
                <div class="flex flex-col items-center text-center"> 
                    <div class="bg-purple-100 p-5 rounded-full mb-4"> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> {{-- Increased icon size --}}
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Edit Program</h3> 
                    <p class="text-gray-600 text-base">Ubah detail program yang sudah ada</p> 
                </div>
            </a>

            <a href="{{ route('admin.members.manage') }}" class="block p-10 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1"> {{-- Increased padding, shadow, and added hover effect --}}
                <div class="flex flex-col items-center text-center"> 
                    <div class="bg-red-100 p-5 rounded-full mb-4"> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> {{-- Increased icon size --}}
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857M9 20v-2a3 3 0 00-3-3H4a3 3 0 00-3 3v2m3-3h.01M6 15h.01M12 10a2 2 0 11-4 0 2 2 0 014 0zm0 0V8m0 4v2m0 0h2m-2 0H8"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Edit Member</h3> 
                    <p class="text-gray-600 text-base">Ubah informasi anggota gym</p> 
                </div>
            </a>

        </div>
    </div>
</div>
@endsection

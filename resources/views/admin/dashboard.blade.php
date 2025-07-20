

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white p-8 rounded-lg shadow-xl">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">
            Admin Dashboard
        </h2>
        <p class="text-center text-gray-600 mb-8">Pilih salah satu bagian untuk dikelola.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">

            <a href="{{ route('admin.category.index') }}" class="block bg-blue-500 hover:bg-blue-600 transition-all duration-300 rounded-lg shadow-md p-6 text-white text-center flex flex-col items-center justify-center transform hover:scale-105">
                <div class="text-4xl mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kelola Kategori</h3>
                <p class="text-sm opacity-90">Tambah, edit, atau hapus kategori</p>
            </a>
            <a href="{{ route('admin.programs.recommend') }}" class="block bg-green-500 hover:bg-green-600 transition-all duration-300 rounded-lg shadow-md p-6 text-white text-center flex flex-col items-center justify-center transform hover:scale-105">
                <div class="text-4xl mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kelola Program</h3>
                <p class="text-sm opacity-90">Tambah, edit, atau hapus program</p>
            </a>

            <a href="{{ route('admin.edit_programs') }}" class="block bg-purple-500 hover:bg-purple-600 transition-all duration-300 rounded-lg shadow-md p-6 text-white text-center flex flex-col items-center justify-center transform hover:scale-105">
                <div class="text-4xl mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Edit Program</h3>
                <p class="text-sm opacity-90">Ubah detail program yang sudah ada</p>
            </a>

            <a href="{{ route('admin.members.manage') }}" class="block bg-red-500 hover:bg-red-600 transition-all duration-300 rounded-lg shadow-md p-6 text-white text-center flex flex-col items-center justify-center transform hover:scale-105">
                <div class="text-4xl mb-3">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857M9 20v-2a3 3 0 00-3-3H4a3 3 0 00-3 3v2m3-3h.01M6 15h.01M12 10a2 2 0 11-4 0 2 2 0 014 0zm0 0V8m0 4v2m0 0h2m-2 0H8"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Edit Member</h3>
                <p class="text-sm opacity-90">Ubah informasi anggota gym</p>
            </a>
        </div>
    </div>
</div>


@endsection

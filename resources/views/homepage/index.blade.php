@extends('gym')

@section('content')
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2 text-white">🏋️‍♀️ Recommended exercise program</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($programs as $program)
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-bold"><a href="/books/{{ $program['id'] }}">{{ $program['hari'] }}</a></h3>
          <p class="text-sm text-gray-600">by {{ $program['rekomendasi'] }}</p>
        </div>
        @endforeach
      </div>
    </section>

    <!-- Gym News -->
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2 text-white">📰 Gym News</h2>
      <ul class="space-y-2">
        <li class="bg-white p-4 rounded shadow">
          <h3 class="font-bold">belum diisi</h3>
          <p class="text-sm text-gray-600">.</p>
        </li>
        <li class="bg-white p-4 rounded shadow">
          <h3 class="font-bold">belum diisi</h3>
          <p class="text-sm text-gray-600">.</p>
        </li>
      </ul>
    </section>

    <!-- Package Categories -->
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2 text-white">🗂️ Package Categories</h2>
      <div class="flex flex-wrap gap-4">
        <span class="bg-white px-4 py-2 rounded shadow">1 Bulan</span>
        <span class="bg-white px-4 py-2 rounded shadow">3 Bulan</span>
        <span class="bg-white px-4 py-2 rounded shadow">6 Bulan free 1 Bulan</span>
        <span class="bg-white px-4 py-2 rounded shadow">12 Bulan free 2 Bulan</span>
        <span class="bg-white px-4 py-2 rounded shadow">18 Bulan free 3 Bulan</span>
        <span class="bg-white px-4 py-2 rounded shadow">24 Bulan free 4 Bulan</span>
      </div>
    </section>

    @endsection
  </main>
@extends('gym')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row gap-6">

      <div class="w-full md:w-1/3">
        <img src="https://via.placeholder.com/300x450.png?text=Book+Cover" alt="Book Cover" class="rounded shadow" />
      </div>

      <div class="w-full md:w-2/3 space-y-4">
        <h2 class="text-3xl font-bold">{{ $programs->hari }}</h2>

        <div class="space-y-1 text-sm">
          <p><span class="font-semibold">Hari: </span> {{ $programs->hari }}</p>
          <p><span class="font-semibold">Nama Program:</span> {{ $programs->program_name}}</p>
          <p><span class="font-semibold">Program Latihan:</span> {{ $programs->latihan_plan}}</p>
          <p><span class="font-semibold">Tips Nutrisi:</span> {{ $programs->nutrisi_tips}}</p>
          <p><span class="font-semibold">By:</span> {{ $programs->rekomendasi }}</p>
        </div>
      </div>
    </div>
    @endsection
  </main>
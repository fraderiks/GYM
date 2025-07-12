@extends('app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row gap-6">

      <div class="w-full md:w-1/3">
        <img src="https://via.placeholder.com/300x450.png?text=Book+Cover" alt="Book Cover" class="rounded shadow" />
      </div>

      <div class="w-full md:w-2/3 space-y-4">
        <h2 class="text-3xl font-bold">{{ $book->title }}</h2>

        <div class="space-y-1 text-sm">
          <p><span class="font-semibold">Author:</span> {{ $book->author }}</p>
          <p><span class="font-semibold">Published Year:</span> {{ $book->published_year}}</p>
          <p><span class="font-semibold">Category:</span> {{ $book->category }}</p>
          <p><span class="font-semibold">ISBN:</span> {{ $book->isbn }}</p>
        </div>

        <div>
          <h3 class="text-lg font-semibold mt-4 mb-2">Excerpt</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            "{{ $book->excerpt }}"
          </p>
        </div>
      </div>
    </div>
    @endsection
  </main>
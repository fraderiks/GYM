@extends('app')

@section('content')
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2">📚 Latest Books</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($books as $book)
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-bold"><a href="/books/{{ $book['id'] }}">{{ $book['title'] }}</a></h3>
          <p class="text-sm text-gray-600">by {{ $book['author'] }}</p>
        </div>
        @endforeach
      </div>
    </section>

    <!-- News -->
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2">📰 Library News</h2>
      <ul class="space-y-2">
        <li class="bg-white p-4 rounded shadow">
          <h3 class="font-bold">New Branch Opening in South District</h3>
          <p class="text-sm text-gray-600">June 1, 2025</p>
        </li>
        <li class="bg-white p-4 rounded shadow">
          <h3 class="font-bold">Summer Reading Program Registration</h3>
          <p class="text-sm text-gray-600">Open until July 15</p>
        </li>
      </ul>
    </section>

    <!-- Book Categories -->
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2">🗂️ Book Categories</h2>
      <div class="flex flex-wrap gap-4">
        <span class="bg-white px-4 py-2 rounded shadow">Fiction</span>
        <span class="bg-white px-4 py-2 rounded shadow">Non-Fiction</span>
        <span class="bg-white px-4 py-2 rounded shadow">Technology</span>
        <span class="bg-white px-4 py-2 rounded shadow">Science</span>
        <span class="bg-white px-4 py-2 rounded shadow">Children</span>
        <span class="bg-white px-4 py-2 rounded shadow">History</span>
      </div>
    </section>

    <!-- Register as Library Member -->
    <section>
      <h2 class="text-2xl font-semibold mb-4 border-b pb-2">📝 Register as a Library Member</h2>
      <form class="bg-white p-6 rounded shadow max-w-md space-y-4">
        <div>
          <label class="block text-sm font-medium">Full Name</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Email Address</label>
          <input type="email" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Phone Number</label>
          <input type="tel" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">Register</button>
      </form>
    </section>
    @endsection
  </main>
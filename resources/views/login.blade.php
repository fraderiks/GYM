@extends('app')

@section('content')
<div class="bg-white rounded-2xl p-8 w-full max-w-sm shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login</h2>

    <form method="post" action="{{ route('authenticate') }}">
      @csrf
      <div class="mb-4">
        <label for="email" class="block text-gray-600 text-sm font-medium">Email</label>
        <input 
          id="email" 
          name="email" 
          type="email" 
          placeholder="you@example.com" 
          class="mt-1 w-full rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3" 
          required />
      </div>

      <div class="mb-6">
        <label for="password" class="block text-gray-600 text-sm font-medium">Password</label>
        <input 
          id="password" 
          name="password" 
          type="password" 
          placeholder="********" 
          class="mt-1 w-full rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3" 
          required />
      </div>

      @error('login')
      <div class="mb-6">
        <p class="text-red-500">{{ $message  }}</p>
      </div>
      @enderror

      <button 
        type="submit" 
        class="w-full rounded-xl bg-blue-600 text-white font-semibold p-3 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        Login
      </button>
    </form>
  </div>
@endsection
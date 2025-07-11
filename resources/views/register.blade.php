<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Dosage Gym</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-red-100 text-gray-800 font-sans min-h-screen flex flex-col bg-cover bg-center" style="background-image: url('foto/gym.jpg')">

  <header class="bg-red-800 text-white p-6">
    <div class="container mx-auto text-center">
      <h1 class="text-3xl font-bold">Dosage Gym</h1>
      <p class="text-sm">"Your body, your machine 💪"</p>
    </div>
  </header>

  <main class="flex-grow flex items-center justify-center">
    <div class="bg-white rounded-2xl p-8 w-full max-w-sm shadow-lg mt-10">
      <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Register</h2>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
          <label for="name" class="block text-gray-600 text-sm font-medium">Name</label>
          <input
            id="name"
            name="name"
            type="text"
            placeholder="Your Full Name"
            value="{{ old('name') }}"
            class="mt-1 w-full rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3"
            required autofocus />
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-600 text-sm font-medium">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            placeholder="you@example.com"
            value="{{ old('email') }}"
            class="mt-1 w-full rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3"
            required />
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-600 text-sm font-medium">Password</label>
          <input
            id="password"
            name="password"
            type="password"
            placeholder="********"
            class="mt-1 w-full rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3"
            required autocomplete="new-password" />
          @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="password_confirmation" class="block text-gray-600 text-sm font-medium">Confirm Password</label>
          <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            placeholder="********"
            class="mt-1 w-full rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3"
            required autocomplete="new-password" />
        </div>

        <button
          type="submit"
          class="w-full rounded-xl bg-blue-600 text-white font-semibold p-3 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
          Register
        </button>
      </form>

      <div class="mt-4 text-center text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login here</a>
      </div>

    </div>
  </main>

  <footer class="bg-grey-800 text-white text-center p-4">
    &copy; 2025 Dosage Gym. No part may be distributed without permission from Dosage Gym. All rights reserved.
  </footer>

</body>
</html>
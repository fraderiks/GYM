<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col bg-cover bg-center" style="background-image: url('foto/gym.jpg')">
  <header class="bg-gray-800 text-white py-4 px-6 relative">
    <div class="text-center">
      <h1 class="text-3xl font-bold text-white hover:text-yellow-300 transition duration-300">
        Dosage Gym
      </h1>
      <p class="text-sm italic text-white hover:text-yellow-100 transition duration-300">
        "Your body, your machine 💪"
      </p>
    </div>
  </header>

  <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Register</h2>

      <form class="mt-8 space-y-6" method="post" action="{{ route('register.submit') }}">
        @csrf

        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <div class="mt-1">
            <input
              id="name"
              name="name"
              type="text"
              placeholder="Your Full Name"
              value="{{ old('name') }}"
              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
              autofocus />
          </div>
          @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <div class="mt-1">
            <input
              id="email"
              name="email"
              type="email"
              placeholder="you@example.com"
              value="{{ old('email') }}"
              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required />
          </div>
          @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="mt-1">
            <input
              id="password"
              name="password"
              type="password"
              placeholder="********"
              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
              autocomplete="new-password" />
          </div>
          @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <div class="mt-1">
            <input
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              placeholder="********"
              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
              autocomplete="new-password" />
          </div>
          @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Register
          </button>
        </div>
      </form>

      <div class="text-sm text-center text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Login here</a>
      </div>
    </div>
  </main>

  <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
    <div class="container mx-auto">
      <p>&copy; 2025 Dosage Gym. No part may be distributed without permission from Dosage Gym. All rights reserved.</p>
      <div class="mt-2 space-x-4">
        <a href="#" aria-label="Facebook" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="X" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
      </div>
    </div>
  </footer>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>
</html>
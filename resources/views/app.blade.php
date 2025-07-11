<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library Homepage</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
  <header class="bg-blue-800 text-white p-6">
    <div class="flex">
      <div class="flex-auto container mx-auto">
        <h1 class="text-3xl font-bold">City Library</h1>
        <p class="text-sm">Explore, Learn, and Grow</p>
      </div>
      @auth
      <div class="flex-1">
        <x-auth-button :action="route('logout')" method="post" :csrf="true">Logout</x-auth-button>
      </div>
      @endauth

      @guest
      <div class="flex-1">
        <x-auth-button :action="route('login')" method="get">Login</x-auth-button>
    </div>
    @endguest
    </div>
  </header>

  <main class="container mx-auto p-6 space-y-10">
    @yield('content')
  </main>
  <footer class="bg-blue-800 text-white text-center p-4 mt-10">
    &copy; 2025 City Library. All rights reserved.
  </footer>
</body>
</html>
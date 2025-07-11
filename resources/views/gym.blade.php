<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dosage Gym</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col bg-cover bg-center" style="background-image: url('foto/gym.jpg')">
  <header class="bg-red-800 text-white p-6">
    <div class="flex">
      <div class="container mx-auto text-center">
        <h1 class="text-3xl font-bold">Dosage Gym</h1>
        <p class="text-sm">"Your body, your machine 💪"</p>
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

  <main class="container mx-auto p-6 **flex flex-col items-center justify-center flex-grow**">
    @yield('content')
  </main>

  <footer class="bg-grey-800 text-white text-center p-4 mt-10">
    &copy; 2025 Dosage Gym. No part may be distributed without permission from Dosage Gym. All rights reserved.
  </footer>
</body>
</html>
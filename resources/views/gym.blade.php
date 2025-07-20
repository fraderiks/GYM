<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dosage Gym - Your Body, Your Machine Life.</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col bg-cover bg-center" style="background-image: url('foto/gym.jpg')">

  <header class="bg-red-800 text-white py-4 px-6 relative">


    <div class="absolute right-6 top-1/2 transform -translate-y-1/2">
      @auth
        <x-auth-button :action="route('logout')" method="post" :csrf="true"
          class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-base px-5 py-2 rounded shadow-md 
                 transform transition duration-500 ease-in-out hover:bg-green-500 hover:scale-110 hover:rotate-1 hover:shadow-xl">
          Logout
        </x-auth-button>
      @endauth

      @guest
        <x-auth-button :action="route('login')" method="get"
          class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-base px-5 py-2 rounded shadow-md 
                 transform transition duration-500 ease-in-out hover:bg-green-500 hover:scale-110 hover:rotate-1 hover:shadow-xl">
          Login
        </x-auth-button>
      @endguest
    </div>

    <div class="text-center">
      <h1 class="text-3xl font-bold text-white hover:text-yellow-300 transition duration-300">
        Dosage Gym
      </h1>
      <p class="text-sm italic text-white hover:text-yellow-100 transition duration-300">
        "Your body, your machine 💪"
      </p>
    </div>
  </header>

  <main class="container mx-auto p-6 flex flex-col items-center justify-center flex-grow">
    @yield('content')
  </main>

  <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
    <div class="container mx-auto">
      <p>&copy; {{ date('Y') }} Dosage Gym. No part may be distributed without permission from Dosage Gym. All rights reserved.</p>
      <div class="mt-2 space-x-4">
        <a href="#" aria-label="Facebook" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="X" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
      </div>
    </div>
  </footer>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>
</body>
</html>

{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dosage Gym - Your Body, Your Machine Life.')</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header class="main-header">
        <div class="container">
            <h1 class="logo"><a href="{{ url('/') }}">Dosage Gym</a></h1>
            <nav class="main-nav">

                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Dosage Gym. All rights reserved.</p>
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    @yield('scripts')

</body>
</html>

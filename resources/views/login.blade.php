
@extends('layouts.app')

@section('title', 'Login to Dosage Gym')

@section('body_class', 'login-page login-body-bg')

@section('content')


    <main class="login-main">
        <div class="login-card">
            <h2>Login</h2>

            <form method="post" action="{{ route('authenticate') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="you@example.com"
                        class="form-control"
                        required
                        autofocus />
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="********"
                        class="form-control"
                        required />
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                @error('login')
                    <div class="form-group">
                        <p class="error-message">{{ $message }}</p>
                    </div>
                @enderror

                <button
                    type="submit"
                    class="btn btn-primary">
                    Login
                </button>
            </form>

            <div class="login-link-group">
                Don't have an account yet?
                <a href="{{ route('register') }}" class="login-register-link">Register here</a>
                <br> 
                <a href="{{ route('homepage.index') }}" class="login-back-link">Back to Homepage</a>
            </div>

        </div>
    </main>

@endsection

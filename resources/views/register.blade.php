{{-- resources/views/register.blade.php --}}
@extends('layouts.app') {{-- Extends the main layout for consistent header and footer --}}

@section('title', 'Register - Dosage Gym')

{{-- Applies the same body classes as the login page for consistent background and centering --}}
@section('body_class', 'login-page login-body-bg')

@section('content')

    {{-- This 'main' element will handle vertical and horizontal centering of the card --}}
    <main class="login-main">
        {{-- This 'div' will be your white, box-style container for the form --}}
        <div class="login-card">
            <h2>Register</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group"> {{-- Using the custom form-group class --}}
                    <label for="name">Name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Your Full Name"
                        value="{{ old('name') }}"
                        class="form-control" {{-- Using the custom form-control class --}}
                        required autofocus />
                    @error('name')
                        <p class="error-message">{{ $message }}</p> {{-- Using the custom error-message class --}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        class="form-control"
                        required />
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
                        required autocomplete="new-password" />
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group"> {{-- Moved margin-bottom here for consistency --}}
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="********"
                        class="form-control"
                        required autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"> {{-- Using our primary button style --}}
                    Register
                </button>
            </form>

            {{-- Using our new custom classes for the link group --}}
            <div class="login-link-group">
                Already have an account?
                <a href="{{ route('login') }}" class="login-register-link">Login here</a>
            </div>

        </div>
    </main>

@endsection
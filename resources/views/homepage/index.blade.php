{{-- resources/views/homepage/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Welcome to Dosage Gym')

@section('content')

    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <h2>Unleash Your Potential.</h2>
            <p>Personalized workouts, expert guidance, and a community that empowers you.</p>
            <a href="#packages" class="btn btn-primary">View Membership Plans</a>
        </div>
    </section>

    <section class="exercise-programs-section">
        <div class="container">
            <h3>Recommended Exercise Program</h3>
            <div class="program-cards">
                {{-- ⭐ This is where the magic happens: Loop through each program --}}
                @foreach($programs as $program)
                    <div class="program-card">
                        {{-- Use the icon_class from the database --}}
                        <i class="{{ $program->icon_class }} program-icon"></i>
                        {{-- Use the title from the database --}}
                        <h4>{{ $program->title }}</h4>
                        {{-- Use the subtitle from the database --}}
                        <p>{{ $program->subtitle }}</p>
                        {{-- Use the description from the database --}}
                        <p>{{ $program->description }}</p>
                        {{-- Use the link_url and link_text from the database --}}
                        <a href="{{ $program->link_url }}" class="learn-more-link">{{ $program->link_text }} <i class="fas fa-arrow-right"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ... (rest of your index.blade.php content, like Gym News and Membership Packages) ... --}}

    <section class="gym-news-section">
        <div class="container">
            <h3>Gym News & Updates</h3>
            <div class="news-items">
                <div class="news-item">
                    <i class="fas fa-bell news-icon"></i>
                    <div class="news-content">
                        <h4>New Equipment Arrival!</h4>
                        <p class="news-date">July 12, {{ date('Y') }}</p>
                        <p>We've added brand new dumbbells (up to 100kg!) and a state-of-the-art rowing machine. Come try them today!</p>
                        <a href="#" class="read-more-link">Read More <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="news-item">
                    <i class="fas fa-trophy news-icon"></i>
                    <div class="news-content">
                        <h4>Monthly Challenge: Plank It Out!</h4>
                        <p class="news-date">July 01, {{ date('Y') }}</p>
                        <p>Join the July "Plank It Out" challenge. Hold your longest plank and win 1 free month membership!</p>
                        <a href="#" class="read-more-link">Join Challenge <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="packages" class="package-categories-section">
        <div class="container">
            <h3>Choose Your Membership Package</h3>
            <div class="package-cards">
                <div class="package-card">
                    <h4>1 Month Flex</h4>
                    <p class="price">$50<span class="per-month">/month</span></p>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Basic Gym Access</li>
                        <li><i class="fas fa-check-circle"></i> Locker Room</li>
                        <li><i class="fas fa-times-circle"></i> Group Classes</li>
                        <li><i class="fas fa-times-circle"></i> Personal Trainer</li>
                    </ul>
                    <a href="#" class="btn btn-secondary">Select Plan</a>
                </div>
                <div class="package-card featured">
                    <span class="badge">Most Popular</span>
                    <h4>6 Months Saver</h4>
                    <p class="price">$40<span class="per-month">/month</span></p>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Full Gym Access</li>
                        <li><i class="fas fa-check-circle"></i> All Group Classes</li>
                        <li><i class="fas fa-check-circle"></i> Locker Room</li>
                        <li><i class="fas fa-check-circle"></i> 1 Free PT Session</li>
                    </ul>
                    <a href="#" class="btn btn-primary">Select Plan</a>
                </div>
                <div class="package-card">
                    <h4>24 Months Ultimate</h4>
                    <p class="price">$35<span class="per-month">/month</span></p>
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Premium Gym Access</li>
                        <li><i class="fas fa-check-circle"></i> All Group Classes</li>
                        <li><i class="fas fa-check-circle"></i> Locker Room</li>
                        <li><i class="fas fa-check-circle"></i> Unlimited PT Sessions</li>
                        <li><i class="fas fa-check-circle"></i> Nutritional Guidance</li>
                    </ul>
                    <a href="#" class="btn btn-secondary">Select Plan</a>
                </div>
            </div>
        </div>
    </section>

@endsection

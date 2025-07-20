@extends('gym')

@section('content')

    <section class="relative bg-cover bg-center h-96 flex items-center justify-center text-white" style="background-image: url('https://via.placeholder.com/1500x500/000000/FFFFFF?text=Gym+Hero+Image');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="container mx-auto text-center z-10 p-4">
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">Maksimalkan Potensi Anda.</h2>
            <p class="text-lg md:text-xl mb-8">Latihan yang disesuaikan, bimbingan dari para ahli, serta komunitas yang mendukung dan memberdayakan Anda.</p>
            <a href="#packages" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition duration-300 hover:scale-105">Membership Package</a>
        </div>
    </section>

    <div class="container mx-auto p-6">

        {{-- Exercise Programs Section --}}
        <section class="py-12">
            <h3 class="text-3xl font-bold text-white text-center mb-8">Recommended Exercise Program</h3> {{-- Changed text-gray-800 to text-white --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center transform transition duration-300 hover:scale-105">
                        <i class="{{ $program->hari }} text-indigo-600 text-5xl mb-4"></i>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $program->program_name }}</h4>
                        <p class="text-gray-600 mb-2">{{ $program->latiha_plan }}</p>
                        <p class="text-gray-700 text-sm mb-4">{{ $program->description }}</p>
                        <a href="{{ $program->link_url }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center justify-center">
                            {{ $program->link_text }} <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Gym News Section --}}
        <section class="py-12">
            <h3 class="text-3xl font-bold text-white text-center mb-8">Gym News & Updates</h3> {{-- Changed text-gray-800 to text-white --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-start space-x-4">
                    <i class="fas fa-bell text-blue-500 text-3xl mt-1"></i>
                    <div class="flex-1">
                        <h4 class="text-xl font-semibold text-gray-900 mb-1">New Equipment Arrival!</h4>
                        <p class="text-gray-500 text-xs mb-2">July 12, {{ date('Y') }}</p>
                        <p class="text-gray-700 mb-3">We've added brand new dumbbells (up to 100kg!) and a state-of-the-art rowing machine. Come try them today!</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                            Read More <i class="fas fa-angle-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-start space-x-4">
                    <i class="fas fa-trophy text-yellow-500 text-3xl mt-1"></i>
                    <div class="flex-1">
                        <h4 class="text-xl font-semibold text-gray-900 mb-1">Monthly Challenge: Plank It Out!</h4>
                        <p class="text-gray-500 text-xs mb-2">July 01, {{ date('Y') }}</p>
                        <p class="text-gray-700 mb-3">Join the July "Plank It Out" challenge. Hold your longest plank and win 1 free month membership!</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                            Join Challenge <i class="fas fa-angle-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Membership Packages Section --}}
        <section id="packages" class="py-12">
            <h3 class="text-3xl font-bold text-white text-center mb-8">Choose Your Membership Package</h3> {{-- Changed text-gray-800 to text-white --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">

                {{-- 1 Month Flex Package --}}
                <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col justify-between transform transition duration-300 hover:scale-105">
                    <div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">1 Month Flex</h4>
                        <p class="text-4xl font-extrabold text-indigo-600 mb-4">$50<span class="text-lg font-normal text-gray-600">/month</span></p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> Basic Gym Access</li>
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> Locker Room</li>
                            <li class="flex items-center text-gray-500"><i class="fas fa-times-circle text-red-500 mr-2"></i> Group Classes</li>
                            <li class="flex items-center text-gray-500"><i class="fas fa-times-circle text-red-500 mr-2"></i> Personal Trainer</li>
                        </ul>
                    </div>
                    <a href="#" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-full text-center">Select Plan</a>
                </div>

                {{-- 6 Months Saver Package (Featured) --}}
                <div class="bg-indigo-700 text-white p-6 rounded-lg shadow-xl flex flex-col justify-between transform transition duration-300 scale-105 border-4 border-yellow-400">
                    <span class="block bg-yellow-400 text-indigo-900 text-xs font-bold px-3 py-1 rounded-full absolute -top-3 left-1/2 -translate-x-1/2 shadow-md">Most Popular</span>
                    <div>
                        <h4 class="text-2xl font-bold mb-2">6 Months Saver</h4>
                        <p class="text-4xl font-extrabold text-yellow-300 mb-4">$40<span class="text-lg font-normal text-white">/month</span></p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-300 mr-2"></i> Full Gym Access</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-300 mr-2"></i> All Group Classes</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-300 mr-2"></i> Locker Room</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-green-300 mr-2"></i> 1 Free PT Session</li>
                        </ul>
                    </div>
                    <a href="#" class="inline-block bg-white hover:bg-gray-100 text-indigo-700 font-bold py-3 px-6 rounded-full text-center shadow-lg">Select Plan</a>
                </div>

                {{-- 24 Months Ultimate Package --}}
                <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col justify-between transform transition duration-300 hover:scale-105">
                    <div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">24 Months Ultimate</h4>
                        <p class="text-4xl font-extrabold text-indigo-600 mb-4">$35<span class="text-lg font-normal text-gray-600">/month</span></p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> Premium Gym Access</li>
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> All Group Classes</li>
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> Locker Room</li>
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> Unlimited PT Sessions</li>
                            <li class="flex items-center text-gray-700"><i class="fas fa-check-circle text-green-500 mr-2"></i> Nutritional Guidance</li>
                        </ul>
                    </div>
                    <a href="#" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-full text-center">Select Plan</a>
                </div>

            </div>
        </section>

    </div>

@endsection
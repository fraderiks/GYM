@extends('gym')

@section('title', 'Program & Category Management')

@section('content')
<div class="w-full max-w-7xl mx-auto bg-white bg-opacity-95 rounded-lg shadow-xl p-8">
    <div class="mb-8">
        <h3 class="text-3xl font-bold text-gray-800 hover:text-red-700 transition duration-300 mb-6">
            Program & Category Management
        </h3>
        
        <!-- Tab Navigation -->
        <div class="flex space-x-4 mb-8">
            <button onclick="switchTab('categories')" 
                    id="categoriesTab"
                    class="tab-button px-6 py-3 rounded-lg font-semibold transition duration-200 {{ $activeTab === 'categories' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                <i class="fas fa-folder mr-2"></i>
                Kategori
            </button>
            <button onclick="switchTab('programs')" 
                    id="programsTab"
                    class="tab-button px-6 py-3 rounded-lg font-semibold transition duration-200 {{ $activeTab === 'programs' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                <i class="fas fa-dumbbell mr-2"></i>
                Program
            </button>
        </div>
        
        <!-- Categories Tab Content -->
        <div id="categoriesContent" class="tab-content {{ $activeTab === 'categories' ? '' : 'hidden' }}">
            <!-- Categories Header -->
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-2xl font-bold text-gray-800">Kategori Program</h4>
                <button type="button" onclick="openCreateCategoryModal()" 
                    class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-lg shadow-md 
                           transform transition duration-500 ease-in-out hover:scale-110 hover:shadow-xl 
                           flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Kategori</span>
                </button>
            </div>
            
            <!-- Categories Filter Form -->
            <form method="GET" action="{{ route('admin.programs.index') }}" class="mb-8">
                <input type="hidden" name="tab" value="categories">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input type="text" name="category_search" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                               placeholder="Cari kategori..." value="{{ request('category_search') }}">
                    </div>
                    <div>
                        <button type="submit" 
                                class="w-full bg-gray-600 text-white px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            Filter
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('admin.programs.index') }}?tab=categories" 
                           class="w-full block text-center border border-gray-400 text-gray-600 px-4 py-3 rounded-lg hover:bg-gray-50 transition duration-200">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Categories Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full border-collapse">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Jumlah Program</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Dibuat</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $category->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $category->program_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($category->description, 50) ?: '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                        {{ $category->programs()->count() }} program
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $category->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="viewCategory({{ $category->id }})" 
                                                class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" onclick="editCategory({{ $category->id }})" 
                                                class="bg-yellow-500 text-white px-3 py-2 rounded-md hover:bg-yellow-600 transition duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" onclick="deleteCategory({{ $category->id }}, '{{ $category->program_name }}')" 
                                                class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 transition duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-folder text-4xl mb-4 text-gray-300"></i>
                                        <p class="text-lg">Tidak ada data kategori</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Categories Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
        
        <!-- Programs Tab Content -->
        <div id="programsContent" class="tab-content {{ $activeTab === 'programs' ? '' : 'hidden' }}">
            <!-- Programs Header -->
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-2xl font-bold text-gray-800">Program Gym</h4>
                <button type="button" onclick="openCreateProgramModal()" 
                    class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-lg shadow-md 
                           transform transition duration-500 ease-in-out hover:scale-110 hover:shadow-xl 
                           flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Program</span>
                </button>
            </div>
            
            <!-- Programs Filter Form -->
            <form method="GET" action="{{ route('admin.programs.index') }}" class="mb-8">
                <input type="hidden" name="tab" value="programs">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" name="program_search" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                               placeholder="Cari program..." value="{{ request('program_search') }}">
                    </div>
                    <div>
                        <select name="category_filter" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                            <option value="">Semua Kategori</option>
                            @foreach($allCategories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_filter') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->program_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" 
                                class="w-full bg-gray-600 text-white px-4 py-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            Filter
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('admin.programs.index') }}?tab=programs" 
                           class="w-full block text-center border border-gray-400 text-gray-600 px-4 py-3 rounded-lg hover:bg-gray-50 transition duration-200">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Programs Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full border-collapse">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama Program</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Durasi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Harga</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Dibuat</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($programs as $program)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $program->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $program->program_name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                        {{ $program->category->program_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $program->duration }} hari</td>
                                <td class="px-6 py-4 text-sm text-gray-600 font-semibold">Rp {{ number_format($program->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $program->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="viewProgram({{ $program->id }})" 
                                                class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" onclick="editProgram({{ $program->id }})" 
                                                class="bg-yellow-500 text-white px-3 py-2 rounded-md hover:bg-yellow-600 transition duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" onclick="deleteProgram({{ $program->id }}, '{{ $program->program_name }}')" 
                                                class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 transition duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-dumbbell text-4xl mb-4 text-gray-300"></i>
                                        <p class="text-lg">Tidak ada data program</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Programs Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $programs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Include all modals here -->
@include('admin.partials.category-modals')
@include('admin.partials.program-modals')

@endsection

@push('styles')
<style>
    .modal-backdrop {
        backdrop-filter: blur(2px);
    }
    
    .hidden {
        display: none !important;
    }
    
    .modal-content {
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .tab-content.hidden {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
// Tab switching functionality
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('bg-red-600', 'text-white');
        button.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
    });
    
    // Show selected tab content
    document.getElementById(tabName + 'Content').classList.remove('hidden');
    
    // Add active class to selected tab button
    const activeButton = document.getElementById(tabName + 'Tab');
    activeButton.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
    activeButton.classList.add('bg-red-600', 'text-white');
    
    // Update URL without page reload
    const url = new URL(window.location);
    url.searchParams.set('tab', tabName);
    window.history.pushState({}, '', url);
}

// Include category and program JavaScript functions
@include('admin.partials.category-scripts')
@include('admin.partials.program-scripts')
</script>
@endpush
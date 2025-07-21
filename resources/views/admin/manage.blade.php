@extends('gym')

@section('title', 'User Management')

@section('content')
<div class="w-full max-w-7xl mx-auto bg-white bg-opacity-95 rounded-lg shadow-xl p-8">
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl font-bold text-gray-800 hover:text-red-700 transition duration-300">
                User Management
            </h3>
            <button type="button" onclick="openCreateModal()" 
                class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-lg shadow-md 
                       transform transition duration-500 ease-in-out hover:scale-110 hover:shadow-xl 
                       flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Tambah User</span>
            </button>
        </div>
        
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" name="search" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           placeholder="Cari nama atau email..." value="{{ request('search') }}">
                </div>
                <div>
                    <select name="role" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                        <option value="">Semua Role</option>
                        @foreach($roles as $value => $label)
                            <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>
                                {{ $label }}
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
                    <a href="{{ route('admin.users.index') }}" 
                       class="w-full block text-center border border-gray-400 text-gray-600 px-4 py-3 rounded-lg hover:bg-gray-50 transition duration-200">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full border-collapse">
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Role</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $user->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $roleEnum = is_string($user->role) ? \App\UserRole::from($user->role) : $user->role;
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $roleEnum->value === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $roleEnum->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-2">
                                    <button type="button" onclick="viewUser({{ $user->id }})" 
                                            class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" onclick="editUser({{ $user->id }})" 
                                            class="bg-yellow-500 text-white px-3 py-2 rounded-md hover:bg-yellow-600 transition duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" 
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
                                    <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                                    <p class="text-lg">Tidak ada data user</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Create User Modal -->
<div id="createUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center p-6 border-b">
            <h5 class="text-xl font-bold text-gray-800">Tambah User Baru</h5>
            <button type="button" onclick="closeCreateModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="createUserForm">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="create_name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="create_name" name="name" required>
                </div>
                <div>
                    <label for="create_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="create_email" name="email" required>
                </div>
                <div>
                    <label for="create_password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="create_password" name="password" required>
                </div>
                <div>
                    <label for="create_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="create_password_confirmation" name="password_confirmation" required>
                </div>
                <div>
                    <label for="create_role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                            id="create_role" name="role" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50 rounded-b-lg">
                <button type="button" onclick="closeCreateModal()" 
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- View User Modal -->
<div id="viewUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center p-6 border-b">
            <h5 class="text-xl font-bold text-gray-800">Detail User</h5>
            <button type="button" onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6" id="viewUserContent">
            <!-- Content will be loaded here -->
        </div>
        <div class="flex justify-end p-6 border-t bg-gray-50 rounded-b-lg">
            <button type="button" onclick="closeViewModal()" 
                    class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center p-6 border-b">
            <h5 class="text-xl font-bold text-gray-800">Edit User</h5>
            <button type="button" onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="editUserForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_user_id" name="user_id">
            <div class="p-6 space-y-4">
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="edit_name" name="name" required>
                </div>
                <div>
                    <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="edit_email" name="email" required>
                </div>
                <div>
                    <label for="edit_password" class="block text-sm font-medium text-gray-700 mb-2">Password (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="edit_password" name="password">
                </div>
                <div>
                    <label for="edit_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                           id="edit_password_confirmation" name="password_confirmation">
                </div>
                <div>
                    <label for="edit_role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" 
                            id="edit_role" name="role" required>
                        @foreach($roles as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50 rounded-b-lg">
                <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

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
</style>
@endpush

@push('scripts')
<script>
// Global modal functions (available immediately)
window.openCreateModal = function() {
    console.log('openCreateModal called');
    const modal = document.getElementById('createUserModal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        console.log('Modal opened');
    } else {
        console.error('Modal not found');
    }
};

window.closeCreateModal = function() {
    const modal = document.getElementById('createUserModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        const form = document.getElementById('createUserForm');
        if (form) form.reset();
    }
};

window.closeViewModal = function() {
    const modal = document.getElementById('viewUserModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
};

window.closeEditModal = function() {
    const modal = document.getElementById('editUserModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        const form = document.getElementById('editUserForm');
        if (form) form.reset();
    }
};

// View User Function
window.viewUser = function(id) {
    fetch(`/admin/users/${id}`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            let user = data.data;
            let content = `
                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium text-gray-700">ID:</span>
                        <span class="text-gray-900">${user.id}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium text-gray-700">Nama:</span>
                        <span class="text-gray-900">${user.name}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium text-gray-700">Email:</span>
                        <span class="text-gray-900">${user.email}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium text-gray-700">Role:</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold ${user.role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'}">${user.role_label}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="font-medium text-gray-700">Dibuat:</span>
                        <span class="text-gray-900">${user.created_at}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="font-medium text-gray-700">Diupdate:</span>
                        <span class="text-gray-900">${user.updated_at}</span>
                    </div>
                </div>
            `;
            const viewContent = document.getElementById('viewUserContent');
            const viewModal = document.getElementById('viewUserModal');
            
            if (viewContent && viewModal) {
                viewContent.innerHTML = content;
                viewModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        } else {
            showAlert('Gagal memuat data user', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memuat data user', 'error');
    });
};

// Edit User Function
window.editUser = function(id) {
    fetch(`/admin/users/${id}/edit`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            let user = data.data;
            const editModal = document.getElementById('editUserModal');
            
            if (editModal) {
                document.getElementById('edit_user_id').value = user.id;
                document.getElementById('edit_name').value = user.name;
                document.getElementById('edit_email').value = user.email;
                document.getElementById('edit_role').value = user.role;
                document.getElementById('edit_password').value = '';
                document.getElementById('edit_password_confirmation').value = '';
                
                editModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        } else {
            showAlert('Gagal memuat data user untuk diedit', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memuat data user', 'error');
    });
};

// Delete User Function  
window.deleteUser = function(id, name) {
    if(confirm(`Apakah Anda yakin ingin menghapus user "${name}"?`)) {
        fetch(`/admin/users/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showAlert(data.message || 'Gagal menghapus user', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menghapus user', 'error');
        });
    }
};

// Alert function
function showAlert(message, type) {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.alert-notification');
    existingAlerts.forEach(alert => alert.remove());
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    alertDiv.className += type === 'success' ? ' bg-green-500 text-white' : ' bg-red-500 text-white';
    alertDiv.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        alertDiv.classList.add('translate-x-full');
        setTimeout(() => {
            if (document.body.contains(alertDiv)) {
                document.body.removeChild(alertDiv);
            }
        }, 300);
    }, 3000);
}

// DOM Ready event listener for form handlers and event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    
    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modals = ['createUserModal', 'viewUserModal', 'editUserModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && event.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    });

    // Prevent modal close when clicking inside modal content
    document.querySelectorAll('.bg-white.rounded-lg').forEach(modalContent => {
        modalContent.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    // Create User Form
    const createUserForm = document.getElementById('createUserForm');
    if (createUserForm) {
        createUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("admin.users.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    closeCreateModal();
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showAlert(data.message || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan saat menyimpan user', 'error');
            });
        });
    }

    // Update User Form
    const editUserForm = document.getElementById('editUserForm');
    if (editUserForm) {
        editUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const userId = document.getElementById('edit_user_id').value;
            const formData = new FormData(this);
            
            fetch(`/admin/users/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    closeEditModal();
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showAlert(data.message || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan saat mengupdate user', 'error');
            });
        });
    }
});
</script>
@endpush
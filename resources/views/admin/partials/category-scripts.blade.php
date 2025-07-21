// Category Modal Functions
function openCreateCategoryModal() {
    document.getElementById('createCategoryModal').classList.remove('hidden');
    document.getElementById('createCategoryForm').reset();
}

function closeCreateCategoryModal() {
    document.getElementById('createCategoryModal').classList.add('hidden');
}

function openViewCategoryModal() {
    document.getElementById('viewCategoryModal').classList.remove('hidden');
}

function closeViewCategoryModal() {
    document.getElementById('viewCategoryModal').classList.add('hidden');
}

function openEditCategoryModal() {
    document.getElementById('editCategoryModal').classList.remove('hidden');
}

function closeEditCategoryModal() {
    document.getElementById('editCategoryModal').classList.add('hidden');
}

function openDeleteCategoryModal() {
    document.getElementById('deleteCategoryModal').classList.remove('hidden');
}

function closeDeleteCategoryModal() {
    document.getElementById('deleteCategoryModal').classList.add('hidden');
}

// Category CRUD Operations
function viewCategory(id) {
    fetch(`/admin/programs/categories/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const category = data.data;
                document.getElementById('view_category_name').textContent = category.name || category.program_name || '-';
                document.getElementById('view_category_description').textContent = category.description || '-';
                document.getElementById('view_category_programs_count').textContent = category.programs_count + ' program';
                document.getElementById('view_category_created_at').textContent = new Date(category.created_at).toLocaleDateString('id-ID');
                openViewCategoryModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data kategori');
        });
                // Use ISO string if available, fallback to formatted
                let tgl = '-';
                if (category.created_at) {
                    const d = new Date(category.created_at);
                    tgl = isNaN(d) ? (category.created_at_formatted || '-') : d.toLocaleDateString('id-ID');
                }
                document.getElementById('view_category_created_at').textContent = tgl;
}

function editCategory(id) {
    fetch(`/admin/programs/categories/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const category = data.data;
                document.getElementById('edit_category_id').value = category.id;
                document.getElementById('edit_category_name').value = category.name;
                document.getElementById('edit_category_description').value = category.description || '';
                openEditCategoryModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data kategori');
        });
}

function deleteCategory(id, name) {
    document.getElementById('delete_category_id').value = id;
    document.getElementById('delete_category_name').textContent = name;
    openDeleteCategoryModal();
}

// Form Submissions
document.getElementById('createCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/admin/programs/categories', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Kategori berhasil ditambahkan!');
            closeCreateCategoryModal();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan kategori');
    });
});

document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('edit_category_id').value;
    
    fetch(`/admin/programs/categories/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Kategori berhasil diperbarui!');
            closeEditCategoryModal();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui kategori');
    });
});

document.getElementById('deleteCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('delete_category_id').value;
    
    fetch(`/admin/programs/categories/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Kategori berhasil dihapus!');
            closeDeleteCategoryModal();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus kategori');
    });
});

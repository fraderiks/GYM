// Program Modal Functions
function openCreateProgramModal() {
    document.getElementById('createProgramModal').classList.remove('hidden');
    document.getElementById('createProgramForm').reset();
}

function closeCreateProgramModal() {
    document.getElementById('createProgramModal').classList.add('hidden');
}

function openViewProgramModal() {
    document.getElementById('viewProgramModal').classList.remove('hidden');
}

function closeViewProgramModal() {
    document.getElementById('viewProgramModal').classList.add('hidden');
}

function openEditProgramModal() {
    document.getElementById('editProgramModal').classList.remove('hidden');
}

function closeEditProgramModal() {
    document.getElementById('editProgramModal').classList.add('hidden');
}

function openDeleteProgramModal() {
    document.getElementById('deleteProgramModal').classList.remove('hidden');
}

function closeDeleteProgramModal() {
    document.getElementById('deleteProgramModal').classList.add('hidden');
}

// Program CRUD Operations
function viewProgram(id) {
    fetch(`/admin/programs/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const program = data.data;
                document.getElementById('view_program_name').textContent = program.name;
                document.getElementById('view_program_category').textContent = program.category.name;
                document.getElementById('view_program_duration').textContent = program.duration + ' hari';
                document.getElementById('view_program_price').textContent = 'Rp ' + parseInt(program.price).toLocaleString('id-ID');
                document.getElementById('view_program_description').textContent = program.description || '-';
                document.getElementById('view_program_benefits').textContent = program.benefits || '-';
                document.getElementById('view_program_created_at').textContent = program.created_at;
                
                const imageContainer = document.getElementById('view_program_image_container');
                if (program.image) {
                    imageContainer.innerHTML = `<img src="/storage/${program.image}" alt="Program Image" class="w-32 h-32 object-cover rounded-lg">`;
                } else {
                    imageContainer.innerHTML = '<p class="text-gray-500 italic">Tidak ada gambar</p>';
                }
                
                openViewProgramModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data program');
        });
}

function editProgram(id) {
    fetch(`/admin/programs/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const program = data.data;
                document.getElementById('edit_program_id').value = program.id;
                document.getElementById('edit_program_name').value = program.name;
                document.getElementById('edit_program_category').value = program.category.id;
                document.getElementById('edit_program_duration').value = program.duration;
                document.getElementById('edit_program_price').value = program.price;
                document.getElementById('edit_program_description').value = program.description || '';
                document.getElementById('edit_program_benefits').value = program.benefits || '';
                
                const currentImageContainer = document.getElementById('edit_program_current_image');
                if (program.image) {
                    currentImageContainer.innerHTML = `
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <img src="/storage/${program.image}" alt="Current Image" class="w-24 h-24 object-cover rounded-lg">
                    `;
                } else {
                    currentImageContainer.innerHTML = '<p class="text-sm text-gray-500 italic">Belum ada gambar</p>';
                }
                
                openEditProgramModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data program');
        });
}

function deleteProgram(id, name) {
    document.getElementById('delete_program_id').value = id;
    document.getElementById('delete_program_name').textContent = name;
    openDeleteProgramModal();
}

// Form Submissions
document.getElementById('createProgramForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/admin/programs', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Program berhasil ditambahkan!');
            closeCreateProgramModal();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan program');
    });
});

document.getElementById('editProgramForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('edit_program_id').value;
    
    fetch(`/admin/programs/${id}`, {
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
            alert('Program berhasil diperbarui!');
            closeEditProgramModal();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui program');
    });
});

document.getElementById('deleteProgramForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('delete_program_id').value;
    
    fetch(`/admin/programs/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Program berhasil dihapus!');
            closeDeleteProgramModal();
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus program');
    });
});
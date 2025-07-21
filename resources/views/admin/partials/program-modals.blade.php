<!-- Program Modals -->

<!-- Create Program Modal -->
<div id="createProgramModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl m-4 modal-content">
        <div class="bg-red-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Tambah Program</h3>
        </div>
        <form id="createProgramForm" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="create_program_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Program*</label>
                        <input type="text" id="create_program_name" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    
                    <div>
                        <label for="create_program_category" class="block text-sm font-medium text-gray-700 mb-2">Kategori*</label>
                        <select id="create_program_category" name="category_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Pilih Kategori</option>
                            @foreach($allCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->program_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="create_program_duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi (hari)*</label>
                        <input type="number" id="create_program_duration" name="duration" min="1" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    
                    <div>
                        <label for="create_program_price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)*</label>
                        <input type="number" id="create_program_price" name="price" min="0" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
                
                <div>
                    <label for="create_program_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="create_program_description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Masukkan deskripsi program (opsional)"></textarea>
                </div>
                
                <div>
                    <label for="create_program_benefits" class="block text-sm font-medium text-gray-700 mb-2">Manfaat</label>
                    <textarea id="create_program_benefits" name="benefits" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Masukkan manfaat program (opsional)"></textarea>
                </div>
                
                <div>
                    <label for="create_program_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Program</label>
                    <input type="file" id="create_program_image" name="image" accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <p class="text-sm text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF (Maksimal 2MB)</p>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeCreateProgramModal()" 
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- View Program Modal -->
<div id="viewProgramModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl m-4 modal-content">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Detail Program</h3>
        </div>
        <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Program</label>
                    <p id="view_program_name" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-900"></p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <p id="view_program_category" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                    <p id="view_program_duration" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <p id="view_program_price" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <p id="view_program_description" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Manfaat</label>
                <p id="view_program_benefits" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <div id="view_program_image_container" class="px-4 py-3 bg-gray-50 rounded-lg"></div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dibuat</label>
                <p id="view_program_created_at" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
            </div>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
            <button type="button" onclick="closeViewProgramModal()" 
                    class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Edit Program Modal -->
<div id="editProgramModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl m-4 modal-content">
        <div class="bg-yellow-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Edit Program</h3>
        </div>
        <form id="editProgramForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_program_id">
            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_program_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Program*</label>
                        <input type="text" id="edit_program_name" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    
                    <div>
                        <label for="edit_program_category" class="block text-sm font-medium text-gray-700 mb-2">Kategori*</label>
                        <select id="edit_program_category" name="category_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Pilih Kategori</option>
                            @foreach($allCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->program_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_program_duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi (hari)*</label>
                        <input type="number" id="edit_program_duration" name="duration" min="1" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    
                    <div>
                        <label for="edit_program_price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)*</label>
                        <input type="number" id="edit_program_price" name="price" min="0" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
                
                <div>
                    <label for="edit_program_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="edit_program_description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Masukkan deskripsi program (opsional)"></textarea>
                </div>
                
                <div>
                    <label for="edit_program_benefits" class="block text-sm font-medium text-gray-700 mb-2">Manfaat</label>
                    <textarea id="edit_program_benefits" name="benefits" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Masukkan manfaat program (opsional)"></textarea>
                </div>
                
                <div>
                    <label for="edit_program_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Program</label>
                    <input type="file" id="edit_program_image" name="image" accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <p class="text-sm text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF (Maksimal 2MB)</p>
                    <div id="edit_program_current_image" class="mt-2"></div>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeEditProgramModal()" 
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Program Confirmation Modal -->
<div id="deleteProgramModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md m-4 modal-content">
        <div class="bg-red-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Hapus Program</h3>
        </div>
        <div class="p-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-exclamation-triangle text-yellow-400 text-3xl mr-4"></i>
                <div>
                    <p class="text-gray-800 font-medium">Apakah Anda yakin ingin menghapus program ini?</p>
                    <p id="delete_program_name" class="text-gray-600 text-sm mt-1"></p>
                </div>
            </div>
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            <strong>Peringatan:</strong> Data program yang dihapus tidak dapat dikembalikan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <form id="deleteProgramForm">
            @csrf
            @method('DELETE')
            <input type="hidden" id="delete_program_id">
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeDeleteProgramModal()" 
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

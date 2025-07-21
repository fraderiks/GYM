<!-- Category Modals -->

<!-- Create Category Modal -->
<div id="createCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg m-4 modal-content">
        <div class="bg-red-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Tambah Kategori</h3>
        </div>
        <form id="createCategoryForm">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="create_category_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori*</label>
                    <input type="text" id="create_category_name" name="name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>
                
                <div>
                    <label for="create_category_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="create_category_description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Masukkan deskripsi kategori (opsional)"></textarea>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeCreateCategoryModal()" 
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

<!-- View Category Modal -->
<div id="viewCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg m-4 modal-content">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Detail Kategori</h3>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <p id="view_category_name" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-900"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <p id="view_category_description" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Program</label>
                <p id="view_category_programs_count" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dibuat</label>
                <p id="view_category_created_at" class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700"></p>
            </div>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
            <button type="button" onclick="closeViewCategoryModal()" 
                    class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg m-4 modal-content">
        <div class="bg-yellow-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Edit Kategori</h3>
        </div>
        <form id="editCategoryForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_category_id">
            <div class="p-6 space-y-4">
                <div>
                    <label for="edit_category_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori*</label>
                    <input type="text" id="edit_category_name" name="name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>
                
                <div>
                    <label for="edit_category_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="edit_category_description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Masukkan deskripsi kategori (opsional)"></textarea>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeEditCategoryModal()" 
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

<!-- Delete Category Confirmation Modal -->
<div id="deleteCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 modal-backdrop">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md m-4 modal-content">
        <div class="bg-red-600 text-white px-6 py-4 rounded-t-lg">
            <h3 class="text-xl font-bold">Hapus Kategori</h3>
        </div>
        <div class="p-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-exclamation-triangle text-yellow-400 text-3xl mr-4"></i>
                <div>
                    <p class="text-gray-800 font-medium">Apakah Anda yakin ingin menghapus kategori ini?</p>
                    <p id="delete_category_name" class="text-gray-600 text-sm mt-1"></p>
                </div>
            </div>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>Peringatan:</strong> Jika kategori ini memiliki program, semua program terkait juga akan terpengaruh.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <form id="deleteCategoryForm">
            @csrf
            @method('DELETE')
            <input type="hidden" id="delete_category_id">
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeDeleteCategoryModal()" 
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

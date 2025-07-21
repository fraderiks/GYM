<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display the main page with categories and programs tabs
     */
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'categories');

        // Get categories with search and pagination
        $categoriesQuery = Category::query();
        if ($request->has('category_search') && $request->category_search) {
            $categoriesQuery->where('program_name', 'like', "%{$request->category_search}%");
        }
        $categories = $categoriesQuery->orderBy('program_name')->paginate(10, ['*'], 'categories_page');

        // Get programs with search, category filter, and pagination
        $programsQuery = Program::with('category');
        if ($request->has('program_search') && $request->program_search) {
            $programsQuery->where('program_name', 'like', "%{$request->program_search}%");
        }
        if ($request->has('category_filter') && $request->category_filter) {
            $programsQuery->where('category_id', $request->category_filter);
        }
        $programs = $programsQuery->latest()->paginate(10, ['*'], 'programs_page');

        // Get all categories for program filter dropdown
        $allCategories = Category::orderBy('program_name')->get();

        return view('admin.programs', compact('categories', 'programs', 'allCategories', 'activeTab'));
    }

    // ========== CATEGORY CRUD ==========

    /**
     * Store a new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,program_name'],
            'description' => ['nullable', 'string'],
        ]);

        Category::create([
            'program_name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan.'
        ]);
    }

    /**
     * Show category details
     */
    public function showCategory($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $category->id,
                'name' => $category->program_name,
                'description' => $category->description ?? '-',
                'programs_count' => $category->programs()->count(),
                'created_at' => $category->created_at ? $category->created_at->format('d M Y H:i') : '-',
                'updated_at' => $category->updated_at ? $category->updated_at->format('d M Y H:i') : '-',
            ]
        ]);
    }

    /**
     * Update category
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,program_name,' . $category->id],
            'description' => ['nullable', 'string'],
        ]);

        $category->update([
            'program_name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diupdate.'
        ]);
    }

    /**
     * Delete category
     */
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        // Check if category has programs
        if ($category->programs()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus kategori yang masih memiliki program.'
            ]);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }

    // ========== PROGRAM CRUD ==========

    /**
     * Store a new program
     */
    public function storeProgram(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'duration' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('programs', 'public');
        }

        Program::create([
            'program_name' => $request->name,
            'description' => $request->description,
            'benefits' => $request->benefits,
            'duration' => $request->duration,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil ditambahkan.'
        ]);
    }

    /**
     * Show program details
     */
    public function showProgram($id)
    {
        $program = Program::with('category')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $program->id,
                'name' => $program->program_name,
                'description' => $program->description ?? '-',
                'benefits' => $program->benefits ?? '-',
                'duration' => $program->duration ?? 0,
                'price' => $program->price ?? 0,
                'category' => [
                    'id' => $program->category->id ?? null,
                    'name' => $program->category->program_name ?? 'No Category'
                ],
                'image' => $program->image,
                'created_at' => $program->created_at ? $program->created_at->format('d M Y H:i') : '-',
                'updated_at' => $program->updated_at ? $program->updated_at->format('d M Y H:i') : '-',
            ]
        ]);
    }

    /**
     * Update program
     */
    public function updateProgram(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'duration' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $updateData = [
            'program_name' => $request->name,
            'description' => $request->description,
            'benefits' => $request->benefits,
            'duration' => $request->duration,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($program->image && Storage::disk('public')->exists($program->image)) {
                Storage::disk('public')->delete($program->image);
            }

            $updateData['image'] = $request->file('image')->store('programs', 'public');
        }

        $program->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil diupdate.'
        ]);
    }

    /**
     * Delete program
     */
    public function destroyProgram($id)
    {
        $program = Program::findOrFail($id);

        // Delete image if exists
        if ($program->image && Storage::disk('public')->exists($program->image)) {
            Storage::disk('public')->delete($program->image);
        }

        $program->delete();

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil dihapus.'
        ]);
    }
}
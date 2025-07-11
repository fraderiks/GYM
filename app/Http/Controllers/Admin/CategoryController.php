<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $count = Category::count();
        $categories = Category::query()->with(['books']);
        if ($request->query('ordering', 'ascending') === 'descending') {
            $categories->orderBy('name', 'desc');
        }

        if ($request->query('filter', '') !== '') {
            $filter = $request->query('filter');
            $categories->where('name', 'like', "%{$filter}%");
        }

        if ($count <= 1000) {
            $categories = $categories->paginate(3);
        } else {
            $categories = $categories->cursorPaginate(3);
        }

        return view('admin.category.index',
            [
                'categories' => $categories,
                'ordering' => $request->query('ordering', 'ascending'),
                'filter' => $request->query('filter', ''),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.form', [
            'formHeading' => 'New Category',
            'action' => route('admin.category.store'),
            'category' => new Category(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);

        Category::create($validated);

        return redirect(route('admin.category.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.form', [
            'formHeading' => 'Edit Category',
            'action' => route('admin.category.update', $id),
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oldCategory = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required', 
                Rule::unique('categories', 'name')
                    ->ignore($oldCategory->name, 'name')
            ],
        ]);

        $oldCategory->update($validated);

        return redirect(route('admin.category.show', $oldCategory->name));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        $category->delete();

        return redirect(route('admin.category.index'));
    }
}
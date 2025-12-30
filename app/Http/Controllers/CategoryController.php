<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Show categories page (form + table)
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories', compact('categories'));
    }

    /**
     * Store new category
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:255',
                    'regex:/^[A-Za-z0-9\s\-]+$/',
                    'unique:categories,name',
                ],
            ],
            [
                'name.required' => 'Category name is required.',
                'name.unique'   => 'This category already exists.',
                'name.regex'    => 'Category name contains invalid characters.',
            ]
        );

        Category::create([
            'name'    => trim($validated['name']),
            'creator' => session('admin_name') ?? 'Admin',
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category added successfully');
    }

    /**
     * Update category
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:255',
                    'regex:/^[A-Za-z0-9\s\-]+$/',
                    Rule::unique('categories', 'name')->ignore($id),
                ],
            ],
            [
                'name.required' => 'Category name is required.',
                'name.unique'   => 'This category already exists.',
                'name.regex'    => 'Category name contains invalid characters.',
            ]
        );

        $category = Category::findOrFail($id);
        $category->update([
            'name' => trim($validated['name']),
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Delete category
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category deleted successfully');
    }
}

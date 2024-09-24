<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // Display a listing of categories
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        return view('pages.product.category', compact('categories'));

    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        // Temporarily use a Validator to capture errors
        $validator = Validator::make($request->all(), [
            'categoryTitle' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'description' => 'nullable|string',
            'status' => 'required|in:Publish,Inactive',
            'parentCategory.*' => 'nullable|string|max:255',
        ]);


        // Use the service to store the category and subcategories
        $this->categoryService->storeCategory($request);

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'Category and subcategories saved successfully.');
    }
    
    // Show the form for editing the specified category
    public function edit(Category $category)
    {
        return view('pages.product.category', compact('category'));
    }

    // Update the specified category in storage
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryTitle' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'description' => 'nullable|string',
            'status' => 'required|in:Scheduled,Publish,Inactive',
            'parentCategory.*' => 'nullable|string|max:255',
        ]);

        // Use the service to update the category and subcategories
        $this->categoryService->updateCategory($request, $category);

        return redirect()->route('categories.index')->with('success', 'Category and subcategories updated successfully.');
    }

    // Remove the specified category from storage
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }


}

<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryService
{
    public function storeCategory(Request $request)
    {

        // dd($request->all());
        // Generate the filename with the category name
        $imageName = null;
        if ($request->file('image')) {
            $categoryNameSlug = Str::slug($request->categoryTitle); // Updated line
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $categoryNameSlug . '_' . time() . '.' . $extension;

            // Store the image
            $imageName = $request->file('image')->storeAs('category_images', $imageName, 'public');
        }

        // Save the category
        $category = Category::create([
            'title' => $request->categoryTitle,
            'slug' => $request->slug,
            'image' => $imageName,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Save the subcategories
        if ($request->parentCategory) {
            foreach ($request->parentCategory as $subcategoryTitle) {
                if ($subcategoryTitle) {
                    $category->subcategories()->create(['title' => $subcategoryTitle]);
                }
            }
        }

        return $category;
    }

    public function updateCategory(Request $request, Category $category)
    {
        // dd($request->all());

        // Handle image update
        $imageName = $category->image;
        if ($request->file('image')) {
            $categoryNameSlug = Str::slug($request->categoryTitle);
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $categoryNameSlug . '_' . time() . '.' . $extension;

            // Store the image
            $imageName = $request->file('image')->storeAs('category_images', $imageName, 'public');
        }

        // Update the category
        $category->update([
            'title' => $request->categoryTitle,
            'slug' => $request->slug,
            'image' => $imageName,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Fetch the existing subcategories
        $existingSubcategories = $category->subcategories()->pluck('id', 'title')->toArray();

        // Track processed subcategories
        $processedSubcategoryIds = [];

        // Update or create subcategories
        foreach ($request->subcategories as $subcategoryTitle) {
            if ($subcategoryTitle) {
                // Check if subcategory already exists
                if (array_key_exists($subcategoryTitle, $existingSubcategories)) {
                    $processedSubcategoryIds[] = $existingSubcategories[$subcategoryTitle];
                } else {
                    // Create a new subcategory
                    $newSubcategory = $category->subcategories()->create(['title' => $subcategoryTitle]);
                    $processedSubcategoryIds[] = $newSubcategory->id;
                }
            }
        }

        // Delete subcategories that are no longer in the request
        $category->subcategories()->whereNotIn('id', $processedSubcategoryIds)->delete();
    
        return $category;
    }
    
}

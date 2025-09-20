<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ✅ Show All Category
    public function AllCategory()
    {
        $category = ProductCategory::latest()->get();
        return view('admin.backend.category.all_category', compact('category'));
    } // End Method

    // ✅ Store Category
    public function storeCategory(Request $request)
    {
        // 1. Validate input
        $request->validate([
            'category_name' => 'required|unique:product_categories,category_name|max:255',
        ]);

        // 2. Insert data (using create so timestamps work)
        ProductCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        // shows the toaster message where admin master added js file

        $notification = array(
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } // End Method
}
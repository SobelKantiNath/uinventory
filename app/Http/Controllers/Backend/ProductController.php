<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\WareHouse;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ===================== CATEGORY METHODS ===================== //

    // ✅ Show All Categories
    public function AllCategory()
    {
        $category = ProductCategory::latest()->get();
        return view('admin.backend.category.all_category', compact('category'));
    }

    // ✅ Store Category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:product_categories,category_name|max:255',
        ]);

        ProductCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message'    => 'Category Added Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    // ✅ Edit Category (returns JSON for modal)
    public function EditCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        return response()->json($category);
    }

    // ✅ Update Category
    public function UpdateCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:product_categories,category_name,' . $request->cat_id,
        ]);

        ProductCategory::findOrFail($request->cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message'    => 'Category Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    // ✅ Delete Category
    public function DeleteCategory($id)
    {
        ProductCategory::findOrFail($id)->delete();

        $notification = [
            'message'    => 'Category Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    // ===================== PRODUCT METHODS ===================== //

    // ✅ All Products
    public function AllProduct()
    {
        $allData = Product::orderBy('id', 'desc')->get();
        return view('admin.backend.product.product_list', compact('allData'));
    }

    // ✅ Add Product Page
    public function AddProduct()
    {
        $categories = ProductCategory::all();
        $suppliers  = Supplier::all();
        $brands     = Brand::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.product.add_product', compact('categories', 'suppliers', 'brands', 'warehouses'));
    }

    // ✅ Store Product
    public function StoreProduct(Request $request)
    {
         $request->validate([
        'name'        => 'required|max:255',
        'code'        => 'required|unique:products,code|max:100',
        'category_id' => 'required|exists:product_categories,id',
        'brand_id'    => 'required|exists:brands,id',
        'warehouse_id'=> 'required|exists:ware_houses,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'price'       => 'nullable|numeric|min:0',   // changed to nullable
        'product_qty' => 'required|integer|min:1',
        'stock_alert' => 'nullable|integer|min:0',
        'status'      => 'required|in:Received,Pending',  // match form values
        'image.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

        $product = Product::create([
            'name'         => $request->name,
            'code'         => $request->code,
            'category_id'  => $request->category_id,
            'brand_id'     => $request->brand_id,
            'warehouse_id' => $request->warehouse_id,
            'supplier_id'  => $request->supplier_id,
            'price'        => $request->price,
            'stock_alert'  => $request->stock_alert,
            'note'         => $request->note,
            'product_qty'  => $request->product_qty,
            'status'       => $request->status,
        ]);

        // Handle multiple images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $manager->read($img)->resize(600, 500)->save(public_path('upload/productimg/' . $name_gen));

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => 'upload/productimg/' . $name_gen,
                ]);
            }
        }

        $notification = [
            'message'    => 'Product Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.product')->with($notification);
    }

    // ✅ Edit Product Page
    public function EditProduct($id)
    {
        $editData   = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $suppliers  = Supplier::all();
        $brands     = Brand::all();
        $warehouses = WareHouse::all();
        // FIX: was using '$id' (string literal) instead of $id (variable)
        $multiimg   = ProductImage::where('product_id', $id)->get();

        return view('admin.backend.product.edit_product', compact(
            'categories', 'suppliers', 'brands', 'warehouses', 'editData', 'multiimg'
        ));
    }

    // ✅ Update Product (main fields only — images handled separately)
    public function UpdateProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'code'        => 'required|max:100|unique:products,code,' . $request->id,
            'category_id' => 'required|exists:product_categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'warehouse_id'=> 'required|exists:ware_houses,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price'       => 'required|numeric|min:0',
            'product_qty' => 'required|integer|min:0',
            'stock_alert' => 'nullable|integer|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        Product::findOrFail($request->id)->update([
            'name'         => $request->name,
            'code'         => $request->code,
            'category_id'  => $request->category_id,
            'brand_id'     => $request->brand_id,
            'warehouse_id' => $request->warehouse_id,
            'supplier_id'  => $request->supplier_id,
            'price'        => $request->price,
            'stock_alert'  => $request->stock_alert,
            'note'         => $request->note,
            'product_qty'  => $request->product_qty,
            'status'       => $request->status,
        ]);

        $notification = [
            'message'    => 'Product Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.product')->with($notification);
    }

    // ✅ Add New Images to an Existing Product (from Edit page)
    public function UpdateProductImage(Request $request)
    {
        $request->validate([
            'id'      => 'required|exists:products,id',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $manager->read($img)->resize(600, 500)->save(public_path('upload/productimg/' . $name_gen));

                ProductImage::create([
                    'product_id' => $request->id,
                    'image'      => 'upload/productimg/' . $name_gen,
                ]);
            }
        }

        $notification = [
            'message'    => 'Product Image Added Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    // ✅ Delete a Single Product Image
    public function DeleteProductImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Delete the physical file if it exists
        $imagePath = public_path($image->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();

        $notification = [
            'message'    => 'Product Image Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    // ✅ Delete Product (with all its images)
    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete all associated images from disk and DB
        $images = ProductImage::where('product_id', $id)->get();
        foreach ($images as $image) {
            $imagePath = public_path($image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        $product->delete();

        $notification = [
            'message'    => 'Product Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.product')->with($notification);
    }
}
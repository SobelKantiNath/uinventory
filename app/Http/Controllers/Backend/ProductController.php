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

    public function EditCategory($id)
    {
        $category = ProductCategory::find($id);
        return response()->json($category);
    } // End Method

    // ✅ Update Category
    public function UpdateCategory(Request $request)
    {
        $cat_id = $request->cat_id;

        ProductCategory::find($cat_id)->update([
             'category_name' =>$request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        // shows the toaster message where admin master added js file

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } // End Method

    public function DeleteCategory($id){
        ProductCategory::find($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    //End Method

    ///=================== Product All Methods ===================///

    public function AllProduct(){
        $allData = Product::orderBy('id','desc')->get();
        return view('admin.backend.product.product_list', compact('allData'));
    }
    //End Method

    public function AddProduct(){
        $categories = ProductCategory::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.product.add_product', compact('categories','suppliers','brands','warehouses'));
    }
    //End Method

    public function StoreProduct(Request $request){
        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'warehouse_id' => $request->warehouse_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->price,
            'stock_alert' => $request->stock_alert,
            'note' => $request->note,
            'product_qty' => $request->product_qty,
            'status' => $request->status,
            'created_at' => now(),
        ]);
        $product_id = $product->id;
        // Handle multiple images
        if($request->hasFile(('image'))){
            foreach($request->file('image') as $img){
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $imgs = $manager->read($img);
                $imgs->resize(100,90)->save(public_path('upload/productimg/'.$name_gen));
                $save_url = 'upload/productimg/'.$name_gen;

                ProductImage::create([
                    'product_id' => $product_id,
                    'image' => $save_url
                ]);
            }
        }
        // shows the toaster message where admin master added js file

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }
    //End Method

}
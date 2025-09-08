<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    public function AllBrand() {
        $brand = Brand::latest()->get();
        return view('admin.backend.brand.all_brand',compact('brand'));
    } //End Method

    public function AddBrand() {

        return view('admin.backend.brand.add_brand');
    } //End Method

    public function StoreBrand( Request $request) {

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(100,90)->save(public_path('upload/brand/'.$name_gen));
            $save_url = 'upload/brand/'.$name_gen;

            Brand::create([
                'name' => $request->name,
                'image' => $save_url
            ]);


        }

        // shows the toaster message where admin master added js file

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.brand')->with($notification);

    } //End Method

    public function EditBrand($id) {

        $brand = Brand::find($id);
        return view('admin.backend.brand.edit_brand',compact('brand'));

    } //End Method

    public function UpdateBrand(Request $request) {

        $brand_id = $request->id; //Edit brand theaka patano ID ja request a asva ta accept korlam brand_id ar maddoma
        $brand = Brand::find($brand_id);//Brand Id ar data gula nia asa holo
        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(100,90)->save(public_path('upload/brand/'.$name_gen));
            $save_url = 'upload/brand/'.$name_gen;

            if(file_exists(public_path($brand->image))){
                @unlink(public_path($brand->image));

            }

            Brand::find($brand_id)->update([
                'name' => $request->name,
                'image' => $save_url
             ]);

             // shows the toaster message where admin master added js file
            $notification = array(
                'message' => 'Brand Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);

        } else{
          Brand::find($brand_id)->update([
                'name' => $request->name,
             ]);

             // shows the toaster message where admin master added js file
            $notification = array(
                'message' => 'Brand Updated without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }

    } //End Method

    public function DeleteBrand($id){
        $item = Brand::find($id);
        $img = $item->image;
        unlink($img);

        Brand::find($id)->delete();
        $notification = array(
                'message' => 'Brand Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

    } //End Method

}

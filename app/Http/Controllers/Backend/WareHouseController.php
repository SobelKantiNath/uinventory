<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    public function AllWareHouse(){
        $warehouse = WareHouse::latest()->get();
        return view('admin.backend.warehouse.all_warehouse',compact('warehouse'));
    } //End Method

    public function AddWareHouse() {

        return view('admin.backend.warehouse.add_warehouse');
    } //End Method

    public function StoreWareHouse( Request $request) {

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
}

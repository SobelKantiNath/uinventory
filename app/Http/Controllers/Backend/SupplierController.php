<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // ✅ Show All Supplier
    public function AllSupplier()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.backend.supplier.all_supplier', compact('suppliers'));
    }

    // ✅ Add Supplier Page
    public function AddSupplier()
    {
        return view('admin.backend.supplier.add_supplier');
    }

    public function StoreSupplier( Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:ware_houses,email|max:255',
            'phone'=> 'nullable|string|max:20',
            'address'=> 'nullable|string',
        ]);

        Supplier::create([
            'name' => $validated['name'], //Where database name, email, phone, address = assign requested name, email, phone and address which  is comming from form data
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // shows the toaster message where admin master added js file

        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);

    } //End Method

    public function EditSupplier($id) { //This id is comes from route not from blade page

        $supplier = Supplier::find($id);
        return view('admin.backend.supplier.edit_supplier',compact('supplier'));

    } //End Method

    public function UpdateSupplier( Request $request) {

        $supplier_id = $request->id; //This is is coming from blade page

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'phone'=> 'nullable|string|max:20',
            'address'=> 'nullable|string',
        ]);

        Supplier::find($supplier_id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // shows the toaster message where admin master added js file

        $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);

    } //End Method


    public function DeleteSupplier($id){ //This id is comes from route not from blade page

        Supplier::find($id)->delete();
        $notification = array(
                'message' => 'Supplier Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

    } //End Method
}

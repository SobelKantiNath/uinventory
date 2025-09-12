<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // ✅ Show All Customers
    public function AllCustomer()
    {
        $customers = Customer::latest()->get();
        return view('admin.backend.customer.all_customer', compact('customers'));
    }

    // ✅ Add Customer Page
    public function AddCustomer()
    {
        return view('admin.backend.customer.add_customer');
    }

    // ✅ Store Customer
    public function StoreCustomer(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:customers,email|max:255',
            'phone'  => 'nullable|string|max:20',
            'address'=> 'nullable|string',
        ]);

        Customer::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'address' => $validated['address'],
        ]);

        $notification = array(
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    }

    // ✅ Edit Customer
    public function EditCustomer($id)
    {
        $customer = Customer::find($id);
        return view('admin.backend.customer.edit_customer', compact('customer'));
    }

    // ✅ Update Customer
    public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'phone'  => 'nullable|string|max:20',
            'address'=> 'nullable|string',
        ]);

        Customer::find($customer_id)->update([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'address' => $validated['address'],
        ]);

        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    }

    // ✅ Delete Customer
    public function DeleteCustomer($id)
    {
        Customer::find($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
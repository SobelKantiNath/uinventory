<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // ✅ Show All Employees
    public function AllEmployee()
    {
        $employees = Employee::latest()->get();
        return view('admin.backend.employee.all_employee', compact('employees'));
    }

    // ✅ Add Employee Page
    public function AddEmployee()
    {
        return view('admin.backend.employee.add_employee');
    }

    // ✅ Store Employee
    public function StoreEmployee(Request $request)
    {
        $validated = $request->validate([
            'pf_no'           => ['required', 'string', 'max:100', 'unique:employees,pf_no'],
            'name'            => ['required', 'string', 'max:255'],
            'designation'     => ['nullable', 'string', 'max:255'],
            'mobile'          => ['nullable', 'string', 'max:20'],
            'email'           => ['nullable', 'email', 'max:255', 'unique:employees,email'],
            'department_name' => ['nullable', 'string', 'max:255'],
            'joining_date'    => ['nullable', 'date'],
        ]);

        Employee::create($validated);

        $notification = [
            'message' => 'Employee Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.employee')->with($notification);
    }

    // ✅ Edit Employee
    public function EditEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.backend.employee.edit_employee', compact('employee'));
    }

    // ✅ Update Employee
    public function UpdateEmployee(Request $request)
    {
        $employee_id = $request->id;
        $employee = Employee::findOrFail($employee_id);

        $validated = $request->validate([
            'pf_no'           => ['required', 'string', 'max:100', Rule::unique('employees', 'pf_no')->ignore($employee_id)],
            'name'            => ['required', 'string', 'max:255'],
            'designation'     => ['nullable', 'string', 'max:255'],
            'mobile'          => ['nullable', 'string', 'max:20'],
            'email'           => ['nullable', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($employee_id)],
            'department_name' => ['nullable', 'string', 'max:255'],
            'joining_date'    => ['nullable', 'date'],
        ]);

        $employee->update($validated);

        $notification = [
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.employee')->with($notification);
    }

    // ✅ Delete Employee
    public function DeleteEmployee($id)
    {
        Employee::findOrFail($id)->delete();

        $notification = [
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
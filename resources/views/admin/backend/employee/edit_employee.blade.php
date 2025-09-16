@extends('admin.admin_master')
@section('admin')

<div class="container-xxl">

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Edit Employee</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Employee</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Edit Employee</h5></div>

            <div class="card-body">
                <form action="{{ route('update.employee') }}" method="POST" class="row g-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $employee->id }}">

                    <div class="col-md-6">
                        <label class="form-label">PF No:</label>
                        <input type="text" class="form-control @error('pf_no') is-invalid @enderror" name="pf_no" value="{{ $employee->pf_no }}">
                        @error('pf_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Employee Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $employee->name }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Designation:</label>
                        <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ $employee->designation }}">
                        @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile No:</label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $employee->mobile }}">
                        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department Name:</label>
                        <input type="text" class="form-control @error('department_name') is-invalid @enderror" name="department_name" value="{{ $employee->department_name }}">
                        @error('department_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department Joining Date:</label>
                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror" name="joining_date" value="{{ $employee->joining_date }}">
                        @error('joining_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-6">
                        <button class="btn btn-primary" type="submit">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

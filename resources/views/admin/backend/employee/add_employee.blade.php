@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-xxl">

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Add Employee</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Employee</a></li>
        </ol>
    </div>
</div>

<!-- Form Validation -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Employee</h5>
            </div>

            <div class="card-body">
                <form id="myForm" action="{{ route('store.employee') }}" method="POST" class="row g-3">
                    @csrf

                    <div class="form-group col-md-6">
                        <label class="form-label">PF No:</label>
                        <input type="text" class="form-control @error('pf_no') is-invalid @enderror" name="pf_no">
                        @error('pf_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label">Employee Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label">Designation:</label>
                        <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation">
                        @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label">Mobile No:</label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile">
                        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label">Department Name:</label>
                        <input type="text" class="form-control @error('department_name') is-invalid @enderror" name="department_name">
                        @error('department_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label">Department Joining Date:</label>
                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror" name="joining_date">
                        @error('joining_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Save Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                pf_no: { required: true },
                name: { required: true },
                designation: { required: true },
                mobile: { required: true },
                email: { required: true },
                department_name: { required: true },
                joining_date: { required: true },
            },
            messages: {
                pf_no: { required: 'Please Enter PF No' },
                name: { required: 'Please Enter Employee Name' },
                designation: { required: 'Please Enter Designation' },
                mobile: { required: 'Please Enter Mobile No' },
                email: { required: 'Please Enter Email' },
                department_name: { required: 'Please Enter Department Name' },
                joining_date: { required: 'Please Enter Joining Date' },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element){ $(element).addClass('is-invalid'); },
            unhighlight : function(element){ $(element).removeClass('is-invalid'); }
        });
    });
</script>

@endsection

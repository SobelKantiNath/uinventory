@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-xxl">

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Add Customer</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Customer</a></li>
        </ol>
    </div>
</div>

    <!-- Form Validation -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Customer</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <form id="myForm" action="{{ route('store.customer') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="validationDefault01" class="form-label">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group col-md-6">
                        <label for="validationDefault01" class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="validationDefault01" class="form-label">Phone:</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone">

                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="validationDefault01" class="form-label">Address:</label>

                        <textarea class="form-control @error('address') is-invalid @enderror"
                            name="address" rows="2">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="col-6">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },

                email: {
                    required : true,
                },
                phone: {
                    required : true,
                },

                address: {
                    required : true,
                },

            },

            messages :{
                name: {
                    required : 'Please Enter Customer Name',
                },

                email: {
                    required : 'Please Enter Customer Email',
                },

                phone: {
                    required : 'Please Enter Customer Phone',
                },

                address: {
                    required : 'Please Enter Customer Address',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

@endsection

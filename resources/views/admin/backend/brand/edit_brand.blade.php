@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-xxl">

<div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Edit Brand</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Brand</a></li>
        </ol>
    </div>
</div>

    <!-- Form Validation -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Brand</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('update.brand') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <input type="hidden" name="id" id="" value="{{ $brand->id }}">
                    <div class="col-md-12">
                        <label for="validationDefault01" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
                    </div>

                    <div class="col-md-6">
                        <label for="validationDefault01" class="form-label">Image:</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="col-md-6">
                        <label for="validationDefault01" class="form-label"></label>
                        <img id="showImage"src="{{ asset($brand->image) }}"
                        class="rounded-circle avatar-xl img-thumbnail"
                        alt="profile image">
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update Brand</button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#image').on('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
</script>

@endsection

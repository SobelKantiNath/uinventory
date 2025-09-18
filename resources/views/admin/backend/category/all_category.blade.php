@extends('admin.admin_master')
@section('admin')

<div class="content">

<!-- Start Content-->
<div class="container-xxl">

<div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">All Product Category</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <a href="{{ route('add.category') }}" class="btn btn-secondary">Add Category</a>
        </ol>
    </div>
</div>

<!-- Datatables  -->

<!-- Button Datatable -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Category</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->category_slug }}</td>

                            <td>
                                <a href="{{ route('edit.category', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                <a href="{{ route('delete.category', $item->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</div> <!-- container-fluid -->

</div> <!-- content -->

@endsection

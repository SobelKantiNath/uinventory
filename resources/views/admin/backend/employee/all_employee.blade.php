@extends('admin.admin_master')
@section('admin')

<style>
    /* Keep only a bottom scrollbar and avoid layout shift */
    .table-wrap-x {
        overflow-x: auto;
        overflow-y: hidden;
        width: 100%;
    }
    /* Optional: keep cells on one line so the table can scroll horizontally */
    .table-nowrap th, .table-nowrap td {
        white-space: nowrap;
    }
</style>

<div class="content">
<div class="container-xxl">

<div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">All Employees</h4>
    </div>

    <div class="text-end">
        <a href="{{ route('add.employee') }}" class="btn btn-secondary">Add Employee</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">All Employees</h5></div>

            <div class="card-body">
                <!-- 👇 Bottom scrollbar lives here -->
                <div class="table-responsive table-wrap-x">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>PF No</th>
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->pf_no }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->designation }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->department_name }}</td>
                                <td>{{ $item->joining_date }}</td>
                                <td>
                                    <a href="{{ route('edit.employee',$item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ route('delete.employee',$item->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.table-responsive -->
            </div>

        </div>
    </div>
</div>

</div>
</div>

{{-- If using DataTables, enable horizontal scroll --}}
<script>
    if (window.jQuery && $.fn.DataTable) {
        $('#datatable-buttons').DataTable({
            scrollX: true,        // 👈 forces bottom scrollbar
            autoWidth: false,
            responsive: false     // turn off responsive mode so it doesn't reflow into child rows
        });
    }
</script>

@endsection

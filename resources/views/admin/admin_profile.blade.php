@extends('admin.admin_master')
@section('admin')


@php
    // If $profileData not provided by controller, fallback to authenticated user
    $profileData = $profileData ?? Auth::user();
@endphp

<div class="content">

    <!-- Start Content -->
    <div class="container-xxl">

        <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Profile</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>

        {{-- flash messages --}}
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-3">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ !empty($profileData->photo) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                                 class="rounded-circle avatar-xxl img-thumbnail float-start"
                                 alt="profile image">

                            <div class="overflow-hidden ms-4">
                                <h4 class="m-0 text-dark fs-20">{{ $profileData->name }}</h4>
                                <p class="my-1 text-muted fs-16">{{ $profileData->email }}</p>
                            </div>
                        </div>

                        <!-- Profile Setting Tab -->
                        <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                            <div class="row">

                                <!-- Personal Information -->
                                <div class="col-lg-6 col-xl-6">
                                    <div class="card border mb-0">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title mb-0">Personal Information</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Name</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('name') is-invalid @enderror"
                                                               name="name" type="text" value="{{ old('name', $profileData->name) }}">
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Email</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('email') is-invalid @enderror"
                                                               name="email" type="email" value="{{ old('email', $profileData->email) }}">
                                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Phone</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('phone') is-invalid @enderror"
                                                               name="phone" type="text" value="{{ old('phone', $profileData->phone) }}">
                                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Address</label>
                                                    <div class="col-12">
                                                        <textarea class="form-control @error('address') is-invalid @enderror"
                                                                  name="address" placeholder="Required example textarea">{{ old('address', $profileData->address) }}</textarea>
                                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Profile Image</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('photo') is-invalid @enderror"
                                                               name="photo" type="file" id="image" accept="image/*">
                                                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <div class="col-12">
                                                        <img id="showImage"
                                                             src="{{ !empty($profileData->photo) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                                                             class="rounded-circle avatar-xl img-thumbnail"
                                                             alt="profile image">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        <button type="button" class="btn btn-danger" onclick="history.back()">Cancel</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div><!-- end card-body -->
                                    </div>
                                </div>

                                <!-- Change Password -->
                                <div class="col-lg-6 col-xl-6">
                                    <div class="card border mb-0">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title mb-0">Change Password</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body mb-0">
                                            <form action="{{ route('admin.password.update') }}" method="POST">
                                                @csrf

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Old Password</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('old_password') is-invalid @enderror"
                                                               name="old_password" type="password" placeholder="Old Password">
                                                        @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">New Password</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('new_password') is-invalid @enderror"
                                                               name="new_password" type="password" placeholder="New Password">
                                                        @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Confirm Password</label>
                                                    <div class="col-12">
                                                        <input class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                               name="new_password_confirmation" type="password" placeholder="Confirm Password">
                                                        @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                                        <button type="button" class="btn btn-danger" onclick="history.back()">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!-- end card-body -->
                                    </div>
                                </div>

                            </div><!-- end row -->
                        </div><!-- end tab-pane -->

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div><!-- end row -->

    </div><!-- container-xxl -->
</div><!-- content -->

{{-- Image preview script: ensure jQuery is loaded in layout --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@push('scripts')
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
@endpush

@endsection

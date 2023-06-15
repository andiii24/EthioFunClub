@extends('accounts.sales.admin')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">


            <!-- start page title -->
            <div class="row">
                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                timer: 3000, // Display duration in milliseconds (e.g., 3000ms = 3 seconds)
                                showConfirmButton: false, // Hide the "OK" button
                                toast: true, // Display the message as a toast notification
                                position: 'top', // Position of the toast notification
                                timerProgressBar: true, // Show a progress bar during the display duration
                            });
                        });
                    </script>
                @endif
                @if (session('error'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "{{ session('error') }}",
                                timer: 3000, // Display duration in milliseconds (e.g., 3000ms = 3 seconds)
                                showConfirmButton: false, // Hide the "OK" button
                                toast: true, // Display the message as a toast notification
                                position: 'top', // Position of the toast notification
                                timerProgressBar: true, // Show a progress bar during the display duration
                            });
                        });
                    </script>
                @endif
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ asset('sales-manager') }}">Admin</a></li>
                                <li class="breadcrumb-item active">{{ __('dashboard.Sales') }}</li>
                                <li class="breadcrumb-item active">{{ __('dashboard.Profile') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('dashboard.Sales_Profile') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <form
                                        action="{{ url('update-profile-sales/' . $user->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                    >{{ __('dashboard.Name') }}</label>
                                                    <input
                                                        type="text"
                                                        id="name"
                                                        name="name"
                                                        value="{{ $user->name }}"
                                                        placeholder="Name"
                                                        class="form-control"
                                                    >
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="phone"
                                                        class="form-label"
                                                    >{{ __('dashboard.Phone') }}</label>
                                                    <input
                                                        type="text"
                                                        id="phone"
                                                        value="{{ $user->phone }}"
                                                        name="phone"
                                                        placeholder="Phone"
                                                        class="form-control"
                                                    >
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label
                                                        for="password"
                                                        class="form-label"
                                                    >{{ __('dashboard.Password') }}</label>
                                                    <input
                                                        type="password"
                                                        id="password"
                                                        name="password"
                                                        placeholder="Password"
                                                        class="form-control"
                                                    >
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                    @if (!empty($user->password))
                                                        <input
                                                            type="hidden"
                                                            name="hashed_password"
                                                            value="{{ $user->password }}"
                                                        >
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="confirm_password"
                                                        class="form-label"
                                                    >{{ __('dashboard.Confirm_Password') }}</label>
                                                    <input
                                                        type="password"
                                                        id="confirm_password"
                                                        name="confirm_password"
                                                        placeholder="Confirm Password"
                                                        class="form-control"
                                                    >
                                                    @if ($errors->has('confirm_password'))
                                                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-8"
                                                    style="margin: 20px auto;"
                                                >
                                                    <img
                                                        src="{{ asset('assets/images/users/' . $user->image) }}"
                                                        alt=""
                                                        class="img-fluid"
                                                        style="box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);max-width: 100%; height: auto;"
                                                    >
                                                </div> <!-- end col -->
                                            </div>
                                            <div class="col-12 ">
                                                <div class="col-md-12 mb-3">
                                                    <label
                                                        for="image"
                                                        class="form-label"
                                                    >{{ __('dashboard.ProfilePicture') }}</label>
                                                    <input
                                                        type="file"
                                                        name="image"
                                                        class="form-control"
                                                    >
                                                    @if ($errors->has('image'))
                                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button
                                                    type="submit"
                                                    class="btn btn-success rounded-pill waves-effect waves-light"
                                                >{{ __('dashboard.Submit') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection

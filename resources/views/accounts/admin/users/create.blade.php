@extends('accounts.admin.admin')
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
                                <li class="breadcrumb-item"><a href="{{ asset('account-manager') }}">Admin</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                                <li class="breadcrumb-item active">Register</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Register Sales</h4>
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
                                        action="{{ url('register-sales') }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                    >Name</label>
                                                    <input
                                                        type="text"
                                                        id="name"
                                                        name="name"
                                                        placeholder="Name"
                                                        class="form-control"
                                                        required
                                                    >
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="phone"
                                                        class="form-label"
                                                    >Phone</label>
                                                    <input
                                                        type="text"
                                                        id="phone"
                                                        name="phone"
                                                        placeholder="Phone"
                                                        class="form-control"
                                                        required
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
                                                    >Password</label>
                                                    <input
                                                        type="password"
                                                        id="password"
                                                        name="password"
                                                        placeholder="Password"
                                                        class="form-control"
                                                        required
                                                    >
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="confirm_password"
                                                        class="form-label"
                                                    >Confirm Password</label>
                                                    <input
                                                        type="password"
                                                        id="confirm_password"
                                                        name="confirm_password"
                                                        placeholder="Confirm Password"
                                                        class="form-control"
                                                        required
                                                    >
                                                    @if ($errors->has('confirm_password'))
                                                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="col-md-12 mb-3">
                                                    <label
                                                        for="image"
                                                        class="form-label"
                                                    >Profile Picture</label>
                                                    <input
                                                        type="file"
                                                        name="image"
                                                        class="form-control"
                                                        required
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
                                                >Submit</button>
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

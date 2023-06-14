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
                            });
                        });
                    </script>
                @endif
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ asset('account-manager') }}">Admin</a></li>
                                <li class="breadcrumb-item active">Reset</li>
                                <li class="breadcrumb-item active">Password</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Reset Password</h4>
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
                                        action="{{ url('change-password-admin/' . $user->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <h6>Role: {{ $user->role }}</h6>
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
                                                        value="{{ $user->name }}"
                                                        placeholder="Name"
                                                        class="form-control"
                                                        disabled
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
                                                        value="{{ $user->phone }}"
                                                        name="phone"
                                                        placeholder="Phone"
                                                        class="form-control"
                                                        disabled
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
                                                        type="text"
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
                                                    >Confirm Password</label>
                                                    <input
                                                        type="text"
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

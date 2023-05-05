@extends('accounts.admin.admin')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
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
                                                    >
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                    >Phone</label>
                                                    <input
                                                        type="text"
                                                        id="phone"
                                                        name="phone"
                                                        placeholder="phone"
                                                        class="form-control"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label
                                                        for="example-password"
                                                        class="form-label"
                                                    >Password</label>
                                                    <input
                                                        type="text"
                                                        id="password"
                                                        class="form-control"
                                                        value="password"
                                                    >
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="example-password"
                                                        class="form-label"
                                                    >Confirm Password</label>
                                                    <input
                                                        type="text"
                                                        id="example-password"
                                                        class="form-control"
                                                        value="confirm password"
                                                        name="confirm-password"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="col-md-12 mb-3">
                                                    <label
                                                        for="example-password"
                                                        class="form-label"
                                                    >Profile Picture</label>
                                                    <input
                                                        type="file"
                                                        name="image"
                                                        class="form-control"
                                                    >
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

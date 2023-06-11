@extends('accounts.customer.admin')
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('dashboard.Customer') }}</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('dashboard.ContactUs') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('dashboard.View') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('dashboard.ContactUs') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo & title -->
                            <div class="clearfix">
                                <div class="float-start">
                                    <div class="auth-logo">
                                        <div class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img
                                                    src="assets/images/logo-dark.png"
                                                    alt=""
                                                    height="22"
                                                >
                                            </span>
                                        </div>

                                        <div class="logo logo-light">
                                            <span class="logo-lg">
                                                <img
                                                    src="assets/images/logo-light.png"
                                                    alt=""
                                                    height="22"
                                                >
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">{{ __('dashboard.ContactUs') }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <img
                                            src="{{ asset('assets/images/payment/' . $user->image) }}"
                                            alt=""
                                        >
                                        <h5>WhatsApp Number: +036 95895 9559</h5>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    @endsection

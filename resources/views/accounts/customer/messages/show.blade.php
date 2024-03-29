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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('dashboard.Customer') }}</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('dashboard.Meassage') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('dashboard.View') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('dashboard.Message') }}</h4>
                    </div>
                    <div class="mb-4">
                        <a
                            href="{{ url('customer-view-message') }}"
                            type="button"
                            class="btn btn-info rounded-pill waves-effect waves-light"
                        >
                            <span class="btn-label"><i class="fe-arrow-left-circle"></i></span>{{ __('dashboard.Back') }}
                        </a>
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
                                    <h4 class="m-0 d-print-none">{{ __('dashboard.Messages') }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div
                                    class="col-8"
                                    style="margin: 20px auto;"
                                >
                                    @if (app()->getLocale() === 'en')
                                        <label for="">{{ __('dashboard.Subject') }} : {{ $messages->subject }}</label>
                                        <p>{{ $messages->message_body }}</p>
                                    @else
                                        <label for="">{{ __('dashboard.Subject') }} : {{ $messages->subject_am }}</label>
                                        <p>{{ $messages->message_body_am }}</p>
                                    @endif
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

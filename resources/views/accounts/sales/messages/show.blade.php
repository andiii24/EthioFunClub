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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('dashboard.Sales') }}</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('dashboard.Meassage') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('dashboard.View') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('dashboard.Message') }}</h4>
                    </div>
                    <div class="mb-4">
                        <a
                            href="{{ url('sales-view-message') }}"
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
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b style="text-transform: capitalize;">{{ __('dashboard.To') }} :{{ auth()->user()->name }}</b></p>
                                    </div>

                                </div><!-- end col -->
                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3 float-end">
                                        <p><strong>{{ __('dashboard.Message_Date') }} : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; {{ $messages->created_at->diffForHumans() }}</span></p>
                                        </span></p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div
                                    class="col-8"
                                    style="margin: 20px auto;"
                                >
                                    @if (app()->getLocale() === 'am')
                                        <label for="">{{ __('dashboard.Subject_am') }} : {{ $messages->subject_am }}</label>
                                        <p>{{ $messages->message_body_am }}</p>
                                    @else
                                        <label for="">{{ __('dashboard.Subject') }} : {{ $messages->subject }}</label>
                                        <p>{{ $messages->message_body }}</p>
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

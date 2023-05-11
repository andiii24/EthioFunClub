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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Invoice</h4>
                    </div>
                    <div class="mb-4">
                        <a
                            href="{{ url('account-manager-payments') }}"
                            type="button"
                            class="btn btn-info rounded-pill waves-effect waves-light"
                        >
                            <span class="btn-label"><i class="fe-arrow-left-circle"></i></span>Back
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
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b style="text-transform: capitalize;">Name: {{ $payments->user->name }}</b></p>
                                        <p><b style="text-transform: capitalize;">Role: {{ $payments->user->role }}</b></p>
                                        <p><b>Phone Number: {{ $payments->user->phone }}</b></p>
                                    </div>

                                </div><!-- end col -->
                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3 float-end">
                                        <p><strong>Payment Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; {{ $payments->created_at->diffForHumans() }}</span></p>
                                        <p><strong>Payment Status : </strong> <span class="float-end">
                                                @if ($payments->status == '0')
                                                    <span class="badge bg-danger">Unpaid</span>
                                                @else
                                                    <span class="badge bg-success">Paid</span>
                                                @endif
                                            </span></p>
                                        <p><strong>Payment No. : </strong> <span class="float-end">{{ $payments->id }} </span></p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div
                                    class="col-8"
                                    style="margin: 20px auto;"
                                >
                                    <img
                                        src="{{ asset('assets/images/payment/' . $payments->paymet_img) }}"
                                        alt=""
                                        class="img-fluid"
                                        style="box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);max-width: 100%; height: auto;"
                                    >
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="m-0">Total Payment: ${{ $payments->amount }} ETB</h3>
                                        @if ($payments->status == 0)
                                            <button
                                                type="button"
                                                class="btn btn-success rounded-pill waves-effect waves-light"
                                                onclick="activateUser(event.target.getAttribute('data-user-id'), event.target.getAttribute('data-payment-id'))"
                                                data-user-id="{{ $payments->user->id }}"
                                                data-payment-id="{{ $payments->id }}"
                                            >
                                                Approve
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->
        
        <script>
            function activateUser(userId, paymentId) {
                $.ajax({
                    type: 'POST',
                    url: '{{ url('update-status') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'user_id': userId,
                        'payment_id': paymentId
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();

                        // You can also update the UI here to reflect the new status
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }
        </script>
    @endsection

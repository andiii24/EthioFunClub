@extends('accounts.sales.admin')
@section('content')
    <!-- Content Header (Page header) -->
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

                <div
                    id="danger-alert-modal"
                    class="modal fade"
                    tabindex="-1"
                    aria-hidden="true"
                    style="display: none;"
                >
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-danger">
                            <div class="modal-body p-4">
                                <div class="text-center">
                                    <i class="dripicons-wrong h1 text-white"></i>
                                    <h4 class="mt-2 text-white">{{ __('dashboard.AccountNotActive') }}</h4>
                                    @if ($payment)
                                        <p class="mt-3 text-white">{{ __('dashboard.waitingForApproval') }}</p>
                                        <button
                                            type="button"
                                            class="btn btn-light my-2"
                                            data-bs-dismiss="modal"
                                        >{{ __('dashboard.Continue') }}</button>
                                    @else
                                        <p class="mt-3 text-white">{{ __('dashboard.PayMembership') }}</p>
                                        <button
                                            type="button"
                                            class="btn btn-light my-2"
                                            data-bs-dismiss="modal"
                                            id="attach-payment-button"
                                        >{{ __('dashboard.Attach_Slip') }}</button>
                                    @endif

                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <div class="col-10">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ __('dashboard.Dashboard') }}</h4>
                    </div>
                </div>
                @if (auth()->user()->status == 0)
                    <div class="col-2">
                        <div class="mt-3">
                            <button
                                type="button"
                                class="btn btn-danger rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#danger-alert-modal"
                            >{{ __('dashboard.NotActive') }}</button>
                        </div>
                    </div>
                @else
                    <div class="col-2"></div>
                @endif
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-soft-blue border-blue border">
                                        <i class="fe-shopping-cart font-22 avatar-title text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalSalesCountToday }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">{{ __('dashboard.TodaySale') }}</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                        <i class="fe-award font-22 avatar-title text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $totalSalesCount }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">{{ __('dashboard.TotalSales') }}</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
                @if (auth()->user()->status == 1)
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3 header-title text-center">{{ __('dashboard.RegisterSerialNumber') }}</h4>

                                <form
                                    action="{{ url('sales-register-serial') }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    <div class="mb-3">
                                        <label
                                            for="serialNumber"
                                            class="form-label"
                                        >{{ __('dashboard.productSerialNumber') }}</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="serialNumber"
                                            name="serial_num"
                                            aria-describedby="emailHelp"
                                            placeholder="Enter Product Serial Number"
                                        >
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary waves-effect waves-light"
                                    >{{ __('dashboard.Submit') }}</button>
                                </form>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div><!-- end col-->
                @endif
            </div>
            <!-- end row-->
            <!-- end row -->

        </div> <!-- container -->

    </div>
    <!-- content -->
    <!-- /.content -->
    <script>
        document.getElementById("attach-payment-button").addEventListener("click", function() {
            window.location.href = "/attach-payment-sales";
        });
    </script>
@endsection

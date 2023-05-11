@extends('accounts.sales.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
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
                                    <h4 class="mt-2 text-white">Account Not Active!</h4>
                                    @if ($payment)
                                        <p class="mt-3 text-white">Waiting for payment approval</p>
                                        <button
                                            type="button"
                                            class="btn btn-light my-2"
                                            data-bs-dismiss="modal"
                                        >Continue</button>
                                    @else
                                        <p class="mt-3 text-white">To activate your account you have to pay for your membership</p>
                                        <button
                                            type="button"
                                            class="btn btn-light my-2"
                                            data-bs-dismiss="modal"
                                            id="attach-payment-button"
                                        >Attach payment</button>
                                    @endif

                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <div class="col-10">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
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
                            >Not Active</button>
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
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Today's Sales</p>
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
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">8</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Sales</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <!-- end row -->

        </div> <!-- container -->

    </div>
    <!-- content -->
    <!-- /.content -->
@endsection
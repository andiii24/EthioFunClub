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
                                <li class="breadcrumb-item"><a href="{{ asset('sales-manager') }}">{{ __('dashboard.Sales') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('dashboard.Payment') }}</li>
                                <li class="breadcrumb-item active">{{ __('dashboard.Attach') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('dashboard.Attach_payment_slip') }}</h4>
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
                                        action="{{ url('submit-sales-slip') }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        <div class="row">
                                            <div
                                                class="col-lg-8"
                                                style="margin: 0 auto !important;"
                                            >
                                                <div class="">
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                    >{{ __('dashboard.Acount_Number') }}: 10001232321 (CBE)</label>
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                    >{{ __('dashboard.Name') }}: {{ __('dashboard.Account_Holder') }}</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="mb-3">
                                                            <label
                                                                for="amount"
                                                                class="form-label"
                                                            >{{ __('dashboard.Amount') }} (ETB)</label>
                                                            <input
                                                                type="number"
                                                                id="number"
                                                                name="amount"
                                                                placeholder="Amount in ETB"
                                                                class="form-control"
                                                                required
                                                            >
                                                            @if ($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label
                                                            for="image"
                                                            class="form-label"
                                                        >{{ __('dashboard.Attach_Slip') }}</label>
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

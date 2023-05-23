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
                                        action="{{ url('generate-serial') }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label
                                                        for="count"
                                                        class="form-label"
                                                    >How many serial Numbers</label>
                                                    <input
                                                        type="number"
                                                        id="count"
                                                        name="count"
                                                        placeholder="How much?"
                                                        class="form-control"
                                                        required
                                                    >
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
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

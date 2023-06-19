@extends('accounts.admin.admin')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $title }}</h4>
                </div>
            </div>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $SalesCountToday }}</span></h3>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $sales }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Sales</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
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
            <form
                action="{{ url('filtering-sales') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="col-12 mb-2">
                    <div class="row align-items-center">
                        <div class="col-sm-auto">
                            <select
                                id="demo-foo-filter-status"
                                class="form-select form-select-sm"
                                name="filter"
                            >
                                <option value="1">Show all</option>
                                <option value="2">Today</option>
                                <option value="3">This Week</option>
                                <option value="4">This Month</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <button
                                type="submit"
                                class="btn btn-sm btn-success rounded-pill waves-effect waves-light"
                            >Search</button>
                        </div>
                        <div class="col-3">
                            <a
                                class="btn btn-sm btn-success rounded-pill waves-effect waves-light"
                                href="{{ url('export-sales') }}"
                            > Export to Excel <i class=" fas fa-file-excel"></i> </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table
                            id="basic-datatable"
                            class="table dt-responsive nowrap w-100"
                        >
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Sold By</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Serial Number</th>
                                    <th class="text-center">Sold On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $item->user->name }}</td>
                                        <td class="text-center">{{ $item->user->phone }}</td>
                                        <td class="text-center">{{ $item->user->role }}</td>
                                        <td class="text-center">{{ $item->serial_num }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->
    </div>
    <!-- container -->
@endsection

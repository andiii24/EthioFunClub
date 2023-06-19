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
                                <li class="breadcrumb-item"><a href="{{ asset('account-manager') }}">Admin</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ $title }}</h4>
                    </div>
                </div>
                <form
                    action="{{ url('filtering-user-sales') }}"
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
                                    <option value="0">Level 0</option>
                                    <option value="2">Level 1</option>
                                    <option value="3">Level 2</option>
                                    <option value="4">Level 3</option>
                                    <option value="5">Level 4</option>
                                    <option value="6">Level 5 and above</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-success rounded-pill waves-effect waves-light"
                                >Search</button>
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
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Level</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->level }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-success width-xs rounded-pill waves-effect waves-light btn-xs"
                                                        >Edit</button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-danger width-xs rounded-pill waves-effect waves-light btn-xs"
                                                        >Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                            </td>
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

    </div>
@endsection

@extends('accounts.customer.admin')
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
                                <li class="breadcrumb-item"><a href="{{ asset('customer-manager') }}">{{ Auth::user()->name }}</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Customers</h4>
                    </div>
                </div>
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
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone }}</td>
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
    <script>
        function activateUser(userId) {
            $.ajax({
                type: 'POST',
                url: '{{ url('update-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': userId
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

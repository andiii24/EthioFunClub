@extends('accounts.sales.admin')
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
                                <li class="breadcrumb-item"><a href="{{ asset('sales-manager') }}">Sales</a></li>
                                <li class="breadcrumb-item active">Messages</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Messages</h4>
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
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a
                                                            type="button"
                                                            href="{{ url('show-payment-slip/' . $item->id) }}"
                                                            class="btn btn-outline-success width-xs rounded-pill waves-effect waves-light btn-xs"
                                                        >read</a>

                                                    </div>
                                                </div>
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
    <script>
        function activateUser(messageId) {
            $.ajax({
                type: 'POST',
                url: '{{ url('update-message-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': messageId
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

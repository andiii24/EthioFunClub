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
                                <li class="breadcrumb-item"><a href="{{ asset('customer-manager') }}">customer</a></li>
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
                                                        <button
                                                            type="button"
                                                            onclick="readMsg(event.target.getAttribute('data-message-id'))"
                                                            data-message-id="{{ $item->id }}"
                                                            class="btn btn-outline-success width-xs rounded-pill waves-effect waves-light btn-xs"
                                                        >read</button>

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
        function readMsg(messageId) {
            $.ajax({
                type: 'POST',
                url: '{{ url('update-message-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'msg_id': messageId
                },
                success: function(response) {
                    alert(response.message);
                    window.location.href = '{{ url('read-message') }}' + '/' + messageId;
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    </script>
@endsection

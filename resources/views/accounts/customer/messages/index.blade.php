@extends('accounts.customer.admin')
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
                                <li class="breadcrumb-item"><a href="{{ asset('customer-manager') }}">customer</a></li>
                                <li class="breadcrumb-item active">{{ __('dashboard.Messages') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('dashboard.Messages') }}</h4>
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
                                        <th>{{ __('dashboard.No') }}</th>
                                        <th>{{ __('dashboard.Subject') }}</th>
                                        <th>{{ __('dashboard.Date') }}</th>
                                        <th>{{ __('dashboard.Action') }}</th>
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
                                                        >{{ __('dashboard.read') }}</button>

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

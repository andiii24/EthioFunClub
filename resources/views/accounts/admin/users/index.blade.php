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
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Datatables</h4>
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
                                        <th>Role</th>
                                        <th>Phone</th>
                                        <th>Registerd Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <a
                                                            href="{{ url('edit-sales/' . $item->id) }}"
                                                            type="button"
                                                            class="btn btn-outline-info width-xs rounded-pill waves-effect waves-light btn-xs"
                                                        >Edit</a>
                                                    </div>

                                                    <div class="col-3">
                                                        @if ($item->status == 1)
                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-warning width-xs rounded-pill waves-effect waves-light btn-xs"
                                                                onclick="changeUserStatus(event.target.getAttribute('data-user-id'), 'deactivate')"
                                                                data-user-id="{{ $item->id }}"
                                                            >
                                                                Deactivate
                                                            </button>
                                                        @elseif($item->status == 0)
                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-success width-xs rounded-pill waves-effect waves-light btn-xs"
                                                                onclick="changeUserStatus(event.target.getAttribute('data-user-id'), 'activate')"
                                                                data-user-id="{{ $item->id }}"
                                                            >
                                                                Activate
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="col-3">
                                                        @if ($item->level == 0 && $item->role != 'admin')
                                                            <form
                                                                action="{{ url('delete-user/' . $item->id) }}"
                                                                method="POST"
                                                            >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-outline-danger width-xs rounded-pill waves-effect waves-light btn-xs"
                                                                >Delete</button>
                                                            </form>
                                                        @endif
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
    <script>
        function changeUserStatus(userId, action) {
            $.ajax({
                type: 'POST',
                url: '{{ url('change-user-status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': userId,
                    'action': action
                },
                success: function(response) {
                    // Update the UI to reflect the new status instantly
                    if (action === 'deactivate') {
                        $('#status_' + userId).text('Inactive');
                    } else if (action === 'activate') {
                        $('#status_' + userId).text('Active');
                    }

                    // Reload the table while preserving the current page and session
                    reloadTable();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    </script>
@endsection

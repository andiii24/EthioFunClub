@php
    use App\Models\User;
@endphp
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
                <div
                    class="col-12"
                    {{-- style="display: flex;
                    justify-content: center;" --}}
                >
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ asset('customer-manager') }}">Sales</a></li>
                                <li class="breadcrumb-item active"><a href="{{ url('child/' . $user->id) }}">Genealogy</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><a href="{{ url('child/' . auth()->user()->id) }}">Genealogy</a></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">
                <!-- Center the tree -->
                <div
                    class="col-12"
                    {{-- style="display: flex;
                    justify-content: center;" --}}
                >
                    <div class="card">
                        <div class="card-body">
                            <!-- Your other HTML code -->
                            <div
                                class="tree"
                                style="display: flex;
                                    justify-content: center;"
                            >
                                <ul>
                                    <li>
                                        <a href="#">{{ $user->name }}</a>
                                        <ul>
                                            @foreach ($users as $user)
                                                <li>
                                                    <a href="{{ url('child/' . $user->id) }}">{{ $user->name }}</a>
                                                    @php
                                                        $children = User::where('upid', $user->id)->get();
                                                    @endphp

                                                    @if ($children->count() > 0)
                                                        <ul>
                                                            @foreach ($children as $child)
                                                                <li>
                                                                    <a href="{{ url('child/' . $child->id) }}">{{ $child->name }}</a>
                                                                    @include('accounts.customer.genealogy.partials.tree', ['user' => $child])
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- Your other HTML code -->
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

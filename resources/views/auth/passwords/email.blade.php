@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}
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
                                        position: 'top-end', // Position of the toast notification
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
                                        position: 'top-end', // Position of the toast notification
                                        timerProgressBar: true, // Show a progress bar during the display duration
                                    });
                                });
                            </script>
                        @endif
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div
                                class="alert alert-success"
                                role="alert"
                            >
                                {{ session('status') }}
                            </div>
                        @endif

                        <form
                            method="POST"
                            action="{{ url('password-forgot') }}"
                        >
                            @csrf
                            <div class="row mb-3">
                                <label
                                    for="phone"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('dashboard.Phone') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="phone"
                                        type="number"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        required
                                        autocomplete="email"
                                        autofocus
                                    >

                                    @error('phone')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="Name"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('dashboard.Name') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        required
                                        autocomplete="name"
                                        autofocus
                                    >

                                    @error('name')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        {{ __('dashboard.SendRequest') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

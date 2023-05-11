@extends('accounts.admin.admin')
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
                                <li class="breadcrumb-item"><a href="{{ asset('account-manager') }}">Admin</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                                <li class="breadcrumb-item active">Send Message</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Send Message</h4>
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
                                        action="{{ url('message-send') }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        <div class="row">
                                            <div
                                                class="col-lg-10"
                                                style="margin: 0 auto !important;
                                              }"
                                            >

                                                <div class="mb-3">
                                                    <label
                                                        for="example-select"
                                                        class="form-label"
                                                    > Send To</label>
                                                    <select
                                                        class="form-select"
                                                        id="example-select"
                                                        name="user_id"
                                                        required
                                                    >
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        for="subject"
                                                        class="form-label"
                                                    >Subject</label>
                                                    <input
                                                        type="text"
                                                        id="subject"
                                                        name="subject"
                                                        placeholder="subject"
                                                        class="form-control"
                                                        required
                                                    >
                                                    @if ($errors->has('subject'))
                                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                                    @endif
                                                </div>
                                                <div class="mb-3 text">
                                                    <label
                                                        for="example-textarea"
                                                        class="form-label"
                                                    >Text area</label>
                                                    <textarea
                                                        class="form-control"
                                                        id="example-textarea"
                                                        rows="5"
                                                        name="message"
                                                    ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
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

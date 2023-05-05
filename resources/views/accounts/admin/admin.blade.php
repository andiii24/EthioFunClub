<!DOCTYPE html>
<html lang="en">

@include('accounts.admin.layout.head')
<!-- body start -->

<body
    data-layout-mode="detached"
    data-theme="light"
    data-topbar-color="dark"
    data-menu-position="fixed"
    data-leftbar-color="light"
    data-leftbar-size='default'
    data-sidebar-user='true'
>


    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        @include('accounts.admin.layout.nav')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('accounts.admin.layout.sidebar')

        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            @yield('content')
            <!-- Footer Start -->
            @include('accounts.admin.layout.footer')

            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    <!-- Right Sidebar -->
    <!-- /Right-bar -->
    {{-- @include('accounts.admin.layout.rightbar') --}}

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>
    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

</body>

</html>

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
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true
            });
        });
    </script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>
    <!-- App js-->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- Datatables init -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
</body>

</html>

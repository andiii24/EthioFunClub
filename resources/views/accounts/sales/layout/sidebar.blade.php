<div class="left-side-menu">

    <div
        class="h-100"
        data-simplebar
    >

        <!-- User box -->
        <div class="user-box text-center">
            <img
                src="{{ asset('assets/images/users/user-6.jpg') }}"
                alt="user-img"
                title="Mat Helme"
                class="rounded-circle avatar-md"
            >
            <div class="dropdown">
                <a
                    href="javascript: void(0);"
                    class="text-black dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown"
                >Account Manager</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a
                        href="javascript:void(0);"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a
                        href="javascript:void(0);"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a
                        href="javascript:void(0);"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a
                        href="javascript:void(0);"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ url('sales-manager') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a
                        href="#users"
                        data-bs-toggle="collapse"
                    >
                        <i class="fe-user"></i>
                        <span> My Customers </span>
                    </a>
                    <div
                        class="collapse"
                        id="users"
                    >
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('sales-customer') }}">
                                    <i class="fe-users"></i>
                                    <span>All Customers </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('sales-create-customer') }}">
                                    <i class="fe-user-plus"></i>
                                    <span>Add Customer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ url('reports') }}">
                        <i class="fe-bar-chart-2"></i>
                        <span> Reports </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>

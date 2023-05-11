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
        </div
            <!---
            Sidemenu
            --
        >
        <div id="sidebar-menu">
            <ul id="side-menu">

                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ url('account-manager') }}">
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
                        <span> Users </span>
                    </a>
                    <div
                        class="collapse"
                        id="users"
                    >
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('users') }}">
                                    <i class="fe-users"></i>
                                    <span>All Users </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('create-user') }}">
                                    <i class="fe-user-plus"></i>
                                    <span>Add Sales Person</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('all-sales') }}">
                                    <i class="fe-user-x"></i>
                                    <span> Sales </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a
                        href="#message"
                        data-bs-toggle="collapse"
                    >
                        <i class="fe-mail"></i>
                        <span> Message </span>
                    </a>
                    <div
                        class="collapse"
                        id="message"
                    >
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('admin-message') }}">
                                    <i class="dripicons-conversation"></i>
                                    <span>Messages </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('send-message') }}">
                                    <i class="fe-navigation"></i>
                                    <span>Send Message</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ url('account-manager-payments') }}">
                        <i class="fe-dollar-sign"></i>
                        <span> Payments </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>

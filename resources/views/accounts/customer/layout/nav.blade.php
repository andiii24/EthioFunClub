<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">


            <li class="dropdown d-none d-lg-inline-block">
                <a
                    class="nav-link dropdown-toggle arrow-none waves-effect waves-light"
                    data-toggle="fullscreen"
                    href="#"
                >
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a
                    class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    aria-expanded="false"
                >
                    {{ __('dashboard.lang') }} <span class="caret"></span>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdown"
                >
                    <a
                        class="dropdown-item"
                        style="color: #6c757d;"
                        href="/en"
                    >
                        English
                    </a>
                    <a
                        class="dropdown-item"
                        style="color: #6c757d;"
                        href="/am"
                    >
                        አማርኛ
                    </a>
                    <a
                        class="dropdown-item"
                        style="color: #6c757d;"
                        href="/or"
                    >
                        Oromiffa
                    </a>
                </div>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a
                    class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    aria-expanded="false"
                >
                    <img
                        src="assets/images/users/user-6.jpg"
                        alt="user-image"
                        class="rounded-circle"
                    >
                    <span class="pro-user-name ms-1">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title"></div>

                    <!-- item-->
                    <a
                        href="{{ url('admin-profile') }}"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-user"></i>
                        <span> {{ __('dashboard.myAccount') }}</span>
                    </a>

                    <!-- item-->
                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-log-out"></i>
                        <span>{{ __('dashboard.Logout') }}</span>
                    </a>

                    <form
                        id="logout-form"
                        action="{{ route('logout') }}"
                        method="POST"
                        class="d-none"
                    >
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
        <!-- LOGO -->
        <div class="logo-box">
            <a
                href="{{ url('/') }}"
                class="logo logo-dark text-center"
            >
                <span class="logo-sm">
                    <img
                        src="{{ asset('assets/images/logo-sm.png') }}"
                        alt=""
                        height="22"
                    >
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img
                        src="{{ asset('assets/images/logo-dark.png') }}"
                        alt=""
                        height="20"
                    >
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a
                href="{{ url('/') }}"
                class="logo logo-light text-center"
            >
                <span class="logo-sm">
                    <img
                        src="{{ asset('assets/images/logo-sm.png') }}"
                        alt=""
                        height="22"
                    >
                </span>
                <span class="logo-lg">
                    <img
                        src="{{ asset('assets/images/logo-light.png') }}"
                        alt=""
                        height="60"
                    >
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a
                    class="navbar-toggle nav-link"
                    data-bs-toggle="collapse"
                    data-bs-target="#topnav-menu-content"
                >
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>

<div class="left-side-menu">
    <div
        class="h-100"
        data-simplebar
    >
        <!-- User box -->
        <div class="user-box text-center">
            <img
                src="{{ asset('assets/images/users/' . auth()->user()->image) }}"
                alt="user-img"
                title="Mat Helme"
                class="rounded-circle avatar-md"
            >
            <div class="dropdown">
                <a
                    href="javascript: void(0);"
                    class="text-black dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown"
                >{{ Auth::user()->name }}</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <!-- item-->
                    <a
                        href="{{ url('customer-profile') }}"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-user me-1"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <!-- item-->
                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item notify-item"
                    >
                        <i class="fe-log-out me-1"></i>
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
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">{{ __('dashboard.Navigation') }}</li>
                <li>
                    <a href="{{ url('customer-manager') }}">
                        <i data-feather="airplay"></i>
                        <span> {{ __('dashboard.Dashboard') }} </span>
                    </a>
                </li>
                @if (auth()->user()->status == 1)
                    <li>
                        <a
                            href="#users"
                            data-bs-toggle="collapse"
                        >
                            <i class="fe-user"></i>
                            <span> {{ __('dashboard.Customers') }}</span>
                        </a>
                        <div
                            class="collapse"
                            id="users"
                        >
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ url('customer-customer') }}">
                                        <i class="fe-users"></i>
                                        <span> {{ __('dashboard.All_Customers') }}</span>
                                    </a>
                                </li>
                                @if (!auth()->user()->left_child_id || !auth()->user()->middle_child_id || !auth()->user()->right_child_id)
                                    <li>
                                        <a href="{{ url('customer-create-customer') }}">
                                            <i class="fe-user-plus"></i>
                                            <span>{{ __('dashboard.Add_Customer') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('customer-genealogy') }}">
                            <i class="fe-layers"></i>
                            <span> {{ __('dashboard.My_Genealogy') }} </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('customer-sales') }}">
                            <i class="fe-dollar-sign"></i>
                            <span> {{ __('dashboard.Sales') }} </span>
                        </a>
                    </li>
                @elseif (auth()->user()->status == 0)
                    <li class="inactive-menu">
                        <a
                            href="#users"
                            data-bs-toggle="collapse"
                        >
                            <i class="fe-user"></i>
                            <span> {{ __('dashboard.Customers') }}</span>
                        </a>
                        <div
                            class="collapse"
                            id="users"
                        >
                            <ul class="nav-second-level">
                                <li>
                                    <a href="#">
                                        <i class="fe-users"></i>
                                        <span> {{ __('dashboard.All_Customers') }}</span>
                                    </a>
                                </li>
                                @if (!auth()->user()->left_child_id || !auth()->user()->middle_child_id || !auth()->user()->right_child_id)
                                    <li>
                                        <a href="#">
                                            <i class="fe-user-plus"></i>
                                            <span>{{ __('dashboard.Add_Customer') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="inactive-menu">
                        <a href="#">
                            <i class="fe-layers"></i>
                            <span> {{ __('dashboard.My_Genealogy') }} </span>
                        </a>
                    </li>
                    <li class="inactive-menu">
                        <a href="#">
                            <i class="fe-dollar-sign"></i>
                            <span> {{ __('dashboard.Sales') }} </span>
                        </a>
                    </li>
                @endif
                <li>
                    <a
                        href="#payment"
                        data-bs-toggle="collapse"
                    >
                        <i class="fe-award"></i>
                        <span> {{ __('dashboard.Payment') }}</span>
                    </a>
                    <div
                        class="collapse"
                        id="payment"
                    >
                        <ul class="nav-second-level">
                            @if (auth()->user()->status == 1)
                                <li>
                                    <a href="{{ url('customer-payment-history') }}">
                                        <i class="fe-award"></i>
                                        <span> {{ __('dashboard.PaymentHistory') }}</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ url('customer-make-payment') }}">
                                    <i class="fe-plus-circle"></i>
                                    <span>{{ __('dashboard.MakePayment') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ url('customer-view-message') }}">
                        <i class="fe-mail"></i>
                        <span> {{ __('dashboard.Messages') }}</span>
                        @if ($requestCount > 0)
                            <span class="badge bg-danger rounded-circle noti-icon-badge counter">{{ $requestCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ url('contact-us') }}">
                        <i class="fe-info"></i>
                        <span> {{ __('dashboard.ContactUs') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>

<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">

        <!--begin::Left: Hamburger (mobile only)-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2">
            <button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </button>
        </div>
        <!--end::Left-->

        <!--begin::Page title (opsional, bisa diganti breadcrumb)-->
        <div class="d-flex align-items-center flex-grow-1">
            <h1 class="d-flex text-dark fw-bold fs-3 align-items-center my-0">
                @yield('title', 'Dashboaard')
            </h1>
        </div>
        <!--end::Page title-->

        <!--begin::Right: User Menu-->
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                     data-kt-menu-trigger="click"
                     data-kt-menu-attach="parent"
                     data-kt-menu-placement="bottom-end">
                    <img src="{{ asset('metronic/assets/media/avatars/300-1.jpg') }}" alt="user" />
                </div>
                <!--begin::User dropdown menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800
                            menu-state-bg menu-state-primary fw-semibold py-4 fs-6 w-275px"
                     data-kt-menu="true">

                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{ asset('metronic/assets/media/avatars/300-1.jpg') }}" />
                            </div>
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">
                                    {{ Auth::user()->name ?? 'Guest' }}
                                </div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                    {{ Auth::user()->email ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="separator my-2"></div>

                    <div class="menu-item px-5">
                        <a href="{{ route('profile.show') }}" class="menu-link px-5">My Profile</a>
                    </div>

                    <div class="menu-item px-5">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="menu-link px-5 border-0 bg-transparent w-100 text-start">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                <!--end::User dropdown menu-->
            </div>
        </div>
        <!--end::Right-->

    </div>
    <!--end::Container-->
</div>
<!--end::Header-->

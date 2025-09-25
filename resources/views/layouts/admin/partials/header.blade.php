<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        
        <!--begin::Header Logo (Visible on mobile)-->
        <div class="d-flex align-items-center d-lg-none me-2">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
        </div>
        <!--end::Header Logo-->

        <!--begin::Page Title-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <h1 class="d-flex align-items-center text-dark fw-bold fs-3 my-0">
                @yield('page-title', 'E-COMMERECE')
            </h1>
        </div>
        <!--end::Page Title-->

        <!--begin::Navbar-->
        <div class="d-flex align-items-stretch justify-self-end flex-shrink-0">
            
            <!--begin::Search-->
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px" id="kt_header_search_toggle">
                    <i class="ki-outline ki-magnifier fs-2"></i>
                </div>
            </div>
            <!--end::Search-->

            <!--begin::Notifications-->
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px position-relative" id="kt_activities_toggle">
                    <i class="ki-outline ki-notification-status fs-2"></i>
                    <span class="bullet bullet-dot bg-danger position-absolute top-0 start-50 translate-middle"></span>
                </div>
            </div>
            <!--end::Notifications-->

            <!--begin::User Menu-->
            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="user"/>
                </div>
                <!--begin::User Account Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{ asset('assets/media/avatars/300-1.jpg') }}" />
                            </div>
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name ?? 'Admin' }}</div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-5">
                        <a href="{{ route('profile.show') }}" class="menu-link px-5">My Profile</a>
                    </div>
                    <div class="menu-item px-5">
                        <a href="{{ route('settings.index') }}" class="menu-link px-5">Settings</a>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-5">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="menu-link px-5 btn btn-link text-start w-100">Sign Out</button>
                        </form>
                    </div>
                </div>
                <!--end::User Account Menu-->
            </div>
            <!--end::User Menu-->

        </div>
        <!--end::Navbar-->

    </div>
    <!--end::Container-->
</div>
<!--end::Header-->

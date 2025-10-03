<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable shadow-lg"
     data-kt-drawer="true"
     data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'220px', '300px': '260px'}"
     data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <!--begin::Brand-->
    <div class="aside-logo d-flex flex-column align-items-center py-4"> 
        <a href="{{ route('admin.dashboard') }}"> 
            <div class="logo-box">
                <img alt="Logo" src="{{ asset('assets/media/logos/no-background.png') }}" 
                    width="100" height="100" /> 
            </div>
        </a> 
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 pe-3" id="kt_aside_menu_wrapper"
             data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
             data-kt-scroll-height="auto"
             data-kt-scroll-offset="0">

            <!--begin::Menu-->
            <div class="menu menu-column fw-semibold" id="#kt_aside_menu" data-kt-menu="true">

                <!-- Dashboard -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon"><i class="ki-outline ki-element-11 fs-2"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <!-- Notifikasi -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/notifications*') ? 'active' : '' }}" 
                       href="{{ route('admin.notifications.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-notification fs-2"></i></span>
                        <span class="menu-title">Notifikasi</span>
                        @if(auth()->user()->unreadNotifications->count())
                            <span class="badge badge-sm badge-danger ms-2">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Master Data -->
                <div class="menu-content pt-5 pb-2 text-muted fs-7 text-uppercase">Master Data</div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/products*') ? 'active' : '' }}" 
                       href="{{ route('products.adminIndex') }}">
                        <span class="menu-icon"><i class="ki-outline ki-basket fs-2"></i></span>
                        <span class="menu-title">Products</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/categories*') ? 'active' : '' }}" 
                       href="{{ route('categories.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-category fs-2"></i></span>
                        <span class="menu-title">Categories</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/promos*') ? 'active' : '' }}" 
                       href="{{ route('admin.promos.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-discount fs-2"></i></span>
                        <span class="menu-title">Promos</span>
                    </a>
                </div>

                <!-- Orders -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/orders*') ? 'active' : '' }}" 
                       href="{{ route('admin.orders.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-truck fs-2"></i></span>
                        <span class="menu-title">Orders</span>
                    </a>
                </div>

                <!-- Manajemen -->
                <div class="menu-content pt-5 pb-2 text-muted fs-7 text-uppercase">Manajemen</div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/users*') ? 'active' : '' }}" 
                       href="{{ route('users.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-people fs-2"></i></span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
<!-- 
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/reports*') ? 'active' : '' }}" 
                       href="{{ route('reports.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-chart fs-2"></i></span>
                        <span class="menu-title">Reports</span>
                    </a>
                </div> -->
                <!-- Contact Us -->
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/contacts*') ? 'active' : '' }}" 
                    href="{{ route('admin.contacts.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-message-text-2 fs-2"></i></span>
                        <span class="menu-title">Contact Us</span>
                    </a>
                </div>
<!-- 
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}" 
                       href="{{ route('settings.index') }}">
                        <span class="menu-icon"><i class="ki-outline ki-setting-3 fs-2"></i></span>
                        <span class="menu-title">Settings</span>
                    </a>
                </div> -->

            </div>
            <!--end::Menu-->

        </div>
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->

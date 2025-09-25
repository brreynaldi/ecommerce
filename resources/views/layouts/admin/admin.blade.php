<!DOCTYPE html>
<html lang="en">
@include('layouts.admin.partials.head')

<body id="kt_body" class="header-fixed aside-enabled aside-fixed">

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid" id="kt_page">

            <!--begin::Aside / Sidebar-->
            @include('layouts.admin.partials.sidebar')
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!--begin::Header-->
                @include('layouts.admin.partials.header')
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div class="container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                @include('layouts.admin.partials.footer')
                <!--end::Footer-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    @include('layouts.admin.partials.scripts')
</body>
</html>

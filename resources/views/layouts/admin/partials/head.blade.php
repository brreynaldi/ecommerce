<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logos/favicon.ico') }}" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Vendor Styles -->
    <link href="{{ asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" />

    <!-- Global Styles (Metronic core) -->
    <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" />

    <!-- Custom Styles (Override Metronic) -->
    <style>
        /* Sidebar Styling */
        /* Sidebar transition */
        #kt_aside {
            transition: transform 0.3s ease, width 0.3s ease;
        }

        /* Saat sidebar tertutup (drawer Metronic otomatis pakai transform) */
        .aside.aside-dark[data-kt-drawer="false"][data-kt-drawer-state="off"] {
            transform: translateX(-100%) !important;
        }
        .menu-link {
            color: #cfd2da;
            transition: all 0.2s;
        }
        .menu-link:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .menu-link.active {
            background: #2a2a3d;
            color: #fff !important;
            border-left: 4px solid #00c6ff;
        }
        .menu-icon i {
            color: #a0aec0;
        }
        .menu-link.active .menu-icon i,
        .menu-link:hover .menu-icon i {
            color: #00c6ff;
        }
        body.aside-minimize #kt_aside_toggle .toggle-on {
            display: none !important;
        }
        body.aside-minimize #kt_aside_toggle .toggle-off {
            display: inline-block !important;
        }
        body.aside-minimize #kt_aside {
    width: 70px;
    transition: width 0.3s ease;
}

body.aside-minimize #kt_aside .menu-title {
    display: none;
}
        #kt_aside_menu_wrapper {
            overflow-x: auto !important;
            overflow-y: auto !important; /* tetap bisa geser atas–bawah */
            -webkit-overflow-scrolling: touch; /* biar smooth di mobile */
            white-space: nowrap; /* biar item tidak turun ke bawah */
        }
        #kt_aside_menu_wrapper::-webkit-scrollbar {
            height: 6px; /* scrollbar horizontal */
        }

    </style>
</head>

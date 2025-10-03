<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Linea Bridal')</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body { 
      background-color: #f8f9fa; 
      font-family: 'Segoe UI', sans-serif; 
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main { flex: 1; }

    /* Navbar */
    .navbar { 
      box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
      padding: 12px 0; 
      transition: all 0.3s ease;
    }
    .navbar-brand { font-size: 1.6rem; font-weight: 700; color: #0d6efd !important; }
    .nav-link { font-weight: 500; transition: color 0.2s ease; }
    .nav-link:hover { color: #0d6efd; }

    /* Footer (auto bottom) */
    footer.footer-elegant { 
      background: linear-gradient(135deg, #0a0f29, #1a1f3b); 
      color: #fff; 
      padding: 20px 0;
      margin-top: auto;
    }
    .text-gold { color: #f1c40f; }

    /* Bottom nav mobile */
    .bottom-nav {
      border-top: 1px solid #ddd;
      background: #fff;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1030;
      box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
    }
    .bottom-nav a {
      flex: 1;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      color: #6c757d;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      transition: all 0.3s ease;
    }
    .bottom-nav a i {
      font-size: 20px;
      margin-bottom: 2px;
    }
    .bottom-nav a.active, 
    .bottom-nav a:hover {
      color: #0d6efd;
    }
    /* Highlight bulat bawah icon */
    .bottom-nav a.active::after {
      content: "";
      width: 6px;
      height: 6px;
      background: #0d6efd;
      border-radius: 50%;
      position: absolute;
      bottom: 4px;
    }

    .product-img-wrapper {
  width: 100%;
  aspect-ratio: 1/1; /* kotak */
  overflow: hidden;
  display: block;
  background: #fff;
}

.product-img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* isi penuh tanpa distorsi */
  display: block;
}

    /* Responsive rules */
    @media (min-width: 768px) {
      .bottom-nav { display: none; } /* hide di desktop */
    }
    @media (max-width: 767px) {
      .navbar.sticky-top { display: none; } /* hide navbar atas di mobile */
      main { padding-bottom: 65px; } /* biar tidak ketutupan bottom nav */
    }

    .whatsapp-popup {
  display: none;
  position: fixed;
  bottom: 80px;
  right: 20px;
  width: 280px;
  background: #25D366;
  color: white;
  border-radius: 12px;
  overflow: hidden;
  z-index: 1050;
}
.whatsapp-popup .popup-header {
  background: #128C7E;
  padding: 10px;
}
.whatsapp-popup .popup-body {
  padding: 15px;
  background: #25D366;
}
#wa-widget {
  position: fixed;
  bottom: 70px;
  right: 20px;
  z-index: 1050;
}

.wa-popup {
  position: relative;
  display: flex;
  align-items: center;
  gap: 10px;
}

.wa-bubble {
  background: #fff;
  border-radius: 20px;
  padding: 6px 12px;
  font-weight: bold;
  color: #128C7E;
  display: flex;
  align-items: center;
  animation: bounceIn 0.8s ease;
}

.wa-bubble .wave {
  margin-right: 5px;
}

.wa-button {
  width: 55px;
  height: 55px;
  background: #25D366;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  text-decoration: none;
  transition: transform 0.3s ease;
}

.wa-button:hover {
  transform: scale(1.1);
  background: #20ba5a;
}

.wa-close {
  position: absolute;
  top: -10px;
  right: -10px;
  background: #000;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  font-size: 14px;
  line-height: 1;
  cursor: pointer;
}

/* Animasi bubble */
@keyframes bounceIn {
  from { transform: scale(0.5); opacity: 0; }
  to   { transform: scale(1); opacity: 1; }
}

  </style>
</head>
<body>
  {{-- Navbar tampil kalau bukan di login/register --}}
  @if (!request()->routeIs('login') && !request()->routeIs('register'))
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img alt="Logo" src="{{ asset('assets/media/logos/no-background.png') }}" class="h-35px logo" width="130"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
          <!-- Search -->
          <form class="d-flex ms-auto me-3 w-50" action="{{ route('products.index') }}" method="GET">
            <input class="form-control me-2" type="search" name="q" placeholder="Cari produk...">
            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
          </form>

          <!-- Menu -->
          <ul class="navbar-nav align-items-lg-center">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile.show') }}">Profil</a></li>
            <li class="nav-item">
              <a class="nav-link text-nowrap" href="{{ route('contact.create') }}">
                 Contact Us
              </a>
            </li>


            <!-- Wishlist -->
            <li class="nav-item position-relative">
              <a class="nav-link" href="{{ route('wishlist.index') }}">
                <i class="bi bi-heart-fill fs-5 text-danger"></i>
                @if(session('wishlist_count',0) > 0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session('wishlist_count') }}
                  </span>
                @endif
              </a>
            </li>

            <!-- Notifikasi -->
            <li class="nav-item dropdown position-relative">
              <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-bell-fill fs-5 text-warning"></i>
                @if(Auth::check() && Auth::user()->unreadNotifications->count())
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ Auth::user()->unreadNotifications->count() }}
                  </span>
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notifDropdown" style="min-width: 320px;">
                @if(Auth::check() && Auth::user()->notifications->count())
                  @foreach(Auth::user()->notifications->take(5) as $notification)
                    <li>
                      <a href="{{ route('notifications.readAndGo', $notification->id) }}" 
                         class="dropdown-item d-flex flex-column small {{ $notification->read_at ? '' : 'fw-bold' }}">
                        <span>{{ $notification->data['message'] ?? 'Notifikasi baru' }}</span>
                        <span class="text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                      </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                  @endforeach
                  <li>
                    <a href="{{ route('notifications.index') }}" class="dropdown-item text-center text-primary">
                      Lihat semua notifikasi
                    </a>
                  </li>
                @else
                  <li><span class="dropdown-item text-muted">Belum ada notifikasi</span></li>
                @endif
              </ul>
            </li>

            <!-- Cart -->
            <li class="nav-item position-relative">
              <a class="nav-link" href="{{ route('cart.index') }}">
                <i class="bi bi-cart-fill fs-5 text-primary"></i>
                @if(session('cart_count',0) > 0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                    {{ session('cart_count') }}
                  </span>
                @endif
              </a>
            </li>

            <!-- User Account -->
            @guest
              <li class="nav-item"><a class="nav-link ms-lg-2" href="{{ route('login') }}">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ms-lg-2" href="#" role="button" data-bs-toggle="dropdown">
                  <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  @if(Auth::user()->role == 'admin')
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                    <li><a class="dropdown-item" href="{{ route('reports.index') }}">Reports</a></li>
                    <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                  @else
                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                  @endif
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
  @endif
<!-- Floating WhatsApp -->
<div id="wa-widget">
  <div class="wa-popup shadow-lg">
    <button type="button" class="wa-close" onclick="document.getElementById('wa-widget').style.display='none'">&times;</button>
    <div class="wa-bubble">
      <span class="wave">👋</span>
      <span class="text">We Are Here!</span>
    </div>
    <a href="https://wa.me/62895347118033?text=Halo%20Linea%20Bridal,%20saya%20ingin%20bertanya..." 
       target="_blank" class="wa-button">
      <i class="bi bi-whatsapp"></i>
    </a>
  </div>
</div>
  <!-- Main Content -->
  <main class="py-5">
    @yield('content')
  </main>

  {{-- Bottom nav tampil kalau bukan login/register --}}
  @if (!request()->routeIs('login') && !request()->routeIs('register'))
  
   <div class="bottom-nav d-flex d-md-none">
  <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
    <i class="bi bi-house-door-fill"></i><span>Home</span>
  </a>
  <a href="{{ route('cart.index') }}" class="{{ request()->is('cart*') ? 'active' : '' }}">
    <i class="bi bi-cart-fill"></i><span>Cart</span>
  </a>
  <a href="{{ route('wishlist.index') }}" class="{{ request()->is('wishlist*') ? 'active' : '' }}">
    <i class="bi bi-heart-fill"></i><span>Wishlist</span>
  </a>
  <a href="{{ route('notifications.index') }}" class="{{ request()->is('notifications*') ? 'active' : '' }}">
    <i class="bi bi-bell-fill"></i><span>Notif</span>
  </a>
  <a href="{{ route('contact.create') }}" class="{{ request()->is('contact') ? 'active' : '' }}">
    <i class="bi bi-envelope-fill"></i><span>Contact</span>
  </a>
  <a href="{{ route('profile.show') }}" class="{{ request()->is('profile*') ? 'active' : '' }}">
    <i class="bi bi-person-circle"></i><span>Saya</span>
  </a>
</div>
  @endif

{{-- Footer tampil kalau bukan login/register --}}
@if (!request()->routeIs('login') && !request()->routeIs('register'))
  <footer class="footer-elegant text-light text-center">
    <div class="container">

      <!-- Contact Us Card -->
      <div class="shadow-sm border-0 mb-3">
        <div class="card-body">
          <h5 class="fw-bold text-gold mb-3">Hubungi Kami</h5>
          
          <div class="row justify-content-center">
            <!-- Alamat -->
            <div class="col-md-4 mb-3">
              <i class="bi bi-geo-alt-fill text-warning fs-5 d-block mb-1"></i>
              <small>Jl. Taman Pluit Kencana No.22</small>
            </div>
            <!-- Telepon -->
    <!-- Tombol WhatsApp -->
<div class="col-md-4 mb-3">
  <a href="javascript:void(0)" onclick="openWhatsAppPopup()" class="text-decoration-none text-light">
    <i class="bi bi-whatsapp text-success fs-5 d-block mb-1"></i>
  </a>
  <small>0851-9402-2541</small>
</div>

<!-- Popup WhatsApp -->
<div id="whatsappPopup" class="whatsapp-popup shadow">
  <div class="popup-header d-flex justify-content-between align-items-center">
    <span class="fw-bold">Chat via WhatsApp</span>
    <button type="button" class="btn-close btn-close-white" onclick="closeWhatsAppPopup()"></button>
  </div>
  <div class="popup-body">
    <p class="mb-2">Halo 👋<br>Kami siap membantu Anda!</p>
    <a href="https://wa.me/62895347118033?text=Halo%20Linea%20Bridal,%20saya%20ingin%20bertanya..."
       target="_blank" class="btn btn-success w-100">
      <i class="bi bi-whatsapp"></i> Mulai Chat
    </a>
  </div>
</div>
            <!-- Email -->
            <!-- <div class="col-md-4 mb-3">
              <i class="bi bi-envelope-fill text-warning fs-5 d-block mb-1"></i>
              <small>info@lineabridal.com</small>
            </div> -->
          </div>
        </div>
      </div>



      <!-- Copyright -->
      <p class="mb-0">&copy; 2025 <span class="fw-bold text-gold">Linea Bridal</span>. All rights reserved.</p>
    </div>
  </footer>
@endif
<script>
function openWhatsAppPopup() {
  document.getElementById("whatsappPopup").style.display = "block";
}
function closeWhatsAppPopup() {
  document.getElementById("whatsappPopup").style.display = "none";
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    var myModal = new bootstrap.Modal(document.getElementById('whatsappAdModal'));
    myModal.show();
  }, 3000); // popup muncul 3 detik setelah halaman load
});
</script>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

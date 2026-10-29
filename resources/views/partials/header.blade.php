<head>
	<title>Selekta Adventure - Penyewaan Alat Outdoor</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">Selekta<span>Adventure</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="/" class="nav-link">Beranda</a></li>
                <li class="nav-item {{ request()->is('katalog*') ? 'active' : '' }}"><a href="/katalog" class="nav-link">Katalog Alat</a></li>
                <li class="nav-item {{ request()->is('riwayat*') ? 'active' : '' }}"><a href="/riwayat" class="nav-link">Riwayat Sewa</a></li>
                <li class="nav-item {{ request()->is('cara-sewa') ? 'active' : '' }}"><a href="/cara-sewa" class="nav-link">Cara Sewa</a></li>
                <li class="nav-item {{ request()->is('kontak') ? 'active' : '' }}"><a href="/kontak" class="nav-link">Kontak</a></li>

                @guest
                    <li class="nav-item ml-lg-3 mt-3 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn" style="background-color: #f96d00; border-radius: 30px; color: #fff; padding: 8px 24px; font-weight: 600; font-size: 14px; transition: 0.3s;">
                            <i class="fa fa-sign-in mr-2"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item ml-lg-2 mt-2 mt-lg-0">
                        <a href="{{ route('register') }}" class="btn" style="background-color: transparent; border: 2px solid #f96d00; border-radius: 30px; color: #f96d00; padding: 6px 22px; font-weight: 600; font-size: 14px; transition: 0.3s;">
                            Daftar Akun
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item {{ request()->is('keranjang*') ? 'active' : '' }} ml-lg-3 mt-3 mt-lg-0">
                            <a href="{{ url('/keranjang') }}" class="nav-link">Keranjang
                        </a>
                    </li>

                    <li class="nav-item dropdown ml-lg-2 mt-3 mt-lg-0">
                        <a class="btn dropdown-toggle" href="#" id="navbarProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                           style="background-color: #222; border-radius: 30px; color: #fff; padding: 8px 24px; font-weight: 600; font-size: 14px;">
                            <i class="fa fa-user-circle mr-2"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 mt-2" style="border-radius: 12px; min-width: 220px; padding: 15px;">
                            <div class="dropdown-item-text" style="padding: 0 0 10px 0;">
                                <small class="text-muted d-block">Masuk sebagai:</small>
                                <strong class="text-dark">{{ Auth::user()->name }}</strong><br>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>
                            <div class="dropdown-divider"></div>

                            @if(Auth::user()->role == 'admin')
                                <a class="dropdown-item py-2" href="/admin/dashboard"><i class="fa fa-th-large mr-2 text-muted"></i> Panel Admin</a>
                            @endif
                            
                            <a class="dropdown-item py-2" href="/riwayat"><i class="fa fa-history mr-2 text-muted"></i> Pesanan Saya</a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item py-2 text-danger font-weight-bold" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-front').submit();">
                                <i class="fa fa-sign-out mr-2"></i> Keluar
                            </a>
                            <form id="logout-form-front" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Panel - Selekta Adventure</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* SIDEBAR STYLE */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 25px 15px;
            border-right: 1px solid rgba(0, 0, 0, 0.03);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .brand-section {
            display: flex;
            align-items: center;
            padding-left: 10px;
            margin-bottom: 30px;
        }

        .brand-text h6 {
            font-weight: 700;
            color: #222;
            margin: 0;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .brand-text span {
            font-size: 11px;
            color: #888;
            display: block;
        }

        /* PROFILE CARD SIDEBAR */
        .user-profile-card {
            background: #fdf7f2;
            padding: 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit: cover;
        }

        .profile-info h6 {
            font-weight: 600;
            font-size: 13.5px;
            color: #333;
            margin: 0;
        }

        .profile-info span {
            font-size: 11px;
            color: #f96d00;
            font-weight: 500;
        }

        /* MENU GROUP SIDEBAR */
        .menu-group-title {
            font-size: 11px;
            font-weight: 700;
            color: #b3b3b3;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-left: 12px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        /* Kustomisasi Scrollbar Sidebar agar Tipis dan Estetik */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(249, 109, 0, 0.2);
        }

        .sidebar .nav-link {
            color: #666666;
            font-weight: 500;
            font-size: 14px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 15px;
            width: 20px;
            text-align: center;
            color: #888;
        }

        .sidebar .nav-link:hover {
            background: #f8f9fa;
            color: #222;
        }

        .sidebar .nav-link.active {
            background: #fdf2e9;
            color: #f96d00;
            font-weight: 600;
        }

        .sidebar .nav-link.active i {
            color: #f96d00;
        }

        /* MAIN CONTENT HOLDER */
        .wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP NAVBAR WITH DROPDOWN STYLE */
        .top-navbar {
            background: #ffffff;
            height: 70px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .toggle-btn {
            background: none;
            border: none;
            color: #444;
            font-size: 18px;
            cursor: pointer;
        }

        .top-right-profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Menghilangkan tanda panah bawaan bootstrap dropdown pada profil */
        .top-right-profile .dropdown-toggle::after {
            display: none;
        }

        .main-body-content {
            padding: 40px;
            flex: 1;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand-section">
            <div class="brand-text">
                <h6>Selekta Outdoor</h6>
                <span>Sistem Informasi Penyewaan</span>
            </div>
        </div>

        <div class="user-profile-card">
            <img src="{{ asset('images/person_1.jpg') }}" alt="Avatar" class="profile-avatar">
            <div class="profile-info">
                <h6>Fajar</h6>
                <span>Administrator</span>
            </div>
        </div>

        <nav class="nav flex-column">
            <div class="menu-group-title">Utama</div>
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
                <i class="fa fa-th-large"></i> Dashboard
            </a>

            <div class="menu-group-title">Manajemen Data</div>

            <a class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}" href="/admin/kategori">
                <i class="fa fa-tags"></i> Kategori Alat
            </a>

            <a class="nav-link {{ request()->is('admin/alat*') ? 'active' : '' }}" href="/admin/alat">
                <i class="fa fa-cubes"></i> Data Alat & Stok
            </a>

            <a class="nav-link {{ request()->is('admin/pesanan*') ? 'active' : '' }}" href="/admin/pesanan">
                <i class="fa fa-shopping-cart"></i> Data Pesanan
            </a>

            <a class="nav-link {{ request()->is('admin/pengembalian*') ? 'active' : '' }}" href="/admin/pengembalian">
                <i class="fa fa-arrow-circle-down"></i> Pengembalian & Denda
            </a>

            <a class="nav-link {{ request()->is('admin/pelanggan*') ? 'active' : '' }}" href="/admin/pelanggan">
                <i class="fa fa-users"></i> Data Pelanggan
            </a>

            <div class="menu-group-title">Finalisasi & Pengaturan</div>
            <a class="nav-link {{ request()->is('admin/laporan*') ? 'active' : '' }}" href="/admin/laporan">
                <i class="fa fa-file-text-o"></i> Laporan Operasional
            </a>
        </nav>
    </div>

    <div class="wrapper">
        <div class="top-navbar">
            <button class="toggle-btn">
                <i class="fa fa-bars"></i>
            </button>
            
            <div class="top-right-profile dropdown">
                <a href="#" class="dropdown-toggle d-flex align-items-center text-dark" id="adminDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
                    <img src="{{ asset('images/person_1.jpg') }}" alt="Admin Profile" class="mr-2 shadow-sm">
                    <span class="font-weight-600" style="font-size: 14px;">Fajar</span>
                    <i class="fa fa-angle-down ml-2 text-muted" style="font-size: 14px;"></i>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right border-0 shadow mt-2" aria-labelledby="adminDropdown" style="border-radius: 10px; min-width: 170px;">
                    <a class="dropdown-item py-2 text-muted" href="/admin/users" style="font-size: 13.5px;">
                        <i class="fa fa-user mr-2"></i> Akun Profil
                    </a>
                    <div class="dropdown-divider" style="border-top: 1px solid #f2f2f2;"></div>
                    
                    <a class="dropdown-item py-2 text-danger font-weight-bold" href="#" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 13.5px;">
                            <i class="fa fa-sign-out mr-2"></i> Keluar Aplikasi
                        </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="main-body-content">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
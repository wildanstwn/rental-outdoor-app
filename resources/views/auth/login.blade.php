<!DOCTYPE html>
<html lang="id">
<head>
    <title>Masuk - Selekta Adventure</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        /* Menggunakan gambar latar belakang bawaan template */
        .bg-image {
            background-image: url('{{ asset('images/bg1.jpeg') }}');
            background-size: cover;
            background-position: center;
            height: 100%;
            position: relative;
        }
        /* Overlay gelap transparan agar form terlihat kontras */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }
        .login-container {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Card login bergaya semi-transparan modern (glassmorphism tipis) */
        .login-card {
            background: rgba(255, 255, 255, 0.96);
            border: none;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            padding: 40px 35px;
            backdrop-filter: blur(5px);
        }
        .brand-title {
            font-weight: 800;
            font-size: 24px;
            color: #222;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .brand-title span {
            color: #f96d00; /* Warna khas oranye Pacific */
            display: block;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: 600;
            margin-top: -2px;
        }
        .form-control {
            height: 48px;
            background: #f8f9fa;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 8px;
            font-size: 14px;
            padding: 0 20px;
            color: #333;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background: #fff;
            border-color: #f96d00;
            box-shadow: none;
        }
        /* Tombol masuk warna oranye serasi dengan tema web depan */
        .btn-login {
            height: 48px;
            background: #f96d00;
            border-color: #f96d00;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: #e05e00;
            border-color: #e05e00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(249, 109, 0, 0.3);
        }
        .back-to-home {
            color: #888;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.3s;
        }
        .back-to-home:hover {
            color: #f96d00;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="bg-image">
        <div class="overlay"></div>
        
        <div class="login-container px-3">
            <div class="login-card text-center">
                
                <div class="mb-4">
                    <h2 class="brand-title mb-0">Selekta<span>Adventure</span></h2>
                </div>
                
                <p class="text-muted mb-4" style="font-size: 14px;">Silakan masuk ke akun Anda</p>
                
                <form action="/login" method="POST" class="text-left">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Email atau Username</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukkan email/username" required autofocus>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="small font-weight-bold text-dark">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-login mb-3 shadow-sm">
                        Masuk
                    </button>
                </form>

                <p class="text-muted mt-4 mb-3" style="font-size: 14px;">
                    Belum punya akun? <a href="{{ route('register') }}" class="font-weight-bold" style="color: #f96d00; text-decoration: none;">Daftar di sini</a>
                </p>

                <div class="mt-3">
                    <a href="/" class="back-to-home"><i class="fa fa-arrow-left mr-1"></i> Kembali ke Beranda</a>
                </div>
                

            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
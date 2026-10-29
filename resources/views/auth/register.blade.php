<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Akun - Selekta Adventure</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .register-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 15px; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
        .form-control { border-radius: 8px; padding: 12px 15px; height: auto; font-size: 14px; }
        .form-control:focus { box-shadow: none; border-color: #f96d00; }
        .btn-orange { background-color: #f96d00; border-color: #f96d00; color: white; border-radius: 8px; padding: 12px; font-weight: 600; font-size: 15px; transition: all 0.3s; }
        .btn-orange:hover { background-color: #e65c00; color: white; }
    </style>
</head>
<body>

<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                
                <div class="text-center mb-4">
                    <h2 class="font-weight-bold" style="color: #222;">Selekta<span style="color: #f96d00;">Adventure</span></h2>
                    <p class="text-muted">Buat akun penyewa baru untuk mulai reservasi alat.</p>
                </div>

                <div class="card card-custom">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger" style="border-radius: 8px; font-size: 13.5px;">
                                    <ul class="mb-0 pl-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group mb-3">
                                <label class="font-weight-bold" style="font-size: 13px; color: #555;">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold" style="font-size: 13px; color: #555;">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold" style="font-size: 13px; color: #555;">Nomor WhatsApp</label>
                                    <input type="text" name="no_wa" class="form-control" placeholder="0812xxxxxx" value="{{ old('no_wa') }}" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold" style="font-size: 13px; color: #555;">Alamat Domisili</label>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap..." required>{{ old('alamat') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label class="font-weight-bold" style="font-size: 13px; color: #555;">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                                </div>
                                <div class="col-md-6 form-group mb-4">
                                    <label class="font-weight-bold" style="font-size: 13px; color: #555;">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-orange btn-block mb-3 shadow-sm">Daftar Akun Sekarang</button>
                            
                            <p class="text-center text-muted mb-0" style="font-size: 14px;">
                                Sudah punya akun? <a href="{{ route('login') }}" class="font-weight-bold" style="color: #f96d00;">Masuk di sini</a>
                            </p>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/" class="text-muted" style="font-size: 13px; text-decoration: none;"><i class="fa fa-arrow-left mr-1"></i> Kembali ke Beranda</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
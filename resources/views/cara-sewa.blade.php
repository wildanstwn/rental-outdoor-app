@extends('layouts.app')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/carasewa.jpeg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Prosedur <i class="fa fa-chevron-right"></i></span></p>
         <h1 class="mb-0 bread">Cara Penyewaan</h1>
     </div>
 </div>
</div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Alur Penggunaan Sistem</span>
                <h2 class="mb-4">4 Langkah Mudah Menyewa Alat</h2>
            </div>
        </div>
        <div class="row d-flex align-items-stretch">
            
            <div class="col-md-3 d-flex ftco-animate mb-4">
                <div class="p-4 border rounded shadow-sm bg-light text-center d-flex flex-column w-100">
                    <div class="icon mb-3"><span class="fa fa-search fa-2x text-primary"></span></div>
                    <h3 class="h5 font-weight-bold mb-3">1. Pilih Alat</h3>
                    <p class="mb-0 text-muted" style="font-size: 14.5px;">Buka halaman katalog, cek ketersediaan stok barang secara real-time, lalu pilih alat yang kamu butuhkan.</p>
                </div>
            </div>

            <div class="col-md-3 d-flex ftco-animate mb-4">
                <div class="p-4 border rounded shadow-sm bg-light text-center d-flex flex-column w-100">
                    <div class="icon mb-3"><span class="fa fa-calendar-check-o fa-2x text-primary"></span></div>
                    <h3 class="h5 font-weight-bold mb-3">2. Isi Form Sewa</h3>
                    <p class="mb-0 text-muted" style="font-size: 14.5px;">Tentukan tanggal pengambilan dan tanggal pengembalian alat untuk menghitung otomatis total tarif sewa.</p>
                </div>
            </div>

            <div class="col-md-3 d-flex ftco-animate mb-4">
                <div class="p-4 border rounded shadow-sm bg-light text-center d-flex flex-column w-100">
                    <div class="icon mb-3"><span class="fa fa-credit-card fa-2x text-primary"></span></div>
                    <h3 class="h5 font-weight-bold mb-3">3. Bayar Digital</h3>
                    <p class="mb-0 text-muted" style="font-size: 14.5px;">Lakukan validasi pembayaran menggunakan e-wallet, virtual account, atau QRIS yang tersedia pada sistem.</p>
                </div>
            </div>

            <div class="col-md-3 d-flex ftco-animate mb-4">
                <div class="p-4 border rounded shadow-sm bg-light text-center d-flex flex-column w-100">
                    <div class="icon mb-3"><span class="fa fa-shopping-bag fa-2x text-primary"></span></div>
                    <h3 class="h5 font-weight-bold mb-3">4. Ambil di Toko</h3>
                    <p class="mb-0 text-muted" style="font-size: 14.5px;">Datang ke store Selekta Adventure di Boyolali dengan menunjukkan bukti transaksi digital untuk serah terima alat.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4 border-top">
            <div class="col-md-12 heading-section ftco-animate">
                <h3 class="text-danger mb-3"><span class="fa fa-exclamation-triangle"></span> Ketentuan Penting & Denda</h3>
                <p>Harap mengembalikan peralatan tepat waktu sesuai tanggal yang tertera pada transaksi. Keterlambatan pengembalian akan dikenakan biaya denda tenggang waktu per hari sesuai dengan jenis unit barang yang disewa guna menjaga kenyamanan penyewa berikutnya.</p>
            </div>
        </div>
    </div>
</section>
@endsection
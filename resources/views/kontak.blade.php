@extends('layouts.app')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/kontak.jpeg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Hubungi <i class="fa fa-chevron-right"></i></span></p>
         <h1 class="mb-0 bread">Kontak Kami</h1>
     </div>
 </div>
</div>
</section>

<section class="ftco-section contact-section font-weight-normal">
  <div class="container">
    <div class="row d-flex mb-5 contact-info">
      <div class="col-md-12 mb-4">
        <h2 class="h3">Informasi Kontak Store</h2>
      </div>
      <div class="w-100"></div>
      <div class="col-md-4 d-flex">
          <div class="info bg-light p-4 rounded mb-4 w-100">
            <p><span>Alamat Lokasi:</span> Kelurahan Teras, Kecamatan Teras, Kabupaten Boyolali, Jawa Tengah</p>
          </div>
      </div>
      <div class="col-md-4 d-flex">
          <div class="info bg-light p-4 rounded mb-4 w-100">
            <p><span>Nomor Telepon/WA:</span> <a href="tel://1234567920">+62 812 3456 7890</a></p>
          </div>
      </div>
      <div class="col-md-4 d-flex">
          <div class="info bg-light p-4 rounded mb-4 w-100">
            <p><span>Email Bisnis:</span> <a href="mailto:info@yoursite.com">selekta.outdoor@gmail.com</a></p>
          </div>
      </div>
    </div>
    
    <div class="row block-9">
      <div class="col-md-6 order-md-last d-flex">
        <form action="#" class="bg-light p-5 contact-form w-100 rounded shadow-sm">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nama Lengkap Anda">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Email / Nomor WhatsApp">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Subjek Pesan">
          </div>
          <div class="form-group">
            <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Tulis pesan atau pertanyaan Anda di sini..."></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Kirim Pesan" class="btn btn-primary py-3 px-5">
          </div>
        </form>
      </div>

      <div class="col-md-6 d-flex">
          <div id="map" class="bg-white w-100 rounded shadow-sm" style="min-height: 400px;"></div>
      </div>
    </div>
  </div>
</section>
@endsection
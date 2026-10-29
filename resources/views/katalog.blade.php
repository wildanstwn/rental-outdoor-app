@extends('layouts.app')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/katalog.jpeg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Beranda <i class="fa fa-chevron-right"></i></a></span> <span>Daftar Alat <i class="fa fa-chevron-right"></i></span></p>
         <h1 class="mb-0 bread">Katalog Peralatan</h1>
     </div>
 </div>
</div>
</section>

<section class="ftco-section ftco-no-pb">
   <div class="container">
      <div class="row">
       <div class="col-md-12">
          <div class="search-wrap-1 ftco-animate">
             <form action="/katalog" method="GET" class="search-property-1">
                <div class="row no-gutters">
                   <div class="col-lg d-flex">
                      <div class="form-group p-4 border-0">
                         <label for="#">Nama Peralatan</label>
                         <div class="form-field">
                           <div class="icon"><span class="fa fa-search"></span></div>
                           <input type="text" name="cari" class="form-control" placeholder="Cari tenda, carrier, dll..." value="{{ request('cari') }}">
                       </div>
                   </div>
               </div>
               
               <div class="col-lg d-flex">
                <div class="form-group d-flex w-100 border-0">
                   <div class="form-field w-100 align-items-center d-flex">
                      <input type="submit" value="Cari Alat" class="align-self-stretch form-control btn btn-primary">
                  </div>
              </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>

<section class="ftco-section">
   <div class="container">
    <div class="row">
        
        @forelse ($alats as $alat)
        <div class="col-md-4 ftco-animate">
          <div class="project-wrap">
             @php
                $gambar = $alat->gambar ? asset('images/alat/' . $alat->gambar) : asset('images/destination-1.jpg');
             @endphp
             <a href="#" class="img" style="background-image: url('{{ $gambar }}');">
                <span class="price">Rp {{ number_format($alat->harga_per_hari, 0, ',', '.') }}/hari</span>
            </a>
            <div class="text p-4">
                <span class="days">Tersedia: <strong>{{ $alat->stok_tersedia }} Unit</strong></span>
                <h3><a href="#">{{ $alat->nama_alat }}</a></h3>
                <p class="location"><span class="fa fa-tag"></span> Kategori: {{ $alat->kategori->nama_kategori ?? 'Tanpa Kategori' }}</p>
                
                <form action="/keranjang/tambah" method="POST">
                    @csrf
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">
                    <input type="hidden" name="kuantitas" value="1">
                    <button type="submit" class="btn btn-primary btn-sm mt-2 font-weight-bold" style="border-radius: 30px; padding: 5px 15px;">
                        <i class="fa fa-shopping-cart mr-1"></i> Tambah ke Keranjang
                    </button>
                </form>
           </div>
       </div>
       </div>
       @empty
       <div class="col-12 text-center py-5">
           <i class="fa fa-box-open mb-3" style="font-size: 40px; color: #ccc;"></i>
           <h4>Belum ada data alat yang tersedia.</h4>
       </div>
       @endforelse
    </div>

    <div class="row mt-5">
      <div class="col text-center">
        <div class="d-flex justify-content-center">
            {{ $alats->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>

</div>
</section>
@endsection
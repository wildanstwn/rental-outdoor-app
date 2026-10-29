@extends('layouts.app')

@section('content')
<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/bg1.jpeg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <span class="subheading">Selamat Datang di Selekta Adventure</span>
                <h1 class="mb-4">Sewa Alat Pendakian Mudah & Lengkap</h1>
                <p class="caps">Siapkan perjalanan alammu dengan peralatan terbaik dan harga bersahabat.</p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ftco-search d-flex justify-content-center">
                    <div class="row w-100">
                        <div class="col-md-12 tab-wrap">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel">
                                    
                                    <div class="search-property-1">
                                        <div class="row no-gutters">
                                            
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4 border-0">
                                                    <label for="#" class="text-primary font-weight-bold">Lokasi Store</label>
                                                    <div class="form-field mt-2">
                                                        <div class="icon"><span class="fa fa-map-marker text-muted"></span></div>
                                                        <span class="d-block pl-4 font-weight-normal text-dark">Teras, Boyolali</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#" class="text-primary font-weight-bold">Jam Kerja</label>
                                                    <div class="form-field mt-2">
                                                        <div class="icon"><span class="fa fa-clock-o text-muted"></span></div>
                                                        <span class="d-block pl-4 font-weight-normal text-dark">08:00 - 21:00 WIB</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#" class="text-primary font-weight-bold">Persyaratan</label>
                                                    <div class="form-field mt-2">
                                                        <div class="icon"><span class="fa fa-id-card text-muted"></span></div>
                                                        <span class="d-block pl-4 font-weight-normal text-dark">KTP / Kartu Identitas</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md d-flex">
                                                <div class="form-group d-flex w-100 border-0 m-0">
                                                    <div class="form-field w-100 align-items-center d-flex">
                                                        <a href="/katalog" class="align-self-stretch w-100 btn btn-primary d-flex align-items-center justify-content-center font-weight-bold" style="font-size: 16px;">
                                                            <span class="fa fa-shopping-bag mr-2"></span> Sewa Sekarang
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section services-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                <div class="w-100">
                    <span class="subheading">Selekta Adventure</span>
                    <h2 class="mb-4">Kenapa Harus Sewa di Tempat Kami?</h2>
                    <p>Kami memahami bahwa keselamatan dan kenyamanan pendakian Anda dimulai dari peralatan yang andal. Selekta Adventure hadir di Boyolali untuk menyediakan perlengkapan outdoor terbaik dengan proses pemesanan yang transparan dan terdigitalisasi.</p>
                    <p><a href="#" class="btn btn-primary py-3 px-4">Lihat Seluruh Katalog</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-1 d-block img" style="background-image: url('{{ asset('images/1.jpeg') }}');">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Kualitas Terjamin</h3>
                                <p>Seluruh alat outdoor selalu dibersihkan dan dicek kelayakannya sebelum disewakan.</p>
                            </div>
                        </div>      
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-2 d-block img" style="background-image: url('{{ asset('images/2.jpeg') }}');">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Booking Digital</h3>
                                <p>Kemudahan mengecek ketersediaan stok barang secara real-time lewat sistem web.</p>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-3 d-block img" style="background-image: url('{{ asset('images/3.jpeg') }}');">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Harga Bersahabat</h3>
                                <p>Tarif rental ramah di kantong mahasiswa dan pendaki pemula dengan sistem denda transparan.</p>
                            </div>
                        </div>      
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-4 d-block img" style="background-image: url('{{ asset('images/4.jpeg') }}');">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Pembayaran E-Wallet</h3>
                                <p>Mendukung integrasi pembayaran digital menggunakan QRIS maupun transfer bank.</p>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Katalog Kami</span>
                <h2 class="mb-4">Daftar Perlengkapan Terpopuler</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url('{{ asset('images/destination-1.jpg') }}');">
                        <span class="price">Rp 35.000/hari</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">Stok: 5 Unit</span>
                        <h3><a href="#">Tenda Dome Kapasitas 4 Orang</a></h3>
                        <p class="location"><span class="fa fa-tag"></span> Kategori: Tenda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url('{{ asset('images/destination-2.jpg') }}');">
                        <span class="price">Rp 25.000/hari</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">Stok: 8 Unit</span>
                        <h3><a href="#">Tas Carrier Eiger 60L</a></h3>
                        <p class="location"><span class="fa fa-tag"></span> Kategori: Carrier</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url('{{ asset('images/destination-3.jpg') }}');">
                        <span class="price">Rp 10.000/hari</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">Stok: 15 Unit</span>
                        <h3><a href="#">Sleeping Bag Polar</a></h3>
                        <p class="location"><span class="fa fa-tag"></span> Kategori: Perlengkapan Tidur</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url('{{ asset('images/destination-4.jpg') }}');">
                        <span class="price">Rp 15.000/hari</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">Stok: 6 Unit</span>
                        <h3><a href="#">Kompor Portable & Nesting Set</a></h3>
                        <p class="location"><span class="fa fa-tag"></span> Kategori: Alat Masak</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url('{{ asset('images/destination-5.jpg') }}');">
                        <span class="price">Rp 5.000/hari</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">Stok: 20 Unit</span>
                        <h3><a href="#">Matras Spons Gulung</a></h3>
                        <p class="location"><span class="fa fa-tag"></span> Kategori: Perlengkapan Tidur</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url('{{ asset('images/destination-6.jpg') }}');">
                        <span class="price">Rp 7.500/hari</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">Stok: 12 Unit</span>
                        <h3><a href="#">Headlamp / Senter Kepala LED</a></h3>
                        <p class="location"><span class="fa fa-tag"></span> Kategori: Aksesoris</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-about img" style="background-image: url('{{ asset('images/drone.jpeg') }}');">
    <div class="overlay"></div>
    <div class="container py-md-5">
        <div class="row py-md-5">
            <div class="col-md d-flex align-items-center justify-content-center">
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-about ftco-no-pt img">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-12 about-intro">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url('{{ asset('images/toko.jpeg') }}');">
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5 py-5">
                        <div class="row justify-content-start pb-3">
                            <div class="col-md-12 heading-section ftco-animate">
                                <span class="subheading">Tentang Toko</span>
                                <h2 class="mb-4">Menjelajah Alam Jadi Lebih Aman dan Terencana</h2>
                                <p>Selekta Adventure berkomitmen membantu para penggiat alam bebas mendapatkan alat pendakian yang aman tanpa harus membeli mahal. Berlokasi strategis di Teras, Boyolali, kami melayani pencatatan stok dan transaksi secara digital demi meminimalkan kesalahan operasional toko.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
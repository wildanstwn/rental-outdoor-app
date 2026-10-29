@extends('layouts.app')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/katalog.jpeg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs">
             <span class="mr-2"><a href="/">Beranda <i class="fa fa-chevron-right"></i></a></span> 
             <span class="mr-2"><a href="/keranjang">Keranjang <i class="fa fa-chevron-right"></i></a></span> 
             <span>Checkout <i class="fa fa-chevron-right"></i></span>
         </p>
         <h1 class="mb-0 bread">Checkout Reservasi</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm border-0 rounded-lg">
                    <h4 class="font-weight-bold mb-4">Lengkapi Data Reservasi</h4>
                    <form action="/checkout-all" method="POST" id="checkout-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold text-muted small">Tanggal Ambil</label>
                                <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="font-weight-bold text-muted small">Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" id="btn-submit" class="btn btn-primary mt-3 btn-block font-weight-bold shadow-sm" style="background-color: #f96d00; border: none; padding: 12px;">
                            Konfirmasi & Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card p-4 shadow-sm border-0 rounded-lg">
                    <h5 class="font-weight-bold mb-3">Ringkasan</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total per Hari</span>
                        <strong id="harga_base" data-harga="{{ $total_per_hari ?? 0 }}">Rp {{ number_format($total_per_hari ?? 0, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Durasi</span>
                        <span class="text-primary font-weight-bold" id="durasi">{{ $durasi ?? 0 }} Hari</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">TOTAL BAYAR</span>
                        <h4 class="font-weight-bold text-success mb-0" id="total_bayar">Rp {{ number_format($total_bayar ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const inputTglSewa = document.getElementById('tgl_sewa');
    const inputTglKembali = document.getElementById('tgl_kembali');
    const hargaBase = parseInt(document.getElementById('harga_base').getAttribute('data-harga'));
    
    function hitung() {
        if(inputTglSewa.value && inputTglKembali.value) {
            const d1 = new Date(inputTglSewa.value);
            const d2 = new Date(inputTglKembali.value);
            let durasi = (d2 - d1) / (1000 * 3600 * 24);
            
            if(durasi < 1) durasi = 1;
            
            document.getElementById('durasi').innerText = durasi + ' Hari';
            document.getElementById('total_bayar').innerText = new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', minimumFractionDigits:0}).format(durasi * hargaBase);
        }
    }
    inputTglSewa.addEventListener('change', hitung);
    inputTglKembali.addEventListener('change', hitung);
</script>

@isset($snapToken)
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        function triggerMidtrans() {
            if (typeof window.snap !== 'undefined') {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){ window.location.href = '/riwayat'; },
                    onPending: function(result){ window.location.href = '/riwayat'; },
                    onError: function(result){ alert("Pembayaran gagal!"); }
                });
            } else {
                // Coba lagi setelah 300ms jika script belum siap
                setTimeout(triggerMidtrans, 300);
            }
        }
        triggerMidtrans();
    </script>
@endisset

@endsection
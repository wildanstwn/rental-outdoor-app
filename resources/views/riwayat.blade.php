@extends('layouts.app')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/katalog.jpeg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs">
             <span class="mr-2"><a href="/">Beranda <i class="fa fa-chevron-right"></i></a></span> 
             <span>Riwayat Sewa <i class="fa fa-chevron-right"></i></span>
         </p>
         <h1 class="mb-0 bread">Log & Status Penyewaan</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="card p-4 shadow-sm border-0">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID Sewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Alat</th>
                        <th>Total Bayar</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanans as $p)
                    <tr>
                        <td>#SLK-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_sewa)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_kembali_seharusnya)->format('d M Y') }}</td>
                        <td>{{ $p->total_alat }} Unit</td>
                        <td>Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ $p->denda > 0 ? 'Rp '.number_format($p->denda, 0, ',', '.') : '-' }}</td>
                        <td>
                            @if($p->status == 'menunggu_pembayaran')
                                <span class="badge badge-info">Menunggu Pembayaran</span>
                            @elseif($p->status == 'menunggu_validasi')
                                <span class="badge badge-primary">Menunggu Validasi</span>
                            @elseif($p->status == 'sedang_dipinjam')
                                <span class="badge badge-warning">Sedang Dipinjam</span>
                            @elseif($p->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-danger">Terlambat</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalDetail{{ $p->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@foreach($pesanans as $p)
<div class="modal fade" id="modalDetail{{ $p->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pesanan #SLK-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Alat</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($p->details as $item)
                <tr>
                    <td>{{ $item->alat->nama_alat ?? 'Data Alat' }}</td>
                    <td>{{ $item->kuantitas }}</td>
                    <td>Rp {{ number_format($item->harga_sewa_saat_itu, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->kuantitas * $item->harga_sewa_saat_itu, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right mt-3">
            <h5 class="font-weight-bold">Total Bayar: Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</h5>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
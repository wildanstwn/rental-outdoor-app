@extends('layouts.app')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/katalog.jpeg') }}'); height: 300px;">
  <div class="overlay" style="height: 300px;"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center" style="height: 300px;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <h1 class="mb-0 bread font-weight-bold">Keranjang Belanja</h1>
     </div>
    </div>
  </div>
</section>

<section class="ftco-section">
    <div class="container">
        
        @if(session('success'))
            <div class="alert alert-success rounded shadow-sm">
                <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-lg p-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Alat</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_semua = 0; @endphp
                            @forelse($keranjangs as $item)
                            @php 
                                $subtotal = $item->alat->harga_per_hari * $item->kuantitas; 
                                $total_semua += $subtotal;
                            @endphp
                            <tr>
                                <td class="align-middle">
                                    <img src="{{ asset('images/alat/' . $item->alat->gambar) }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded mr-2">
                                    {{ $item->alat->nama_alat }}
                                </td>
                                <td class="align-middle">Rp {{ number_format($item->alat->harga_per_hari, 0, ',', '.') }}</td>
                                <td class="align-middle">{{ $item->kuantitas }}</td>
                                <td class="align-middle font-weight-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td class="align-middle">
                                    <form action="/keranjang/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Keranjang masih kosong.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-lg p-4">
                    <h5 class="font-weight-bold mb-3">Total Belanja</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Keseluruhan</span>
                        <h4 class="font-weight-bold text-success">Rp {{ number_format($total_semua, 0, ',', '.') }}</h4>
                    </div>
                    
                    @if($keranjangs->count() > 0)
                        <a href="/checkout-all" class="btn btn-primary btn-block font-weight-bold" style="background-color: #f96d00; border: none; padding: 12px;">
                            Lanjut ke Checkout
                        </a>
                    @else
                        <a href="/katalog" class="btn btn-outline-secondary btn-block">Mulai Belanja</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
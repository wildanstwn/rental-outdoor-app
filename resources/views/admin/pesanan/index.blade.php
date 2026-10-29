@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Manajemen Data</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Data Pesanan</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Data Transaksi & Pesanan</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Validasi pembayaran digital, status pemesanan, dan persiapan serah terima barang.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr class="text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th class="border-0">ID Sewa</th>
                        <th class="border-0">Nama Penyewa</th>
                        <th class="border-0">Durasi Sewa</th>
                        <th class="border-0">Total Bayar</th>
                        <th class="border-0 text-center">Status</th>
                        <th class="border-0 text-center">Validasi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px; color: #333;">
                    @forelse ($pesanans as $item)
                        @php
                            // Menghitung selisih hari pakai Carbon
                            $tglSewa = \Carbon\Carbon::parse($item->tgl_sewa);
                            $tglKembali = \Carbon\Carbon::parse($item->tgl_kembali_seharusnya);
                            $durasi = $tglSewa->diffInDays($tglKembali);
                        @endphp
                    <tr style="background: #fdfdfd;">
                        <td class="py-3 align-middle font-weight-bold" style="color: #f96d00;">#SLK-00{{ $item->id }}</td>
                        <td class="py-3 align-middle">{{ $item->user->name ?? 'User Dihapus' }}</td>
                        <td class="py-3 align-middle">
                            {{ $tglSewa->translatedFormat('d M') }} - {{ $tglKembali->translatedFormat('d M') }} 
                            <span class="text-muted">({{ $durasi }} Hari)</span>
                        </td>
                        <td class="py-3 align-middle font-weight-bold">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                        <td class="py-3 align-middle text-center">
                            @if($item->status == 'menunggu_validasi')
                                <span class="badge" style="background-color: #e0f2fe; color: #0284c7; padding: 6px 12px; border-radius: 20px;">Menunggu Validasi</span>
                            @elseif($item->status == 'tervalidasi' || $item->status == 'sedang_dipinjam')
                                <span class="badge" style="background-color: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 20px;">Disetujui / Aktif</span>
                            @else
                                <span class="badge" style="background-color: #f3f4f6; color: #4b5563; padding: 6px 12px; border-radius: 20px;">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                        <td class="py-3 align-middle text-center">
                            @if($item->status == 'menunggu_validasi')
                                <form action="/admin/pesanan/{{ $item->id }}/validasi" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm font-weight-bold px-3" style="border-radius: 6px;" onclick="return confirm('Setujui pesanan ini dan kurangi stok alat?')">
                                        <i class="fa fa-check mr-1"></i> Setujui
                                    </button>
                                </form>
                            @else
                                <span class="text-muted" style="font-size: 13px;"><i class="fa fa-lock mr-1"></i> Tervalidasi</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada transaksi pemesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
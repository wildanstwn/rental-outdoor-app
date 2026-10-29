@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Manajemen Data</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Pengembalian & Denda</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Pengembalian Alat & Kalkulasi Denda</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Pencatatan pengembalian unit sewa, pemulihan kuantitas stok otomatis, dan penalti keterlambatan.</p>
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
                        <th class="border-0">Batas Kembali Seharusnya</th>
                        <th class="border-0 text-center">Status Unit</th>
                        <th class="border-0 text-center">Denda Terhitung</th>
                        <th class="border-0 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px; color: #333;">
                    
                    @forelse ($pesanans as $item)
                        @php
                            $hari_ini = \Carbon\Carbon::now()->startOfDay();
                            $tgl_kembali = \Carbon\Carbon::parse($item->tgl_kembali_seharusnya)->startOfDay();
                            $is_terlewat = $hari_ini->greaterThan($tgl_kembali);
                            $keterlambatan = $is_terlewat ? $hari_ini->diffInDays($tgl_kembali) : 0;
                            
                            $denda_sementara = 0;
                            if ($is_terlewat) {
                                foreach($item->detail_pesanans as $detail) {
                                    if($detail->alat) {
                                        $denda_sementara += ($keterlambatan * $detail->alat->denda_per_hari * $detail->kuantitas);
                                    }
                                }
                            }
                        @endphp

                    <tr style="background: #fdfdfd;">
                        <td class="py-3 align-middle font-weight-bold" style="color: #f96d00;">#SLK-00{{ $item->id }}</td>
                        <td class="py-3 align-middle">{{ $item->user->name ?? 'User Dihapus' }}</td>
                        <td class="py-3 align-middle">
                            {{ $tgl_kembali->translatedFormat('d M Y') }}
                            @if($is_terlewat)
                                <span class="text-danger font-weight-bold ml-1">(Terlewat)</span>
                            @endif
                        </td>
                        <td class="py-3 align-middle text-center">
                            <span class="badge" style="background-color: #fee2e2; color: #b91c1c; padding: 6px 12px; border-radius: 20px;">Belum Kembali</span>
                        </td>
                        <td class="py-3 align-middle text-center font-weight-bold">
                            @if($is_terlewat)
                                <span class="text-danger">Rp {{ number_format($denda_sementara, 0, ',', '.') }} <small>({{ $keterlambatan }} Hari)</small></span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="py-3 align-middle text-center">
                            <form action="/admin/pengembalian/{{ $item->id }}/proses" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn text-white font-weight-bold px-3 btn-sm" style="background-color: #f96d00; border-radius: 6px;" onclick="return confirm('Proses pengembalian alat ini? Stok akan otomatis bertambah kembali.')">
                                    Proses Kembali
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada alat yang sedang dipinjam saat ini.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
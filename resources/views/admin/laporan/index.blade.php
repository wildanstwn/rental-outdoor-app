@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Finalisasi & Pengaturan</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Laporan Operasional</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Laporan Operasional Store</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Rekapitulasi total transaksi sewa, denda keterlambatan, dan pembukuan pendapatan Selekta Adventure.</p>
    </div>

    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 15px;">
        <h6 class="font-weight-bold mb-3" style="color: #444;">Filter & Cetak Laporan</h6>
        <form action="/admin/laporan" method="GET">
            <div class="row align-items-end">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="small font-weight-bold text-muted">Dari Tanggal</label>
                    <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal') }}" style="border-radius: 8px;">
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="small font-weight-bold text-muted">Sampai Tanggal</label>
                    <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal') }}" style="border-radius: 8px;">
                </div>
                <div class="col-md-4 d-flex">
                    <button type="submit" class="btn font-weight-bold text-white shadow-sm flex-fill mr-2" style="background-color: #222; border-radius: 8px; padding: 10px;">
                        <i class="fa fa-filter mr-1"></i> Filter
                    </button>
                    <a href="/admin/laporan/cetak?dari_tanggal={{ request('dari_tanggal') }}&sampai_tanggal={{ request('sampai_tanggal') }}" target="_blank" class="btn font-weight-bold text-white shadow-sm flex-fill" style="background-color: #f96d00; border-radius: 8px; padding: 10px;">
                        <i class="fa fa-file-pdf-o mr-1"></i> Cetak PDF
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr class="text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th class="border-0">Periode / Bulan</th>
                        <th class="border-0">Total Transaksi</th>
                        <th class="border-0">Unit Alat Keluar</th>
                        <th class="border-0">Total Denda</th>
                        <th class="border-0">Total Pendapatan</th>
                        <th class="border-0 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px; color: #333;">
                    
                    @forelse ($laporan as $bulan => $data)
                    <tr style="background: #fdfdfd;">
                        <td class="py-3 align-middle font-weight-bold" style="color: #222;">
                            {{ $bulan }}
                            @if($bulan == \Carbon\Carbon::now()->translatedFormat('F Y'))
                                <span class="text-muted font-weight-normal ml-1">(Berjalan)</span>
                            @endif
                        </td>
                        <td class="py-3 align-middle text-muted">{{ $data['total_transaksi'] }} Transaksi</td>
                        <td class="py-3 align-middle text-muted">{{ $data['unit_keluar'] }} Unit</td>
                        <td class="py-3 align-middle font-weight-bold" style="color: #dc2626;">
                            Rp {{ number_format($data['total_denda'], 0, ',', '.') }}
                        </td>
                        <td class="py-3 align-middle font-weight-bold" style="color: #16a34a;">
                            Rp {{ number_format($data['total_pendapatan'], 0, ',', '.') }}
                        </td>
                        <td class="py-3 align-middle text-center">
                            <a href="#" class="btn btn-light btn-sm text-muted font-weight-bold" style="border-radius: 6px; font-size: 12px;">
                                <i class="fa fa-eye" style="color: #f96d00;"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data laporan transaksi yang selesai.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Manajemen Data</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Data Pelanggan</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Database Pelanggan</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Daftar identitas penyewa terdaftar beserta rekam riwayat kontak aktif.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr class="text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th class="border-0">Nama Lengkap</th>
                        <th class="border-0">Nomor WhatsApp</th>
                        <th class="border-0">Lokasi / Asal</th>
                        <th class="border-0">Jumlah Penyewaan</th>
                        <th class="border-0 text-center">Status Akun</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px; color: #333;">
                    
                    @forelse ($pelanggans as $item)
                    <tr style="background: #fdfdfd;">
                        <td class="py-3 align-middle font-weight-bold" style="color: #222;">{{ $item->name }}</td>
                        
                        <td class="py-3 align-middle text-muted">
                            @if($item->no_wa)
                                {{ $item->no_wa }}
                            @else
                                <span class="text-light-muted font-italic">Belum diisi</span>
                            @endif
                        </td>
                        
                        <td class="py-3 align-middle text-muted">
                            @if($item->alamat)
                                {{ \Illuminate\Support\Str::limit($item->alamat, 30) }}
                            @else
                                <span class="text-light-muted font-italic">-</span>
                            @endif
                        </td>
                        
                        <td class="py-3 align-middle text-muted">
                            {{ $item->pesanans_count }} Kali Transaksi
                        </td>
                        
                        <td class="py-3 align-middle text-center">
                            <span class="badge" style="background-color: #dcfce7; color: #166534; padding: 6px 16px; border-radius: 20px; font-weight: 600;">Aktif</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada pelanggan yang mendaftar.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Manajemen Data</span> <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Data Alat & Stok</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Daftar Alat & Stok</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Manajemen detail spesifikasi produk, tarif sewa harian, dan ketersediaan stok fisik.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="mb-3 text-right">
        <button class="btn btn-primary px-4 font-weight-bold" data-toggle="modal" data-target="#modalTambahAlat" style="background-color: #f96d00; border-color: #f96d00; border-radius: 8px; font-size: 14px;">
            <i class="fa fa-plus mr-2"></i> Tambah Alat Baru
        </button>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr class="text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th class="border-0">Alat</th>
                        <th class="border-0">Kategori</th>
                        <th class="border-0">Harga Sewa</th>
                        <th class="border-0 text-center">Stok Fisik</th>
                        <th class="border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px; color: #333;">
                    @forelse ($alats as $item)
                    <tr style="background: #fdfdfd;">
                        <td class="py-3 align-middle font-weight-bold">
                            @if($item->gambar)
                                <img src="{{ asset('images/alat/' . $item->gambar) }}" alt="Gambar" class="rounded mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-inline-block mr-2 text-center" style="width: 40px; height: 40px; line-height: 40px;"><i class="fa fa-image text-muted"></i></div>
                            @endif
                            {{ $item->nama_alat }}
                        </td>
                        <td class="py-3 align-middle">
                            <span class="badge badge-light px-2 py-1 text-muted">{{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}</span>
                        </td>
                        <td class="py-3 align-middle text-success font-weight-bold">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }} <small class="text-muted">/hari</small></td>
                        <td class="py-3 align-middle text-center">
                            <strong>{{ $item->stok_tersedia }}</strong> / <span class="text-muted">{{ $item->stok_total }}</span>
                        </td>
                        <td class="py-3 align-middle text-center">
                            <form action="/admin/alat/{{ $item->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm px-2 text-danger" onclick="return confirm('Yakin ingin menghapus alat {{ $item->nama_alat }} ini?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data alat yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahAlat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold">Tambah Perlengkapan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/alat" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label class="small font-weight-bold text-muted">Nama Alat</label>
                            <input type="text" name="nama_alat" class="form-control" placeholder="Contoh: Tenda Dome 4 Orang Eiger" required style="border-radius: 8px;">
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-muted">Kategori</label>
                            <select name="kategori_id" class="form-control" required style="border-radius: 8px;">
                                <option value="">Pilih Kategori...</option>
                                @foreach($kategoris as $ktg)
                                    <option value="{{ $ktg->id }}">{{ $ktg->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-muted">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="harga_per_hari" class="form-control" placeholder="Contoh: 35000" required style="border-radius: 8px;">
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-muted">Denda Keterlambatan / Hari (Rp)</label>
                            <input type="number" name="denda_per_hari" class="form-control" placeholder="Contoh: 35000" required style="border-radius: 8px;">
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-muted">Stok Total</label>
                            <input type="number" name="stok_total" class="form-control" placeholder="Contoh: 15" required style="border-radius: 8px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small font-weight-bold text-muted">Gambar Alat <small>(Opsional)</small></label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" style="border-radius: 8px; padding: 5px;">
                    </div>

                    <div class="form-group">
                        <label class="small font-weight-bold text-muted">Deskripsi Singkat <small>(Opsional)</small></label>
                        <textarea name="deskripsi" class="form-control" rows="2" placeholder="Tuliskan kelengkapan atau spesifikasi alat..." style="border-radius: 8px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" style="background-color: #f96d00; border-color: #f96d00; border-radius: 8px;">Simpan Alat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
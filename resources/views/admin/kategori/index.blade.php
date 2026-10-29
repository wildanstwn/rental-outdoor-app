@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    
    <div class="mb-4">
        <div style="font-size: 13px; color: #888888; margin-bottom: 6px; font-weight: 400;">
            <span>Admin</span> 
            <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span>Manajemen Data</span> 
            <span class="mx-2" style="font-size: 10px; color: #bbb;">&gt;</span> 
            <span style="color: #333; font-weight: 500;">Kategori Alat</span>
        </div>
        <h1 class="font-weight-bold mb-1" style="color: #111111; font-size: 28px; letter-spacing: -0.5px;">Kategori Peralatan</h1>
        <p class="text-muted mb-0" style="font-size: 14.5px;">Kelola kelompok atau rumpun perlengkapan outdoor Selekta Adventure.</p>
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
        <button class="btn btn-primary px-4 font-weight-bold" data-toggle="modal" data-target="#modalTambahKategori" style="background-color: #f96d00; border-color: #f96d00; border-radius: 8px; font-size: 14px;">
            <i class="fa fa-plus mr-2"></i> Tambah Kategori
        </button>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr class="text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th class="border-0">ID Kategori</th>
                        <th class="border-0">Nama Kategori</th>
                        <th class="border-0">Jumlah Unit Alat</th>
                        <th class="border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px; color: #333;">
                    
                    @forelse ($kategoris as $item)
                    <tr style="background: #fdfdfd;">
                        <td class="py-3 align-middle font-weight-bold text-muted">#KTG-0{{ $item->id }}</td>
                        <td class="py-3 align-middle font-weight-600">{{ $item->nama_kategori }}</td>
                        <td class="py-3 align-middle">
                            <span class="badge badge-light px-3 py-2 text-dark font-weight-bold" style="font-size: 12px;">
                                {{ $item->alats_count }} Unit
                            </span>
                        </td>
                        <td class="py-3 align-middle text-center">
                            <button class="btn btn-light btn-sm px-3 mr-1 text-primary" data-toggle="modal" data-target="#modalEditKategori{{ $item->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            
                            <form action="/admin/kategori/{{ $item->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm px-2 text-danger" onclick="return confirm('Yakin ingin menghapus kategori {{ $item->nama_kategori }} ini?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditKategori{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border-radius: 15px; border: none;">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title font-weight-bold">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/kategori/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="small font-weight-bold text-muted">Nama Kategori</label>
                                            <input type="text" name="nama_kategori" class="form-control" value="{{ $item->nama_kategori }}" required style="border-radius: 8px;">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" style="background-color: #f96d00; border-color: #f96d00; border-radius: 8px;">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data kategori yang ditambahkan.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold">Tambah Kategori Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/kategori" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small font-weight-bold text-muted">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Sepatu Trekking" required style="border-radius: 8px;">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" style="background-color: #f96d00; border-color: #f96d00; border-radius: 8px;">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
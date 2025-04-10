@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-4">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman Barang</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
                Tambah Peminjaman
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjam</th>
                            <th>Nama Peminjam</th>
                            <th>Jenis Kegiatan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Pinjam</th>
                            <th>Nama Ruangan</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Waktu Peminjaman</th>
                            <th>Serah Terima</th>
                            <th>Berita Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pm_barang as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->code_peminjaman }}</td>
                            <td>{{ $data->anggota->nama_peminjam }}</td>
                            <td>{{ $data->jenis_kegiatan }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($data->peminjaman_details as $detail)
                                    <li>{{ $detail->barang->nama_barang }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($data->peminjaman_details as $detail)
                                    <li>{{ $detail->jumlah_pinjam }} Pcs</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $data->ruangan->nama_ruangan }}</td>
                            <td>{{ $data->tanggal_peminjaman }}</td>
                            <td>{{ $data->waktu_peminjaman }}</td>
                            <td>
                                <a href="{{ route('pm_barang.view-pdf', $data->id) }}" class="btn btn-primary btn-sm">Cetak</a>
                            </td>
                            <td>
                                <a href="{{ route('pm_barang.view-barang', $data->id) }}" class="btn btn-success btn-sm">Cetak</a>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        ⋮
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('pm_barang.edit', $data->code_peminjaman) }}" class="dropdown-item">Edit</a></li>
                                        <li>
                                            <form action="{{ route('pm_barang.destroy', $data->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREATE -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLabel">Tambah Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pm_barang.store') }}" method="POST">
                @csrf
                        <div class="mb-3">
                            <label for="code_peminjaman" class="form-label">Kode Peminjaman</label>
                            <input type="text" id="code_peminjaman" value="{{ old('code_peminjaman', 'PM-' . date('Ymd') . '-' . rand(1000,9999)) }}" readonly class="form-control bg-light" name="code_peminjaman" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_anggota" class="form-label">Nama Peminjam</label>
                            <select name="id_anggota" class="form-select">
                                @foreach ($anggota as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_peminjam}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kegiatan</label>
                            <input type="text" class="form-control" name="jenis_kegiatan" value="{{ old('jenis_kegiatan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Barang yang Dipinjam</label>
                            <table class="table table-bordered table-hover" id="barang-table">
                                <thead class="table-primary text-dark text-center">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="barang-row">
                                        <td>
                                            <select name="id_barang[]" class="form-select barang-select">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barang as $data)
                                                    <option value="{{$data->id}}">{{ $data->nama_barang}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah_pinjam[]" class="form-control text-center" min="1" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-barang"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success btn-sm" id="add-barang"><i class="fas fa-plus"></i> Tambah Barang</button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_ruangan" class="form-label">Nama Ruangan</label>
                            <select name="id_ruangan" class="form-select">
                                @foreach ($ruangan as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_ruangan}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Peminjaman</label>
                                <input type="text" class="form-control" name="waktu_peminjaman" value="{{ old('waktu_peminjaman') }}" required>
                            </div>
                        </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush

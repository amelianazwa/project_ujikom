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
            <a href="{{ route('pm_barang.create') }}" class="btn btn-primary btn-sm">Tambah Peminjaman</a>
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
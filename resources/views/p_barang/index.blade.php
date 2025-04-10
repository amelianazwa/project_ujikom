@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

<style>
    /* Hapus background biru gelap dari header tabel */
    .table thead {
        background-color: #ffffff !important; /* Putih */
        color: #000 !important; /* Hitam */
    }

    /* Hilangkan background item row saat hover */
    .table tbody tr:hover {
        background-color: transparent !important;
    }
</style>

@endsection

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pengembalian Barang</h5>
            <a href="{{ route('p_barang.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="example">
                <thead class="bg-light text-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama Pengembali</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($p_barang as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->code_peminjaman }}</td> <!-- ✅ Pastikan pakai code_peminjaman -->
                            <td>{{ $data->nama_pengembali }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_pengembalian)->format('d M Y') }}</td> <!-- ✅ Format tanggal -->
                            <td>{{ $data->keterangan ?? '-' }}</td> <!-- ✅ Jika kosong, tampilkan '-' -->

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        ⋮
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('p_barang.edit', $data->id) }}">✏ Edit</a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger btn-delete" data-id="{{ $data->id }}">🗑 Hapus</button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    new DataTable('#example');

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            let id = this.getAttribute('data-id');
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('delete-form');
                    form.action = `/p_barang/${id}`;
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

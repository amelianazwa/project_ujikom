@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Pengembalian Barang</h5>
            <a href="{{ route('p_barang.index') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('p_barang.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="code_peminjaman">Kode Peminjaman</label>
                    <select name="code_peminjaman" id="code_peminjaman" class="form-control">
                        <option value="">Pilih Kode Peminjaman</option>
                        @foreach ($pm_barang as $data)
                            <option value="{{ $data->code_peminjaman }}">{{ $data->code_peminjaman }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama_pengembali">Nama Pengembali</label>
                    <input type="text" class="form-control" name="nama_pengembali" placeholder="Masukkan Nama Pengembali" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" name="tanggal_pengembalian" required>
                </div>

                <div class="mb-3">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="Tambahkan keterangan jika perlu"></textarea>
                </div>

                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </form>

            <!-- Tabel Barang yang Dipinjam -->
            <div class="mt-4">
                <h6>Barang yang Dipinjam</h6>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="daftar-barang">
                        <tr>
                            <td colspan="2" class="text-center">Pilih kode peminjaman terlebih dahulu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    document.getElementById('code_peminjaman').addEventListener('change', function() {
        let codePeminjaman = this.value;
        let tbody = document.getElementById('daftar-barang');
        
        tbody.innerHTML = '<tr><td colspan="2" class="text-center">Loading...</td></tr>';

        if (codePeminjaman) {
            fetch(`/get-peminjaman-details/${codePeminjaman}`)
                .then(response => response.json())
                .then(data => {
                    console.log("DATA DARI SERVER:", data); // Debug output
                    tbody.innerHTML = '';

                    if (!data || data.error) {
                        tbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">${data.error || 'Terjadi kesalahan'}</td></tr>`;
                        return;
                    }

                    if (data.peminjaman_details && data.peminjaman_details.length > 0) {
                        data.peminjaman_details.forEach(detail => {
                            tbody.innerHTML += `<tr>
                                <td>${detail.nama_barang || 'Barang tidak ditemukan'}</td>
                                <td>${detail.jumlah_pinjam || '0'}</td>
                            </tr>`;
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="2" class="text-center">Tidak ada barang yang dipinjam</td></tr>';
                    }
                })
                .catch(error => {
                    console.error("Fetch Error:", error);
                    tbody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">Terjadi kesalahan saat mengambil data</td></tr>';
                });
        } else {
            tbody.innerHTML = '<tr><td colspan="2" class="text-center">Pilih kode peminjaman terlebih dahulu</td></tr>';
        }
    });
</script>
@endpush

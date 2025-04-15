@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header bg-light text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Peminjaman Barang</h5>
                    <a href="{{ route('pm_barang.index') }}" class="btn btn-primary btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('pm_barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="code_peminjaman" class="form-label">Kode Peminjaman</label>
                            <input type="text" id="code_peminjaman" value="{{ old('code_peminjaman', 'PM-' . date('Ymd') . '-' . rand(1000,9999)) }}" readonly class="form-control bg-light" name="code_peminjaman" required>
                        </div>

                        <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" id="nim" name="nim" class="form-control">
    </div>

    <div class="mb-3">
        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
        <input type="hidden" id="id_anggota" name="id_anggota">
        <input type="text" id="nama_peminjam" class="form-control bg-light" readonly>
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
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Peminjaman</label>
                                <input type="text" class="form-control" name="waktu_peminjaman" value="{{ old('waktu_peminjaman') }}" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let dataAnggota = @json($anggota); // Ambil data anggota dari Blade ke JS

    document.getElementById('nim').addEventListener('input', function () {
    let nimInput = this.value.trim();
    let namaField = document.getElementById('nama_peminjam');
    let idAnggotaField = document.getElementById('id_anggota'); // Tambahkan ini
    let foundAnggota = dataAnggota.find(a => a.nim === nimInput);

    if (foundAnggota) {
        namaField.value = foundAnggota.nama_peminjam;
        idAnggotaField.value = foundAnggota.id; // Isi ID Anggota
    } else {
        namaField.value = "";
        idAnggotaField.value = ""; // Kosongkan jika tidak ditemukan
    }
});

    function updateBarangOptions() {
        let selectedItems = [];

        document.querySelectorAll('.barang-select').forEach(select => {
            if (select.value) {
                selectedItems.push(select.value);
            }
        });

        document.querySelectorAll('.barang-select').forEach(select => {
            let currentValue = select.value;
            select.querySelectorAll('option').forEach(option => {
                if (selectedItems.includes(option.value) && option.value !== currentValue) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    document.getElementById('add-barang').addEventListener('click', function () {
        let table = document.getElementById('barang-table').getElementsByTagName('tbody')[0];
        let newRow = document.querySelector('.barang-row').cloneNode(true);

        newRow.querySelector("input").value = "";
        let selectElement = newRow.querySelector(".barang-select");
        selectElement.value = "";

        selectElement.addEventListener('change', updateBarangOptions);

        table.appendChild(newRow);
        updateBarangOptions();
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-barang')) {
            let row = event.target.closest('tr');
            if (document.querySelectorAll('.barang-row').length > 1) {
                row.remove();
                updateBarangOptions();
            } else {
                alert('Minimal satu barang harus dipinjam!');
            }
        }
    });

    document.addEventListener('change', function (event) {
        if (event.target.matches('.barang-select')) {
            updateBarangOptions();
        }
    });

    updateBarangOptions();
});
</script>
@endsection

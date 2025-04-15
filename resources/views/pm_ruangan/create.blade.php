@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Peminjaman Ruangan</h5>
                    <a href="{{ route('pm_ruangan.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('pm_ruangan.store') }}" method="POST" enctype="multipart/form-data" id="formPeminjaman">
                        @csrf

                        <div class="mb-3">
                            <label for="code_peminjaman" class="form-label">Kode Peminjaman</label>
                            <input type="text" id="code_peminjaman" name="code_peminjaman" value="{{ old('code_peminjaman', 'PM-' . date('Ymd') . '-' . rand(1000,9999)) }}" class="form-control bg-light" readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nim" name="nim" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                            <input type="hidden" id="id_anggota" name="id_anggota">
                            <input type="text" id="nama_peminjam" class="form-control bg-light" readonly>
                        </div>

                        {{-- Debug helper --}}
                        <p><strong>DEBUG ID Anggota:</strong> <span id="debug_id_anggota">-</span></p>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kegiatan</label>
                            <input type="text" class="form-control" name="jenis_kegiatan" value="{{ old('jenis_kegiatan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruangan yang Dipinjam</label>
                            <table class="table table-bordered table-hover" id="ruangan-table">
                                <thead class="table-primary text-dark text-center">
                                    <tr>
                                        <th>Nama Ruangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="ruangan-row">
                                        <td>
                                            <select name="id_ruangan[]" class="form-select ruangan-select" required>
                                                <option value="">Pilih Ruangan</option>
                                                @foreach ($ruangan as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_ruangan }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-ruangan"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success btn-sm" id="add-ruangan"><i class="fas fa-plus"></i> Tambah Ruangan</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}" required>
                            </div>
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    let dataAnggota = @json($anggota);

    const nimInput = document.getElementById('nim');
    const namaField = document.getElementById('nama_peminjam');
    const idAnggotaField = document.getElementById('id_anggota');
    const debugIdAnggota = document.getElementById('debug_id_anggota');

    nimInput.addEventListener('input', function () {
        let nim = this.value.trim();
        let found = dataAnggota.find(a => a.nim === nim);

        if (found) {
            namaField.value = found.nama_peminjam;
            idAnggotaField.value = found.id;
            debugIdAnggota.textContent = found.id;
        } else {
            namaField.value = "";
            idAnggotaField.value = "";
            debugIdAnggota.textContent = "-";
        }
    });

    document.getElementById('formPeminjaman').addEventListener('submit', function (e) {
        if (!idAnggotaField.value) {
            e.preventDefault();
            alert('NIM tidak ditemukan. Pastikan Anda memasukkan NIM yang benar!');
        }
    });

    function updateRuanganOptions() {
        let selectedItems = [];
        document.querySelectorAll('.ruangan-select').forEach(select => {
            if (select.value) {
                selectedItems.push(select.value);
            }
        });

        document.querySelectorAll('.ruangan-select').forEach(select => {
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

    document.getElementById('add-ruangan').addEventListener('click', function () {
        let table = document.getElementById('ruangan-table').getElementsByTagName('tbody')[0];
        let newRow = document.querySelector('.ruangan-row').cloneNode(true);
        newRow.querySelector(".ruangan-select").value = "";
        table.appendChild(newRow);
        updateRuanganOptions();
    });

    document.addEventListener('click', function (event) {
        if (event.target.closest('.remove-ruangan')) {
            let row = event.target.closest('tr');
            if (document.querySelectorAll('.ruangan-row').length > 1) {
                row.remove();
                updateRuanganOptions();
            } else {
                alert('Minimal satu ruangan harus dipinjam!');
            }
        }
    });

    document.addEventListener('change', function (event) {
        if (event.target.matches('.ruangan-select')) {
            updateRuanganOptions();
        }
    });

    updateRuanganOptions();
});
</script>
@endsection

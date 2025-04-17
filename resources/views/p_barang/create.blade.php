@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<style>
    .form-control {
        max-width: 300px;
    }
</style>
@endsection

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Pengembalian Barang</h5>
            <a href="{{ route('p_barang.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('p_barang.store') }}" method="POST">
                @csrf
                <div class="row">

                    {{-- Dropdown untuk memilih peminjaman --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_pm_barang" class="form-label">ID Peminjaman barang</label>
                            <select class="form-control" id="id_pm_barang" name="id_pm_barang" required>
                                <option value="">-- Pilih Peminjaman --</option>
                                @foreach($pm_barang as $item)
                                    <option value="{{ $item->id }}" data-tanggal="{{ $item->tanggal_pengembalian }}">
                                        {{ $item->code_peminjaman }} - {{ $item->anggota->nama_peminjam ?? 'Tanpa Nama' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tanggal selesai pengembalian --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="col-md-6">
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <select class="form-control" id="keterangan" name="keterangan">
            <option value="Baik" {{ old('keterangan') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak" {{ old('keterangan') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            <option value="Telat Dikembalikan" {{ old('keterangan') == 'Telat Dikembalikan' ? 'selected' : '' }}>Telat Dikembalikan</option>
        </select>
    </div>
</div>


                    {{-- Denda --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="denda" class="form-label">Denda</label>
                            <input type="text" class="form-control" id="denda" name="denda" value="Rp 0" readonly>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const dendaField = document.getElementById('denda');
    const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
    const keteranganInput = document.getElementById('keterangan');
    const selectPeminjaman = document.getElementById('id_pm_barang');

    function hitungDenda() {
        const selectedOption = selectPeminjaman.options[selectPeminjaman.selectedIndex];
        const tanggalPengembalian = new Date(selectedOption.getAttribute('data-tanggal'));
        const tanggalSelesai = new Date(tanggalSelesaiInput.value);
        const keterangan = keteranganInput.value.toLowerCase();

        let denda = 0;

        if (tanggalSelesai && tanggalSelesai > tanggalPengembalian) {
            const diffTime = tanggalSelesai - tanggalPengembalian;
            const daysLate = Math.ceil(diffTime / (1000 * 3600 * 24));
            denda += daysLate * 10000; // Denda 10 ribu per hari
        }

        if (keterangan.includes('rusak')) {
            denda += 5000; // Denda tambahan jika rusak
        }

        dendaField.value = denda > 0 ? "Rp " + denda.toLocaleString() : "Rp 0";
    }

    tanggalSelesaiInput.addEventListener('change', hitungDenda);
    keteranganInput.addEventListener('input', hitungDenda);
    selectPeminjaman.addEventListener('change', hitungDenda);
</script>
@endpush

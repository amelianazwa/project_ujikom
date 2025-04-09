@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Edit Peminjaman Barang</h5>
            <a href="{{ route('pm_barang.index') }}" class="btn btn-primary btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('pm_barang.update', $pm_barang->code_peminjaman) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama Peminjam</label>
                    <select name="id_anggota" class="form-control" required>
                        @foreach($anggota as $a)
                            <option value="{{ $a->id }}" {{ $pm_barang->id_anggota == $a->id ? 'selected' : '' }}>{{ $a->nama_peminjam }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kegiatan</label>
                    <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $pm_barang->jenis_kegiatan }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ruangan</label>
                    <select name="id_ruangan" class="form-control" required>
                        @foreach($ruangan as $r)
                            <option value="{{ $r->id }}" {{ $pm_barang->id_ruangan == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $pm_barang->tanggal_peminjaman }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Peminjaman</label>
                    <input type="time" name="waktu_peminjaman" class="form-control" value="{{ $pm_barang->waktu_peminjaman }}" required>
                </div>

                <h5 class="mt-4">Barang yang Dipinjam</h5>
                <div id="barang-container">
                    @foreach($details as $detail)
                    <div class="row mb-2 barang-item">
                        <div class="col-md-6">
                            <select name="id_barang[]" class="form-control" required>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}" {{ $detail->id_barang == $b->id ? 'selected' : '' }}>{{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="jumlah_pinjam[]" class="form-control" value="{{ $detail->jumlah_pinjam }}" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-barang">✖</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn btn-primary mt-2" id="add-barang">+ Tambah Barang</button>
                <br><br>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-barang').addEventListener('click', function() {
        let container = document.getElementById('barang-container');
        let newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-2', 'barang-item');
        newRow.innerHTML = `
            <div class="col-md-6">
                <select name="id_barang[]" class="form-control" required>
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="jumlah_pinjam[]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-barang">✖</button>
            </div>
        `;
        container.appendChild(newRow);
    });
    
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-barang')) {
            e.target.closest('.barang-item').remove();
        }
    });
</script>
@endsection
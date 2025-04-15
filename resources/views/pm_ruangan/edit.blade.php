@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Edit Peminjaman Ruangan</h5>
            <a href="{{ route('pm_ruangan.index') }}" class="btn btn-primary btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <!-- Ganti dari $pm_ruangan->id ke $pm_ruangan->code_peminjaman -->
            <form action="{{ route('pm_ruangan.update', $pm_ruangan->code_peminjaman) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama Peminjam</label>
                    <select name="id_anggota" class="form-control" required>
                        @foreach($anggota as $a)
                            <option value="{{ $a->id }}" {{ $pm_ruangan->id_anggota == $a->id ? 'selected' : '' }}>{{ $a->nama_peminjam }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kegiatan</label>
                    <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $pm_ruangan->jenis_kegiatan }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $pm_ruangan->tanggal_peminjaman }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Peminjaman</label>
                    <input type="time" name="waktu_peminjaman" class="form-control" value="{{ $pm_ruangan->waktu_peminjaman }}" required>
                </div>

                <h5 class="mt-4">Ruangan yang Dipinjam</h5>
                <div id="ruangan-container">
                    @foreach($details as $detail)
                    <div class="row mb-2 ruangan-item">
                        <div class="col-md-10">
                            <select name="id_ruangan[]" class="form-control" required>
                                @foreach($ruangan as $r)
                                    <option value="{{ $r->id }}" {{ $detail->id_ruangan == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-ruangan">✖</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn btn-primary mt-2" id="add-ruangan">+ Tambah Ruangan</button>
                <br><br>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-ruangan').addEventListener('click', function() {
        let container = document.getElementById('ruangan-container');
        let newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-2', 'ruangan-item');
        newRow.innerHTML = `
            <div class="col-md-10">
                <select name="id_ruangan[]" class="form-control" required>
                    @foreach($ruangan as $r)
                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-ruangan">✖</button>
            </div>
        `;
        container.appendChild(newRow);
    });
    
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-ruangan')) {
            e.target.closest('.ruangan-item').remove();
        }
    });
</script>
@endsection

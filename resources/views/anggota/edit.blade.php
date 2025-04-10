
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Anggota') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('anggota.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kode Mahasiswa</label>
                            <input type="text" class="form-control @error('code_anggota') is-invalid @enderror" name="code_anggota"
                                value="{{ $anggota->code_anggota }}" placeholder="Kode Mahasiswa" required>
                            @error('code_anggota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_peminjam"
                                value="{{ $anggota->nama_peminjam }}" placeholder="Nama peminjam" required>
                            @error('nama_anggota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $anggota->email }}" placeholder="Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomer Telepon</label>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon"
                                value="{{ $anggota->no_telepon }}" placeholder="Nomer telepon" required>
                            @error('no_telepon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">instansi Lembaga</label>
                            <input type="text" class="form-control @error('instansi_lembaga') is-invalid @enderror" name="instansi_lembaga"
                                value="{{ $anggota->instansi_lembaga }}" placeholder="Instansi Lembaga" required>
                            @error('instansi_lembaga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>






                        <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-sm btn-danger">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
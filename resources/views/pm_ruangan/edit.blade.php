
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Peminjaman Ruangan') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('pm_ruangan.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('pm_ruangan.update', $pm_ruangan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf

                         <div class="mb-3">
                            <label class="form-label">Kode Peminjaman</label>
                            <input type="text" class="form-control @error('code_peminjaman') is-invalid @enderror" name="code_peminjaman"
                                value="{{ $pm_ruangan->code_peminjaman }}" placeholder="Kode Peminjaman" required>
                            @error('code_peminjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Peminjam</label>
                            <select name="id_anggota" id="" class="form-control">
                                @foreach ($anggota as $item)
                                    <option value="{{$item->id}}" {{$item->id == $pm_ruangan->id_anggota ? 'selected': ''}}>{{ $item->nama_peminjam }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Ruangan</label>
                            <select name="id_ruangan" id="" class="form-control">
                                @foreach ($ruangan as $item)
                                    <option value="{{$item->id}}" {{$item->id == $pm_ruangan->id_ruangan ? 'selected': ''}}>{{ $item->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman"
                                value="{{ $pm_ruangan->tanggal_peminjaman }}" placeholder="Tanggal peminjaman" required>
                            @error('tanggal_peminjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kegiatan</label>
                            <input type="text" class="form-control @error('jenis_kegiatan') is-invalid @enderror" name="jenis_kegiatan"
                                value="{{ $pm_ruangan->jenis_kegiatan }}" placeholder="Jenis kegiatan" required>
                            @error('jenis_kegiatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman"
                                value="{{ $pm_ruangan->tanggal_peminjaman }}" placeholder="Tanggal peminjaman" required>
                            @error('tanggal_peminjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Peminjaman</label>
                            <input type="date" class="form-control @error('waktu_peminjaman') is-invalid @enderror" name="waktu_peminjaman"
                                value="{{ $pm_ruangan->waktu_peminjaman }}" placeholder="Waktu peminjaman" required>
                            @error('waktu_peminjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi</label>
                            <img src="{{ asset('/images/pm_ruangan/' . $pm_ruangan->cover) }}" width="100">
                            <input type="file" class="form-control" name="cover">
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

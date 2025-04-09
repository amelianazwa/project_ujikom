@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                            {{ __('Ruangan') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('ruangan.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('ruangan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Nama ruangan</label>
                            <input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="nama_ruangan"
                            value="{{ old('ruangan') }}" placeholder="Nama ruangan" required>
                            @error('ruangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Nama pic</label>
                            <input type="text" class="form-control @error('pic') is-invalid @enderror" name="nama_pic"
                            value="{{ old('pic') }}" placeholder="Nama pic" required>
                            @error('pic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Posisi Ruangan</label>
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi_ruangan"
                            value="{{ old('posisi') }}" placeholder="posisi ruangan" required>
                            @error('posisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>





                    <br>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Barang') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code_barang"
                            value="{{ old('barang') }}" placeholder="Kode barang" required>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control @error('barang') is-invalid @enderror" name="nama_barang"
                            value="{{ old('barang') }}" placeholder="Nama barang" required>
                            @error('barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Merk</label>
                            <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk"
                            value="{{ old('merk') }}" placeholder="Merk" required>
                            @error('merk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="">Kategori</label>
                            <select name="id_kategori" id="" class="form-control">
                                @foreach ($kategori as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Detail</label>
                            <input type="text" class="form-control @error('detail') is-invalid @enderror" name="detail"
                            value="{{ old('detail') }}" placeholder="Detail" required>
                            @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Jumlah</label>
                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                            value="{{ old('jumlah') }}" placeholder="Jumlah" required>
                            @error('jumlah')
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

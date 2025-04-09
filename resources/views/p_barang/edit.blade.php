
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Pengembalian Barang') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('p_barang.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('p_barang.update', $p_barang->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="">Kode Peminjaman</label>
                            <select name="id_pm_barang" id="" class="form-control">
                                @foreach ($pm_barang as $item)
                                    <option value="{{$item->id}}" {{$item->id == $p_barang->id_pm_barang ? 'selected': ''}}>{{ $item->code_peminjaman }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Pengembalian</label>
                            <input type="text" class="form-control @error('nama_pengembalian') is-invalid @enderror" name="nama_pengembalian"
                                value="{{ $p_barang->nama_pengembalian }}" placeholder="Nama Pengembalian" required>
                            @error('nama_pengembalian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" name="tanggal_pengembalian"
                                value="{{ $p_barang->tanggal_pengembalian }}" placeholder="Tanggal Pengembalian" required>
                            @error('tanggal_pengembalian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                value="{{ $p_barang->keterangan }}" placeholder="Keterangan" required>
                            @error('keterangan')
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

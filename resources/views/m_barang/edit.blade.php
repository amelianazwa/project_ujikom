
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Maintenance Barang') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('m_barang.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('m_barang.update', $m_barang->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Code Maintenace</label>
                            <input type="text" class="form-control @error('code_maintenance') is-invalid @enderror" name="code_maintenance"
                                value="{{ $m_barang->code_maintenance }}" placeholder="code maintenace" required>
                            @error('code_maintenance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Barang</label>
                            <select name="id_barang" id="" class="form-control">
                                @foreach ($barang as $item)
                                    <option value="{{$item->id}}" {{$item->id == $m_barang->id_barang ? 'selected': ''}}>{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Ruangan</label>
                            <select name="id_ruangan" id="" class="form-control">
                                @foreach ($ruangan as $item)
                                    <option value="{{$item->id}}" {{$item->id == $m_barang->id_ruangan ? 'selected': ''}}>{{ $item->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>





                        <div class="mb-3">
                            <label class="form-label">Tanggal Maintenance</label>
                            <input type="text" class="form-control @error('tanggal_maintenance') is-invalid @enderror" name="tanggal_maintenance"
                                value="{{ $m_barang->tanggal_maintenance }}" placeholder="tanggal_maintenance" required>
                            @error('tanggal_maintenance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Pengerjaan</label>
                            <input type="text" class="form-control @error('waktu_pengerjaan') is-invalid @enderror" name="waktu_pengerjaan"
                                value="{{ $m_barang->waktu_pengerjaan }}" placeholder="Waktu pengerjaan" required>
                            @error('waktu_pengerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">jumlah</label>
                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                                value="{{ $m_barang->jumlah }}" placeholder="jumlah" required>
                            @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('jenis_perbaikan') is-invalid @enderror" name="jenis_perbaikan"
                                value="{{ $m_barang->jenis_perbaikan }}" placeholder="Jenis perbaikan" required>
                            @error('jenis_perbaikan')
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
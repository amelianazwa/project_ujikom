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
                    <form action="{{ route('m_barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="">Nama Barang</label>
                            <select name="id_barang" id="" class="form-control">
                                @foreach ($barang as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Ruangan</label>
                            <select name="id_ruangan" id="" class="form-control">
                                @foreach ($ruangan as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_ruangan}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Posisi</label>
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi"
                            value="{{ old('posisi') }}" placeholder="Posisi" required>
                            @error('posisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('jenis_perbaikan') is-invalid @enderror" name="jenis_perbaikan"
                            value="{{ old('jenis_perbaikan') }}" placeholder="Jenis perbaikan" required>
                            @error('jenis_perbaikan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Waktu Pengerjaan</label>
                            <input type="text" class="form-control @error('waktu_pengerjaan') is-invalid @enderror" name="waktu_pengerjaan"
                            value="{{ old('waktu_pengerjaan') }}" placeholder="Waktu pengerjaan" required>
                            @error('waktu_pengerjaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="">Kondisi</label>
                            <select name="id_kondisi" id="" class="form-control">
                                @foreach ($kondisi as $data)
                                    <option value="{{$data->id}}">{{ $data->kondisi}}</option>
                                @endforeach
                            </select>
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


@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Dashboard') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('l_ruangan.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('l_ruangan.update', $l_ruangan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="">Penanggung Jawab</label>
                            <select name="id_pm_ruangan" id="" class="form-control">
                                @foreach ($pm_ruangan as $item)
                                    <option value="{{$item->id}}" {{$item->id == $l_ruangan->id_pm_ruangan ? 'selected': ''}}>{{ $item->penanggungjawab }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                value="{{ $l_ruangan->keterangan }}" placeholder="keterangan" required>
                            @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi</label>
                            <img src="{{ asset('/images/l_ruangan/' . $l_ruangan->cover) }}" width="100">
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

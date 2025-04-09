@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-10">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
        </div>
    </div>
</div>
<div class="container">


<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>Detail Ruangan</h5>
        </div>
        <div class="float-end ">
            <a href="{{ route('detail_ruangan.create') }}" class="btn btn-sm btn-primary">Add</a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Maintenance</th>
                        <th>Ruangan</th>
                        <th>Nama Barang</th>
                        <th>Kondisi</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $i = 1; @endphp
                    @foreach ($detail_ruangan as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $data->code_maintenance }}</td>
                        <td>{{$data->barang->nama_barang}}</td>
                        <td>{{$data->ruangan->nama_ruangan}}</td>
                        <td>{{ $data->kondisi }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>{{ $data->jumlah }}</td>

                        <td>
                            <div class="dropdown d-inline">
     <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
         ⋮
     </button>
     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
         <li>
             <a class="dropdown-item" href="{{ route('detail_ruangan.edit', $data->id) }}">✏ Edit</a>
         </li>
         <li>
             <form action="{{ route('detail_ruangan.destroy', $data->id) }}" method="POST" class="d-inline">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</button>
             </form>
         </li>
     </ul>
 </div>

                         </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#example');
</script>
@endpush

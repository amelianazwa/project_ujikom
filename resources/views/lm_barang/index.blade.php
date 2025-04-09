
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
            <h5>Laporan Maintenance Barang</h5>
        </div>
        <div class="float-end ">

        </div>
       </div>

    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Nama Ruangan</th>
                        <th>Posisi</th>
                        <th>Jenis Perbaikan</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Kondisi</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $i = 1; @endphp
                    @foreach ($m_barang as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$data->barang->nama_barang}}</td>
                        <td>{{$data->ruangan->nama_ruangan}}</td>
                        <td>{{ $data->posisi }}</td>
                        <td>{{ $data->jenis_perbaikan }}</td>
                        <td>{{ $data->waktu_pengerjaan }}</td>
                        <td>{{$data->kondisi->kondisi}}</td>

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
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script>
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: [
                    { extend: 'pdf', className: 'pdf' },
                    { extend: 'excel', className: 'excel    ' }
                ]
            }
        }
    });
</script>
@endpush


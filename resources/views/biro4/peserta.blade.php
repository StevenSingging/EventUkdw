@extends('template.master')
<title>Peserta</title>
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Beranda</a></li>
                    <li class="breadcrumb-item active">Peserta</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <table id="peserta" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Jenis Acara
                        </th>
                        <th>
                            Nama Acara
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Terbuka Untuk
                        </th>
                        <th>
                            Peserta
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($event as $evt)
                    <tr>
                        <td scope="row">{{ $no++ + ($event->currentPage() - 1) * $event->perPage() }}</td>
                        <td>{{ $evt->jenis_acara }}</td>
                        <td>{{ $evt->nama_acara }}</td>
                        <td>{{ date('d F Y', strtotime($evt->waktu_mulai)) }} - {{ date('d F Y', strtotime($evt->waktu_selesai)) }}</td>
                        <td>{{ $evt->terbuka_untuk }}</td>
                        <td> <a class="btn btn-primary" href="{{route('manage.peserta',$evt->id)}}" role="button">Lihat Peserta</a>
                    </tr>
                    </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script>
    $(function() {
        $('#peserta').DataTable({
            "dom": '<"top"i>rt<"bottom"p><"clear">',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 10,
        });
    });
</script>
@endsection
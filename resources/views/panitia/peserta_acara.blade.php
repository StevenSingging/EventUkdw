@extends('template.master')
<title>Peserta Acara </title>
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
                    @if($nama_acara == null)
                    <li class="breadcrumb-item active">Peserta Acara</li>
                    @else
                    <li class="breadcrumb-item active">Peserta Acara {{$nama_acara->nama_acara}}</li>
                    @endif
                    
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
        <a class="btn btn-info" role="button" href="{{route('cetak.peserta',$nama_acara->id)}}"><span class="fa-solid fa-print" aria-hidden="true"></span></a>
            <table id="peserta" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($peserta as $pst)
                    <tr>
                        <td scope="row">{{ $no++ + ($peserta->currentPage() - 1) * $peserta->perPage() }}</td>
                        <td>{{ $pst->userp->nama }}</td>
                        <td>{{ $pst->userp->role }}</td>
                        <td>
                            @if($pst->status == null)
                            <span class="badge badge-warning">Dalam Progress</span>
                            @elseif($pst->status == 1)
                            <span class="badge badge-success">Valid</span>
                            @elseif($pst->status == 0)
                            <span class="badge badge-danger">Tidak Valid</span>
                            @endif
                            
                        </td>
                        <td>
                            <form action="{{ route('validasi.peserta', $pst->id) }}" method="post">
                                @csrf
                                <button class="btn btn-success" name="status" value="1" type="submit"><span class="fa-solid fa-check" aria-hidden="true"></span></button>
                                <button class="btn btn-danger" name="status" value="0" type="submit"><span class="fa-solid fa-xmark" aria-hidden="true"></span></button>
                            </form>
                        </td>
                    </tr>
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
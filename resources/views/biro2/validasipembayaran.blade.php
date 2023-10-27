@extends('template.master')
<title>Validasi Pembayaran</title>

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
                    <li class="breadcrumb-item active">Validasi Pembayaran</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <table id="pembayaran" class="table table-bordered table-hover">
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
                        Tanggal Pembayaran
                    </th>
                    <th>
                        Bukti Pembayaran
                    </th>
                    <th>
                        Status Pembayaran
                    </th>
                    <th>
                        Validasi
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
                    <td>{{ date('d F Y', strtotime($pst->pembayaran->tanggal_pembayaran)) }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bukti{{$pst->id}}"><i class="fa-solid fa-magnifying-glass-dollar"></i></button>
                    </td>
                    <td>
                        @if($pst->pembayaran->status_pembayaran == null)
                        <span class="badge badge-warning">Dalam Progress</span>
                        @elseif($pst->pembayaran->status_pembayaran == '1')
                        <span class="badge badge-success">Valid</span>
                        @elseif($pst->pembayaran->status_pembayaran == '0')
                        <span class="badge badge-danger">Tidak Valid</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('validasi.pembayaran',$pst->id)}}" method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" name="status" value="1" type="submit" ><i class="fa-solid fa-check"></i> Valid</button>
                            <button class="btn btn-danger btn-sm" name="status" value="0" type="submit"><i class="fa-solid fa-xmark"></i> Unvalid</button>
                        </form>
                    </td>
                </tr>
                <div class="modal fade" id="bukti{{$pst->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Bukti Pembayaran </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <img src="{{asset('buktipembayaran/'. $pst->pembayaran->bukti_pembayaran)}}" style="display:block; margin-left:auto; margin-right:auto; width:100%; margin-bottom:5px" alt="">

                            </div>
                        </div>

                    </div>

                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#pembayaran').DataTable({
            "dom": '<"top"i>rt<"bottom"p><"clear">',
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 10,
        });
    });
</script>
@endsection
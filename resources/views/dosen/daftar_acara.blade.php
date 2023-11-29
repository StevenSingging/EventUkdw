@extends('template.master')
<title>Daftar Acara </title>
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
                    <li class="breadcrumb-item active">Daftar Acara Yang Diikuti</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table id="acarau" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Nama Acara
                        </th>
                        <th>
                            Validasi Peserta
                        </th>
                        <th>
                            Pembayaran
                        </th>
                        <th>
                            Status Pembayaran
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($acara as $ev)
                    <tr>
                        <td scope="row">{{ $no++ + ($acara->currentPage() - 1) * $acara->perPage() }}</td>
                        <td>{{ $ev->acarap->nama_acara }}</td>
                        <td>
                            @if($ev->status == null)
                            <span class="badge badge-warning">Dalam Progress</span>
                            @elseif($ev->status == 1)
                            <span class="badge badge-success">Valid</span>
                            @elseif($ev->status == 0)
                            <span class="badge badge-danger">Tidak Valid</span>
                            @endif

                        </td>
                        <td>
                            @if($ev->acarap->harga_dosen == null)
                            <span class="badge badge-success">Gratis</span>
                            @elseif($ev->acarap->harga_dosen != null && $ev->status == null)
                            <span class="badge badge-warning">Dalam Progress</span>
                            @elseif($ev->acarap->harga_dosen != null && $ev->status == '1')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pembayarandsn{{$ev->id}}">Bayar Disini</button>
                            @elseif($ev->acarap->harga_dosen != null && $ev->status == '0')
                            <span class="badge badge-danger">Tidak Valid</span>
                            @endif
                        </td>
                        <td>
                        @if($ev->pembayaran && $ev->pembayaran->status_pembayaran == null)
                        <span class="badge badge-warning">Dalam Progress</span>
                        @elseif($ev->pembayaran && $ev->pembayaran->status_pembayaran == '1')
                        <span class="badge badge-success">Valid</span>
                        @elseif($ev->pembayaran && $ev->pembayaran->status_pembayaran == '0')
                        <span class="badge badge-danger">Tidak Valid</span>
                        @else
                        <span class="badge badge-success">Gratis</span>
                        @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="pembayarandsn{{$ev->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('bayar.dosen', $ev->id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h4 class="modal-title">Pembayaran</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{asset('AdminLTE-3.2.0/dist/img/qris.jpg')}}" style="display:block; margin-left:auto; margin-right:auto; width:50%; margin-bottom:5px" alt="">
                                        <p>Biaya Pendaftaran : Rp. {{ number_format($ev->acarap->harga_dosen, 2, ',', '.') }}</p>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload Bukti Bayar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="gambar">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script>
    $(function() {
        $('#acarau').DataTable({
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
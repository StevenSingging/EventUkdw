@extends('template.master')
<title>Dashboard</title>

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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="card">
        <div class="card-header">
            <h3><b>Validasi Pembayaran</b></h3>
        </div>
        <table id="project" class="table table-bordered table-hover">
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
                    @if(date('d M Y', strtotime($evt->waktu_mulai)) ==  date('d M Y', strtotime($evt->waktu_selesai)))
                    <td>{{ date('d M Y', strtotime($evt->waktu_mulai)) }}</td>
                    @else
                    <td>{{ date('d M Y', strtotime($evt->waktu_mulai)) }} - {{ date('d m Y', strtotime($evt->waktu_selesai)) }}</td>
                    @endif
                    
                    <td>
                        @foreach(json_decode($evt->terbuka_untuk) as $key => $item)
                        {{ $item }}
                        @if ($key < count(json_decode($evt->terbuka_untuk)) - 1)
                            , <!-- Tambahkan koma jika ini bukan elemen terakhir -->
                            @endif
                            @endforeach
                    </td>
                    <td> <a class="btn btn-info" role="button" href="{{route('peserta.acara.validasi',$evt->id)}}"><span class="fa-solid fa-users-viewfinder" aria-hidden="true"></span></a></td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card">
        <div class="card-header">
            <h3><b>Validasi Peserta</b></h3>
        </div>
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
                @foreach($acara as $evt)
                <tr>
                    <td scope="row">{{ $no++ + ($event->currentPage() - 1) * $event->perPage() }}</td>
                    <td>{{ $evt->jenis_acara }}</td>
                    <td>{{ $evt->nama_acara }}</td>
                    @if(date('d M Y', strtotime($evt->waktu_mulai)) ==  date('d M Y', strtotime($evt->waktu_selesai)))
                    <td>{{ date('d M Y', strtotime($evt->waktu_mulai)) }}</td>
                    @else
                    <td>{{ date('d M Y', strtotime($evt->waktu_mulai)) }} - {{ date('d M Y', strtotime($evt->waktu_selesai)) }}</td>
                    @endif
                    <td>
                        @foreach(json_decode($evt->terbuka_untuk) as $key => $item)
                        {{ $item }}
                        @if ($key < count(json_decode($evt->terbuka_untuk)) - 1)
                            , <!-- Tambahkan koma jika ini bukan elemen terakhir -->
                        @endif
                        @endforeach
                    </td>
                    <td> <a class="btn btn-info" role="button" href="{{route('manage.peserta',$evt->id)}}"><span class="fa-solid fa-users-viewfinder" aria-hidden="true"></span></a></td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#project').DataTable({
            "dom": '<"top"i>rt<"bottom"p><"clear">',
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 6,
        });
    });
</script>
<script>
    $(function() {
        $('#peserta').DataTable({
            "dom": '<"top"i>rt<"bottom"p><"clear">',
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 6,
        });
    });
</script>

@endsection
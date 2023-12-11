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
                    <li class="breadcrumb-item active">Halaman Utama</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$countacara}}</h3>
                    <p>Total Acara (Bulan)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    @if(!empty($totalpendapatan))
                    <h3><sup style="font-size: 20px">Rp. </sup>{{$totalpendapatan}}</h3>
                    @else
                    <h3><sup style="font-size: 20px">Rp. </sup>0</h3>
                    @endif
                    <p>Total Pembayaran</p>
                </div>
                <div class="icon">
                    <i class="ion ion-card"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3><b>Rekap Pembayaran</b></h3>
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
                        Total Pendapatan
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
                    @if(date('d M Y', strtotime($evt->waktu_mulai)) == date('d M Y', strtotime($evt->waktu_selesai)))
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
                    @php
                    $totalPendapatan = $revenueByEvent[$evt->id] ?? 0;
                    @endphp
                    
                    <td>Rp. {{ $totalPendapatan }}</td>
                    <td> <a class="btn btn-info" role="button" href="{{route('peserta.acara.bayar',$evt->id)}}"><span class="fa-solid fa-users-viewfinder" aria-hidden="true"></span></a></td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


@endsection
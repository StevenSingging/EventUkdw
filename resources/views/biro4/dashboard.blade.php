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
                    <h3>{{$countacara}}</h3>
                    <p>Total Acara (Bulan)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$countacarath}}</h3>
                    <p>Total Acara (Tahun)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$countuser}}</h3>

                    <p>Total User (Aktif)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$countpeserta}}</h3>

                    <p>Total Peserta Acara (Bulan)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="card">
        <div class="card-header">
            <h3><b>Validasi Pengajuan Acara</b></h3>
        </div>
        <table id="validasip" class="table table-bordered table-hover">
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
                        Pengaju
                    </th>
                    <th>
                        No WA
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($acara as $evt)
                <tr>
                    <td scope="row">{{ $no++ + ($acara->currentPage() - 1) * $acara->perPage() }}</td>
                    <td>{{ $evt->jenis_acara }}</td>
                    <td>{{ $evt->nama_acara }}</td>
                    @if(date('d M Y', strtotime($evt->waktu_mulai)) == date('d M Y', strtotime($evt->waktu_selesai)))
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
                    <td>{{ $evt->panitiaa->nama }}</td>
                    <td>{{ $evt->panitiaa->nowa }}</td>
                    <td>
                    <form action="{{route('acara.validasi',$evt->id)}}" method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" name="status" value="1" type="submit"><span class="fa-solid fa-check" aria-hidden="true"></span></button>
                            <button class="btn btn-danger btn-sm" name="status" value="0" type="submit"><span class="fa-solid fa-xmark" aria-hidden="true"></span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#validasip').DataTable({
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
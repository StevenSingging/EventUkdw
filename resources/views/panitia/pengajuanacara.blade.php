@extends('template.master')
<title>Pengajuan Acara</title>

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
                    <li class="breadcrumb-item active">Pengajuan Acara</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="contaoner-fluid">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><span class="fa-solid fa-plus" aria-hidden="true"></span>
                Tambah Pengajuan
            </button>
        </div>
        <div class="card-body">
            <table id="pengajuan" class="table table-bordered table-hover">
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
                            Status
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
                        <td> 
                            @if($evt->status == null)
                            <span class="badge badge-warning">Dalam Progress</span>
                            @elseif($evt->status == '1')
                            <span class="badge badge-success">Valid</span>
                            @elseif($evt->status == '0')
                            <span class="badge badge-danger">Tidak Valid</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('simpanpengajuanacara')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Acara</label>
                                    <select class="custom-select" name="jenis_acara">
                                        <option selected>Choose...</option>
                                        <option value="Seminar">Seminar</option>
                                        <option value="Lomba">Lomba</option>
                                        <option value="Workshop">Workshop</option>
                                        <option value="Pelatihan">Pelatihan</option>
                                        <option value="Aktivitas Sosial">Aktivitas Sosial</option>
                                        <option value="Pameran">Pameran</option>
                                        <option value="Job Fair">Job Fair</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Judul Acara</label>
                                    <input type="text" class="form-control" name="nama_acara" placeholder="Nama Acara">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Warna</label>
                                    <input type="color" class="form-control" name="warna" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Waktu Mulai Acara</label>
                                    <input type="datetime-local" class="form-control" name="waktu_mulai">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Waktu Selesai Acara</label>
                                    <input type="datetime-local" class="form-control" name="waktu_selesai">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lokasi Acara</label>
                                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Acara">
                                </div>
                                <div class="form-group">
                                    <label for="">Terbuka Untuk</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Mahasiswa" name="terbuka_untuk[]" id="chkMahasiswa">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Mahasiswa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Dosen" name="terbuka_untuk[]" id="chkDosen">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Dosen
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Umum" name="terbuka_untuk[]" id="chkUmum">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Umum
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Staff" name="terbuka_untuk[]" id="chkStaff">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Staff
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="hargaInputmhs" style="display: none;">
                                    <label for="">Harga Mahasiswa</label>
                                    <input type="number" class="form-control" name="harga_mhs">
                                </div>
                                <div class="form-group" id="hargaInputdsn" style="display: none;">
                                    <label for="">Harga Dosen</label>
                                    <input type="number" class="form-control" name="harga_dosen">
                                </div>
                                <div class="form-group" id="hargaInputumum" style="display: none;">
                                    <label for="">Harga Umum</label>
                                    <input type="number" class="form-control" name="harga_umum">
                                </div>
                                <div class="form-group" id="hargaInputstaff" style="display: none;">
                                    <label for="">Harga Staff</label>
                                    <input type="number" class="form-control" name="harga_staff">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Batas Pendaftaran</label>
                                    <input type="datetime-local" class="form-control" name="batas_pendaftaran">
                                </div>
                                <div class="form-group">
                                    <label for="">Kuota Peserta</label>
                                    <input type="number" class="form-control" name="kuota">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="gambar">

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#pengajuan').DataTable({
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
    // Ambil elemen checkbox
    var chkMahasiswa = document.getElementById('chkMahasiswa');
    var chkDosen = document.getElementById('chkDosen');
    var chkUmum = document.getElementById('chkUmum');
    var chkStaff = document.getElementById('chkStaff');

    // Ambil elemen input harga
    var hargaInputdsn = document.getElementById('hargaInputdsn');
    var hargaInputmhs = document.getElementById('hargaInputmhs');
    var hargaInputumum = document.getElementById('hargaInputumum');
    var hargaInputstaff = document.getElementById('hargaInputstaff');

    // Tambahkan event listener saat checkbox berubah
    chkMahasiswa.addEventListener('change', toggleHargaInput);
    chkDosen.addEventListener('change', toggleHargaInput);
    chkUmum.addEventListener('change', toggleHargaInput);
    chkStaff.addEventListener('change', toggleHargaInput);

    function toggleHargaInput() {
        hargaInputmhs.style.display = chkMahasiswa.checked ? 'block' : 'none';
        hargaInputdsn.style.display = chkDosen.checked ? 'block' : 'none';
        hargaInputumum.style.display = chkUmum.checked ? 'block' : 'none';
        hargaInputstaff.style.display = chkStaff.checked ? 'block' : 'none';
    }
</script>
@endsection
@extends('template.master')
<title>Form Pendaftaran Acara</title>
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
                    <li class="breadcrumb-item active">Pendaftaran Acara</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pendaftaran Acara</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('simpandaftarumum', $acara->id) }}" method="post">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Acara</label>
                    <input type="text" class="form-control" name="nama_acara" value="{{$acara->nama_acara}}" placeholder="Nama Acara" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama</label>
                    <input type="text" class="form-control" name="nama_acara" value="{{auth()->user()->nama}}" placeholder="Nama Acara" disabled>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
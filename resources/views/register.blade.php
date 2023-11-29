<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/dist/css/adminlte.min.css')}}">

</head>

<body class="hold-transition register-page">
    <div class="register-box">
    @if(session('fail'))
    <div class="alert alert-danger" role="alert">
        {{session('fail')}}
    </div>
    @endif
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>SI</b>EVENT</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Daftar Akun Baru</p>

                <form action="{{route('simpanregistrasi')}}" method="post">
                {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select" name="role" id="roleSelect">
                            <option selected>Choose...</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Umum">Umum</option>
                            <option value="Staff">Staff</option>
                            <option value="Panitia">Panitia</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="nidn" id="nidnInput" placeholder="NIP">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="nim" id="nimInput" placeholder="NIM">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="nowa" placeholder="No WA">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="/login" class="text-center">Sudah mempunyai akun?</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    
    <!-- jQuery -->
    <script src="{{asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE-3.2.0/dist/js/adminlte.min.js')}}"></script>
    <script>
    // Mendapatkan elemen-elemen yang diperlukan
    var roleSelect = document.getElementById('roleSelect');
    var nidnInput = document.getElementById('nidnInput');
    var nimInput = document.getElementById('nimInput');

    // Menambahkan event listener untuk perubahan seleksi peran
    roleSelect.addEventListener('change', function() {
        if (roleSelect.value === 'Mahasiswa') {
            // Jika peran yang dipilih adalah 'mahasiswa', nonaktifkan input nidn dan aktifkan input nim
            nidnInput.disabled = true;
            nimInput.disabled = false;
        } else if (roleSelect.value === 'Dosen') {
            // Jika peran yang dipilih adalah 'dosen', aktifkan input nidn dan nonaktifkan input nim
            nidnInput.disabled = false;
            nimInput.disabled = true;
        } else if (roleSelect.value === 'Umum'){
            nidnInput.disabled = true;
            nimInput.disabled = true;
        }else if (roleSelect.value === 'Staff'){
            nidnInput.disabled = false;
            nimInput.disabled = true;
        }else if (roleSelect.value === 'Panitia'){
            nidnInput.disabled = true;
            nimInput.disabled = true;
        }else {
            nidnInput.disabled = true;
            nimInput.disabled = true;
        }
    });
</script>
</body>

</html>
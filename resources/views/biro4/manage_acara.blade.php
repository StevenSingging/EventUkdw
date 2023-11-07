@extends('template.master')
<title>Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .fc-event-time {
        display: none;
    }
</style>
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
                    <li class="breadcrumb-item active">Manage Acara</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Tambah Acara</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('simpanacara')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Acara</label>
                            <select class="custom-select" name="jenis_acara">
                                <option selected>Choose...</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Event Kampus">Event Kampus</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Acara</label>
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
                        <div class="form-group">
                            <label for="exampleInputPassword1">Batas Pendaftaran</label>
                            <input type="datetime-local" class="form-control" name="batas_pendaftaran">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="gambar">

                                </div>
                            </div>
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
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Event Calendar</h3>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="modal-action"></div>

    </div>
</div>

</div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const modal = $('#modal-action')
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek' // user can switch between the two
            },
            themeSystem: 'bootstrap5',
            events: "{{ route('acara.list') }}",
            eventClick: function({
                event
            }) {
                $.ajax({
                    url: `{{ url('events') }}/${event.id}/edit`,
                    success: function(res) {
                        modal.html(res).modal('show')

                        $('#form-action').on('submit', function(e) {
                            e.preventDefault()
                            const form = this
                            const formData = new FormData(form)
                            $.ajax({
                                url: form.action,
                                method: form.method,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                }
                            })
                        })
                    }
                })
            },
            eventDrop: function(info) {
                const event = info.event
                $.ajax({
                    url: `{{ url('events') }}/${event.id}`,
                    method: 'put',
                    data: {
                        id: event.id,
                        start_date: event.startStr,
                        end_date: event.end.toISOString().substring(0, 10),
                        title: event.title,
                        category: event.extendedProps.category
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        accept: 'application/json'
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Success',
                            message: res.message,
                            position: 'topRight'
                        });
                    },
                    error: function(res) {
                        const message = res.responseJSON.message
                        info.revert()
                        iziToast.error({
                            title: 'Error',
                            message: message ?? 'Something wrong',
                            position: 'topRight'
                        });
                    }
                })
            },
        });

        calendar.render();
    });
</script>
<script>
    // Ambil elemen checkbox
    var chkMahasiswa = document.getElementById('chkMahasiswa');
    var chkDosen = document.getElementById('chkDosen');
    var chkUmum = document.getElementById('chkUmum');

    // Ambil elemen input harga
    var hargaInputdsn = document.getElementById('hargaInputdsn');
    var hargaInputmhs = document.getElementById('hargaInputmhs');
    var hargaInputumum = document.getElementById('hargaInputumum');


    // Tambahkan event listener saat checkbox berubah
    chkMahasiswa.addEventListener('change', toggleHargaInput);
    chkDosen.addEventListener('change', toggleHargaInput);
    chkUmum.addEventListener('change', toggleHargaInput);

    function toggleHargaInput() {
        hargaInputmhs.style.display = chkMahasiswa.checked ? 'block' : 'none';
        hargaInputdsn.style.display = chkDosen.checked ? 'block' : 'none';
        hargaInputumum.style.display = chkUmum.checked ? 'block' : 'none';
    }
</script>
@endsection
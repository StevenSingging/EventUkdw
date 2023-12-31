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
                            <select class="custom-select" name="jenis_acara" id="jenis_acara">
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
                            <input type="color" class="form-control" name="warna" id="warna" placeholder="Warna">
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Penanggung Jawab</label>
                            <select class="custom-select" name="penanggung_jawab">
                                <option selected>Choose...</option>
                                @foreach($panitia as $p)
                                <option value="{{$p->id}}">{{$p->nama}} - {{$p->nowa}}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Publish</button>

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
        <div class="modal fade" id="modal-action">

        </div>

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
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            dayMaxEventRows: true, // for all non-TimeGrid view
            views: {
                dayGrid: {
                    dayMaxEventRows: 2,
                },
            },
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek' // user can switch between the two
            },
            themeSystem: 'bootstrap5',
            timeZone: 'local',
            events: "{{ route('acara.list') }}",
            eventClick: function({
                event
            }) {
                $.ajax({
                    url: `{{ url('events') }}/${event.id}/edit`,
                    success: function(res) {
                        modal.html(res).modal('show')
                        
                        $('#deleteButton').off('click').on('click', function(e) {
                            if (confirm('Apakah Anda yakin ingin menghapus acara ini?')) {
                                $.ajax({
                                    url: `{{ url('eventsdelete') }}/${event.id}`,
                                    method: 'delete',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
                                    },
                                    success: function(res) {
                                        modal.modal('hide');
                                        calendar.refetchEvents();
                                    },
                                    error: function(res) {
                                        toastr["error"]("Terjadi Kesalahan");
                                    }
                                });
                            }
                        });
                        $.ajax({
                            url: "{{ route('users.list') }}",
                            success: function(panitiaData) {
                                // Ambil data acara
                                $.ajax({
                                    url: "{{ route('acara.list') }}",
                                    success: function(acaraData) {
                                        const selectPenanggungJawab = document.getElementById('panitiaForm1');
                                        selectPenanggungJawab.innerHTML = '';

                                        // Loop melalui panitia untuk membuat opsi dropdown
                                        panitiaData.forEach(panitia => {
                                            // Cek apakah panitia juga ada di data acara
                                            const matchingAcara = acaraData.find(acaraData => acaraData.penanggung_jawab === panitia.id);

                                            // Buat elemen option dan tambahkan ke dalam select
                                            const option = document.createElement('option');
                                            option.value = panitia.id;
                                            option.text = panitia.nama;

                                            // Tandai sebagai terpilih jika sesuai dengan acara
                                            if (matchingAcara) {
                                                option.selected = true;
                                            }

                                            selectPenanggungJawab.appendChild(option);
                                        });
                                    },
                                    error: function(err) {
                                        console.error('Error saat mengambil data acara:', err);
                                    }
                                });

                                // ... (the rest of your eventClick function)
                            },
                            error: function(err) {
                                console.error('Error saat mengambil data panitia:', err);
                            }
                        });
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
                                    toastr["success"]("Berhasil Mengedit Data");
                                }
                            })
                        })
                    }
                })
            },
            eventDrop: function(info) {
                const event = info.event;

                // Menyusun data yang akan dikirim dalam request PUT
                const eventData = {
                    id: event.id,
                    start_date: event.startStr,
                    end_date: event.end.toISOString().substring(0, 10),
                    title: event.title,
                    category: event.extendedProps.category,

                };
                // Ajax request untuk mengupdate acara
                $.ajax({
                    url: `{{ url('events') }}/${event.id}`,
                    method: 'put',
                    data: eventData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        toastr["success"]("Berhasil Mengedit Data");
                    },
                    error: function(res) {
                        const message = res.responseJSON.message;
                        info.revert();
                        toastr["error"](message);
                    }
                });

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
<script>
    // Ambil elemen-elemen yang diperlukan
    const jenisAcara = document.getElementById('jenis_acara');
    const warnaInput = document.getElementById('warna');

    // Tambahkan event listener pada elemen jenis_acara
    jenisAcara.addEventListener('change', function () {
        // Ambil nilai jenis_acara yang dipilih
        const selectedJenisAcara = jenisAcara.value;

        // Tentukan warna berdasarkan jenis_acara
        let color;
        switch (selectedJenisAcara) {
            case 'Seminar':
                color = '#FF5733'; // Misalnya, Anda dapat mengganti warna ini sesuai keinginan
                break;
            case 'Lomba':
                color = '#33FF57';
                break;
            case 'Workshop':
                color = '#5733FF';
                break;
            case 'Pelatihan':
                color = '#FF33A1';
                break;
            case 'Aktivitas Sosial':
                color = '#FFD700';
                break;
            case 'Pameran':
                color = '#4CAF50';
                break;
            case 'Job Fair':
                color = '#008CBA';
                break;
            // Tambahkan case lain sesuai kebutuhan
            default:
                color = '#000000'; // Warna default jika jenis_acara tidak cocok
        }

        // Set nilai warna pada input
        warnaInput.value = color;
    });
</script>
@endsection
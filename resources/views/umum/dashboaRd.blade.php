@extends('template.master')
<title>Dashboard</title>
<style>
    .timeline {
    max-height: 500px; /* Ganti tinggi sesuai kebutuhan Anda */
    overflow-y: auto;
}
.fc-event-time{
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
                    <li class="breadcrumb-item active">Dashboard</li>
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
                    <h3 class="card-title">Riwayat Acara</h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach($riwayat as $notifikasi => $aktivitas)
                        <div class="time-label">
                            <span class="bg-red">{{date('d F Y', strtotime($notifikasi))}}</span>
                        </div>

                        @foreach($aktivitas as $item)
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{date('h:i a', strtotime($item->created_at))}}</span>
                                <h3 class="timeline-header"><a href="#">{{$item->usern->nama}}</a> </h3>
                                <div class="timeline-body">
                                {{$item->judul}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Acara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tempatkan data acara di sini -->
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content:space-between; ">

                    </div>
                </div>
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
            events: "{{ route('acara.list.umum') }}",
            eventClick: function({
                event
            }) {
                // Mengambil data event yang diklik
                var eventData = event;
                var deskripsi = eventData.extendedProps.deskripsi;
                var gambar = eventData.extendedProps.gambar;
                var jenis_acara = eventData.extendedProps.jenis_acara;
                var penanggung_jawab = eventData.extendedProps.penanggung_jawab;
                var nowa = eventData.extendedProps.nowa;
                var hargaumum = eventData.extendedProps.harga_umum;
                var kouta = eventData.extendedProps.kouta;
                var hargaText = hargaumum !== null ? '<p>' + 'Harga : ' + hargaumum + '</p>' : '';
                deskripsi = deskripsi.replace(/\n/g, '<br>');
                console.log(eventData);
                // Menampilkan data event dalam modal
                modal.find('.modal-body').html(
                    '<h5>' + eventData.title + '</h5>' +
                    '<img src="{{ asset('fotoacara') }}' + '/' + gambar + '" style="display:block; margin-left:auto; margin-right:auto; width:70%; margin-bottom:5px"/>' + // Menampilkan gambar
                    '<p>' + deskripsi + '</p>' +
                    '<br>' + '<p>' + 'CP : '+ penanggung_jawab +' - ' + nowa +'</p>' + 
                    hargaText + '<p>' + 'Kouta Peserta : '+ kouta +'</p>'
                    // Tambahkan atribut lainnya sesuai kebutuhan
                );
                modal.find('.modal-footer').html(function() {
                    if (jenis_acara == 'Job Fair') {
                        return '<div>'+'<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>'+'</div>'; // Atau kode HTML sesuai kebutuhan jika jenis_acara adalah 'JobFair'
                    } else {
                        return '<div>'+ '<a href="' + '{{ url('form_daftar_acara/umum') }}' + '/' + eventData.id + '" class="btn btn-primary"> Daftar Sekarang </a>' +'</div>'+
                        '<div>'+'<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>' +'</div>';
                    }
                    
                });

                modal.modal('show');
            }
        });

        calendar.render();
    });
</script>

<script>
$(document).ready(function() {
    // Menggulir otomatis ke bawah pada elemen .timeline
    var timeline = $('.timeline');
    timeline.scrollTop(timeline[0].scrollHeight);
});
</script>
@endsection
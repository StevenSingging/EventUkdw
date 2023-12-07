<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Event</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        body {
            background-color: #eee;
        }

        .title {

            margin-bottom: 50px;
            text-transform: uppercase;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;

        }

        .card {
            font-size: 1em;
            overflow: hidden;
            padding: 5;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
            margin-top: 20px;
        }

        .btn {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-light bg-light">
        <a class="navbar-brand" href="/">
            <img src="{{asset('AdminLTE-3.2.0/dist/img/LOGO UKDW WARNA PNG.png')}}" width="30" height="40" class="d-inline-block align-top" alt="">
            SI Event UKDW
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item" style="text-align: center;">
                    <a class="nav-link" style="color: green;" href="/login">Login </a>
                </li>
                <li class="nav-item" style="text-align: center;">
                    <a class="nav-link" style="color: blue;" href="/register">Register </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="row ">
                <div class="col-md-7 px-3">
                    <div class="card-block px-6">
                        <h4 class="card-title">{{$event->nama_acara}}</h4>
                        Terbuka Untuk : <br>
                        <div class="flex justify-start">
                            
                            @foreach(json_decode($event->terbuka_untuk) as $key => $item)
                            <span class="p-1 m-1 bg-indigo-300 rounded mb-2">{{ $item }}</span>
                            @endforeach
                        </div>
                        <div class="flex justify-start">

                            <div class="flex flex-col">
                                <div class="mb-4 flex items-center text-sm font-medium">
                                    <i class="fa-solid fa-location-dot fa-lg  mr-2" style="color:cadetblue"></i>

                                    {{ $event->lokasi}}
                                </div>
                            </div>


                            <div class="flex flex-col">
                                <div class="mb-4 flex items-center text-sm font-medium">
                                    <i class="fa-regular fa-calendar fa-lg ml-3 mr-2" style="color:cadetblue"></i>
                                    @php
                                    $startFormatted = date('d M Y', strtotime($event->waktu_mulai));
                                    $endFormatted = date('d M Y', strtotime($event->waktu_selesai));

                                    // Tampilkan hanya satu kali jika tanggal mulai dan tanggal selesai sama
                                    if ($startFormatted == $endFormatted) {
                                    echo $startFormatted;
                                    } else {
                                    echo $startFormatted . ' - ' . $endFormatted;
                                    }
                                    @endphp
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="mb-4 flex items-center text-sm font-medium">
                                    <i class="fa-regular fa-clock fa-lg ml-3 mr-2" style="color:cadetblue"></i>
                                    @php
                                    $startFormatted = date('d M Y', strtotime($event->waktu_mulai));
                                    $endFormatted = date('d M Y', strtotime($event->waktu_selesai));

                                    // Tampilkan hanya satu kali jika tanggal mulai dan tanggal selesai sama
                                    if ($startFormatted == $endFormatted) {
                                    echo date('H:i', strtotime($event->waktu_mulai)). ' - ' . date('H:i', strtotime($event->selesai)). ' WIB';

                                    } else {
                                    echo date('H:i', strtotime($event->waktu_mulai)). ' WIB';
                                    }
                                    @endphp
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="mb-4 flex items-center text-sm font-medium">
                                    <i class="fa-solid fa-users fa-lg ml-3 mr-2" style="color:cadetblue"></i>
                                    @if($event->kuota != null)
                                    {{ $event->kuota  }} Orang  
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="card-text">
                            {!! nl2br(e($event->deskripsi)) !!} <br>
                            
                            <b>CP : {{ $event->panitiaa->nama  }} - {{ $event->panitiaa->nowa  }}</b> <br>

                        </p>

                        <a href="/login" class="mt-auto btn btn-primary  ">Daftar Sekarang</a>
                    </div>
                </div>
                <!-- Carousel start -->
                <div class="col-md-5" style="display: flex; align-items: center;">
                    <img src="{{ asset('/fotoacara/' . $event->gambar) }}" class="w-full" alt="Louvre" />
                </div>
                <!-- End of carousel -->
            </div>
        </div>
        <!-- End of card -->

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
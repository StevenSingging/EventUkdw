<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Event</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar sticky-top navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="https://www.ukdw.ac.id/wp-content/uploads/2017/10/logo-ukdw.png" width="30" height="40" class="d-inline-block align-top" alt="">
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
    <div class="container-fluid">
    <div class="m-2 p-2 flex justify-between">
        <h3 class="mb-4 text-2xl font-bold text-indigo-700">{{ $event->nama_acara }}</h3>
        <div class="flex space-x-2">
            From:
            <span class="mx-2">{{ $event->waktu_mulai }}</span> | <span
                class="mx-2">{{ $event->waktu_selesai }}</span>
        </div>
    </div>
        <div class="mb-16 flex flex-wrap">
            <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                <div class="flex flex-col">
                    <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20" data-te-ripple-init data-te-ripple-color="light">
                        <img src="{{asset('fotoacara/'.$event->gambar)}}" class="w-full" alt="Louvre" />
                        <a href="#!">
                            <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full shrink-0 grow-0 lg:w-6/12 lg:pl-6 bg-slate-50 rounded-md p-2">
                <p class="mb-6 text-sm text-yellow-600 dark:text-neutral-400">
                    Start: <time>{{ $event->waktu_mulai }}</time>
                </p>
                <p class="mb-6 mt-4 text-neutral-500 dark:text-neutral-300">
                {{ $event->deskripsi }}
                </p>
                <div class="flex justify-end">
                    <div class="flex flex-col">
                        <div class="mb-4 flex items-center text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                            <div class="text-yellow-700"></div>
                        </div>
                        <div class="text-yellow-700">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
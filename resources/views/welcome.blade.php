<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    /* * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    } */

    .fancy {
      --b: 6px;
      /* control the border thickness */
      --w: 80px;
      /* control the width of the line*/
      --g: 15px;
      /* control the gap */
      --c: #0B486B;

      width: fit-content;
      padding: 0 1em;
      line-height: 1.6em;
      border: 1px solid;
      color: #fff;
      background:
        conic-gradient(from 45deg at left, var(--c) 25%, #0000 0) 0,
        conic-gradient(from -135deg at right, var(--c) 25%, #0000 0) 100%;
      background-size: 51% 100%;
      background-origin: border-box;
      background-repeat: no-repeat;
      border-image:
        linear-gradient(#0000 calc(50% - var(--b)/2),
          var(--c) 0 calc(50% + var(--b)/2),
          #0000 0) 1/0 var(--w)/calc(var(--w) + var(--g));
      margin-inline: auto;
      margin-top: 50px;
      margin-bottom: 15px;
    }

    .card-deck {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      
    }

    .card-custom {
      margin-top: 10px;
      /* spacing between cards */
      margin-bottom: 20px;
      /* spacing between rows */
      width: calc(33.33% - 20px);
    }
  </style>
</head>

<body>
  <!-- Image and text -->
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
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 30%; width:100%">
    <div class="carousel-inner">
      <div class="carousel-item active" >
        <img class="d-block" src="{{asset('AdminLTE-3.2.0/dist/img/slide2021_01.jpg')}}" style="height: 30%; width:100%" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="{{asset('AdminLTE-3.2.0/dist/img/slide2021_01.jpg')}}" style="height: 30%; width:100%" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="{{asset('AdminLTE-3.2.0/dist/img/slide2021_01.jpg')}}" style="height: 30%; width:100%" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="container-fluid">
    <h1 class="fancy">Event Terbaru</h1>
    <div class="card-deck">
    @foreach($event as $ev)
      <div class="card-custom">
        <img class="card-img-top" src="{{ asset('fotoacara/'.$ev->gambar)}}" style="height:50%" alt="Card image cap">
        <div class="card-body">
          <a href="{{route('lihatacara',$ev->id)}}" class="card-title h5" >{{$ev->nama_acara}}</a>
          <p class="card-text" style="margin-top: 10px;">{{ substr($ev->deskripsi, 0, 100) }}</p>
          <p class="card-text"><small class="text-muted">Last updated {{ $ev->updated_at->diffForHumans() }}</small></p>
        </div>
      </div>
    @endforeach
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</body>

</html>
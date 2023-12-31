<li class="nav-header">MAIN NAVIGATION</li>
@if(auth()->user()->role == "Biro 4")
<li class="nav-item">
      <a href="{{route('dashboard.admin')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Halaman Utama

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('manage')}}" class="nav-link {{ (request()->segment(1) == 'manage_acara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Manage Acara

        </p>
      </a>
</li>
<!-- <li class="nav-item">
      <a href="{{route('peserta.admin')}}" class="nav-link {{ (request()->segment(1) == 'peserta') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>
          Daftar Acara

        </p>
      </a>
</li> -->
@endif
@if(auth()->user()->role == "Biro 2")
<li class="nav-item">
      <a href="{{route('dashboard.biro2')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
         Halaman Utama

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Mahasiswa")
<li class="nav-item">
      <a href="{{route('dashboard.mahasiswa')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Halaman Utama

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('daftaracara.mahasiswa')}}" class="nav-link {{ (request()->segment(1) == 'daftar_acara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Daftar Acara

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Dosen")
<li class="nav-item">
      <a href="{{route('dashboard.dosen')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Halaman Utama

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('daftaracara.dosen')}}" class="nav-link {{ (request()->segment(1) == 'daftar_acara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Daftar Acara

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Umum")
<li class="nav-item">
      <a href="{{route('dashboard.umum')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Halaman Utama

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('daftaracara.umum')}}" class="nav-link {{ (request()->segment(1) == 'daftar_acara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Daftar Acara

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Staff")
<li class="nav-item">
      <a href="{{route('dashboard.staff')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Halaman Utama

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('daftaracara.staff')}}" class="nav-link {{ (request()->segment(1) == 'daftar_acara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Daftar Acara

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Panitia")
<li class="nav-item">
      <a href="{{route('dashboard.panitia')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Halaman Utama

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('pengajuan.panitia')}}" class="nav-link {{ (request()->segment(1) == 'pengajuanacara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-plus"></i>
        <p>
         Pengajuan Acara

        </p>
      </a>
</li>
@endif
<li class="nav-item">
      <a href="{{route('logout')}}" class="nav-link" onclick="return confirm('Apakah Anda yakin akan logout ?')">
        <i class="nav-icon fas fa-right-from-bracket"></i>
        <p>
          Logout

        </p>
      </a>
</li>
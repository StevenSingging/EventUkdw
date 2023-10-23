<li class="nav-header">MAIN NAVIGATION</li>
@if(auth()->user()->role == "Biro 4")
<li class="nav-item">
      <a href="{{route('dashboard.admin')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard

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
<li class="nav-item">
      <a href="{{route('peserta.admin')}}" class="nav-link {{ (request()->segment(1) == 'peserta') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>
          Daftar Acara

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('logout')}}" class="nav-link" onclick="return confirm('Apakah Anda yakin akan logout ?')">
        <i class="nav-icon fas fa-right-from-bracket"></i>
        <p>
          Logout

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Biro 2")
<li class="nav-item">
      <a href="{{route('dashboard.admin')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Mahasiswa")
<li class="nav-item">
      <a href="{{route('dashboard.mahasiswa')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('logout')}}" class="nav-link" onclick="return confirm('Apakah Anda yakin akan logout ?')">
        <i class="nav-icon fas fa-right-from-bracket"></i>
        <p>
          Logout

        </p>
      </a>
</li>
@endif
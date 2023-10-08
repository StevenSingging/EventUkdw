<li class="nav-header">MAIN NAVIGATION</li>
@if(auth()->user()->role == "Admin")
<li class="nav-item">
      <a href="{{route('manage')}}" class="nav-link {{ (request()->segment(1) == 'manage_acara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Acara

        </p>
      </a>
</li>

@endif
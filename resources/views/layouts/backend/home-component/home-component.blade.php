<div class="card-header card-header-info">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="nav-item">
            <a class="nav-link {{ (request()->is('admin-client')) ? 'active' : '' }}" href="{{route('admin-client.index')}}">
                Client & Team
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('authority-teams')) ? 'active' : '' }}" href="{{route('authority-teams.index')}}">
                  Authority Team
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('admin-services')) ? 'active' : '' }}" href="{{route('admin-services.index')}}">
                Services
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('admin-about')) ? 'active' : '' }}" href="{{route('admin-about.index')}}">
                About Us
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin-inter-city-rates')) ? 'active' : '' }}" href="{{route('admin-inter-city-rates.index')}}">
                  Inter City Rates
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin-rate-info')) ? 'active' : '' }}" href="{{route('admin-rate-info.index')}}">
                  Rate Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin-contact')) ? 'active' : '' }}" href="{{route('admin-contact')}}">
                  Contact
                </a>
            </li>
          </ul>
        </div>
      </div>
</div>

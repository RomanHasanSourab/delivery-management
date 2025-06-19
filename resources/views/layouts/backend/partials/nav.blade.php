{{-- <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top "> --}}
<nav class="navbar navbar-expand-lg container-fluid bg-primary">
    <div class="container-fluid">
      <div class="navbar-wrapper">
            <h4 class="navbar-brand">{{auth()->user()->name}}</h4>
            <p>{{auth()->user()->code}}</p>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <div>
            <hr>
        {{-- logout btn --}}
            <a class="dropdown-item t-res" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        {{-- logout btn --}}
        </div>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          {{-- <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>
              <span class="notification" id=noti_number>10</span>
              <p class="d-lg-none d-md-block">
                Some Actions
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Mike John responded to your email Mike John responded to your email</a>
              <a class="dropdown-item" href="#">You have 5 new tasks</a>
              <a class="dropdown-item" href="#">You're now friend with Andrew</a>
              <a class="dropdown-item" href="#">Another Notification</a>
              <a class="dropdown-item" href="#">Another One</a>
            </div>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                Account
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
              @if(auth()->user()->role_id == 3)
              <a class="dropdown-item" href="{{route('merchants.edit', auth()->user()->id)}}">My Profile</a>
              @elseif(auth()->user()->role_id == 2)
                    <a class="dropdown-item" href="{{route('agents.edit', auth()->user()->id)}}">My Profile</a>
              @elseif(auth()->user()->role_id == 1)
                  @if(auth()->user()->id == 1)
                    <a class="dropdown-item" href="{{route('user.index')}}">Manage User</a>
                  @endif
                    <a class="dropdown-item" href="{{route('user.edit', auth()->user()->id)}}">My Profile</a>
              @endif
              <div class="dropdown-divider"></div>
              {{-- logout btn --}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                {{-- logout btn --}}
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
{{-- @push('scripts')
<script>
    function loadDoc() {

        setInterval(function(){

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("noti_number").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "ajax_info.txt", true);
            xhttp.send();
        }, 1000);

    }
    loadDoc();
</script>
@endpush --}}

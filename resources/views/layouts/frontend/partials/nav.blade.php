
@if (url()->current() == url('/home') || url()->current() == url('/'))
<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
@else
<nav class="navbar fixed-top navbar-expand-lg">
@endif

    <div class="container">
        <div class="navbar-translate">
            <a href="{{url('/')}}">
                <img style="height: 4em; padding: 0;" class="navbar-brand" src="{{asset('/img/cityv1.png')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="active nav-item">
                    <a href="{{url('/')}}" class="nav-link">
                        <i class="material-icons">home</i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('services')}}" class="nav-link">
                        <i class="material-icons">construction</i>
                        Services
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pricing')}}" class="nav-link">
                        <i class="material-icons">local_offer</i>
                        Pricing
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('contact')}}" class="nav-link">
                        <i class="material-icons">contact_phone</i>
                        Contact
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('contact')}}" class="nav-link">--}}
{{--                        <i class="material-icons">contact_support</i>--}}
{{--                        About--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="material-icons">login</i>
                            {{ __('Login') }}
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="material-icons">person_add</i>
                                Merchant Register
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hub.register') }}">
                                <i class="material-icons">person_add</i>
                                Agent Register
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </div>

</nav>

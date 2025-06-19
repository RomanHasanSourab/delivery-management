@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 6)
<div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
      <a class="nav-link" href="{{route('dashboard')}}">
          <i class="material-icons">dashboard</i>
          <p>Overview</p>
        </a>
      </li>
      <li class="nav-item {{ (request()->is(['admin-client', 'admin-services', 'admin-about', 'admin-inter-city-rates', 'admin-rate-info'])) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin-client.index')}}">
          <i class="material-icons">home</i>
          <p>Webpage Manage</p>
        </a>
      </li>
      <li class="nav-item {{ (request()->is('messages')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('messages')}}">
          <i class="material-icons">message</i>
            <p>Public Message <span class="badge badge-pill badge-danger">{{$m}}</span></p>
        </a>
      </li>

        <li class="nav-item {{ (request()->is(['agents', 'agent-requests', 'agent-inactive'])) ? 'active' : '' }}">
            @if($aReq == 0)
                <a class="nav-link" href="{{route('agents.index')}}">
                    @else
                        <a class="nav-link" href="{{route('agent-requests')}}">
                            @endif
                            <i class="material-icons">device_hub</i>
                            <p>Agent Manage <span class="badge badge-pill badge-danger">{{$aReq}}</span></p>
                        </a>
                </a>
        </li>

      <li class="nav-item {{ (request()->is('deliveries-admin')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('deliveries-admin')}}">
          <i class="material-icons">local_shipping</i>
          <p>Delivery Requests <span class="badge badge-pill badge-danger">{{$dReq}}</span></p>
        </a>
      </li>
      <li class="nav-item {{ (request()->is(['merchants', 'merchant-requests', 'merchant-inactive'])) ? 'active' : '' }}">
        @if($mReq == 0)
        <a class="nav-link" href="{{route('merchants.index')}}">
        @else
        <a class="nav-link" href="{{route('merchant-requests')}}">
        @endif
          <i class="material-icons">store</i>
          <p>Merchant Manage <span class="badge badge-pill badge-danger">{{$mReq}}</span></p>
        </a>
        </a>
      </li>
      <li class="nav-item {{ (request()->is('invoices')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('invoices.index')}}">
            <i class="material-icons">receipt</i>
            <p>Invoices</p>
        </a>
    </li>
    <li class="nav-item {{ (request()->is('payment-requests')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('payment-requests.index')}}">
            <i class="material-icons">payment</i>
            <p>Payment request <span class="badge badge-pill badge-danger">{{$prReq}}</span></p>
        </a>
    </li>
      {{-- <li class="nav-item {{ (request()->is('customers')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('customers.index')}}">
          <i class="material-icons">how_to_reg</i>
          <p>Customer Manage</p>
        </a>
      </li> --}}
      <li class="nav-item {{ (request()->is('districts')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('districts.index')}}">
          <i class="material-icons">location_on</i>
          <p>Districts</p>
        </a>
      </li>
      {{-- <li class="nav-item {{ (request()->is('areas')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('areas.index')}}">
          <i class="material-icons">my_location</i>
          <p>Areas</p>
        </a>
      </li> --}}
      <li class="nav-item {{ (request()->is('special-merchants')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('special-merchants.index')}}">
          <i class="material-icons">add_business</i>
          <p>Special Merchants</p>
        </a>
      </li>
    </ul>
  </div>
  @elseif(Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
      <a class="nav-link" href="{{route('dashboard')}}">
          <i class="material-icons">dashboard</i>
          <p>Overview</p>
        </a>
      </li>
      <li class="nav-item {{ (request()->is('deliveries')) ? 'active' : '' }}">
        <a class="nav-link" href="{{route('deliveries.index')}}">
            <i class="material-icons">local_shipping</i>
            <p>Deliveries</p>
          </a>
        </li>
        <li class="nav-item {{ (request()->is('invoices')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('invoices.index')}}">
                <i class="material-icons">receipt</i>
                <p>Invoices</p>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('payment-requests')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('payment-requests.index')}}">
                <i class="material-icons">payment</i>
                <p>Payment request</p>
            </a>
        </li>
    </ul>
  </div>
@elseif(Auth::user()->role_id == 2)
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Overview</p>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('deliveries-admin')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('deliveries-admin')}}">
                    <i class="material-icons">local_shipping</i>
                    <p>Delivery Requests <span class="badge badge-pill badge-danger">{{$dReq}}</span></p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('invoices')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('invoices.index')}}">
                    <i class="material-icons">receipt</i>
                    <p>Invoices</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('payment-requests')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('payment-requests.index')}}">
                    <i class="material-icons">payment</i>
                    <p>Payment request</p>
                </a>
            </li>
        </ul>
    </div>
  @endif

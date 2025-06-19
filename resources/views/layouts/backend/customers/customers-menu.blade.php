<div class="card-header card-header-info">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="nav-item">
            <a class="nav-link {{ (request()->is('customer-requests')) ? 'active' : '' }}" href="{{url('customer-requests')}}">
                Customer Request <span class="badge badge-pill badge-warning">{{$mReq}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('customers')) ? 'active' : '' }}" href="{{route('customers.index')}}">
                Active Customers
              </a>
            </li>
          </ul>
        </div>
      </div>
</div>

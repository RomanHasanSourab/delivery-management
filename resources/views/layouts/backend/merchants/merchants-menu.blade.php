<div class="card-header card-header-info">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="nav-item">
            <a class="nav-link {{ (request()->is('merchant-requests')) ? 'active' : '' }}" href="{{url('merchant-requests')}}">
                Merchant Request <span class="badge badge-pill badge-warning">{{$mReq}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('merchants')) ? 'active' : '' }}" href="{{route('merchants.index')}}">
                Active Merchants
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('merchant-inactive')) ? 'active' : '' }}" href="{{route('merchants.inactive')}}">
                  Inactive
                </a>
              </li>
          </ul>
        </div>
      </div>
</div>

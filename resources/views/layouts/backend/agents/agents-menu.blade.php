<div class="card-header card-header-info">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="nav-item">
            <a class="nav-link {{ (request()->is('agent-requests')) ? 'active' : '' }}" href="{{url('agent-requests')}}">
                Agent Request <span class="badge badge-pill badge-warning">{{$aReq}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('agents')) ? 'active' : '' }}" href="{{route('agents.index')}}">
                Active Agents
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('agent-inactive')) ? 'active' : '' }}" href="{{route('agents.inactive')}}">
                  Inactive
                </a>
              </li>
          </ul>
        </div>
      </div>
</div>

<div class="card-header card-header-info">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="nav-item">
            <a class="nav-link {{ (request()->is('invoices')) ? 'active' : '' }}" href="{{route('invoices.index')}}">
                Invoice List
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('invoices/generate')) ? 'active' : '' }}" href="{{route('generate.invoices')}}">
                Generate Invoice
              </a>
            </li>
          </ul>
        </div>
      </div>
</div>

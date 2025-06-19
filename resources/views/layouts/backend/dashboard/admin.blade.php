<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">device_hub</i>
          </div>
          <p class="card-category">Active Agents</p>
          <h3 class="card-title">{{count($branches)}}
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons text-danger">link</i>
            <a href="javascript:;">See List</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons">store</i>
          </div>
          <p class="card-category">Active Merchants</p>
          <h3 class="card-title">{{count($merchants)}}</h3>
        </div>
        <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">link</i>
              <a href="{{route('merchants.index')}}">See List</a>
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-info card-header-icon">
          <div class="card-icon">
            <i class="material-icons">how_to_reg</i>
          </div>
          <p class="card-category">Active Delivery Boys</p>
          <h3 class="card-title">{{count($customers)}}</h3>
        </div>
        <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">link</i>
              <a href="{{route('customers.index')}}">See List</a>
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-danger card-header-icon">
          <div class="card-icon">
            <i class="material-icons">admin_panel_settings</i>
          </div>
          <p class="card-category">Super Admins</p>
          <h3 class="card-title">{{count($superAdmin)}}</h3>
        </div>
        <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">link</i>
            <a href="{{route('role.index')}}">See List</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-success">
          <div class="ct-chart" id="dailySalesChart"></div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Daily Sales</h4>
          <p class="card-category">
            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> updated 4 minutes ago
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-warning">
          <div class="ct-chart" id="websiteViewsChart"></div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Email Subscriptions</h4>
          <p class="card-category">Last Campaign Performance</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> campaign sent 2 days ago
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-danger">
          <div class="ct-chart" id="completedTasksChart"></div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Completed Tasks</h4>
          <p class="card-category">Last Campaign Performance</p>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">access_time</i> campaign sent 2 days ago
          </div>
        </div>
      </div>
    </div>
  </div>

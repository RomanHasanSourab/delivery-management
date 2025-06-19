  <div class="row">
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="dailySalesChart"></div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Total Deliveries <b>{{$deliveries}}</b></h4>
            {{-- <h5 class="card-title">{{$deliveries}}</h5> --}}
          <p class="card-category">
            <span class="text-success"></span> Total deliveries till now</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="websiteViewsChart"></div>
        </div>
        <div class="card-body">
            <h4 class="card-title">Total Delivered <b>{{$delivered}}</b></h4>
          <p class="card-category">Total delivered till now</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="completedTasksChart"></div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Total Pending <b>{{$pending}}</b></h4>
          <p class="card-category">Now</p>
        </div>
      </div>
    </div>
    {{-- <div class="col-md-3">
        <div class="card card-chart">
          <div class="card-header card-header-info">
            <div class="ct-chart" id="completedTasksChart"></div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Paid After Delivery <b>{{$paidCount}}</b></h5>
            <h5 class="card-title">Unpaid After Delivery <b>{{$unpaidCount}}</b></h5>
          </div>
        </div>
      </div> --}}
  </div>


  <div class="row">
    @if(auth()->user()->role_id == 1)
    <div class="col-md-4">
        <div class="card card-chart">
          <div class="card-header card-header-info">
            <div class="ct-chart" id="dailySalesChart"></div>
          </div>
          <div class="card-body">
          @if(auth()->user()->role_id == 1)
              {{-- <h4 class="card-title">Payable Delivery Charge <b>{{$charge}}</b> TK</h4> --}}
              <h4 class="card-title">Got Delivery Charge Till Now <b>{{$getCharge}}</b> TK</h4>
          @endif
          </div>
        </div>
      </div>
      @endif
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="dailySalesChart"></div>
        </div>
        <div class="card-body">
        @if(auth()->user()->role_id != 1)
            <h4 class="card-title">Total Delivery Charge <b>{{$charge}}</b> TK</h4>
        @elseif(auth()->user()->role_id == 1)
            <h4 class="card-title">Payable Delivery Charge <b>{{$charge}}</b> TK</h4>
            {{-- <h4 class="card-title">Payment Complete Till Now <b>{{$getCharge}}</b> TK</h4> --}}
        @endif
          <p class="card-category">
            @if(auth()->user()->role_id != 1)
                Delivery Charge
            @endif
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="websiteViewsChart"></div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Total Uninvoiced <b>{{$unpaid}}</b> TK</h4>
          @if(auth()->user()->role_id == 3)
            <p class="card-category">Not paid to Merchant</p>
          @elseif(auth()->user()->role_id == 4)
            <p class="card-category">Not paid to Customer</p>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-chart">
        <div class="card-header card-header-info">
          <div class="ct-chart" id="completedTasksChart"></div>
        </div>
        <div class="card-body">
           <h4 class="card-title">Total Paid <b>{{$paid}}</b> TK</h4>
           @if(auth()->user()->role_id == 3)
            <p class="card-category">Paid to Merchant</p>
           @elseif(auth()->user()->role_id == 4)
            <p class="card-category">Paid to Customer</p>
           @endif
        </div>
      </div>
    </div>
  </div>

@if(auth()->user()->role_id != 1)
  @php
  $i = 1;
 @endphp
 <div class="card">
    <div class="card-body table-responsive">
     <h3>Last 10 Deliveries</h3>
        <table class="table table-bordered table-hover" data-form="deleteForm">
            <thead class="card-header-primary no-shadow">
            <tr style="text-align: center">
                <th scope="col">SL</th>
                <th scope="col">Date</th>
                <th scope="col">Code</th>
                <th scope="col">Recipient</th>
                <th scope="col">Mobile</th>
                <th scope="col">Collection amount</th>
                <th scope="col">Delivery status</th>
                <th scope="col">Payment status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($deliveryData as $row)
                <tr style="text-align: center">
                    <td>{{$i++}}</td>
                    <td>{{date('d-M-Y | h:i A', strtotime($row->created_at))}}</td>
                    <td>{{$row->code}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->collect_amount}}</td>
                    <td>{{$row->status->title}}</td>
                    @if($row->paid_status == 2)
                    <td>
                        <p class="badge badge-pill badge-info">
                            Pending
                        </p>
                    </td>
                    @elseif($row->paid_status == 1)
                    <td>
                        <p class="badge badge-pill badge-success">
                            Paid
                        </p>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endif

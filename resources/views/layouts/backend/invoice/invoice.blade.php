@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="card">
            <div class="card-body">

                @php
                $i = 1;
                $g = 1;
                $h = 1;
               @endphp


                <a class="btn btn-danger pull-left" href="{{route('invoices.index')}}">
                    Back
                </a>
                <a target="_blank" class="btn btn-primary pull-right" href="{{route('export.pdf', [$invoice->id])}}">
                    Print
                </a>
                <div class="clearfix"></div>
                <br>
                <hr>
                {{-- <br> --}}
                <div style="margin: 2.5em" class="row">
                    <div class="col-md-6">
                        <img style="height: 5em;" class="navbar-brand" src="{{asset('/img/cityv1.png')}}" alt="">
                    </div>
                    <div class="col-md-6" style="text-align: right">
                        <h2>
                            <b>
                                Invoice
                            </b>
                        </h2>

                        <h4>
                            Invoice No. : <strong>{{$invoice->code}}</strong>
                        </h4>

                        <h4>
                            @php
                                $date = strtotime($invoice->created_at);
                                date('d-M-Y | h:i A', $date);
                            @endphp
                            Invoice Date : <strong>{{date('d-M-Y | h:i A', $date)}}</strong>
                        </h4>
                    </div>
                </div>

                <div style="margin: 2.5em" class="row">
                    <div class="col-md-6">
                        <div>
                            <h4>
                                <strong>
                                    @if ($userInfo->role_id == 3)
                                        Merchant Info
                                    @elseif($userInfo->role_id == 4)
                                        Customer Info
                                    @elseif($userInfo->role_id == 2)
                                        Branch Info
                                    @endif
                                </strong>
                            </h4>
                            <h5>
                                Name: {{$userInfo->name}}
                            </h5>
                            <h5>
                                Shop: {{$userInfo->shop_name}}
                            </h5>
                            <h5>
                                Address: {{$district->title}}
                            </h5>
                            <h5>
                                <i style="font-size: inherit" class="material-icons">mail</i>
                                {{$userInfo->email}}
                            </h5>
                            <h5>
                                <i style="font-size: inherit" class="material-icons">phone</i>
                                {{$userInfo->phone}}
                            </h5>
                        </div>
                    </div>

                    <div class="col-md-6" style="text-align: right">
                        <h4>
                            <strong>
                                City Express
                            </strong>
                        </h4>
                        <h5>
                            @foreach($addresses as $address)
                                Address {{$i++}}: {{$address->description}}
                                <br>
                            @endforeach
                        </h5>
                        <h5>
                            @foreach($emails as $email)
                                Email {{$h++}}: {{$email->title}}
                                <br>
                            @endforeach
                        </h5>
                        <h5>
                            @foreach($helplines as $helpline)
                                Phone {{$g++}}: {{$helpline->title}}
                                <br>
                            @endforeach
                        </h5>
                    </div>
                </div>

                <div style="margin: 2.5em" class="row">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr style="background-color: white; color:black;">
                                <th style="text-align: center; font-weight: bold" scope="col">SL</th>
                                <th style="text-align: center; font-weight: bold" scope="col">Date</th>
                                <th style="text-align: center; font-weight: bold" scope="col">Code</th>
                                <th style="text-align: center; font-weight: bold" scope="col">Recipient</th>
                                <th style="text-align: center; font-weight: bold" scope="col">Collection Amount</th>
                                <th style="text-align: center; font-weight: bold" scope="col">Delivery charge</th>
                                <th style="text-align: center; font-weight: bold" scope="col">Payout amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                            @foreach ($deliveryInfos as $deliveryInfo)
                                <tr>
                                    <td style="text-align: center">
                                        {{$i++}}
                                    </td>
                                    <td style="text-align: center">
                                        @php
                                            $dDate = strtotime($deliveryInfo->delivery_status_changed_at);
                                        @endphp
                                        @if ($dDate)
                                            {{date('d-M-Y | h:i A', $dDate)}}
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        {{$deliveryInfo->code}}
                                    </td>
                                    <td>
                                        {{$deliveryInfo->name}}
                                    </td>
                                    <td style="text-align: right">
                                        {{$deliveryInfo->collect_amount}}
                                    </td>
                                    <td style="text-align: right">
                                        {{$deliveryInfo->total_charge}}
                                    </td>
                                    <td style="text-align: right">
                                        {{$deliveryInfo->collect_amount - $deliveryInfo->total_charge}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td style="text-align: right" colspan="4">
                                    <h5>
                                        Total =
                                    </h5>
                                </td>
                                <td style="text-align: right">
                                    <h5>
                                        <b>{{$collection}}</b>
                                    </h5>
                                </td>
                                <td style="text-align: right">
                                    <h5>
                                        <b>{{$charge}}</b>
                                    </h5>
                                </td>
                                <td style="text-align: right">
                                    <h5>
                                        <b>{{$payout}}</b>
                                    </h5>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
          </div>
      </div>
    </div>


@endsection

@push('scripts')
<script>

</script>
@endpush

@push('styles')
    <style>
        .table-bordered{
            border: 1px solid #333333 !important;
        }
        .table-bordered th, .table-bordered td{
            border: 1px solid #333333 !important;
        }
    </style>
@endpush

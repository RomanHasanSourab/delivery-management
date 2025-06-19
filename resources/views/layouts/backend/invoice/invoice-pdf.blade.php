<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style type="text/css">
        .table-bordered{
            border: 1px solid #333333 !important;
        }
        .table-bordered th, .table-bordered td{
            border: 1px solid #333333 !important;
        }
    </style>

<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the current printer page size */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    @media print {
    #printPageButton {
            display: none;
        }
    }

    body
    {
        /* background-color:#FFFFFF; */
        margin: 0px;  /* the margin on the content before printing */
   }
</style>
  </head>
  <body>

    @php
    $i = 1;
    $g = 1;
    $h = 1;
   @endphp

   
    <div style="margin: 2.5em" class="row">
        <button id="printPageButton" type="button" class="print-invoice btn btn-info">Print</button>
    </div>

    <div style="margin: 2.5em" class="row">
    <table class="table">
        <tbody>
          <tr>
            <td style="width:50%; border-top: 0">
                <img style="height: 5em;" class="navbar-brand" src="{{asset('/img/cityv1.png')}}" alt="">
             </td>
            <td style="text-align: right; width:50%; border-top: 0">
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
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div style="margin: 2.5em" class="row">
        <table class="table">
            <tbody>
              <tr>
                <td style="width:50%; border-top: 0">
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
                        Email: {{$userInfo->email}}
                    </h5>
                    <h5>
                        Phone: {{$userInfo->phone}}
                    </h5>
                 </td>
                <td style="text-align: right; width:50%; border-top: 0">
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
                </td>
              </tr>
            </tbody>
        </table>
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
                        <td style="text-align: center; font-weight: 500">
                            {{$i++}}
                        </td>
                        <td style="text-align: center; font-weight: 500">
                            @php
                                $dDate = strtotime($deliveryInfo->delivery_status_changed_at);
                            @endphp
                            @if ($dDate)
                                {{date('d-M-Y | h:i A', $dDate)}}
                            @endif
                        </td>
                        <td style="text-align: center; font-weight: 500">
                            {{$deliveryInfo->code}}
                        </td>
                        <td>
                            {{$deliveryInfo->name}}
                        </td>
                        <td style="text-align: right; font-weight: 500">
                            {{$deliveryInfo->collect_amount}}
                        </td>
                        <td style="text-align: right; font-weight: 500">
                            {{$deliveryInfo->total_charge}}
                        </td>
                        <td style="text-align: right; font-weight: 500">
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

    <div style="margin: 9em 2.5em 2.5em 2.5em" class="row">
        <table class="table">
            <tbody>
              <tr>
                <td style="width:30%; border-top: 1.5px solid black; text-align:center">
                    <h5>
                        Signature by City Express
                    </h5>
                 </td>
                 <td style="width:40%; border-top: 0">

                 </td>
                <td style="text-align: right; width:30%; border-top: 1.5px solid black; text-align:center">
                    <h5>
                        Signature by Merchant
                    </h5>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('/js/core/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script>
        $('.print-invoice').click(function() {
            window.print();
        });
    </script>
  </body>
</html>

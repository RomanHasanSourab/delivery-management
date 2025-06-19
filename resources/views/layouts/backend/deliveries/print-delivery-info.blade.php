<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

        .table-bordered thead tr th,
        .table-bordered thead tr td,
        .table-bordered tbody tr th,
        .table-bordered tbody tr td{
            border: 1px solid black !important;
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
    @endphp
    <div class="container" style="margin: 5em auto">
      <table class="table">
        <tbody>
          <tr>
            <td style="width:50%; border-top: 0">
                <h5> Weblink: http://www.cityexpress.group/</h5>
                <h5> FB: https://www.facebook.com/city.express.bd.cm</h5>
                <h5>
                    @foreach($addresses as $address)
                        Address {{$i++}}: {{$address->description}}
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
             <td style="text-align: right; width:50%; border-top: 0">
                <img style="height: 4em; padding: 0;" class="navbar-brand" src="{{asset('/img/cityv1.png')}}" alt="">
            </td>
          </tr>
        </tbody>
      </table>
    <br>
      <h4 style="text-align: center;">
          Delivery Information ({{$delivery->deliveryFrom ? $delivery->deliveryFrom->title : ''}} - {{$delivery->deliveryTo ? $delivery->deliveryTo->title : ''}})
      </h4>
      <h5 style="text-align: center">
          {{$userInfo->code}} - {{$userInfo->name}}
      </h5>
      <h5 style="text-align: center">
        || {{$userInfo->shop_name}} ||
      </h5>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th>
                DELIVERY TYPE
            </th>
            <td style="font-weight: 500">
                @if ($delivery->delivery_type == 1)
                Standard delivery
                @elseif($delivery->delivery_type == 2)
                Food delivery
                @elseif($delivery->delivery_type == 3)
                Urgent delivery( within 6 hours)
                @endif
            </td>
          </tr>
          <tr style="border-color:red;">
            <th>
                CODE
            </th>
            <td style="font-weight: 500">
                {{$delivery->code}}
            </td>
          </tr>
          <tr>
            <th>
                RECIPIENT
            </th>
            <td style="font-weight: 500">
                {{$delivery->name}}
            </td>
          </tr>
          <tr>
            <th>
                MOBILE
            </th>
            <td style="font-weight: 500">
                {{'0'.$delivery->phone}}
            </td>
          </tr>
          <tr>
            <th>
                ADDRESS
            </th>
            <td style="font-weight: 500">
                {{$delivery->address}}
            </td>
          </tr>
          <tr>
            <th>
                CITY
            </th>
            <td style="font-weight: 500">
                {{$delivery->deliveryTo ? $delivery->deliveryTo->title : ''}}
            </td>
          </tr>
          <tr>
            <th>
                COLLECTION AMOUNT
            </th>
            <td style="font-weight: 500">
                {{$delivery->collect_amount}} Taka
            </td>
          </tr>
          <tr>
            <th>
                NOTE
            </th>
            <td style="font-weight: 500">
                {{$delivery->note}}
            </td>
          </tr>

        </tbody>
      </table>
      <button id="printPageButton" type="button" class="print-window btn btn-info">Print</button>
      <a id="printPageButton" class="btn btn-rose btn-link" href="{{route('deliveries.pickup.print', $delivery->id)}}">
        Print With Pickup Information
      </a>
      {{-- <button id="printPageButton" type="button" class="print-window btn btn-rose btn-link">Print With Pickup Information</button> --}}
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('/js/core/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script>
        $('.print-window').click(function() {
            window.print();
        });
    </script>
  </body>
</html>

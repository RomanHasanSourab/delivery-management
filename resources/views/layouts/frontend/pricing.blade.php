@extends('layouts.frontend.layouts.app')
@section('breadcrumb')
    <nav class="container" aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item title text-primary"><a href="javascript:;">HOME</a></li>
          <li class="breadcrumb-item active title text-danger" aria-current="page">PRICING</li>
        </ol>
      </nav>
@endsection
@section('content')
<div class="container">
    <h3 class="text-center text-danger title">Our Pricing & Plans</h3>
    <div class="row">
        <table class="table table-bordered table-hover">
            <tbody>
                @foreach ($rates as $rate)
                <tr style="text-align: center">
                    <td>{{$rate->title}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
    <hr>
    <br>
    @foreach ($datas as $item)
    <div class="container">
        <h3 class="title"><span style="color: #d32f2f">{{$item['0']->districtFrom->title}}</span> Inter City Rates</h3>
        <div class="card card-nav-tabs">
        <table class="table table-bordered table-hover">
            <thead class="card-header-danger no-shadow">
              <tr style="text-align: center">
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Charge</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($item as $row)
              @if($row->districtFrom && $row->districtTo)
                <tr style="text-align: center">
                    <td>{{$row->districtFrom->title}}</td>
                    <td>{{$row->districtTo->title}}</td>
                    <td>{{$row['charge']}} tk</td>
                </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
    <br>
    @endforeach

@endsection

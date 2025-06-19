@extends('layouts.frontend.layouts.app')
@section('breadcrumb')
    {{-- <div class="container">
            <h3 class="title text-primary">Home / Pricing</h3>
    </div> --}}
    <nav class="container" aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item title text-primary"><a href="javascript:;">HOME</a></li>
          <li class="breadcrumb-item active title text-danger" aria-current="page">SERVICES</li>
        </ol>
      </nav>
@endsection
@section('content')

<div class="container">
    <h3 class="text-center text-danger title">Our Services</h3>
    <br>
    <div class="row">
        @if($datas)
        @foreach ($datas as $data)
            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                    <h4 class="card-title text-danger">
                        {{$data->title}} &nbsp;
                        <i class="text-danger material-icons">done_all</i>
                        </h4>
                    <p class="card-text">
                        {{$data->description}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
        {{-- <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h4 class="card-title  text-danger">
                      E-commerce support &nbsp;
                      <i class="text-danger material-icons">done_all</i>
                    </h4>
                  <p class="card-text">
                    Are you running ecommerce in Bangladesh. Dont worry about delivery in time. Leave to us and we will handle it
                  </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h4 class="card-title  text-danger">
                      We Do Care &nbsp;
                      <i class="text-danger material-icons">done_all</i>
                    </h4>
                  <p class="card-text">
                    We understand how much important it is for you to deliver product to your customer safely. W eensure you that we take good care of your parcel to deliver without any harm.
                  </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h4 class="card-title text-danger">
                      Fasted Delivery in Bangladesh &nbsp;
                      <i class="text-danger material-icons">done_all</i>
                    </h4>
                  <p class="card-text">
                    We are providing door to door delivery service within in Bangladesh with guarantee. Otherwise you will get your money back
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h4 class="card-title  text-danger">
                      E-commerce support &nbsp;
                      <i class="text-danger material-icons">done_all</i>
                    </h4>
                  <p class="card-text">
                    Are you running ecommerce in Bangladesh. Dont worry about delivery in time. Leave to us and we will handle it
                  </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h4 class="card-title  text-danger">
                      We Do Care &nbsp;
                      <i class="text-danger material-icons">done_all</i>
                    </h4>
                  <p class="card-text">
                    We understand how much important it is for you to deliver product to your customer safely. W eensure you that we take good care of your parcel to deliver without any harm.
                  </p>
                </div>
            </div>
        </div> --}}
    </div>
</div>


@endsection

@extends('layouts.frontend.layouts.app')
@section('breadcrumb')
    {{-- <div class="container">
            <h3 class="title text-primary">Home / Pricing</h3>
    </div> --}}
    <nav class="container" aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item title text-primary"><a href="javascript:;">HOME</a></li>
          <li class="breadcrumb-item active title text-danger" aria-current="page">CONTACT</li>
        </ol>
      </nav>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-danger title">Drop Your Message</h3>
            <form action="{{route('public-message.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input name="full_name" type="text" class="form-control" id="inputName4" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group">
                    <input name="number" type="number" class="form-control" id="inputNumber4" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <input name="subject" type="text" class="form-control" id="inputSubject4" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>

                <button type="submit" class="btn btn-danger">
                    Send
                </button>
            </form>
        </div>

        <div class="col-md-6">
            <div style="box-shadow: unset; text-align:center" class="card card-nav-tabs" text-align:center">
                <div class="">
                    <div class="card-text">
                      <h2 class="card-title text-danger">
                        <i style="font-size: inherit" class="material-icons">ring_volume</i>
                        Helpline
                      </h2>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                  <li style="text-align: center; list-style:none">
                    @foreach($helplines as $helpline)
                    <h5>
                        {{$helpline->title}}
                    </h5>
                    @endforeach
                </li>
                </ul>
            </div>

            <div style="box-shadow: unset; text-align:center" class="card card-nav-tabs" text-align:center">
                <div class="">
                    <div class="card-text">
                      <h2 class="card-title text-danger">
                        <i style="font-size: inherit" class="material-icons">mail</i>
                        Email
                      </h2>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                  <li style="text-align: center; list-style:none">
                    @foreach($emails as $email)
                    <h5>
                        {{$email->title}}
                    </h5>
                    @endforeach
                </li>
                </ul>
            </div>

            <div style="box-shadow: unset; text-align:center" class="card card-nav-tabs" text-align:center">
                <div class="">
                    <div class="card-text">
                      <h2 class="card-title text-danger">
                        <i style="font-size: inherit" class="material-icons">room</i>
                        Address
                      </h2>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($addresses as $address)
                        <li style="text-align: center; list-style:none">
                            <h3>
                                {{$address->title}}
                            </h3>
                            <h5 style="text-align: center">
                                {{$address->description}}
                            </h5>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


@endsection

@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update Special Merchant</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('special-merchants.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label class="bmd-label-floating">Merchant Code</label>
                                <input value="{{$merchantCode}}" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label class="bmd-label-floating">From</label>
                                <select class="select2 col-md-6" name="district_id_from">
                                    @foreach ($districts as $district)
                                    <option></option>
                                    <option value="{{$district->id}}" {{ $district->id == $data->district_id_from ? 'selected' : '' }}>{{$district->title}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label class="bmd-label-floating">To</label>
                                <select class="select2 col-md-6" name="district_id_to">
                                    @foreach ($districts as $district)
                                    <option></option>
                                    <option value="{{$district->id}}" {{ $district->id == $data->district_id_to ? 'selected' : '' }}>{{$district->title}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label class="bmd-label-floating">Charge</label>
                                <input value="{{$data->charge}}" name="charge" type="text" class="form-control">
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <a class="btn btn-danger pull-right" href="{{route('special-merchants.index')}}">Back</a>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

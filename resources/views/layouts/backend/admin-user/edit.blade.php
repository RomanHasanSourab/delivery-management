@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update Merchant</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('merchants.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input value="{{$data->name}}" name="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input value="{{$data->email}}" name="email" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Shop Name</label>
                                <input value="{{$data->shop_name}}" name="shop_name" type="test" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Address</label>
                                <input value="{{$data->address}}" name="address" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <input value="{{$data->phone}}" name="phone" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Status</label>
                                    <select style="width: 90%"class="select2 form-control" name="status" required>
                                        <option></option>
                                        <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="3" {{ $data->status == '3' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">City</label>
                                <select style="width: 90%" class="select2 col-md-6" name="district_id">
                                    @foreach ($districts as $district)
                                    <option></option>
                                    <option value="{{$district->id}}" {{ $district->id == $data->district_id ? 'selected' : '' }}>{{$district->title}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input id="password" name="password" type="password" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" autocomplete="new-password">
                                </div>
                            </div> --}}
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Update</button>

                        <a class="btn btn-danger pull-right" href="{{route('merchants.index')}}">Back</a>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

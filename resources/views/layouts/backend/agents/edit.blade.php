@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update Agent Info</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agents.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    @if(auth()->user()->role_id == 1)
                    <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input value="{{$data->name}}" name="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input value="{{$data->email}}" name="email" type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Service Name</label>
                                <input value="{{isset($data->hubInfo) ? $data->hubInfo->service_name : ''}}" name="service_name" type="test" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Address</label>
                                <input value="{{$data->address}}" name="address" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone 1</label>
                                    <input value="{{$data->phone}}" name="phone" type="number" class="form-control @error('phone') is-invalid @enderror">
                                </div>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone 2</label>
                                    <input value="{{isset($data->hubInfo) ? $data->hubInfo->phone2 : ''}}" name="phone2" type="number" class="form-control @error('phone2') is-invalid @enderror">
                                </div>

                                @error('phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">License Number</label>
                                <input value="{{isset($data->hubInfo) ? $data->hubInfo->license : ''}}" name="license" type="text" class="form-control @error('license') is-invalid @enderror">
                            </div>

                            @error('license')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">NID/Passport/Birth Certificate Number</label>
                                <input value="{{isset($data->hubInfo) ? $data->hubInfo->identy_no : ''}}" name="identy_no" type="text" class="form-control @error('identy_no') is-invalid @enderror">
                            </div>

                            @error('identy_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input data-toggle="tooltip" data-placement="top" title="Upload the provided NID/Passport/Birth Certificate's Picture" id="identy_image" type="file" accept="image/*" class="form-control @error('identy_image') is-invalid @enderror" name="identy_image" value="{{ old('identy_image') }}">
                                    @error('identy_image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            @if(auth()->user()->role_id == 1)
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Status</label>
                                    <select style="width: 90%"class="select2 form-control" name="status" required>
                                        <option></option>
                                        <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="3" {{ $data->status == '3' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                        @endif

                        @if(auth()->user()->role_id == 2)
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <label class="form-control">{{$data->name}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <label class="form-control">{{$data->email}}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Address</label>
                                <label class="form-control">{{$data->address}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">City</label>
                                <label class="form-control">{{$city}}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Service Name</label>
                                    <label class="form-control">{{$data->hubInfo->service_name}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">License Number</label>
                                    <label class="form-control">{{$data->hubInfo->license}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">NID/Passport/Birth Certificate Number</label>
                                    <label class="form-control">{{$data->hubInfo->identy_no}}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 style="color: #f44336">You can change your phone number and password</h4>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Phone 1</label>
                                <input value="{{$data->phone}}" name="phone" type="number" class="form-control @error('phone') is-invalid @enderror">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone 2</label>
                                    <input value="{{$data->hubInfo->phone2}}" name="phone2" type="number" class="form-control @error('phone2') is-invalid @enderror">

                                    @error('phone2')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input id="password" name="password" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        @endif
                        <button type="submit" class="btn btn-primary pull-right">Update</button>

                        <a class="btn btn-danger pull-right" href="{{route('agents.index')}}">Back</a>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>


          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update Admin User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $old->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    @if(auth()->user()->id == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name <span style="color: red">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $old->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email <span style="color: red">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $old->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Address <span style="color: red">*</span></label>
                                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" rows="3" spellcheck="false"  name="address" required>{{$old->address}}</textarea>
                                {{--            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" spellcheck="false" required></textarea>--}}
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">District</label>
                                    <select style="width: 90%" class="select2 col-md-6" name="district_id">
                                        @foreach ($districts as $district)
                                            <option></option>
                                            <option value="{{$district->id}}" {{ $district->id == $old->district_id ? 'selected' : '' }}>{{$district->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Status</label>
                                    <select style="width: 90%"class="select2 form-control" name="status" required>
                                        <option></option>
                                        <option value="1" {{ $old->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="3" {{ $old->status == '3' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Name</label>
                                    <label class="form-control">{{$old->name}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <label class="form-control">{{$old->email}}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Address</label>
                                    <label class="form-control">{{$old->email}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">District</label>
                                    <label class="form-control">{{$old->district->title}}</label>
                                </div>
                            </div>

                        </div>
                    @endif

                    <br>
                    <h4 style="color: #f44336">You can change your phone number and password</h4>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone <span style="color: red">*</span></label>
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $old->phone }}" required>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <br>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
{{--                    <a href="{{route('user.index')}}" type="submit" class="btn btn-danger pull-right">Back</a>--}}
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

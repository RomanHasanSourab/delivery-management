@extends('layouts.auth-app')

@section('content')
    <div class="card card-login">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <input type="number" name="role_id" value="2" hidden>
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Agent Register</h4>
                <div class="social-line">
                  <a target="_blank" href="https://www.facebook.com/city.express.bd.cm" class="btn  btn-link">
                    <i class="material-icons">facebook</i>
                    Connect with our Facebook page
                  </a>
                  {{-- <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-google-plus"></i>
                  </a> --}}
                </div>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">face</i>
                              </span>
                            </div>
                            <input id="name" type="text" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">mail</i>
                              </span>
                            </div>
                            <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">phone</i>
                              </span>
                            </div>
                            <input id="phone" type="number" placeholder="Enter Phone 1 (11 Digits)" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                      <div class="col-md-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">phone</i>
                              </span>
                              </div>
                              <input id="phone2" type="number" placeholder="Enter Phone 2 (11 Digits)" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2') }}" required>

                              @error('phone2')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">store</i>
                              </span>
                              </div>
                              <input id="service_name" type="text" placeholder="Enter Service Name" class="form-control @error('service_name') is-invalid @enderror" name="service_name" value="{{ old('service_name') }}" required>

                              @error('service_name')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">location_on</i>
                            </span>
                              </div>
                              {{-- <input id="role" type="text" placeholder="Enter Address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required> --}}
                              <select class="role form-control @error('district_id') is-invalid @enderror" name="district_id" required>
                                  <option></option>
                                  @foreach ($districts as $district)
                                      <option value="{{$district->id}}">{{$district->title}}</option>
                                  @endforeach
                              </select>
                              @error('address')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>
                  </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">home</i>
                            </span>
                            </div>
                            <input id="address" type="text" placeholder="Enter Address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">recent_actors</i>
                              </span>
                            </div>
                            <input id="license" type="text" placeholder="Enter License Number" class="form-control @error('license') is-invalid @enderror" name="license" value="{{ old('license') }}" required>

                            @error('license')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">badge</i>
                              </span>
                              </div>
                              <input id="identy_no" type="number" placeholder="Enter NID/Passport/Birth Certificate Number" class="form-control @error('identy_no') is-invalid @enderror" name="identy_no" value="{{ old('identy_no') }}" required>

                              @error('identy_no')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="input-group">
                              <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">perm_media</i>
                            </span>
                              </div>
                              <input data-toggle="tooltip" data-placement="top" title="Upload the provided NID/Passport/Birth Certificate's Picture" id="identy_image" type="file" accept="image/*" class="form-control @error('identy_image') is-invalid @enderror" name="identy_image" value="{{ old('identy_image') }}" required>
                              @error('identy_image')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>
                  </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">lock_outline</i>
                              </span>
                            </div>
                            <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">lock_outline</i>
                              </span>
                            </div>
                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <div class="input-group-text">
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                            or
                            <a style="color: #f44336" href="{{ route('login') }}"><b>Login</b></a>
                        </div>
                    </div>
                </div>
                  {{-- <div class="footer text-center">
                    <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Get Started</a>
                  </div> --}}
                </form>
              </div>
    @endsection

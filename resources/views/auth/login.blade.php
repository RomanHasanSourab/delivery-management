@extends('layouts.auth-app')

@section('content')
          <div class="card card-login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4>
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
              {{-- <p class="description text-center">Or Be Classical</p> --}}
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input id="password" type="password" placeholder="Password..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    {{ __('Remember Me') }}
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                </div>

              </div>
              <div class="input-group-text">
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                        or
                        <a style="color: #f44336" href="{{ route('register') }}"><b>Register</b></a>
                    </div>
                </div>
            </div>
              {{-- <div class="footer text-center">
                <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Get Started</a>
              </div> --}}
            </form>
          </div>
@endsection


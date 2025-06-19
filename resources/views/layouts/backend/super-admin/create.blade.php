@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Create Admin User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    {{ csrf_field() }}
                    @include('layouts.backend.super-admin.form')
                    <br>
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                    <a href="{{route('user.index')}}" type="submit" class="btn btn-danger pull-right">Back</a>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

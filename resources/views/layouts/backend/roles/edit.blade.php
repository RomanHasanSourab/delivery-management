@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">Update Role</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Role Name <span style="color: red">*</span></label>
                            <input value="{{$data->title}}" name="title" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Code</label>
                            <input value="{{$data->code}}" name="code" type="text" class="form-control">
                            </div>
                        </div>
                        </div>


                        <a class="btn btn-danger pull-right" href="{{route('role.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

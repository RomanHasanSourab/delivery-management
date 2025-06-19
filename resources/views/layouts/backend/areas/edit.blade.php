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
                <form action="{{ route('areas.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">District Name</label>
                                <select class="select2 col-md-6" name="district_id">
                                    @foreach ($districts as $district)
                                    <option></option>
                                    <option value="{{$district->id}}" {{ $district->id == $data->district_id ? 'selected' : '' }}>{{$district->title}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="bmd-label-floating">Area Name</label>
                                <input value="{{$data->title}}" name="title" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <a class="btn btn-danger pull-right" href="{{route('areas.index')}}">Back</a>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update About Us</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-about.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label class="bmd-label-floating">Description</label>
                            {{-- <input value="{{$data->description}}" name="description" type="text" class="form-control"> --}}
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false">{{$data->description}}</textarea>
                            </div>
                        </div>
                        </div>


                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <a class="btn btn-danger pull-right" href="{{route('admin-about.index')}}">Back</a>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

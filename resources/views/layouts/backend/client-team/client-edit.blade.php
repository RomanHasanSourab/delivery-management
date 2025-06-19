@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update Client</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-client.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <br>
                    <br>
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="bmd-label-floating">name</label>
                            <input value="{{$data->name}}" name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="bmd-label-floating">Title</label>
                            <input value="{{$data->title}}" name="title" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <span>Choose file</span>
                            <input name="image" style="width: 100%" type="file">
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label class="bmd-label-floating">Description</label>
                                <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false">{{$data->body}}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <a class="btn btn-danger pull-right" href="{{route('admin-client.index')}}">Back</a>
                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

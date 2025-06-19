@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            @include('layouts.backend.home-component.home-component')
            <div class="card-body">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".client-create">Create New</button>
                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp
                <div class="table-responsive">
                <table class="table table-bordered table-hover" data-form="deleteForm">
                    <thead class="card-header-primary no-shadow">
                      <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->body}}</td>
                            <td>
                                {{-- <img src="{{asset('public/clients/'.$row->image)}}" alt=""> --}}
                                <img style="height: 10em" class="img-fluid" src="{{asset('authority-team/'.$row->image)}}" alt="">
                            </td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->authorityCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->authorityUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('authority-teams.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('authority-teams.destroy', $row->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" title="Delete" class="delete btn btn-danger btn-link">
                                        <i class="material-icons">close</i>
                                      </button>
                                </form>


                              </td>
                        </tr>
                    @endforeach
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@include('layouts.backend.authority-team.delete-modal')
@include('layouts.backend.authority-team.create-modal')

@endsection

@push('scripts')

@endpush

@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">All Roles</h4>
            </div>
            <div class="card-body table-responsive">
                {{-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Create New Role</button> --}}
                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp
                <table class="table table-bordered table-hover" data-form="deleteForm">
                    <thead class="card-header-primary no-shadow">
                      <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">ID</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Code</th>
                        {{-- <th scope="col">Number of Users</th>
                        <th scope="col">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->code}}</td>
                            {{-- <td>null</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('role.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('role.destroy', $row->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" title="Delete" class="delete btn btn-danger btn-link">
                                        <i class="material-icons">close</i>
                                      </button>
                                </form>


                              </td> --}}
                        </tr>
                    @endforeach
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@include('layouts.backend.roles.delete-modal')
@include('layouts.backend.roles.create-modal')

@endsection

@push('scripts')

@endpush

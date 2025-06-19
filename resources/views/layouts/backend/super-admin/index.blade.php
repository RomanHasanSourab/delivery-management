@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
{{--            @include('layouts.backend.home-component.home-component')--}}
            <div class="card-body">
                <a href="{{route('user.create')}}" class="btn btn-primary pull-right">Create New User</a>
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
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">District</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{$row->district['title']}}</td>
                            <td>{{$row->phone}}</td>
                            <td>
                                @if ($row->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                @elseif($row->status == 3 || $row->status == 2)
                                    <span class="badge badge-pill badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('user.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('user.destroy', $row->id) }}" method="POST">
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


@include('layouts.backend.super-admin.delete-modal')
@include('layouts.backend.super-admin.create-modal')

@endsection

@push('scripts')

@endpush

@extends('layouts.backend.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
      {{-- <div class="col-md-8"> --}}
        <div class="card">
          @include('layouts.backend.customers.customers-menu')
          <div class="card-body">
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
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Email</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">City</th>
                        <th scope="col">Status</th>
                        <th scope="col">Registered At</th>
                        <th scope="col">Activated At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datas as $data)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->code}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->shop_name}}</td>
                            <td>{{$data->address}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->district->title}}</td>
                            <td>
                                @if ($data->status == 1)
                                <span class="badge badge-pill badge-success">Active</span>
                                @elseif($data->status == 2)
                                <span class="badge badge-pill badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('merchants.edit', $data->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                {{-- <form class="form-delete" action="{{ route('role.destroy', $data->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" title="Delete" class="delete btn btn-danger btn-link">
                                        <i class="material-icons">close</i>
                                      </button>
                                </form> --}}


                              </td>
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


@include('layouts.backend.merchants.delete-modal')
@include('layouts.backend.merchants.create-modal')

@endsection

@push('scripts')

@endpush

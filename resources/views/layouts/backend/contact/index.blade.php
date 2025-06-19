@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            @include('layouts.backend.home-component.home-component')
            <div class="card-body">
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#phone">Create Helpline Number</button>
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
                        <th scope="col">Helpline Number</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($helplines as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->helplineCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->helplineUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('admin-phone.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('admin-phone.destroy', $row->id) }}" method="POST">
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
                  <br>



                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#email">Create Email</button>
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
                        <th scope="col">Email</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($emails as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->emailCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->emailUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('admin-email.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('admin-email.destroy', $row->id) }}" method="POST">
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
                  <br>



                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#address">Create Address</button>
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
                        <th scope="col">Address</th>
                        <th scope="col">Full Address</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($addresses as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->description}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->addressCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->addressUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('admin-address.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('admin-address.destroy', $row->id) }}" method="POST">
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


@include('layouts.backend.services.delete-modal')
@include('layouts.backend.contact.create-phone-modal')
@include('layouts.backend.contact.create-email-modal')
@include('layouts.backend.contact.create-address-modal')

@endsection

@push('scripts')

@endpush

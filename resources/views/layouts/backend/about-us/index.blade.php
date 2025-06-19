@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            @include('layouts.backend.home-component.home-component')
            <div class="card-body">
                  @if (count($aboutData) < 1)
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#about">Create About Us</button>
                  @endif
                  <div class="clearfix"></div>
                  <br>
                  <div class="table-responsive">
                  <table class="table table-bordered table-hover" data-form="deleteForm">
                    <thead class="card-header-primary no-shadow">
                      <tr style="text-align: center">
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($aboutData as $row)
                        <tr style="text-align: center">
                            <td style="text-align: justify">{{$row->description}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->aboutCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->aboutUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('admin-about.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('admin-about.destroy', $row->id) }}" method="POST">
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
                  {{-- <br>
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#card">Create New Card</button>
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
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($cardData as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->description}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->aboutCardCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->aboutCardUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('admin-about-card.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('admin-about-card.destroy', $row->id) }}" method="POST">
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
                  </div> --}}
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@include('layouts.backend.services.delete-modal')
@include('layouts.backend.about-us.create-description-modal')
@include('layouts.backend.about-us.create-card-modal')

@endsection

@push('scripts')

@endpush

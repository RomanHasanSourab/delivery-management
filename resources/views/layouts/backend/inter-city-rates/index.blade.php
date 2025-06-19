@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            @include('layouts.backend.home-component.home-component')
            <div class="card-body">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Create City Rate</button>
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
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Charge</th>
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
                            <td>{{$row->districtFrom['title']}}</td>
                            <td>{{$row->districtTo['title']}}</td>
                            <td>{{$row->charge}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->cityRateCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->cityRateUpdatedBy['name']}}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary btn-link" href="{{ route('admin-inter-city-rates.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>

                                <form class="form-delete" action="{{ route('admin-inter-city-rates.destroy', $row->id) }}" method="POST">
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


@include('layouts.backend.inter-city-rates.delete-modal')
@include('layouts.backend.inter-city-rates.create-modal')

@endsection

@push('scripts')

@endpush

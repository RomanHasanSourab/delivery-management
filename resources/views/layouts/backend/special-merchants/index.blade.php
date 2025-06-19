@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
                <h4 class="card-title">All Special Merchants</h4>
              </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Create Price</button>
                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp
                <div class="table-responsive">

{{--                <table class="table table-bordered table-hover" data-form="deleteForm">--}}
                <table class="table table-bordered" class="display nowrap" id="get-sm" data-form="deleteForm" width="100%">
                    <thead class="card-header-primary no-shadow">
                      <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">Merchant Name</th>
                        <th scope="col">Merchant Code</th>
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
                            <td>{{$row->merchantInfo['name']}}</td>
                            <td>{{$row->merchantInfo['code']}}</td>
                            <td>{{$row->districtFrom['title']}}</td>
                            <td>{{$row->districtTo['title']}}</td>
                            <td>{{$row->charge}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->sMCreatedBy['name']}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>{{$row->sMUpdatedBy['name']}}</td>
                            <td class="td-actions d-flex justify-content-center">
                                <a class="btn btn-primary btn-link" href="{{ route('special-merchants.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>
                                @if(auth()->user()->id == 1)
                                <form class="form-delete" action="{{ route('special-merchants.destroy', $row->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" title="Delete" class="delete btn btn-danger btn-link">
                                        <i class="material-icons">close</i>
                                      </button>
                                </form>
                                @endif

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


@include('layouts.backend.special-merchants.delete-modal')
@include('layouts.backend.special-merchants.create-modal')

@endsection

@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#get-sm').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                // scrollX: true,
                // paging: false,
                // scrollY: "500px",
            });

        });
    </script>
@endpush

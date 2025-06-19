@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            {{-- @include('layouts.backend.home-component.home-component') --}}
            <div class="card-body">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Create New Delivery</button>
                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp
                <table class="table table-bordered table-hover" data-form="deleteForm">
                    <thead class="card-header-primary no-shadow">
                      <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">Date</th>
                        <th scope="col">Recipient Name</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Collection amount</th>
                        <th scope="col">Total Charge</th>
                        <th scope="col">Total Payout</th>
                        <th scope="col">Delivery type</th>
                        <th scope="col">Delivery status</th>
                        <th scope="col">Delivery date</th>
                        <th scope="col">Payment status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                    @php
                        $date= strtotime($row->created_at);
                        $payout = $row->collect_amount - $row->total_charge;
                    @endphp
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{date('d-M-Y | h:i A', $date)}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->collect_amount}}</td>
                            <td>{{$row->total_charge}}</td>
                            <td>{{$payout}}</td>
                            <td>
                                @if ($row->delivery_type == 1)
                                    Standard delivery
                                @elseif($row->delivery_type == 2)
                                    Standard delivery
                                @elseif($row->delivery_type == 3)
                                    Urgent delivery( within 6 hours)
                                @endif
                            </td>
                            <td>Delivery Status</td>
                            <td>Delivery Date</td>
                            <td>Payment status</td>
                            <td class="td-actions">
                                {{-- <a class="btn btn-primary btn-link" href="{{ route('admin-services.edit', $row->id) }}">
                                    <i class="material-icons">edit</i>
                                </a> --}}

                                {{-- <form class="form-delete" action="{{ route('admin-services.destroy', $row->id) }}" method="POST">
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


@include('layouts.backend.deliveries.delete-modal')
@include('layouts.backend.deliveries.create-modal')

@endsection

@push('scripts')

@endpush

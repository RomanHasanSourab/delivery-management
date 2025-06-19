@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            {{-- @include('layouts.backend.home-component.home-component') --}}
            <div class="card-body">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Request Now</button>
                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp
                <table class="table table-bordered" class="table-hover" id="get-requests"  width="100%">
                    <thead>
                    <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">Date</th>
                        <th scope="col">Merchant</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                    </tr>
                    </thead>
                </table>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@include('layouts.backend.payment-request.create-modal')

@endsection

@push('scripts')
    <script>
        $(function() {
            $('#get-requests').DataTable({
                processing: true,
                serverSide: true,
                // responsive: true,
                scrollX: true,
                scrollY: "500px",
                // paging: false,
                ajax: '{{ url('get-payment-requests') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'id', orderable: false },
                    { data: 'date', name: 'date', orderable: false },
                    { data: 'merchant', name: 'merchant', orderable: false },
                    { data: 'status', name: 'status', orderable: false },
                    { data: 'description', name: 'description', orderable: false },
                ],

            });

        });
    </script>
@endpush

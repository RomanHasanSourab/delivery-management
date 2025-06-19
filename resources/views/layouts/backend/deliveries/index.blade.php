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
                <table class="table table-bordered" class="table-hover" id="get-admin-deliveries"  width="100%">
                    <thead>
                    <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">Date</th>
                        <th scope="col">Code</th>
                        <th scope="col">Recipient</th>
                        <th scope="col">Delivery City</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Collection amount</th>
                        <th scope="col">Total Charge</th>
                        <th scope="col">Total Payout</th>
                        <th scope="col">Delivery type</th>
                        <th scope="col">Delivery status</th>
                        <th scope="col">Payment status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


{{-- @include('layouts.backend.deliveries.delete-modal') --}}
@include('layouts.backend.deliveries.create-modal')
@include('layouts.backend.deliveries.view-admin')

@endsection

@push('scripts')
    <script>
        $(function() {
            $('#get-admin-deliveries').DataTable({
                processing: true,
                serverSide: true,
                // responsive: true,
                scrollX: true,
                scrollY: "500px",
                // paging: false,
                ajax: '{{ url('get-deliveries-admin') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'id', orderable: false },
                    { data: 'date', name: 'date', orderable: false },
                    { data: 'code', name: 'code', orderable: false },
                    { data: 'name', name: 'name', orderable: false },
                    { data: 'to', name: 'to', orderable: false },
                    { data: 'phone', name: 'phone', orderable: false },
                    { data: 'collect_amount', name: 'collect_amount', orderable: false },
                    { data: 'total_charge', name: 'total_charge', orderable: false },
                    { data: 'payout', name: 'payout', orderable: false },
                    { data: 'delivery_type', name: 'delivery_type', orderable: false },
                    { data: 'delivery_status', name: 'delivery_status', orderable: false },
                    { data: 'payment_status', name: 'payment_status', orderable: false },
                    {data: 'action', name: 'action', orderable: false,
                        render:
                            function(data, type, row) {
                                if(row.delivery_status_id == 1){
                                    return '<div style="text-align:center" class="action-btn">'+
                                            '<span class="btn btn-primary btn-sm" id="modalView" onclick="journalView('+row.id+')">View</span>'+
                                            '<a class="btn btn-info btn-sm" href="deliveries/'+row.id+'/edit">Edit</a>'+
                                            '<a class="btn btn-rose btn-link" target="_blank" href="/print/delivery-info/'+row.id+'">Print</a>'+
                                        '</div>';
                                }
                                return '<div style="text-align:center" class="action-btn">'+
                                        '<span class="btn btn-primary btn-sm" id="modalView" onclick="journalView('+row.id+')">View</span>'+
                                        '<a class="btn btn-rose btn-link" target="_blank" href="/print/delivery-info/'+row.id+'">Print</a>'+
                                    '</div>';
                                // if(row.delivery_status_id == 1){
                                    // return '<div class="action-btn">'+
                                    //         '<span class="btn btn-primary" id="modalView" onclick="journalView('+row.id+')">View</span>'+
                                    //         '<a class="btn btn-info" href="deliveries/'+row.id+'/edit"><i class="material-icons">edit</i></a>'+
                                    //     '</div>';
                                // }
                                // return '<div class="action-btn">'+
                                //             '<span class="btn btn-primary" id="modalView" onclick="journalView('+row.id+')">View</span>'
                                //         '</div>';

                            }
                    },
                ],

            });

        });



        function journalView(data){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                url: '{{ route("get-delivery-info") }}',
                type: 'post',
                data: {'data': data },
                success: function (response) {

                    var obj = jQuery.parseJSON(response);

                    $("#v-type").text(obj['2']);
                    $("#v-code").text(obj['0'].code);
                    $("#v-recipient").text(obj['0'].name);
                    $("#v-phone").text(obj['0'].phone);
                    $("#v-address").text(obj['0'].address);
                    $("#v-collect-amount").text(obj['0'].collect_amount);
                    $("#v-total-charge").text(obj['0'].total_charge);
                    $("#v-total-payout").text(obj['3']);
                    $("#v-note").text(obj['0'].note);
                    $("#v-remark").text(obj['0'].delivery_remark);
                    $("#v-id").text(obj['1'].code);
                    $("#v-store").text(obj['1'].shop_name);
                    $("#v-m-name").text(obj['1'].name);
                    $("#v-m-phone").text(obj['1'].phone);
                    $("#v-pickup-address").text(obj['0'].pickup_address);
                    $("#v-city-to").text(obj['5']);
                    $("#v-city-from").text(obj['4']);
                    $("#v-status").text(obj['6']);
                    $("#v-pay-status").text(obj['7']);
                    $("#v-date-time").text(obj['8']);

                    $('#myModal').modal({
                        show: true,
                        backdrop: true,
                        keyboard: true
                    });
                }
            });

        }
    </script>
@endpush

@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="card">
            <div class="card-body">
                <a class="btn btn-primary pull-right" href="{{route('all.deliveries.agent')}}">All Deliveries</a>

                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp

                <nav class="navbar navbar-expand-lg">
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.no.status')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="no-status" value="" hidden>
                            <button class="btn" onclick="get_no_status_id()">No Status Set</button>
                        </form>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.pickup')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="pickup" value="" hidden>
                            <button class="btn btn-rose" onclick="get_pickup_id()">Pickup</button>
                        </form>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.delivered')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="delivered" value="" hidden>
                            <button class="btn btn-success" onclick="get_delivered_id()">Delivered</button>
                        </form>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.cancel')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="cancel" value="" hidden>
                            <button class="btn btn-danger" onclick="get_cancel_id()">Cancel</button>
                        </form>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".hold" onclick="get_hold_id()">Hold</button>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.paid')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="paid" value="" hidden>
                            <button class="btn btn-info" onclick="get_paid_id()">Paid</button>
                        </form>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.unpaid')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="unpaid" value="" hidden>
                            <button class="btn btn-info" onclick="get_unpaid_id()">Unpaid</button>
                        </form>
                    </li>
                </nav>

                <table class="table table-bordered" class="display nowrap" id="get-agent-deliveries"  width="100%">
                    <thead>
                    <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th>
                            <input type="checkbox" id="checkAllAddMore" name="allId[]">
                        </th>
                        <th scope="col">Date</th>
                        <th scope="col">Code</th>
                        <th scope="col">Merchant</th>
                        <th scope="col">Recipient</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Collection amount</th>
                        <th scope="col">Total Charge</th>
                        <th scope="col">Total Payout</th>
                        <th scope="col">Delivery type</th>
                        <th scope="col">Delivery status</th>
                        <th scope="col">Assigned Agent</th>
                        <th scope="col">Payment status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
          </div>
      </div>
    </div>


    <div class="modal fade delete" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <p>Are you sure you want to delete this?</p>
            </div>

            <div class="modal-footer">
                <form action="{{route('deliveries.delete')}}" method="POST">
                    @csrf
                    <input type="text" name="id" id="delete" value="" hidden>
                        <button type="button" class="btn btn-sm btn-default pull-right" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete</button>
                </form>

            </div>
          </div>
        </div>
    </div>


    <div class="modal fade hold" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        {{-- <div class="modal-dialog modal-lg modal-dialog-centered"> --}}
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Write Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>


            <div class="modal-body">
                <form action="{{route('admin.hold')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label class="bmd-label-floating">Remark </label>
                            <input type="text" name="id" id="hold" value="" hidden>
                            <textarea name="delivery_remark" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Send</button>
                        <button type="reset" class="btn btn-danger pull-right">Reset</button>
                        <div class="clearfix"></div>
                </form>
            {{-- form End--}}

            </div>
          </div>
        </div>
      </div>

@include('layouts.backend.deliveries.view-admin')
{{-- @include('layouts.backend.deliveries.delete-modal') --}}
{{-- @include('layouts.backend.deliveries.remark-modal') --}}

@endsection

@push('scripts')
<script>
    $(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('#get-agent-deliveries').DataTable({
            processing: true,
            serverSide: true,
            // responsive: true,
            scrollX: true,
            // paging: false,
            scrollY: "500px",
            ajax: '{{ url('get-deliveries-agent') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', orderable: false },
                { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                { data: 'date', name: 'date', orderable: false },
                { data: 'code', name: 'code', orderable: false },
                { data: 'merchant', name: 'merchant', orderable: false },
                { data: 'name', name: 'name', orderable: false },
                { data: 'from', name: 'from', orderable: false},
                { data: 'to', name: 'to', orderable: false },
                { data: 'phone', name: 'phone', orderable: false },
                { data: 'collect_amount', name: 'collect_amount', orderable: false },
                { data: 'total_charge', name: 'total_charge', orderable: false },
                { data: 'payout', name: 'payout', orderable: false },
                { data: 'delivery_type', name: 'delivery_type', orderable: false },
                { data: 'delivery_status', name: 'delivery_status', orderable: false },
                { data: 'assign', name: 'assign', orderable: false },
                { data: 'payment_status', name: 'payment_status', orderable: false },
                {data: 'action', name: 'action', orderable: false,
                        render:
                            function(data, type, row) {
                                // return '<span class="btn btn-primary" id="modalView" onclick="journalView('+data+')">Details</span>';
                                return '<div style="text-align:center" class="action-btn">'+
                                            '<span class="btn btn-primary btn-sm" id="modalView" onclick="journalView('+row.id+')">View</span>'+
                                            // '<a class="btn btn-info btn-sm" href="deliveries/'+row.id+'/edit">Edit</a>'+
                                            '<a class="btn btn-rose btn-link" target="_blank" href="/print/delivery-info/'+row.id+'">Print</a>'+
                                            // '<span class="btn btn-danger btn-sm" onclick="deliveryDelete('+row.id+')">Delete</span>'+
                                        '</div>';
                            }
                },
            ],

        });

    });


    $(document).ready(function() {

            $('#checkAllAddMore').checkAll({

                name:'checkGroup',
                vagueCls:'indeterminate',
                //$(':checkbox[class='+ $(this).data('dis_checkitem') + ']:not(:disabled)').prop("checked", $(this).prop("checked")).trigger("change");
                onFull : function (count,ids,nodes) {
                    // all in checked callback
                    // params : count|len, length , ids, value, nodes
                    //$('.statusbar').text(count+' items, checked '+count+' item');
                    $(':checkbox .'+ $(this).data('checkGroup')).not(':disabled').prop("checked", $(this).prop("checked")).trigger("change");
                    console.log(count)
                },

            });
    });

    function get_no_status_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("no-status").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }


    function get_cancel_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("cancel").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_hold_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("hold").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_pickup_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("pickup").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_delivered_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("delivered").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_paid_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("paid").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_unpaid_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("unpaid").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_delete_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("delete").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_tag_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("agent_tag").value = selected_item;
        } else {
            alert("Please Select an item");
        }
    }

    function journalView(data){
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
                    });
                }
            });

        }


    function deliveryDelete(data){
        // $("#dDelete").attr("action", "deliveries/"data;

        $('#deliveryDelete').modal({
                        show: true,
                        backdrop: true,
                        keyboard: true
                    });
  $("#dDelete").append(data);
                    // document.getElementById("dDelete").action = "/deliveries/".append(data);
    }
</script>
@endpush

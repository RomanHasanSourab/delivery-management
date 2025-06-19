@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            {{-- @include('layouts.backend.home-component.home-component') --}}
            <div class="card-body">
                {{-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Request Now</button> --}}
                <div class="clearfix"></div>
                <br>
                @php
                 $i = 1;
                @endphp

                <nav class="navbar navbar-expand-lg">
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.request.solve')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="solve_id" value="" hidden>
                            <button class="btn btn-success" onclick="get_solve_id()">Solved</button>
                        </form>
                    </li>
                    <li style="list-style: none;" class="nav-item">
                        <form action="{{route('admin.request.pending')}}" method="POST">
                            @csrf
                            <input type="text" name="id" id="pending_id" value="" hidden>
                            <button class="btn btn-default" onclick="get_pending_id()">Pending</button>
                        </form>
                    </li>
                </nav>

                <table class="table table-bordered" class="table-hover" id="get-requests"  width="100%">
                    <thead>
                    <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th>
                            <input type="checkbox" id="checkAllAddMore" name="allId[]">
                        </th>
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


{{-- @include('layouts.backend.payment-request.create-modal') --}}

@endsection

@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                    { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    { data: 'date', name: 'date', orderable: false },
                    { data: 'merchant', name: 'merchant', orderable: false },
                    { data: 'status', name: 'status', orderable: false },
                    { data: 'description', name: 'description', orderable: false },
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


    function get_solve_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("solve_id").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    function get_pending_id() {
        var selected_item = [];
        $('.checkAll:checked').map(function () {
            selected_item.push($(this).val());
        })
        if (selected_item.length > 0) {
            document.getElementById("pending_id").value = selected_item;
        } else {
                alert("Please Select an item");
        }
    }

    </script>
@endpush

@extends('layouts.backend.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
      {{-- <div class="col-md-8"> --}}
        <div class="card">
          @include('layouts.backend.merchants.merchants-menu')
          <div class="card-body table-responsive">
              {{-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".create">Create New Role</button> --}}
              <div class="clearfix"></div>
              <br>
              @php
               $i = 1;
              @endphp
              <table class="table table-bordered" class="table-hover" id="get-merchants-admin"  width="100%">
                  <thead>
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
              </table>
          </div>
        </div>
      {{-- </div> --}}
    </div>
  </div>


@include('layouts.backend.deliveries.delete-modal')
@include('layouts.backend.deliveries.view-admin')

@endsection

@push('scripts')
  <script>
      $(function() {
          $('#get-merchants-admin').DataTable({
                processing: true,
                serverSide: true,
                // responsive: true,
                scrollX: true,
                // paging: false,
              ajax: '{{ url('get-merchants-admin') }}',
              columns: [
                  { data: 'DT_RowIndex', name: 'id', orderable: false },
                  { data: 'name', name: 'name', orderable: false },
                  { data: 'code', name: 'code', orderable: false },
                  { data: 'email', name: 'email', orderable: false },
                  { data: 'shop_name', name: 'shop_name', orderable: false },
                  { data: 'address', name: 'address', orderable: false },
                  { data: 'phone', name: 'phone', orderable: false },
                  { data: 'city', name: 'city', orderable: false },
                  { data: 'status', name: 'status', orderable: false ,
                      render:
                          function(data, type, row) {
                              if(row.status == 1){
                                  return '<span class="badge badge-pill badge-success">Active</span>';
                              }

                          }
                  },
                  { data: 'registered_at', name: 'registered_at', orderable: false },
                  { data: 'activated_at', name: 'activated_at', orderable: false },
                //   { data: 'action', name: 'action', orderable: false },
                  {data: 'action', name: 'action', orderable: false,
                      render:
                          function(data, type, row) {
                                return '<div class="action-btn">'+
                                        '<a class="btn btn-primary btn-link" href="merchants/'+row.id+'/edit"><i class="material-icons">edit</i></a>'+
                                        '<a class="btn btn-info" href="manage/'+row.id+'">Manage</a>'+
                                    '</div>';

                          }
                  },
              ],

          });

      });
  </script>
@endpush

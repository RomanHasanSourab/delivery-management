@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">All Messages</h4>
            </div>
            <div class="card-body">
                <br>
                @php
                 $i = 1;
                @endphp
                <div class="table-responsive">
                <table class="table table-bordered table-hover" data-form="deleteForm">
                    <thead class="card-header-primary no-shadow">
                      <tr style="text-align: center">
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                        <tr style="text-align: center">
                            <td>{{$i++}}</td>
                            <td>{{$row->full_name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->number}}</td>
                            <td style="text-align: justify">{{$row->subject}}</td>
                            <td style="text-align: justify">{{$row->message}}</td>
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


@endsection

@push('scripts')

@endpush

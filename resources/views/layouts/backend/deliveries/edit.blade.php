@extends('layouts.backend.layouts.app')
@section('content')
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-md-8"> --}}
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Update Delivery</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('deliveries.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="text" value="2" name="edit_from" hidden>
                    <input type="url" value="{{$preUrl}}" name="pre_url" hidden>
                    <input type="text" name="user_id" value="{{$data->created_by}}" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Recipient Name <span style="color: red">*</span></label>
                            <input name="name" value="{{$data->name}}" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Mobile Number <span style="color: red">*</span></label>
                            <input name="phone" type="number" value="{{$data->phone}}" class="form-control" maxlength="11" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Email</label>
                            <input name="email" type="email" value="{{$data->email}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="bmd-label-floating">Collect Amount <span style="color: red">*</span></label>
                            <input name="collect_amount" value="{{$data->collect_amount}}" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="bmd-label-floating">Custom Charge</label>
                                <input name="total_charge" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Pickup City</label>
                            <input type="text" value="{{$data->district_id_from}}" name="district_id_from" hidden>
                            <select style="width: 100%" class="select2" disabled>
                                @foreach ($districts as $district)
                                <option></option>
                                <option value="{{$district->id}}" {{ $district->id == $data->district_id_from ? 'selected' : '' }}>{{$district->title}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                                <label class="bmd-label-floating">Pickup Address </label>
                                <textarea name="pickup_address" class="form-control" rows="5" spellcheck="false">{{$data->pickup_address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Delivery City <span style="color: red">*</span></label>
                            <select style="width: 100%" class="select2" name="district_id" required>
                                @foreach ($districts as $district)
                                <option></option>
                                <option value="{{$district->id}}" {{ $district->id == $data->district_id ? 'selected' : '' }}>{{$district->title}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                                <label class="bmd-label-floating">Delivery Address <span style="color: red">*</span></label>
                                <textarea name="address" class="form-control" rows="5" spellcheck="false" required>{{$data->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Delivery Type <span style="color: red">*</span></label>
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="delivery_type" id="exampleRadios1" value="1" {{$data->delivery_type == 1 ? 'checked' : null}}>
                                  Standard delivery
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="delivery_type" id="exampleRadios2" value="2"  {{$data->delivery_type == 2 ? 'checked' : null}}>
                                  Food delivery
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="delivery_type" id="exampleRadios2" value="3"  {{$data->delivery_type == 3 ? 'checked' : null}}>
                                  Urgent delivery( within 6 hours)
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Note </label>
                            <textarea name="note" class="form-control" rows="5" spellcheck="false">{{$data->note}}</textarea>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                    <a class="btn btn-danger pull-right" href="{{ url()->previous() }}">Back</a>

                        {{-- <button type="submit" class="btn btn-danger pull-right">Update</button> --}}
                        <div class="clearfix"></div>
                </form>
            </div>
          </div>
        {{-- </div> --}}
      </div>
    </div>


@endsection

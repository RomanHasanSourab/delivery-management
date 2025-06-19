<div class="modal fade create" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <div class="modal-dialog modal-lg modal-dialog-centered"> --}}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Delivery</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>


        <div class="modal-body">
            <form action="{{route('deliveries.store')}}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Recipient Name <span style="color: red">*</span></label>
                            <input name="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Mobile Number <span style="color: red">*</span></label>
                            <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Email</label>
                            <input name="email" type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Collect Amount <span style="color: red">*</span></label>
                            <input name="collect_amount" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Pickup City</label>
                            <select style="width: 100%" class="select2" disabled>
                                {{-- @if (auth()->user()->role_id == 1) --}}
                                    <option>{{$selfCity->district->title}}</option>
                                {{-- @endif --}}
                            </select>
                            </div>

                            <div class="form-group">
                                <label class="bmd-label-floating">Pickup Address </label>
                                <textarea name="pickup_address" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Delivery City <span style="color: red">*</span></label>
                            <select style="width: 100%" class="select2" name="district_id" required>
                                @foreach ($districts as $district)
                                <option></option>
                                    <option value="{{$district->id}}">{{$district->title}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                                <label class="bmd-label-floating">Delivery Address <span style="color: red">*</span></label>
                                <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Delivery Type <span style="color: red">*</span></label>
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="delivery_type" id="exampleRadios1" value="1" checked>
                                  Standard delivery
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="delivery_type" id="exampleRadios2" value="2">
                                  Food delivery
                                  <span class="circle">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="delivery_type" id="exampleRadios2" value="3">
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
                            <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    <button type="reset" class="btn btn-danger pull-right">Reset</button>
                    <div class="clearfix"></div>
            </form>
        {{-- form End--}}

        </div>
      </div>
    </div>
  </div>
@push('scripts')

@endpush

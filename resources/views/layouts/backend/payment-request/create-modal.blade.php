<div class="modal fade create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <div class="modal-dialog modal-lg modal-dialog-centered"> --}}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Payment Request</h5>
            <button style="color: white" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>


        <div class="modal-body">
            <form action="{{route('payment-requests.store')}}" method="POST">
                @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <h5>
                            <b>
                                If you think you have pending payment or need payment urgent please let us know with detail. We will look into it. You can request once in a day.
                            </b>
                        </h5>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Description <span style="color: red">*</span></label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false" required></textarea>
                        </div>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Send</button>
                    <div class="clearfix"></div>
            </form>
        {{-- form End--}}

        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id='email' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <div class="modal-dialog modal-lg modal-dialog-centered"> --}}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Email</h5>
            <button style="color: white" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>


        <div class="modal-body">
            <form action="{{route('admin-email.store')}}" method="POST">
                @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Email <span style="color: red">*</span></label>
                        <input name="title" type="email" class="form-control" required>
                        </div>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                    <div class="clearfix"></div>
            </form>
        {{-- form End--}}

        </div>
      </div>
    </div>
  </div>

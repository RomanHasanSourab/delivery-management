<div class="modal fade client-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <div class="modal-dialog modal-lg modal-dialog-centered"> --}}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Member</h5>
            <button style="color: white" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>


        <div class="modal-body">
            <form action="{{route('authority-teams.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Name <span style="color: red">*</span></label>
                        <input name="name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Title <span style="color: red">*</span></label>
                        <input name="title" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label class="bmd-label-floating">Description <span style="color: red">*</span></label>
                        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="5" spellcheck="false" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span>Choose file <span style="color: red">*</span></span>
                        <input name="image" style="width: 100%" type="file" required>
                    </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                    <div class="clearfix"></div>
            </form>
        {{-- form End--}}

        </div>
      </div>
    </div>
  </div>

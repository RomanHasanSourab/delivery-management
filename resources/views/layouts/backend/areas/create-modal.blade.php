<div class="modal fade create"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New Area</h5>
            <button style="color: white" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>


        <div class="modal-body">
            <form action="{{route('areas.store')}}" method="POST">
                @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Districts <span style="color: red">*</span></label>
                        <select style="width: 80%" class="select2" name="district_id" required>
                            @foreach ($districts as $district)
                            <option></option>
                                <option value="{{$district->id}}">{{$district->title}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Title <span style="color: red">*</span></label>
                        <input name="title" type="text" class="form-control" required>
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


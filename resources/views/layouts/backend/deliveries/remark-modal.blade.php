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
@push('scripts')

@endpush

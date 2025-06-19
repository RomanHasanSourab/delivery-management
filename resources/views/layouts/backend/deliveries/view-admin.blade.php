  <div class="modal fade create bd-example-modal-lg" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h3 class="modal-title">Delivery Information</h3> --}}
          {{-- <a class="btn btn-rose btn-sm" href="{{route('deliveries.print', '1')}}">Print only delivery Info</a>
          <a class="btn btn-danger btn-sm" href="{{route('deliveries.pickup.print', '2')}}">Print with pickup Info</a> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
            <div style="width: 80%; margin:auto" class="row">
                <p class="btn-link">Delivery Information</p>
                <table style="font-size: .9rem" class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="font-weight: bold">DELIVERY TYPE</td>
                        <td>
                            <span id="v-type"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">CODE</td>
                        <td>
                            <span id="v-code"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">RECIPIENT</td>
                        <td>
                            <span id="v-recipient"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">MOBILE</td>
                        <td>
                            <span id="v-phone"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">ADDRESS</td>
                        <td>
                            <span id="v-address"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">CITY</td>
                        <td>
                            <span id="v-city-to"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">COLLECTION AMOUNT</td>
                        <td>
                            <span id="v-collect-amount"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">DELIVERY CHARGE</td>
                        <td>
                            <span id="v-total-charge"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">TOTAL PAYOUT</td>
                        <td>
                            <span id="v-total-payout"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">STATUS</td>
                        <td>
                            <span id="v-status"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">PAYMENT STATUS</td>
                        <td>
                            <span id="v-pay-status"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">NOTE</td>
                        <td>
                            <span id="v-note"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">REMARKS</td>
                        <td>
                            <span id="v-remark"></span>
                        </td>
                      </tr>

                    </tbody>
                  </table>

                  <br>
                  <br>

                  <p class="btn-link">Pickup Information</p>
                  <table style="font-size: .9rem" class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="font-weight: bold">DATE</td>
                        <td>
                            <span id="v-date-time"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">MERCHANT ID</td>
                        <td>
                            <span id="v-id"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">STORE NAME</td>
                        <td>
                            <span id="v-store"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">MERCHANT NAME</td>
                        <td>
                            <span id="v-m-name"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">MOBILE</td>
                        <td>
                            <span id="v-m-phone"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">PICK UP ADDRESS</td>
                        <td>
                            <span id="v-pickup-address"></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="font-weight: bold">PICKUP CITY</td>
                        <td>
                            <span id="v-city-from"></span>
                        </td>
                      </tr>


                    </tbody>
                  </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



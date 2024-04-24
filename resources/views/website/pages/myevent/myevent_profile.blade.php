<div class="sell_box" id="myevents">
    <div class="head">
        <div class="tabmenu">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link active" id="eventstab" type="button" onclick="ajax_myevent('<?php echo $requestId ; ?>',0)">Events</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="gdiesclk" type="button" onclick="ajax_mygoodies('<?php echo $requestId ; ?>',0)">Goodies</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="myevntsection">
        <div id="sm_evnt" class="sellbox s_mevnt">
		
        </div>

        <div id="sm_gds" class="sellbox s_mgds" style="display: none;">
		
            
        </div>
    </div>
</div>

<!-- Cancel booking  -->
<div class="modal fade basic_infofrom bk_modal" id="cancel_booking" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel your booking</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                <!-- <h3>Cancel your booking</h3> -->
               


                <form id="cnacelBooking_info" action="javascript:void(0);" method="post">
                    <div class="aef_bx">
                    <h6>Are you sure you want to cancel your booking?</h6>
                        <input type="hidden" name="bookingId" id="bookingId" >
                        <div class="form-group">
                            <label for=""><b>Please give Reason of Cancellation</b></label>
                            <textarea class="form-control"  name="cancelReason" id="cancelReason" cols="12" rows="5"></textarea>
                            <span id="err_cancelReason" class="err" style="color:red"></span>
                        </div>
                        <div class="button-group">
                            <button type="button" class="btn" onclick="cancelBooking()">Yes, Cancel Booking</button>
                           <!--  <button type="button" class="btn" data-bs-dismiss="modal"
                                aria-bs-label="Close">Cancel</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    
    $(document).ready(function(){
        var requestId='<?php echo $requestId ; ?>' ;      
        ajax_myevent(requestId,0);
    });

$("#eventstab").click(function (){
        $("#sm_evnt").show();
        $("#sm_gds").hide();
        $("#eventstab").addClass('active');
        $("#gdiesclk").removeClass('active');        
    });

    $("#gdiesclk").click(function (){
        $("#sm_evnt").hide();
        $("#sm_gds").show();
        $("#eventstab").removeClass('active');
        $("#gdiesclk").addClass('active');        
    });

//   function ajaxCsrf() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
// }

 
  

  function cancelModal(eventId){
    $('#bookingId').val(eventId);
  }
</script>

@extends('includes.website.ajax_template') 
@section('content')
 <link rel="stylesheet" href="{{asset('public/website/css/fm.selectator.jquery.css')}}">

    <link href="{{ URL('/').'/public/website/group_chat/jquery.multiselect.css' }}" rel="stylesheet" type="text/css">
<div class="sell_box" id="Events">
  <div class="head">
    <h3>Events</h3>
    <div class="tabmenu">
      <button type="button" class="btn_filter" data-bs-toggle="modal" data-bs-target="#filter_modal"><i class="ri-filter-2-fill"></i> Filter</button>
      <ul class="nav nav-tabs" id="get_tab_id" role="tablist">
        <li class="nav-item" role="presentation" id="all">
          <button class="nav-link active" id="All-tab" value="all"  data-bs-toggle="tab" data-bs-target="#All-menu" type="button" role="tab" aria-selected="true">All</button>
        </li>
        <li class="nav-item" role="presentation" id="paid">
          <button class="nav-link" id="Paid-tab" value="paid" data-bs-toggle="tab" data-bs-target="#Paid-menu" type="button" role="tab" aria-selected="false" tabindex="-1">Paid</button>
        </li>
        <li class="nav-item" role="presentation" id="unpaid">
          <button class="nav-link" id="Unpaid-tab" value="unpaid" data-bs-toggle="tab" data-bs-target="#Unpaid-menu" type="button" role="tab" aria-selected="false" tabindex="-1">Unpaid</button>
        </li>
      </ul>
    </div>
  </div>
  <div class="Box_details_sect">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="All-menu" role="tabpanel" aria-labelledby="All-tab">
        <div class="post_list" id="event_listing_all"></div>
      </div>
      <div class="tab-pane fade" id="Paid-menu" role="tabpanel" aria-labelledby="Paid-tab">
        <div class="post_list" id="event_listing_paid"></div>
      </div>
      <div class="tab-pane fade" id="Unpaid-menu" role="tabpanel" aria-labelledby="Unpaid-tab">
        <div class="post_list" id="event_listing_unpaid"></div>
      </div>
      <div class="no_record_box" style="display:none" id="event_not_found">
				<div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt=""> </div>
				<h3>No record Found</h3>
				<p>Event Not found</p>  
			  </div>	  
    </div>  
  </div>
</div>
<!-- Modal -->
<div class="modal fade small_modal" id="filter_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Find Events</h5>
        <button type="button" class="close" data-bs-dismiss="modal" id="eventFilterModal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">          
        </button>
      </div>
      <form id="search_event" method="post" action="javascript:void(0);">  
      <div class="modal-body">
        <div class="form_feel">
          <div class="form-group">
            <label for="">Events Name</label>  
            <input type="text" name="s_event_name" id="s_event_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Event Date</label>
            <input type="date" name="s_event_date" id="s_event_date" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Country</label>
              <select name="s_event_country"  id="s_event_country" class="form-control">
               <!-- <option value="">Select Country</option> -->
                <?php foreach($country_list as $countryData){  ?>
                    <option value="<?php echo $countryData->id ; ?>" id="ctr_<?php echo $countryData->id ; ?>" ><?php echo $countryData->name ; ?></option>
                <?php } ?>  

            </select>
          </div>
          <div class="form-group cty" id="eventCity">
            <label for="">City</label>
            <select name="s_event_city" id="s_event_city" class="form-control" ><option value="">Select City</option></select>
          </div>
          <div class="button-group">
            <button type="button" class="btn" onclick="filter_event('all');">Find</button>
          </div>
        </div>        
      </div>
     </form>	  
    </div>
	<!--  -->
  </div>
</div>

<div class="modal fade small_modal" id="join_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">      
      <div class="modal-header border-0 p-0">        
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">       
        </button>
      </div>
      <div class="modal-body">

        <div class="join_cont">

          <div class="jc_head">
            <i class="ri-checkbox-circle-fill"></i>
            <h3>You have Succeeded</h3>
          </div>
          
          <p class="jc_dec">Now sit back and relax. Now it was our work to check out your details. We will send you Email Confirmation once we are done.</p>

          <div class="jc_name">
            <p>In mean time, Know about</p>
            <h4>Golden Girls</h4>
          </div>

          <div class="button-group">
            <button type="button" class="btn">About Golden Girls</button>
          </div>

        </div>
      </div>       
    </div>
  </div>
</div>

<div class="modal fade edit_post_modal" id="editComment" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Comment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body" id="edit_comment_model_id">

      </div>

    </div>
  </div>
</div>

<div class="modal fade edit_post_modal" id="editReplyComment" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Reply Comment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body" id="edit_reply_comment_model_id">

      </div>

    </div>
  </div>
</div>


<script src="{{ URL('/').'/public/website/group_chat/jquery.min.js' }}"></script>
  <script src="{{ URL('/').'/public/website/group_chat/jquery.multiselect.js' }}"></script>
<script type="text/javascript">

 $(document).ready(function(){
     var tab_id = $("#tab_Id_data").val();
    event_listing(tab_id);
 });


  
   $('#s_event_country').change(function(e) {
     
        var selected = $('#s_event_country').val();
         
      if(selected!=''){

        ajaxCsrf();

         var fromData=$("#search_event").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/getEventCityFront',
        data:fromData,
        success: function (response) {        
          if(response.trim()!=='fail'){

            $('#eventCity').html(response);

          }else{
             $('#eventCity').html('<label for="">City</label><select name="s_event_city" id="s_event_city" class="form-control" ><option value="">Select City</option></select> ');
          }
        }
    });
      }else{
        $('#eventCity').html('<label for="">City</label><select name="s_event_city" id="s_event_city" class="form-control" ><option value="">Select City</option></select> ');
      } 
    }); 

function resetFilter(){

}
function editEventComment(eventId,commentId){       
      ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/editEventComment',
        data:{'postId':eventId,'commentId':commentId},
        success: function (response) {
            $('#edit_comment_model_id').html(response);
        }
    });
}

function updateEventComment(eventId){
     ajaxCsrf();

      var fromData=$("#edit_comment_forms_id").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/updateEventComment',
        data:fromData,
        success: function (response) {
            $("#edit_comment_forms_id")[0].reset();
            $('#editComment').modal('hide');
            event_save_comment(eventId, 1);
        }
    });
}

function editEventReplyComment(replyId,eventId){      
     ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/editERComment',
        data:{'eventId':eventId,'replyId':replyId},
        success: function (response) {
            $('#edit_reply_comment_model_id').html(response);
        }
    });
}

function updateEventReplyComment(eventId){
     ajaxCsrf();

      var fromData=$("#edit_reply_comment_forms_id").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/updateERComment',
        data:fromData,
        success: function (response) {

            $("#edit_reply_comment_forms_id")[0].reset();
            $('#editReplyComment').modal('hide');
            event_save_comment(eventId, 1);
        }
    });
}


</script>


@stop 
<?php //echo "<pre>";print_r($eventInfo);die;   ?>  
<form action="javascript:void(0);" method="post" id="editEventForm" enctype="multipart/form-data">
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form">  
        <div class="form-group">
            <label for="edit_event_name">Event Name</label>
             <input type="text" name="edit_event_name" id="edit_event_name"  value="<?php echo isset($eventInfo->event_name)?$eventInfo->event_name:'' ; ?>" class="form-control" placeholder="Event Name">
             <span id="err_editSTitle" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_type">Event Type</label>
             <select name="edit_event_type" id="edit_event_type" class="form-control" >
							    <option value="">Select</option>
								<?php foreach($event_type_data as $event_type_datas){   ?>
                                <option value="<?php echo $event_type_datas->id; ?>"<?php echo $event_type_datas->id == $eventInfo->event_type ? ' selected="selected"' : '';?>><?php echo $event_type_datas->type_name;  ?></option>
								<?php } ?>								
                            </select>
             <span id="err_edit_event_type" class="err" style="color:red"></span>
        </div>  
		</div>
		<div class="form modal-form" >
                    <div class="form-group">
                        <label for="edit_event_country">Event Country</label>
                          <select name="edit_event_country" id="edit_event_country" class="form-control">
							    <option value="">Select</option>
								<?php foreach($country_data as $country_datas){ ?>
                                <option value="<?php echo $country_datas->id; ?>"<?php echo $country_datas->id == $eventInfo->country ? ' selected="selected"' : '';?>><?php echo $country_datas->name;  ?></option>
								<?php } ?>								
                            </select>
							<span id="err_edit_event_country" class="err" style="color:red"></span>
                    </div>  
                </div>
				<div class="form modal-form">
                    <div class="form-group" id="editEventCity">
                        <label for="edit_event_city">Event City</label>
						 <select name="edit_event_city" id="edit_event_city" class="form-control">  
							    <option value="">Select</option>
								<option value="<?php echo $eventInfo->city_id;?>" selected><?php echo $eventInfo->city ;?></option>
																
                   </select>
						<span id="err_edit_event_city" class="err" style="color:red"></span>
                    </div>  
                </div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_fee_type">Event Fee Type</label>   
             <select name="edit_event_fee_type" id="edit_event_fee_type" class="form-control">
							    <option value="">Select</option>
								<?php foreach($fee_data as $fee_datas){ ?>
                                <option value="<?php echo $fee_datas->id; ?>"<?php echo  $fee_datas->id == $eventInfo->event_fee_type ? ' selected="selected"' : '';?>><?php echo $fee_datas->fee_type;  ?></option>
								<?php } ?>	 							
                            </select>  
             <span id="err_edit_event_fee_type" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_address">Event Address</label>
             <input type="text" name="edit_event_address" id="edit_event_address"  value="<?php echo isset($eventInfo->address)?$eventInfo->address:'' ; ?>" class="form-control" placeholder="Event Address">
             <span id="err_edit_event_address" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_price">Event Price</label>
             <input type="number" name="edit_event_price" id="edit_event_price"  value="<?php echo isset($eventInfo->event_price)?$eventInfo->event_price:'' ; ?>" class="form-control" placeholder="Event Price">
             <span id="err_edit_event_price" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">  
            <label for="edit_event_seats">Quantity</label>
             <input type="number" name="edit_event_seats" id="edit_event_seats"  value="<?php echo isset($eventInfo->total_seats)?$eventInfo->total_seats:'' ; ?>" class="form-control" placeholder="Quantity">
             <span id="err_edit_event_seat" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_date">Event Date</label>
             <input type="datetime-local" name="edit_event_date" id="edit_event_date"  value="<?php echo isset($eventInfo->event_date)?$eventInfo->event_date:'' ; ?>" class="form-control" placeholder="Event Date">
             <span id="err_edit_event_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_start_date">Start Date</label>
             <input type="date" name="edit_start_date" id="edit_start_date"  value="<?php echo isset($eventInfo->event_start_date)? date("Y-m-d", strtotime($eventInfo->event_start_date)):'' ; ?>" class="form-control" placeholder="Start Date">
             <span id="err_edit_event_start_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_end_date">End Date</label>
             <input type="date" name="edit_end_date" id="edit_end_date"  value="<?php echo isset($eventInfo->event_end_date)? date("Y-m-d", strtotime($eventInfo->event_end_date)):'' ; ?>" class="form-control" placeholder="End Date">
             <span id="err_edit_event_end_date" class="err" style="color:red"></span>
        </div>
      </div>	
       <div class="form modal-form">  	  
		<div class="form-group">
            <label for="edit_event_descrption">Event Descrption</label>
             <input type="text" name="edit_event_descrption" id="edit_event_descrption"  value="<?php echo isset($eventInfo->event_descrption)?$eventInfo->event_descrption:'' ; ?>" class="form-control" placeholder="Event Descrption">
             <span id="err_edit_event_descrption" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_image">Event Image</label>
             <input type="file" name="edit_event_image[]"  id="edit_event_image"  value="<?= isset($eventInfo->image)?$eventInfo->image:'' ; ?>" class="form-control" placeholder="Event Image" multiple>
             <span id="err_edit_event_image" class="err" style="color:red"></span>
        </div>
		</div>
    </div>           
    <div class="mt-4">
        <a href="javascript:void(0);"  onclick="updateEvent()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>

</form>
<script>
$('#edit_event_country').change(function(e) {
        var selected = $('#edit_event_country').val();
      if(selected!=''){
        ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/getEditEventCity',  
        data:{id:selected},
        success: function (response) {
          if(response.trim()!=='fail'){  

            $('#editEventCity').html(response);

          }else{
             $('#editEventCity').html('<label for="edit_event_city">Event City</label><select name="edit_event_city" id="edit_event_city" class="form-control"><option value="">Select</option></select>');
          }
        }
    });
      }else{
        $('#editEventCity').html('<label for="edit_event_city">Event City</label><select name="edit_event_city" id="edit_event_city" class="form-control"><option value="">Select</option></select>');
      } 
    });


</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/admin/event/event/editEvent.blade.php ENDPATH**/ ?>
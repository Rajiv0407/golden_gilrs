<?php //echo "<pre>";print_r($couponInfo);die;   ?>  
<form action="javascript:void(0);" method="post" id="editCouponForm" enctype="multipart/form-data">
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form">  
        <div class="form-group">
            <label for="edit_event_name">Coupon Title</label>
             <input type="text" name="edit_coupon_title" id="edit_coupon_title"  value="<?php echo isset($couponInfo->coupon_title)?$couponInfo->coupon_title:'' ; ?>" class="form-control" placeholder="Event Name">
             <span id="err_couponTitle" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_coupon_event_name">Event Name</label>   
             <select name="edit_coupon_event_name" id="edit_coupon_event_name" class="form-control">
							    <option value="">Select</option>
								<?php foreach($event_data as $event_datas){ ?>
                                <option value="<?php echo $event_datas->id; ?>"<?php echo  $event_datas->id == $couponInfo->event_id ? ' selected="selected"' : '';?>><?php echo $event_datas->event_name;  ?></option>
								<?php } ?>	 		  					
                            </select>  
             <span id="err_edit_event_coupon_name" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_coupon_value_type">Value Type</label>
             <select name="edit_coupon_value_type" id="edit_coupon_value_type" class="form-control" >
							    <option value="">Select</option>
								<?php foreach($coupon_type_data as $coupon_type_datas){   ?>
                                <option value="<?php echo $coupon_type_datas->id; ?>"<?php echo $coupon_type_datas->id == $couponInfo->coupon_type ? ' selected="selected"' : '';?>><?php echo $coupon_type_datas->type;  ?></option>
								<?php } ?>								
                            </select>
             <span id="err_edit_event_type" class="err" style="color:red"></span>
        </div> 
       </div>
        <div class="form modal-form">  	   
		<div class="form-group">
            <label for="edit_event_name">Value</label>
             <input type="text" name="edit_coupon_value" id="edit_coupon_value"  value="<?php echo isset($couponInfo->coupon_value )?$couponInfo->coupon_value :'' ; ?>" class="form-control" placeholder="Coupon Value">
             <span id="err_couponValue" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_coupon_start_date">Start Date</label>
             <input type="date" name="edit_coupon_start_date" id="edit_coupon_start_date"  value="<?php echo isset($couponInfo->start_date)? date("Y-m-d", strtotime($couponInfo->start_date)):'' ; ?>" class="form-control" placeholder="Coupon Start Date">
             <span id="err_edit_event_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_event_date">End Date</label>
             <input type="date" name="edit_coupon_end_date" id="edit_coupon_end_date"  value="<?php echo isset($couponInfo->end_date)? date("Y-m-d", strtotime($couponInfo->end_date)):'' ; ?>" class="form-control" placeholder="Event Price">
             <span id="err_edit_event_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_coupon_status">Status</label>
             <select name="edit_coupon_status" id="edit_coupon_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1"<?php echo $couponInfo->status == 1 ? ' selected="selected"' : '';?>>Active</option>
                                <option value="2" <?php echo $couponInfo->status == 2 ? ' selected="selected"' : '';?>>In Active</option>
                            </select>
             <span id="err_edit_event_date" class="err" style="color:red"></span>
        </div>
		</div>
		
    </div>           
    <div class="mt-4">
        <a href="javascript:void(0);"  onclick="updateEvent()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>

</form>
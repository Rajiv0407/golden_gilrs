<?php //echo "<pre>";print_r($eventInfo);   ?>  
<form action="javascript:void(0);" method="post" id="editGoodiesForm" enctype="multipart/form-data">
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form">  
        <div class="form-group">
            <label for="edit_goodies_title">Goodies Title</label>
             <input type="text" name="edit_goodies_title" id="edit_goodies_title"  value="<?php echo isset($eventInfo->title)?$eventInfo->title:'' ; ?>" class="form-control" placeholder="Goodies Title">
             <span id="err_goodies_title" class="err" style="color:red"></span>
        </div>
	</div>
	<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_goodies_fee_type">Goodies Fee Type</label>
             <select name="edit_goodies_fee_type" id="edit_goodies_fee_type" class="form-control">
							    <option value="">Select</option>
                                <option value="1"<?php echo $eventInfo->goodies_fee_type == 1 ? ' selected="selected"' : '';?>>Paid</option>
                                <option value="3" <?php echo $eventInfo->goodies_fee_type == 3 ? ' selected="selected"' : '';?>>Free</option>
                            </select>
             <span id="err_edit_goodies_fee_type" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
        <div class="form-group">
            <label for="edit_goodies_address">Goodies Address</label>
             <input type="text" name="edit_goodies_address" id="edit_goodies_address"  value="<?php echo isset($eventInfo->goodies_address)?$eventInfo->goodies_address:'' ; ?>" class="form-control" placeholder="Goodies Address">    
             <span id="err_edit_goodies_address" class="err" style="color:red"></span>
        </div>
	</div>
	<div class="form modal-form">  
        <div class="form-group">
            <label for="edit_goodies_seats">Goodies Seats</label>
             <input type="text" name="edit_goodies_seats" id="edit_goodies_seats"  value="<?php echo isset($eventInfo->goodies_seats)?$eventInfo->goodies_seats:'' ; ?>" class="form-control" placeholder="Goodies Seats">
             <span id="err_edit_goodies_seats" class="err" style="color:red"></span>
        </div>
	</div>
		
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_goodies_start_date">Start Date</label>
             <input type="date" name="edit_goodies_start_date" id="edit_goodies_start_date"  value="<?php echo isset($eventInfo->start_date)? date("Y-m-d", strtotime($eventInfo->start_date)):'' ; ?>" class="form-control" placeholder="Coupon Start Date">
             <span id="err_goodies_start_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_goodies_end_date">End Date</label>
             <input type="date" name="edit_goodies_end_date" id="edit_goodies_end_date"  value="<?php echo isset($eventInfo->end_date)? date("Y-m-d", strtotime($eventInfo->end_date)):'' ; ?>" class="form-control" placeholder="End Date">
             <span id="err_goodies_end_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_goodies_date">Goodies Date</label>
             <input type="datetime-local" name="edit_goodies_date" id="edit_goodies_date"  value="<?php echo isset($eventInfo->goodies_date)?$eventInfo->goodies_date:'' ; ?>" class="form-control" placeholder="Goodies Date">
             <span id="err_goodies_end_date" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_coupon_status">Status</label>
             <select name="edit_goodies_status" id="edit_goodies_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1"<?php echo $eventInfo->status == 1 ? ' selected="selected"' : '';?>>Active</option>
                                <option value="2" <?php echo $eventInfo->status == 2 ? ' selected="selected"' : '';?>>In Active</option>
                            </select>
             <span id="err_edit_goodies_status" class="err" style="color:red"></span>
        </div>
		</div>  
		<div class="form modal-form">
                    <div class="form-group">  
                        <label for="edit_goodies_image">Goodies Image</label>
                         <input type="file" name="edit_goodies_image" id="edit_goodies_image" value="<?php !empty($eventInfo->image) ? $eventInfo->image:""; ?>"  class="form-control" placeholder="Goodies Image">
                    </div>
         </div>
		<div class="form modal-form">  
		<div class="form-group">
            <label for="edit_goodies_descrption">Goodies Descrption</label>
             <input type="text" name="edit_goodies_descrption" id="edit_goodies_descrption"  value="<?php echo isset($eventInfo->goodies_descrption)? $eventInfo->goodies_descrption:'' ; ?>" class="form-control" placeholder="Goodies Descrption">
             <span id="err_edit_goodies_descrption" class="err" style="color:red"></span>
        </div>
		</div>
		
		
		
		
    </div>           
    <div class="mt-4">  
        <a href="javascript:void(0);"  onclick="updateGoodies()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>

</form>
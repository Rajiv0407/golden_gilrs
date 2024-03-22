<?php //echo "<pre>";print_r($couponInfo);die;   ?>  
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
                        <label for="edit_goodies_image">Goodies Image</label>
                         <input type="file" name="edit_goodies_image" id="edit_goodies_image" value="<?php !empty($eventInfo->image) ? $eventInfo->image:""; ?>"  class="form-control" placeholder="Goodies Image">
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
             <input type="date" name="edit_goodies_end_date" id="edit_goodies_end_date"  value="<?php echo isset($eventInfo->end_date)? date("Y-m-d", strtotime($eventInfo->end_date)):'' ; ?>" class="form-control" placeholder="Event Price">
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
		
    </div>           
    <div class="mt-4">  
        <a href="javascript:void(0);"  onclick="updateGoodies()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>

</form>
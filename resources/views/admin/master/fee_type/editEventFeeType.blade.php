
<form action="javascript:void(0);" method="post" id="editFeeTypeForm" enctype="multipart/form-data">
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form event_type">
        <div class="form-group">
            <label for="Manufacture">Event Fee Type</label>
             <input type="text" name="edit_event_fee_type" id="edit_event_fee_type"  value="<?php echo isset($eventTypeInfo->fee_type)?$eventTypeInfo->fee_type:'' ; ?>" class="form-control" placeholder="Title">
             <span id="err_editSFee" class="err" style="color:red"></span>
        </div>
		<?php //$status=$eventTypeInfo->status;   ?>
		<div class="form-group">
                            <label for="edit_fee_status">Status</label>
                            <select name="edit_fee_status" id="edit_fee_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1" {{$eventTypeInfo->status == "1"? 'selected' : ''}}> Active</option>
                                <option value="0" {{$eventTypeInfo->status == "0"? 'selected' : ''}}>In Active</option>
                            </select>
							<span id="err_fee_status" class="err" style="color:red"></span>
                </div>
    </div>           
    <div class="mt-3">
        <a href="javascript:void(0);"  onclick="updateEventfee()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>

</form>
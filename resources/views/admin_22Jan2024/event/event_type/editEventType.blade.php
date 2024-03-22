
<form action="javascript:void(0);" method="post" id="editFeatureForm" enctype="multipart/form-data">
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form">
        <div class="form-group">
            <label for="Manufacture">Event Type</label>
             <input type="text" name="edit_event_type" id="edit_event_type"  value="<?php echo isset($eventTypeInfo->type_name)?$eventTypeInfo->type_name:'' ; ?>" class="form-control" placeholder="Title">
             <span id="err_editSTitle" class="err" style="color:red"></span>
        </div>
		<div class="form-group">
            <label for="Manufacture">Event Type Image</label>
             <input type="file" name="edit_event_type_image" id="edit_event_type_image"  value="<?= isset($eventTypeInfo->image)?$eventTypeInfo->image:'' ; ?>" class="form-control" placeholder="Image">
             <span id="err_edit_event_type_image" class="err" style="color:red"></span>
        </div>
    </div>           
    <div class="mt-4">
        <a href="javascript:void(0);"  onclick="updateNFor()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>

</form>
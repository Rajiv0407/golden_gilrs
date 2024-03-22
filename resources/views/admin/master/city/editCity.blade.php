
<form action="javascript:void(0);" method="post" id="editCityForm" enctype="multipart/form-data">  
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form"> 
        <div class="form-group">
            <label for="Manufacture">City</label>
             <input type="text" name="edit_city" id="edit_city"  value="<?php echo isset($cityInfo->name)?$cityInfo->name:'' ; ?>" class="form-control" placeholder="City">
             <span id="err_edit_city" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">
		<div class="form-group">
		<label for="edit_city_status">Status</label>
		<select name="edit_city_status" id="edit_city_status" class="form-control">
			<option value="">Select</option>
			<option value="1" {{$cityInfo->flag == "1"? 'selected' : ''}}> Active</option>
			<option value="0" {{$cityInfo->flag == "0"? 'selected' : ''}}>In Active</option>
		</select>
		<span id="err_edit_city_status" class="err" style="color:red"></span>
	   </div>
    </div>             
    <div class="mt-4">
        <a href="javascript:void(0);"  onclick="updateNForCity()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>  
</form>
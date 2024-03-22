
<form action="javascript:void(0);" method="post" id="editCountryForm" enctype="multipart/form-data">  
    <input type="hidden" name="updatedId" id="updatedId" value="<?php echo isset($updatedId)?$updatedId:'' ; ?>">
    
    <div class="form modal-form">
        <div class="form-group">
            <label for="Manufacture">Country</label>
             <input type="text" name="edit_country" id="edit_country"  value="<?php echo isset($countryInfo->name)?$countryInfo->name:'' ; ?>" class="form-control" placeholder="Country">
             <span id="err_edit_country" class="err" style="color:red"></span>
        </div>
		</div>
		<div class="form modal-form">
		<div class="form-group">
		<label for="edit_country_status">Status</label>
		<select name="edit_country_status" id="edit_country_status" class="form-control">
			<option value="">Select</option>
			<option value="1" {{$countryInfo->flag == "1"? 'selected' : ''}}> Active</option>
			<option value="0" {{$countryInfo->flag == "0"? 'selected' : ''}}>In Active</option>
		</select>
		<span id="err_edit_country_status" class="err" style="color:red"></span>
	   </div>
    </div>             
    <div class="mt-4">
        <a href="javascript:void(0);"  onclick="updateNFor()" class="search-btn">Update</a>
        <a href="javascript:void(0);"  class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
    </div>  
</form>
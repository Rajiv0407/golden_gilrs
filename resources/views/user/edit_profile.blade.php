<style>
.err{
	color:red;
	
}
</style>
<div class="profile-content edt_form">
                    <div class="edt_head">
                        <div class="eh_name"><h3 class="ttl_name">Profile Information</h3></div>   
                    </div>
                    <form id="profile_forms" action="javascript:void(0);"  enctype="multipart/form-data" method="post">
             <div class="edt_form_list">
            <div class="form-group">
                <label class="ttl-n">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="edit_name" id="edit_name" value="<?= !empty($userInfo['name'])?$userInfo['name']:"";?>">
				<input type="hidden" name="user_id" id="user_id" value="<?= !empty($userInfo['id'])?$userInfo['id']:"";?>">
				<span id="error_edit_name" class="err"></span>
            </div>


            <div class="form-group">
                <label class="ttl-n">Email Address</label>
                <input type="text" class="form-control" placeholder="Enter email" name="edit_email" id="edit_email" value="<?= !empty($userInfo['email'])?$userInfo['email']:"";?>" disabled="">
				<span id="error_edit_email" class="err"></span>
            </div>

            <div class="form-group">
                <label class="ttl-n">Mobile Number</label>
                <input type="text" class="form-control" placeholder="Mobile Number" name="edit_phone" id="edit_phone" maxlength="13" value="<?= !empty($userInfo['phone'])?$userInfo['phone']:"";?>">
				<span id="error_edit_phone" class="err"></span>
            </div>

            <div class="form-group">
                <label class="ttl-n">DOB</label>
                <input type="date" class="form-control" data-date-format="DD MMMM YYYY" name="edit_dob" id="edit_dob" placeholder="DOB" value="<?= !empty($userInfo['dob'])?$userInfo['dob']:"";?>" max="2023-03-27">
				<span id="error_edit_dob" class="err"></span>
            </div>

            <div class="form-group">
                <label class="ttl-n">Male/Female</label>
                <select id="edit_gender" name="edit_gender" class="form-control">
                    <option <?php echo ($userInfo['gender'] == 'Male')?"selected":"" ?>>Male</option>
                    <option <?php echo ($userInfo['gender'] == 'Female')?"selected":"" ?>>Female</option>
                  </select>        
            </div>

            <div class="form-group custom-file">            
                <label class="ttl-n custom-file-label">Select Profile </label>
                <input type="file" class="form-control custom-file-input" name="profile_picture" id="profile_picture">
				 <span id="error_edit_picture" class="err"></span> 
                <span id="pf-msg" style="color: #ef5f5f;font-size: 12px;font-style: italic;font-weight: 500;">Please Upload a file in jpg, jpeg, png format only</span>    
                <div id="pf-error" class="d-none" style="color:red">Please Upload a file in jpg, jpeg, png format only</div>                         
            </div>
            <div class="form-group"></div>
            <div class="add_attr d-flex justify-content-left">
                <button class="btn btn-primary save-button" type="submit" onclick="update_profile()">Save</button>
                <a href="javascript:void(0);"  onclick="cancelFeature()" class="btn btn-outline-dark cancel-button">Cancel</a>
            </div>   
        </div>
</form>
</div>
<script>
function update_profile(){
        var edit_name = $('#edit_name').val();
		var edit_email = $('#edit_email').val();
		var edit_dob = $('#edit_dob').val();
		var edit_phone = $('#edit_phone').val();
		var edit_gender = $('#edit_gender').val();
		var profile_picture = $('#profile_picture').val();
		
        $('.err').html('');
        if(edit_name==''){
            $('#error_edit_name').html('Please enter name') ;
        }else if(edit_email==''){
            $('#error_edit_email').html('Please enter email') ;
        }else if(edit_dob== ''){
            $('#error_edit_dob').html('Please enter date of birth') ;
        }else if(edit_phone== ''){
            $('#error_edit_phone').html('Please enter phone');
        }else if(edit_gender== ''){
            $('#error_edit_phone').html('Please select gender');
        }else if(profile_picture== ''){
            $('#error_edit_picture').html('Please select profile pic');
        }else{
               //var formData = $('#profile_forms').serialize();
                var formData=new FormData($('#profile_forms')[0]);				
                 ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/update_profile',
            data:formData,
            contentType:false,
            processData:false,			
            beforeSend:function()
            {
                 //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;

            if(res.status==1){  
         	$('#lblErrorMsg').show(); 			
              //statusMesage('Profile updated successfully','success');
			  window.location = baseUrl + '/user/index#index';  
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          }
    }
	
	function cancelFeature(){
		edit_profile();
    }
	
	</script>
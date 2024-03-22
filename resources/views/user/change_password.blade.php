<style>
.err{
	color:red;
	
}
</style>

<div class="profile-content edt_form">
                    <div class="edt_head">
                        <div class="eh_name"><h3 class="ttl_name">Change Password</h3></div>   
                    </div>
                    <form id="change_password_forms" action="javascript:void(0);"  method="post">
             <div class="edt_form_list">
            <div class="form-group">
                <label class="ttl-n">Password</label>
                <input type="text" class="form-control" placeholder="Password" name="cha_password" id="cha_password">
				<input type="hidden" name="user_id" id="user_id" value="<?= !empty($userInfo['id'])?$userInfo['id']:"";?>">
				<span id="error_cha_password" class="err"></span>
            </div>
            <div class="form-group">
                <label class="ttl-n">Confirm Password</label>
                <input type="text" class="form-control" placeholder="Confirm Password" name="con_password" id="con_password">
				<span id="error_con_password" class="err"></span>
            </div>

            <div class="form-group"></div>
            <div class="add_attr d-flex justify-content-left">
                <button class="btn btn-primary save-button" type="submit" onclick="update_password()">Save</button>
                <a href="javascript:void(0);"  onclick="cancelFeature()" class="btn btn-outline-dark cancel-button">Cancel</a>
            </div>   
        </div>
</form>
</div>
<script>

function update_password(){
		var cha_password = $('#cha_password').val();
		var con_password = $('#con_password').val();
        $('.err').html('');
        if(cha_password==''){
            $('#error_cha_password').html('Please enter password');
        }else if(con_password ==''){
			$('#error_con_password').html('Please enter confirm password') ;
		}else if(con_password != cha_password){
			$('#error_con_password').html('New password and confirm password does not matach') ;
		}else{
               var formData = $('#change_password_forms').serialize();		   
                 ajaxCsrf();
        $.ajax({
            type:"POST",
            url:baseUrl+'/update_password',
            data:formData, 
            dataType:'json',
            beforeSend:function()
            {
                 //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;

             if(res.status==1){
				 $('#change_password_forms')[0].reset();             
              statusMesage('Password change successfully','success');
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          }
    }
	
	

	
	
	
	</script>
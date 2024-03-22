 <div class="tab-pane fade" id="Settings-menu" role="tabpanel" aria-labelledby="Settings-tab">
            <div class="card_bx_edit">
              <div class="head">
                <h3>Edit Profile</h3>
              </div>
			  <form id="update_profile" action="javascript:void(0);" enctype="multipart/form-data" method="post">
              <div class="Infor-sect">
                <h3>Basic Information</h3>
                  
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="<?php echo !empty($users['first_name'])?$users['first_name']:""; ?>" class="form-control" placeholder="First Name">
							<span id="error_edit_first_name" class="err"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">Last Name</label>
                            <input type="text"  name="last_name" id="last_name" value="<?php echo !empty($users['last_name'])?$users['last_name']:""; ?>" class="form-control" placeholder="Last Name">
							<span id="error_edit_last_name" class="err"></span>
                        </div>
                    </div>
					<div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">Gender</label>
                            <input type="text"  name="gender" id="gender" value="<?php echo !empty($users['gender'])?$users['gender']:""; ?>" class="form-control" placeholder="Gender">
							<span id="error_edit_gender_name" class="err"></span>
                        </div>
                    </div>
					<div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">Country</label>
                            <input type="text"  name="country" id="country" value="<?php echo !empty($users['country'])?$users['country']:""; ?>" class="form-control" placeholder="Country">
							<span id="error_edit_country_name" class="err"></span>
                        </div>
                    </div>
					<div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">City</label>
                            <input type="text"  name="city" id="city" value="<?php echo !empty($users['city'])?$users['city']:""; ?>" class="form-control" placeholder="City">
							<span id="error_edit_city_name" class="err"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                          <label for="">Date of Birth</label>
                          <input type="date" name="dob" id="dob" value="<?php echo !empty($users['dob'])?$users['dob']:""; ?>" placeholder="dd/mm/yy" class="form-control">
                          <span id="error_edit_dob_name" class="err"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">Hair Color</label>
                            <input type="text" name="hair_color" id="hair_color" value="<?php echo !empty($users['hair_color'])?$users['hair_color']:""; ?>" class="form-control" placeholder="Hair Color">
							<span id="error_edit_hair_color" class="err"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="frm-grp">
                            <label for="">Waist</label>
                            <input type="text" name="waist" id="waist" value="<?php echo !empty($users['waist'])?$users['waist']:""; ?>" class="form-control" placeholder="Waist">
							<span id="error_edit_waist" class="err"></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                      <div class="frm-grp">
                          <label for="">Height</label>
                          <input type="text" name="height" id="height" value="<?php echo !empty($users['height'])?$users['height']:""; ?>" class="form-control" placeholder="Height in Centimeter">
						  <span id="error_edit_height" class="err"></span>
                      </div>
                  </div>
                   <div class="col-lg-4 col-md-12 col-sm-12">
                      <div class="frm-grp">
                          <label for="">Weight</label>
                          <input type="text" name="weight" id="weight" value="<?php echo !empty($users['height'])?$users['height']:""; ?>" class="form-control" placeholder="Weight">
						  <span id="error_edit_weight" class="err"></span>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="frm-grp">
                        <label for="">Bust</label>
                        <input type="text" name="bust" id="bust" value="<?php echo !empty($users['bust'])?$users['bust']:""; ?>" class="form-control" placeholder="Bust">
						<span id="error_edit_bust" class="err"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                  <div class="frm-grp">
                      <label for="">Hips</label>
                      <input type="text" name="hips" id="hips" value="<?php echo !empty($users['hip_size'])?$users['hip_size']:""; ?>" class="form-control" placeholder="Hips">
					  <span id="error_edit_hips" class="err"></span>
                  </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="frm-grp">
                    <label for="">Hair Style</label>
                    <input type="text" name="hair_style" id="hair_style" value="<?php echo !empty($users['hair_style'])?$users['hair_style']:""; ?>" class="form-control" placeholder="Hair Style">
					<span id="error_edit_hair_style" class="err"></span>
                </div>
            </div>
			
			 <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="frm-grp">
                    <label for="">Eye Color</label>
                    <input type="text" name="eye_color" id="eye_color" value="<?php echo !empty($users['eye_color'])?$users['eye_color']:""; ?>" class="form-control" placeholder="Hair Style">
					<span id="error_edit_eye_color" class="err"></span>
                </div>
            </div>
			
			<div class="col-lg-4 col-md-12 col-sm-12">
                <div class="frm-grp">
                    <label for="">Smoking</label>
                    <input type="text" name="smoking" id="smoking" value="<?php echo !empty($users['smoking'])?$users['smoking']:""; ?>" class="form-control" placeholder="Hair Style">
					<span id="error_edit_smoking" class="err"></span>
                </div>
            </div>
			
			<div class="col-lg-4 col-md-12 col-sm-12">
                <div class="frm-grp">
                    <label for="">Know</label>
                    <input type="text" name="know" id="know" value="<?php echo !empty($users['know'])?$users['know']:""; ?>" class="form-control" placeholder="Hair Style">
					<span id="error_edit_know" class="err"></span>
                </div>
            </div>
			<div class="col-lg-4 col-md-12 col-sm-12">
                <div class="frm-grp">
                    <label for="">Interest</label>
                    <input type="text" name="interests" id="interests" value="<?php echo !empty($users['interests'])?$users['interests']:""; ?>" class="form-control" placeholder="Hair Style">
					<span id="error_edit_interests" class="err"></span>
                </div>
            </div>
			<div class="col-lg-4 col-md-12 col-sm-12">
                <div class="frm-grp">
                    <label for="">Marital Status</label>
                    <input type="text" name="marital_status" id="marital_status" value="<?php echo !empty($users['marital_status'])?$users['marital_status']:""; ?>" class="form-control" placeholder="Hair Style">
					<span id="error_edit_marital_status" class="err"></span>
                </div>
            </div>
                  
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="frm-grp textarea-hgt">
                            <label for="">About</label>
                            <textarea type="text" name="about_self" id="about_self" class="form-control" placeholder="Tell people about yourself" cols="30" rows="10"><?php echo !empty($users['self_des'])? strip_tags($users['self_des']):""; ?></textarea>
							<span id="error_edit_about" class="err"></span>
                        </div>
                    </div>
                    <div class="grp_btn">
                        <div class="grp_can">
                            <button class="Cancel_btn">Cancel</button>
                        </div>
                        <div class="grt_list">
                            <a href="#" class="btn">Reset</a>
                            <a href="#" class="btn" onclick="update_profile()">Save</a>
                        </div>
                    </div>



                </div>

            </div>
            </form>
            </div>
          </div>
		<script>
		
		
		function update_profile(){ 
		
        var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var gender = $('#gender').val();
		var country = $('#country').val();
		var city = $('#city').val();
		var hair_color = $('#hair_color').val();
		var dob = $('#dob').val();
		var waist = $('#waist').val();
		var height = $('#height').val();
		var bust = $('#bust').val();
		var weight = $('#weight').val();
		var hips = $('#hips').val();
		var hair_style = $('#hair_style').val();
		var eye_color = $('#eye_color').val();
		var smoking = $('#smoking').val();
		var interests = $('#interests').val();
		var marital_status = $('#marital_status').val();
		var about_self = $('#about_self').val();
		
		
        $('.err').html('');
        if(first_name==''){
            $('#error_edit_first_name').html('Please enter first name') ;
        } if(last_name==''){
            $('#error_edit_last_name').html('Please enter last name') ;
        }else if(gender==''){
            $('#error_edit_gender').html('Please select gender') ;
        }else if(country==''){
            $('#error_edit_country').html('Please enter country') ;
        }else if(city==''){
            $('#error_edit_city').html('Please enter city') ;
        }else if(hair_color==''){
            $('#error_edit_hair_color').html('Please enter hair color') ;
        }else if(dob==''){
            $('#error_edit_dob').html('Please enter dob') ;
        }else if(waist==''){
            $('#error_edit_waist').html('Please enter email') ;
        }else if(height==''){
            $('#error_edit_height').html('Please enter height') ;
        }else if(bust== ''){
            $('#error_edit_bust').html('Please enter Brust') ;
        }else if(weight== ''){
            $('#error_edit_weight').html('Please enter weight') ;
        }else if(hips== ''){
            $('#error_edit_hips').html('Please enter hips size') ;
        }else if(hair_style== ''){
            $('#error_edit_hair_style').html('Please enter hair style') ;
        }else if(eye_color== ''){
            $('#error_edit_eye_color').html('Please enter eye color') ;
        }else if(smoking== ''){
            $('#error_edit_smoking').html('Please select smoking') ;
        }else if(interests== ''){
            $('#error_edit_interests').html('Please enter interests') ;
        }else if(marital_status== ''){
            $('#error_edit_marital_status').html('Please enter marital status');
        }else if(about_self== ''){
            $('#error_edit_about_self').html('Please enter about');
        }else{
               //var formData = $('#profile_forms').serialize();
                var formData=new FormData($('#update_profile')[0]);				
                 ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/update_profile',
            data:formData,
            contentType:false,
            processData:false,	
            dataType:'json',			
            beforeSend:function()
            {
                 //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;
            if(res.status==1){
			   refreshDiv();
              $("#Settings-tab").on("click", function(){
			 $('#Settings-menu').load(' #Settings-menu')
			
			}); 			 
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          }
    }
	
	  function refreshDiv(){
		 $(".grid-container").load(location.href + " .grid-container");
	  }


      function accept_friend_request(id,status){ 
        ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/accept_friend_request',
            data:{id:id,status:status},            
            beforeSend:function()
            {
                  //$('#loadingGife').show();
               //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;
            if(res==2){
               $('#'+ id +'_accept').hide();
			   $('#'+ id +'_cancal').hide();
			   $('#'+ id +'_request_accepted').show();
			   
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          
    }	

     function cancal_friend_request(id,status){ 
        ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/cancal_friend_request',  
            data:{id:id,status:status},            
            beforeSend:function()
            {
                  //$('#loadingGife').show();
               //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;
            if(res==2){
               $('#'+ id +'_accept').hide();
			   $('#'+ id +'_cancal').hide();
			   $('#'+ id +'_cancelled').show();
			   
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          
    }		
		
		 function follow(id,status){ 
		
        ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/follow',
            data:{id:id,status:status},            
            beforeSend:function()
            {
                  //$('#loadingGife').show();
               //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;
            if(res==1){
               $('#'+ id +'_follow').hide();
			   $('#'+ id +'_following').show();
			   
            }else if(res==2){
				$('#'+ id +'_follow').show();
			   $('#'+ id +'_following').hide(); 
				
			}else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          
    }
	
	
		</script><?php /**PATH D:\xampp\htdocs\golden\resources\views/website/profile_tab.blade.php ENDPATH**/ ?>
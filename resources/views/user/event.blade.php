 <div class="edt_form">
                    <div class="edt_head">
                        <div class="eh_name"><h3 class="ttl_name">Event Listing</h3></div>
                        <div class="eh_btn">
						<span id="lblErrorMsg" style="cloor:green"></span>  
                            <!-- <a class="samebtn" href="/accounts/change-password/"><i class="ri-lock-line"></i> Change Password</a> -->
                         <!--s   <a class="samebtn remv_attr" href="{{URL::to('/')}}/user/index#edit_profile" onClick="edit_profile()"><i class="ri-edit-2-fill"></i> Add Event </a>  -->                                                              
                            
                        </div>
                    </div>
					<form id="add_event_forms" action="javascript:void(0);"  enctype="multipart/form-data" method="post">
               <div class="edt_form_list">
                            <div class="form-group">
                                <label class="ttl-n">Event Name</label>
                                <input type="name" class="form-control" name="event_name"  id="event_name" placeholder="Event Name" value="">
								<span id="error_event_name" class="err"></span>
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">Event Type</label>
                                <select id="event_type" name="event_type" class="form-control">
								    <option value="">Select Event Type</option>
									<?php foreach($event_type as $type_data ){ ?>
									<option value="<?php echo $type_data->id;  ?>"><?= $type_data->type_name; ?></option>
									<?php } ?>
								  </select>
								  <span id="error_event_type" class="err"></span>
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">address</label>
                                <input type="text" class="form-control" name="event_address" id="event_address" placeholder="address" value="" >
								<span id="error_event_address" class="err"></span>
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">Event Start date</label>
                                <input type="date" class="form-control" name="event_start_date" id="event_start_date" placeholder="Event Start date" value="" >
								<span id="error_event_start_date" class="err"></span>
                            </div>
							<div class="form-group">
                                <label class="ttl-n">Event End date</label>
                                <input type="date" class="form-control" name="event_end_date" id="event_end_date" placeholder="Event End date" value="" >
								<span id="error_event_end_date" class="err"></span>
                            </div>
							<div class="form-group">
                                <label class="ttl-n">Event Price</label>
                                <input type="text" class="form-control" name="event_price" id="event_price" placeholder="Event Price" value="" >
								<span id="error_event_price" class="err"></span>
                            </div>
							<div class="form-group">
                                <label class="ttl-n">Event Descrption</label>
                                <textarea name="event_descrption" id="event_descrption" cols="30" rows="4" class="ckeditor textarea_control w-100 "></textarea>
								<span id="error_event_descrption" class="err"></span>
                            </div>
							  <div class="form-group custom-file">            
									<label class="ttl-n custom-file-label">Event Image </label>
									<input type="file" class="form-control custom-file-input" name="event_image[]" id="event_image" multiple>
									 <span id="error_event_image" class="err"></span> 
									                            
								</div>
                                                  
                            <div class="add_attr">
                                <a href="javascript:void(0);" class="btn btn-primary" onClick="add_event()">Save</a>
                                <a href="javascript:void(0);" class="btn btn-outline-dark">Cancel</a>
                            </div> 
                    </div>
					</form>
 </div> 
 <script>
function add_event(){
	      
        var event_name = $('#event_name').val();
		var event_type = $('#event_type').val();
		var event_address = $('#event_address').val();
		var event_start_date = $('#event_start_date').val();
		var event_end_date = $('#event_end_date').val();
		var event_price = $('#event_price').val();
		var event_descrption = $('#event_descrption').val();
		var event_image = $('#event_image').val();
		
        $('.err').html('');
        if(event_name==''){
            $('#error_event_name').html('Please enter event name') ;
        }else if(event_type==''){
            $('#error_event_type').html('Please select event type') ;
        }else if(event_address== ''){
            $('#error_event_address').html('Please enter event address') ;
        }else if(event_start_date== ''){
            $('#error_event_start_date').html('Please select event start date');
        }else if(event_end_date== ''){
            $('#error_event_end_date').html('Please select event end date');
        }else if(event_price== ''){
            $('#error_event_price').html('Please enter event price');
        }else if(event_descrption== ''){
            $('#error_event_descrption').html('Please enter event descrption');  
        }else if(event_image== ''){
            $('#error_event_image').html('Please select event image');
        }else{
               //var formData = $('#profile_forms').serialize();
                var formData=new FormData($('#add_event_forms')[0]);				
                 ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/add_event',
            data:formData,
			dataType:'json',
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
            $('#add_event_forms')[0].reset();  			
            statusMesage('Event Added successfully','success');			
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
@extends('includes.website.ajax_template')
@section('content')
<div class="user_prof about_wrapp">
    <div class="about_banner">
        <div class="inner_wrapp">
            <div class="head_title">
                <h3>Contact Us</h3>
            </div>
            <form id="contactUs" action="javascript:void(0);" method="post">
                    <div class="aef_bx">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" value="" class="form-control" placeholder="Enter Name">
                            <span id="err_name" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email"  class="form-control" placeholder="Enter Email">
                            <span id="err_email" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Mobile Number</label>
                            <input type="text" name="mobile_number" id="mobile_number" value="" class="form-control" placeholder="Enter Mobile Number">
                            <span id="err_mobile_number" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Enquiry Type</label>
                            <select id="enquiry" name="enquiry" class="form-control">
                            	<option value="">Select</option>
                            	<?php if(!empty($enquiry)){ 
                            		   foreach ($enquiry as $key => $value) { ?> 
                            	<option value="<?php echo $value->Id ; ?>"><?php echo $value->Type ; ?></option>                            	
                            	<?php } } ?>
                            </select>
                            <span id="err_enquiry" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea class="form-control" id="message" name="message" placeholder="Please enter message."></textarea>
                        	<span id="err_message" class="err" style="color:red"></span>
                        </div>
                        <div class="button-group">
                            <button type="button" class="btn" onclick="contactUs()">Submit</button>
                            <button type="button" class="btn" onclick="resetContactForm()">Reset</button>
                        </div>
                    </div>
                </form>
			 




  
        </div>
    </div>
</div>
<script type="text/javascript">

	

	  function resetContactForm(){
         
        $('#contactUs')[0].reset();
        $('.err').html('');
    }

     function contactUs() {
       
        var name=$('#name').val();
        var email=$('#email').val();
        var mobileNumber=$('#mobile_number').val();
        var enquiryType=$('#enquiry').val();
        var message=$('#message').val();

        $('.err').html('');

        if(name==''){
          $('#err_name').text('Please enter name.');
        }else if(email==''){
          $('#err_email').text('Please enter email.');
        }else if(!validateEmail(email)){
	      $('#err_email').text('Please enter valid email.');
	    }else if(mobileNumber==''){
          $('#err_mobile_number').text('Please enter mobile number.');
        }else if(enquiryType==''){
          $('#err_enquiry').text('Please select enquiry type.');
        }else if(message==''){
          $('#err_message').text('Please enter message.');
        }else{

           $('#loader_spineer').show();

            var formData = $('#contactUs').serialize();
             ajaxCsrf();
            $.ajax({
            type: "POST",
            url: baseUrl+'/saveContactus',
            data:formData,
            cache: 'FALSE',
            beforeSend: function () {
            
            },
            success: function(html){
            $('#loader_spineer').hide();
             $('#contactUs')[0].reset();
             $('#contactUs_succ').show();
             setTimeout(function(){
                 $('#contactUs_succ').hide();
             },2000);

            }

            });
        }

    }


</script>
@stop

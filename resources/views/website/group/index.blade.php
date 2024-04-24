<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Golden Girls</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/website/chat/css/bootstrap.min.css')}}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/website/chat/css/intlTelInput.css')}}">
	 <link rel='stylesheet' href='https://harvesthq.github.io/chosen/chosen.css'>
    <link rel="stylesheet" href="{{asset('public/website/css/style.css?v=').time()}}">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="{{asset('public/website/css/fm.selectator.jquery.css')}}">

    <link href="{{ URL('/').'/public/website/group_chat/jquery.multiselect.css' }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/website/css/responsive.css?v=').time()}}">
     <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
</head>
<!--  --->

<body>
   <?php  $mobileDeduct=isMobileDev();  ?>
    <div class="grid-container" id="web_container">
        
         <?php if(!$mobileDeduct){ ?> 
        <header class="navbar_menu">
            @include('includes.website.header')
        </header>
      <?php } ?>
        <!--  -->
        <div class="main_cont">
            <div class="user_prof chtmssgbx">
                <div class="menu_section">
                    <div class="chat_head">
                       <?php if(!$mobileDeduct){ ?> 
                        <div class="head">
                            <h3>Group</h3>
                        </div>
                      <?php } else { ?> 
                        <div class="head_mobile ">
                           <button type="button" onclick="redirectHomepage()"><i class="ri-arrow-left-s-line"></i></button>
                           <h3>Group</h3>
                        </div>
                      <?php } ?>
                        <div class="button_bx">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#creatgroupmodal"><i class="ri-add-line"></i> Create Group</button>
                        </div>

                    </div>
                    



                    <div class="memu_inner">

                        <div class="menu_inner_list user_profile_menu chattab">
                            <?php  if(count($group_list) > 0) { ?>
                            <ul class="nav nav-tabs" role="tablist">         
                                @foreach($group_list as $user)
                                <li class="nav-item " id="userList_{{ $user->id }}" role="presentation">
                                    <button class="nav-link usrlist" id="{{ $user->id }}" data-bs-toggle="tab"
                                        data-bs-target="#Profile-menu" data-id="{{ $user->id }}" onclick="chatMessage('{{ $user->id }}')"
                                        type="button" role="tab" aria-selected="true">
                                        <span class="nk-menu-img">
                                            <?php if($user->groupImg!=''){ ?>
                                           <img id="add_notfi_no_img_{{ $user->id }}" src="{{$user->groupImg}}">
                                       <?php } ?>

                                        </span>
                                        <span class="nk-menu-text">
                                            <h3 id="add_notfi_no_{{ $user->id }}">{{ $user->group_name }}                                             

                                               @if($user->unread)
                                                <span class="notfi_no">{{ $user->unread }}</span>

                                                @endif 
                                            </h3>
                                        </span>
                                    </button>
                                </li>
                                @endforeach
                            
                            </ul>
                            <?php }else{  ?>
                              <div class="no_record_box">
                               <div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt=""> </div>
                               <h3>No record Found</h3>
                                <p>Group Not found</p>    
                                </div>  
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="section_right">
                   <div class="dash_sell_box ">
                    <div class="head">
                        <h3>Message</h3>
                    </div>
                  </div>
                    <div class="chat_dshbrd">

                        <div id="Profile-menu">
						<div class="dash_not_data">
                            <h3>Group Dashboard </h3>
							</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
          <?php if(!$mobileDeduct){ ?> 
        <footer class="footer_copy">
            @include('includes.website.footer')
        </footer>
      <?php } else { ?> 

            <div id="loader_spineer" style="display:none;">
            <div class="loader_bx">
            <span class="loader_inner"> </span>
            </div>
            </div>

        <?php } ?>

    </div>



 
<!-- Modal -->
<div class="modal fade modal_cust" id="creatgroupmodal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalLabel" aria-bs-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
	  <form action="javascript:void(0);" method="post" id="createGroup" enctype="multipart/form-data" >
          <div class="creatgrou_modal">
      <h3>Create a space</h3>
      <div class="frm_title">
      <div class="icon_bx">
      <label for="add_groupimg" class="add_img">
      <div class="upload_img">
       <img id="def_img" src="{{ URL('/').'/public/user_image/group_icon.png' }}" alt="">
	   <img id="blah" />
      </div>
          <div class="plus">
           <svg width="24px" height="24px" viewBox="0 0 24 24" class=" UB1zOd"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
           </div>
         <input type="file"  id="add_groupimg" name="add_groupimg" class="d-none" accept="image/png, image/gif, image/jpeg">  
      </label>
      </div>
      <div class="frm_grp">
      <div class="">
      <input type="text" class="form-control" id="group_name" name="group_name" placeholder="space name">
      <span id="error_group_name" class="err"></span>
	  </div>
      <div class="">
      <textarea type="text" class="form-control" id="group_description" name="group_description" placeholder="Description (optional)" maxlength="150" data-is-auto-expanding="true" ></textarea>
	 </div>
      </div><!--  -->
              </div>    
            <select name="groupUser[]" multiple id="groupUser">
                <?php foreach($user_list as $user_lists){  ?>
                    <option value="<?php echo $user_lists->id ; ?>" data-content="<img class='email' src='https://thdoan.github.io/bootstrap-select/images/icon-chrome.png'/>" ><?php echo $user_lists->name ; ?></option>
                <?php } ?>  

            </select>  
             <span id="error_group_user" class="err"></span>
             <div class="button-group"> 
                 <button class="btn " id="create" name="create" onclick="createGroup();">Create</button>
              <button class="btn " id="cancel_group" onclick="cancelGroup();" name="cancel">Cancel</button>                
             
               
            </div>

      </div>
      </form>
	  
       
      </div>
     
    </div>
  </div>
</div>
<!-- end -->

<!-- Update Group Detail -->


<!-- End -->
<!-- add Group member -->
<div class="modal fade modal_cust" id="addGroupMembermodal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalLabel" aria-bs-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" id="addGroupMember">
    
    
       
      </div>
     <span class="succ" style="color:green;" id="succ_add_group"></span>
      <span class="err" style="color:green;" id="err_add_group"></span>
    </div>
  </div>
</div>
<div class="sucmssg_box" id="create_group" style="display:none">
    <div class="btm_left_box_mdl">  
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Group has created successfully </p> 
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade basic_infofrom mang_memb_modal" id="manage-members" tabindex="-1" aria-labelledby="manage-membersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="manageMemberModal">
            
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="{{asset('public/website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/website/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('public/website/js/utils.js')}}"></script>
    <script src="{{asset('public/website/js/custom.js?v=1234')}}"></script>
    <script src='https://harvesthq.github.io/chosen/chosen.jquery.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

	<script src="{{asset('public/website/js/fm.selectator.jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script src="{{ URL('/').'/public/website/group_chat/jquery.min.js' }}"></script>
<script src="{{ URL('/').'/public/website/group_chat/jquery.multiselect.js' }}"></script>
<script>

   $("#blah").hide();
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $("#def_img").hide();
			$("#blah").show();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#add_groupimg").change(function(){
        readURL(this);
    });


 function groupManageMember_List(groupId,searchKey=''){
       

       $.ajax({
            type: "POST",
            url: baseUrl + '/groupManageMember/'+groupId,
            data:{"searchKey":searchKey},
            async: false,
            success: function(html) {                           
                $('#loader_spineer').hide();
               $('#groupManageMember').html(html);
               
            }

        });

 }

 function groupManageMemberSearch(groupId,searchKey=''){
    // if(searchKey.length > 3){
        groupManageMember_List(groupId,searchKey);
     //}
 }

 function groupManageMember(groupId,searchKey=''){
       

       $.ajax({
            type: "POST",
            url: baseUrl + '/groupManageMemberModal/'+groupId,
            data:{"searchKey":searchKey},
            async: false,
            success: function(html) {                           
                $('#loader_spineer').hide();
                $('#manageMemberModal').html(html);
               groupManageMember_List(groupId);
               
            }

        });

 }

  function cancelAddMember(){  
    $('#addGroupMemberForm')[0].reset();   
    $('#addGroupUser').multiselect('reload');
    $('#addGroupMembermodal').modal('hide');
  }

function updateGroupMember(){

    
   var groupUser = $('#addGroupUser').val() ;
   var options = $('#addGroupUser > option:selected');
   
    if(options.length == 0){
    $('#error_group_user').html('Please select group users') ;
         return false;
    }

     $('#loader_spineer').show();

  
     var formData=new FormData($('#addGroupMemberForm')[0]);
     var baseUrl = "{{ url('/') }}";
    $.ajax({
        type: "POST",
        url: baseUrl +'/updateGroupMember',
        data:formData ,
        dataType:'json',
        cache: 'FALSE',
        contentType:false,
        processData:false,
        beforeSend: function () { 
        },
        success: function(html){
           $('#loader_spineer').hide();

       if(html.status==1){
        $('#succ_add_group').html('Successfully add member in this group.');
        $('#group_member').text(html.total_participant);
        $('#succ_add_group').html('');
           cancelAddMember();
       
          
      //   $("#create_group").show();
      //   setTimeout(function() {
      //      $("#create_group").hide();  
      //   }, 2000);
      // $( "#web_container" ).load(window.location.href + " #web_container" );
      
        
       }else{
         $('#err_add_group').html('Something went wrong.');
        
       }        
        }
        });      
   
}


function cancelGroup(){
    
    $('#group_name').val('');
    $('#group_description').val('') ;
    $('#createGroup')[0].reset();
    $('#groupUser').multiselect('reload');
    $('#creatgroupmodal').modal('hide');
     
}


function createGroup(){
   var groupName = $('#group_name').val();
   var groupDescription = $('#group_description').val() ;
   var groupUser = $('#groupUser').val() ;
   var options = $('#groupUser > option:selected');
    if(groupName==''){
		$('#error_group_name').html('Please enter group name') ;
    }else if(options.length == 0){
		$('#error_group_user').html('Please select group users') ;
         return false;
    }else{
    // else if(options.length <= 2){
	// 	// $('#error_group_user').html('Please select more than 2 users') ;
    //      //alert('Please select more than 2 users.');
    //      return false;
    // }
    $('#loader_spineer').show();
     var formData=new FormData($('#createGroup')[0]);
     var baseUrl = "{{ url('/') }}";
    $.ajax({
        type: "POST",
        url: baseUrl +'/createGroup',
        data:formData ,
        dataType:'json',
        cache: 'FALSE',
        contentType:false,
        processData:false,
        beforeSend: function () { 
        },
        success: function(html){
          $('#loader_spineer').hide();
			 if(html.status==1){
				cancelGroup();
				$("#create_group").show();
				setTimeout(function() {
				   $("#create_group").hide();  
				}, 2000);
			$( "#web_container" ).load(window.location.href + " #web_container" );
			
				
			 }        
        }
        });      
   }

}



$('#groupUser').multiselect({
    columns: 1,
    placeholder: 'Select User',
    search: true,
   
});
</script>
<script>
    $('.search_user').click(function () {
      $('.search_user_list').addClass('d-block');
    });

    $(document).mouseup(function (e) {
      if ($(e.target).closest(".search_li").length === 0) {
        $('.search_user_list').removeClass('d-block');
      }
    });

        function getTime() {
            var dt = new Date();
            var time = dt.getHours() + ":" + (dt.getMinutes() < 10 ? '0' : '') + dt.getMinutes();
            return time;
        }

        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Enable pusher logging - don't include this in production
            ///Pusher.logToConsole = true;
             var appKey='<?php echo $APP_KEY ; ?>' ;
            var pusher = new Pusher(appKey, {
                cluster: 'ap2'
            });

           // var channel = pusher.subscribe('my-channel');
             var status = my_id;  
                var channel = pusher.subscribe(status);
            //+ ":" + dt.getSeconds()
            channel.bind('App\\Events\\Notify', function (data) {
                //alert(data);
              
                var image_d = '';
                var message = '';
                if(data.message.image.length > 0){

					 $.each(data.message.image, function (key, image_data) {
                     if(image_data.file_type == 'image'){						 
					 image_d +='<div class="media_img"><a href=' + image_data.file + ' data-fancybox="gallery" data-caption=""><img src=' + image_data.file + ' alt="" class="img_thmb"></a></div>';
					 }else if(image_data.file_type == 'video'){  
                      image_d+='<div class="media_video"><a data-fancybox="group-1" href=' + image_data.file + '><video width="300" height="200" class="vdo_thmb" controls><source  src=' + image_data.file + '></video></a></div>'						 
					 }else if(image_data.file_type=='application'){						 
					 image_d +='<div class="media_pdf"><embed src=' + image_data.file + '  alt=""></div>';
					 }  
					}); 
				} else {
                    var image_d = '';
                }


                if (data.message.message != '') {
                    //var message=data.message.message;
                    var message =data.message.message;
                } else {

                    // if (message == '' && filesToUploadImg.length==0 && filesToUploadVideo.length==0 && filesToUploadFile.length==0) {
                    // $('#err_message').html('Please enter message.');
                    // setTimeout(function(){
                    //      $('#err_message').html('');
                    // },1000);
                    // return false ;
                    // } 

                }

                 var activeUsrId = $(".usrlist").filter(".active").attr("id");

                // if (data.type == 1 ) {
                //     //alert(data.loginUserId);
                //     $('#add_notfi_no_' + data.from).append('<span></span>')
                // }
               
                
               //alert(my_id+' ' +data.from);
               if(data.message_type==2 && activeUsrId==data.from){
                 $('#history').append('<div class="message-notif"><p>'+message+'</p></div>');
                     scrollToBottomFunc();
               }else if (my_id != data.to && activeUsrId==data.from) { 
                    

                    $('#history').append('<div class="chat-mss"><ul><li><span class="chat_user_nme"><img src="'+data.message.fromImg+'" alt=""><span>'+data.sender_name+'</span></span><div class="replay-mss"><div class="cont_bx"><p>'+message+'</p><div class="list_media">'+image_d+'</div><div class="date">' + getTime() + '</div></div></div></li></ul></div>');

                     scrollToBottomFunc();

                } else  if (my_id == data.to){

                    if ($('.usrlist').hasClass('active')) {
                        
                        if (receiver_id == data.from && activeUsrId == data.from) {
                           
                            $("#userList_" + data.from).prependTo(".nav-tabs");
                            $('#history').append('<div class="chat-mss rply-mss"><ul><li><div class="replay-mss"><div class="cont_bx"><p>'+message+'</p><div class="list_media">'+image_d+'</div><div class="date"><svg viewBox="0 0 18 18" height="18" width="18" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 18 18"><title>status-dblcheck</title><path fill="currentColor" d="M17.394,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-0.427-0.388c-0.171-0.167-0.431-0.15-0.578,0.038L7.792,13.13 c-0.147,0.188-0.128,0.478,0.043,0.645l1.575,1.51c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C17.616,5.456,17.582,5.182,17.394,5.035z M12.502,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-2.614-2.556c-0.171-0.167-0.447-0.164-0.614,0.007l-0.505,0.516 c-0.167,0.171-0.164,0.447,0.007,0.614l3.887,3.8c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C12.724,5.456,12.69,5.182,12.502,5.035z"></path></svg>' + getTime() + '</div></div></div></li></ul></div>');
                            scrollToBottomFunc();
                        } else {

                            // $("#userList_" + data.from).prependTo(".nav-tabs");
                            // $('#history').append('<div class="chat-mss rply-mss"><ul><li><div class="replay-mss"><div class="cont_bx"><p>'+message+'</p><div class="list_media">'+image_d+'</div><div class="date">' + getTime() + '</div></div></div></li></ul></div>');    
                            // addNotification(data.from);
                            // scrollToBottomFunc();  
                        }


                    } else {
                        addNotification(data.from);
                    }
                }else{
                  addNotification(data.from);
                }

                //alert(JSON.stringify(data));


                //$("#userList_59").prependTo(".nav-tabs");

            });


            function addNotification(usrId) {
              
                $("#userList_" + usrId).prependTo(".nav-tabs");
                var existNotification = parseInt($('#add_notfi_no_' + usrId).find('.notfi_no').html());
                
                if (existNotification) {  
                    $('#add_notfi_no_' + usrId).find('.notfi_no').html(existNotification + 1);
                } else {                   
                    $('#add_notfi_no_' + usrId).append('<span class="notfi_no">1</span>');
                }
            }

            $(document).on('keyup', '#message', function (e) {

                var message = $(this).val();
                // check if enter key is pressed and message is not null also receiver is selected

                if (e.keyCode == 13 && message != '') {
                  chat_message_fn(receiver_id);
                    $(this).val(''); // while pressed enter text box will be empty
                    //alert(message);
                    // var datastr = "&message=" + message;
                    // $.ajax({
                    //     type: "post",
                    //     url: "group_message/" + receiver_id, // need to create this post route
                    //     data: datastr,
                    //     cache: false,
                    //     success: function (data) {

                    //     },
                    //     error: function (jqXHR, status, err) {
                    //     },
                    //     complete: function () {
                    //         scrollToBottomFunc();
                    //     }
                    // })
                }
            });


        });
        $('.search_btn').click(function () {
            $('.search_list').addClass('d-block');
        });

        $(document).mouseup(function (e) {
            if ($(e.target).closest(".search_li").length
                === 0) {
                $('.search_list').removeClass('d-block');
            }
        });

        function ajaxCsrf() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        var baseUrl = "{{ url('/') }}";

        function chatMessage(groupId) {

            if (screen.width < 990) {
    $('.menu_inner_list .nav-tabs .nav-item').click(function () {
        $(".user_prof.chtmssgbx .section_right").addClass("active");
    });
    
    $('.back_btn button').click( function() {
        $(".user_prof.chtmssgbx .section_right").removeClass("active");
    });
    
}
            //$('.user').removeClass('active');
            //$(this).addClass('active');
            //$('.user').removeClass('active');
            //$(this).addClass('active');
            //$(this).find('.pending').remove();
            receiver_id = groupId;
            $('#add_notfi_no_' + receiver_id + ' > span').remove();
            //alert(receiver_id);
            ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/group_conversation/' + groupId,
                dataType: 'html',
                success: function (res) {
                    $('#Profile-menu').html(res);
                    scrollToBottomFunc();
                }
            });
        }

        function scrollToBottomFunc() {
            $('.chat-inner').animate({
                scrollTop: $('.chat-inner').get(0).scrollHeight
            }, 100);
        }

      function addGroupMember(groupId){
        ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/addGroupMember/' + groupId,
                dataType: 'html',
                success: function (res) {
                    $('#addGroupMember').html(res);                    
                }
            });
      }

      function removeMember(userId,groupId){
      
         var check = confirm("Are you sure you want to remove from this space ?") ;
         if(check){
          ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/removeGroupMember',
                data:{'groupId':groupId,'userId':userId},
                dataType: 'html',
                success: function (res) {
                   groupManageMember(groupId);                
                }
            });
         }
           
      }

      function blockMember(userId,groupId,isBlock){
        if(isBlock==0){
          var check = confirm("Are you sure you want to block?") ;
        }else{
          var check = confirm("Are you sure you want to unblock?") ;
        }
        

        if(check){

          ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/blockGroupMember',
                data:{'groupId':groupId,'userId':userId,'isBlock':isBlock},
                dataType: 'html',
                success: function (res) {
                   groupManageMember(groupId);                
                }
            });
        }
      }

      function leaveGroup(groupId,isAdmin){
            ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/leaveGroup',
                data:{'groupId':groupId,'isAdmin':isAdmin},
                dataType: 'html',
                success: function (res) {
                  $('#leave-group').modal('hide');
                  location.reload();
                             
                }
            });
      }

  function redirectHomepage(){
           window.location.href =baseUrl;
        }

  function cancelLeaveGroup(){
    $('#leave-group').modal('hide');
  }

    </script>
</body>
</html>
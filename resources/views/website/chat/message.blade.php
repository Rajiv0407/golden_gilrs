<style>
    .thumb {}

    .remove_img_preview {
        position: relative;
        top: -30px;
        right: 7px;
        width: 20px;
        height: 20px;
        background: black;
        color: white;
        border-radius: 50px;
        font-size: 0.9em;
        padding: 0 0.3em 0;
        text-align: center;
        cursor: pointer;
        display: inline-block;
    }

    .remove_img_preview:before {
        content: "×";
    }
</style>

<?php 

// echo $data['page'] ; 

// echo $data['isShowMore'] ;

// exit;
?>
<!--- <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/style.css?v={{ time() }}"> -->

<div class="chat_write_messenger">
    <div class="head_mg">
        <div class="user_mg">
        <div class="back_btn">
                     <button type="button" onclick="chatBack()"><i class="ri-arrow-left-s-line"></i></button>
                <div class="mg_group_drop">
                    <a class="btn" href="javascript:void(0);" id="dropdownMenuLink" class="btn dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- class="btn dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" -->
                        <div class="mg_user_group">
                            <div class="mg_user_img">
                            <img src="{{$userInfo->image }}" alt="">
                            </div>
                            <div class="cont_mg">
                                <h3>{{$userInfo->name}}</h3>
                                @if($userInfo->isOnline)
                                <span></span>
                                @endif
                            </div>
                        </div>
                    </a>

                    <input type="hidden" name="isBlock" id="isBlock" value="<?php// echo $isBlock ; ?>">
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     
                        <!-- <li>
                            <a class="dropdown-item" href="#">
                                <span>
                                <svg viewBox="0 0 24 24" class="GfYBMd o50UJf"><path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path><path d="M9 8h2v9H9zM13 8h2v9h-2z"></path><path fill="none" d="M0 0h24v24H0V0z"></path></svg>
                                </span>
                                <span>
                                Delete conversation
                                </span>
                            </a>
                        </li> -->
                        <li>
                            <a class="dropdown-item" id="message_block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#block_friend" <?php if($isBlock==1){ ?> style="display:none;" <?php } ?> >
                                <span>
                                    <svg width="20px" height="20px" viewBox="0 0 48 48">
                                        <path d="M0 0h48v48H0z" fill="none"></path>
                                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                                    </svg>
                                </span>
                                <span >
                                Block 
                                </span>
                                
                                <!-- and report -->
                            </a>
                              <a class="dropdown-item" id="message_unblock" href="javascript:void(0);" onclick="blockFriend(<?php echo $userInfo->id ; ?>)"  <?php if($isBlock==0){ ?> style="display:none;" <?php } ?> >
                                <span>
                                    <svg width="20px" height="20px" viewBox="0 0 48 48">
                                        <path d="M0 0h48v48H0z" fill="none"></path>
                                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                                    </svg>
                                </span>
                                <span>
                                Unblock 
                                </span>
                                
                                <!-- and report -->
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    <div class="chat-body">
        <div class="chat-inner" id="chat-inner">
             <?php /*if(isset($data['isShowMore']) && $data['isShowMore']){ ?>
                <div onclick="ajax_message(<?php echo $userInfo->id; ?>,<?php echo $data['page'] ; ?>)"> Load More Message </div>
            <?php } */ ?>
<input type="hidden" name="page_" id="page_" value="<?php echo $data['page'] ; ?>">

<input type="hidden" name="isShowmore" id="isShowmore" value="<?php echo $data['isShowMore'] ; ?>" />

        
            <div id="history">

                @foreach($messages as $message)
                <?php //echo "<pre>";print_r($message->image);die; 
                ?>
               
                <div class="{{ ($message->from == Auth::id()) ? 'chat-mss rply-mss' : 'chat-mss' }}">
                    <ul>
                        <li>
                            <?php if($message->from != Auth::id()){ ?>
                                 <span><img src="{{$message->usrImg}}" alt=""></span>
                                 <!-- http://192.168.1.31:8080/golden/storage/app/public/user_image/user_holder.svg -->

                             <?php  } ?>


                            <div class="replay-mss">
                                <div class="cont_bx">
                                    <?php if (!empty($message->message)) { ?>
                                        <p>{{ $message->message }}</p>
                                    <?php } 

                                if(!empty($message->image) && count($message->image)==1){
                                    $class="singaleImg" ;
                                }else if(!empty($message->image) && count($message->image)==2){
                                    $class="twoImg" ;
                                }else if(!empty($message->image) && count($message->image)==3){
                                     $class="threeImg" ;
                                }else{
                                    $class="moreImg" ;
                                }
                          ?>
                                    <?php if (!empty($message->image)) {  ?>
                                        <div class="list_media <?php echo $class ; ?>">
                                        <?php foreach ($message->image as $image_data) {   ?>
                                            <?php if ($image_data['file_type'] == "image") { ?>
                                                <div class="media_img">
                                                <a href="<?php echo $image_data['image'] ;  ?>" data-fancybox="gallery" data-caption="">
                                                <img src="<?php echo $image_data['image']  ?>" class="img_thmb" alt="">
                                            </a>
                                                </div>
                                            <?php } ?>
                                            <?php if ($image_data['file_type'] == "application") { ?>
                                                <div class="media_pdf">
                                                <embed src="<?php echo $image_data['image'];  ?>" type="application/pdf" height="300px" width="100%">
                                                </div>
                                            <?php } ?>
                                            <?php if ($image_data['file_type'] == "video" && isset($image_data['image'])) { ?>
                                                <div class="media_video">
                                                <a data-fancybox="group-1" href="<?php echo $image_data['image'];  ?>">

                                                <video width="320" height="240" controls>
                                                    <source src="<?php echo $image_data['image'];  ?>">
                                                </video>
                                            </a>
                                                </div>
                                            <?php } ?>
                                        <?php }  ?>
                                        </div>
                                    <?php }  ?>

                                    
                                    <div class="date">
                                        <?php if($message->from == Auth::id()){ ?>
                                    <svg viewBox="0 0 18 18" height="18" width="18" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 18 18">
                                            <title>status-dblcheck</title>
                                            <path fill="currentColor" d="M17.394,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-0.427-0.388c-0.171-0.167-0.431-0.15-0.578,0.038L7.792,13.13 c-0.147,0.188-0.128,0.478,0.043,0.645l1.575,1.51c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C17.616,5.456,17.582,5.182,17.394,5.035z M12.502,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-2.614-2.556c-0.171-0.167-0.447-0.164-0.614,0.007l-0.505,0.516 c-0.167,0.171-0.164,0.447,0.007,0.614l3.887,3.8c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C12.724,5.456,12.69,5.182,12.502,5.035z"></path>
                                        </svg> <?php } ?>
                                        {{$message->createdOn}}
                                    </div>
                                

                                    <!-- {{ date('d M y, h:i a', strtotime($message->created_at)) }} -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                @endforeach

            </div>


            
        </div>
    </div>
    <div class="chat_footer" id="chat_footer" <?php if($isBlock==1){ ?> style="display:none;" <?php }?>>
        <form name="chatform" id="send-message" enctype="multipart/form-data">
            <div class="more_opt_mg">

                <div class="userbtn dropdown">
                    <a class="add_btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-add-circle-fill"></i>
                    </a>
                    <div class="file_add dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <div class="file_bdy">
                        <ul>
                            <li>
                                <label for="chatvideo">

                                    <input type="file" name="chatvideo[]" id="chatvideo" accept="video/*" multiple>
                                    <span class="icon">
                                        <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 8H9v3H6v2h3v3h2v-3h3v-2h-3z"></path>
                                                <path d="M18 7c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-3.333L22 17V7l-4 3.333V7zm-1.999 10H4V7h12v5l.001 5z"></path>
                                            </svg> </span>
                                        <span>Video</span>
                                </label>
                            </li>
                            <li>
                                <label for="chatimg">
                                    <input type="file" name="chatimg[]" id="chatimg" accept="image/png, image/gif, image/jpeg" / multiple>
                                    <span class="icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20 14V2C20 0.9 19.1 0 18 0H6C4.9 0 4 0.9 4 2V14C4 15.1 4.9 16 6 16H18C19.1 16 20 15.1 20 14ZM9.4 10.53L11.03 12.71L13.61 9.49C13.81 9.24 14.19 9.24 14.39 9.49L17.35 13.19C17.61 13.52 17.38 14 16.96 14H7C6.59 14 6.35 13.53 6.6 13.2L8.6 10.53C8.8 10.27 9.2 10.27 9.4 10.53ZM0 18V5C0 4.45 0.45 4 1 4C1.55 4 2 4.45 2 5V17C2 17.55 2.45 18 3 18H15C15.55 18 16 18.45 16 19C16 19.55 15.55 20 15 20H2C0.9 20 0 19.1 0 18Z" fill="var(--attachment-type-photos-color)"></path>
                                            </svg>
                                        </span>
                                        <span>Photos</span>
                                </label>
                            </li>
                            <li>
                                <label for="chatFile">
                                    <input type="file" name="chatFile[]" id="chatFile" accept=".pdf" multiple>
                                    <span class="icon">
                                            <svg height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 0C0.9 0 0.01 0.9 0.01 2L0 18C0 19.1 0.89 20 1.99 20H14C15.1 20 16 19.1 16 18V6.83C16 6.3 15.79 5.79 15.41 5.42L10.58 0.59C10.21 0.21 9.7 0 9.17 0H2ZM9 6V1.5L14.5 7H10C9.45 7 9 6.55 9 6ZM4 10C3.44772 10 3 10.4477 3 11C3 11.5523 3.44772 12 4 12H12C12.5523 12 13 11.5523 13 11C13 10.4477 12.5523 10 12 10H4ZM10 15C10 14.4477 9.55228 14 9 14H4C3.44772 14 3 14.4477 3 15C3 15.5523 3.44772 16 4 16H9C9.55228 16 10 15.5523 10 15Z" fill="var(--attachment-type-documents-color)"></path>
                                            </svg>
                                        </span>
                                        <span>Document</span>
                                </label>
                            </li>

                        </ul>
                    </div>
                    </div>
                </div>


                <!---<button class="add_btn">
<i class="ri-add-circle-fill"></i>
</button>-->
            </div>
            <div class="mg_text_input">
                <div class="chat-box">
                    <textarea rows="1" type="text" name="message" placeholder="Type a message here" class="msg_int_style" id="message" style="height: 32px;"></textarea>
                    <div class="upload_file_post1" id="chat_imgvideo" style="display:none;">
                        <div class="list_bx">
                            <div id="chat_image"> </div>
                        </div>
                    </div>

                    <span class="err" id="err_message"></span>
                </div>
                <!-- <button id="emoji-button"><span class="fa fa-smile"></span></button> -->
            </div>
        </form>
        <div class="btn_grp">  
            <button onclick="chat_message_fn(receiver_id);" class="btn_submit"><i class="ri-send-plane-fill"></i>
            </button>
        </div>
    </div>    
     <div class="blcked_bx" id="blcked_bx" <?php if($isBlock==0){ ?> style="display:none;" <?php }?> >
        <div class="blced_c">
            <p>You blocked <?php echo $userInfo->name ; ?></p>
            <span><?php echo $userInfo->name ; ?> will not be able to message you anymore</span>
        </div>
        <div class="unblc_bnt">
            <button class="btn" onclick="blockFriend(<?php echo $userInfo->id ; ?>)">Unblock</button>
        </div>
         
     </div>
     <div class="blcked_bx" id="blcked_bx_user" style="display:none;">
        <div class="blced_c">
            <p>You cannot message <?php echo $userInfo->name ; ?></p>           
        </div>
        <div class="unblc_bnt">
            <button class="btn" onclick="dismissModal();">Dismiss</button>
        </div>
         
     </div>
</div>


<!-- Block Popup -->
<div class="modal fade basic_infofrom mang_memb_modal" id="block_friend" tabindex="-1" aria-labelledby="manage-membersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
               <div class="modal-header ">              
                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
                </button>
            </div>   
             <div class="modal-body">
                
                  <div class="creatgrou_modal members_popup aef_bx" >
                    <h5>Block <?php echo $userInfo->name ; ?></h5>
                    <p><?php echo $userInfo->name ; ?> won't be able to message you directly, and their messages in the space will be hidden for you. They can still read any messages that you send to the space.</p>
                    <div class="button-group">

                 <button class="btn "   onclick="blockFriend(<?php echo $userInfo->id ; ?>)">Block</button>
                <button class="btn "  onclick="cancelBlockModal();" name="cancel">Cancel</button>   
            </div>
                </div>

             </div>
        </div>
    </div>
</div>

<div class="sucmssg_box" id="block_user_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Unblocked Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>

<script>

      function cancelBlockModal(){
    $('#block_friend').modal('hide');
  }

    $('#chatimg').change(handleFileSelect);
    $('#chatvideo').change(handleFileSelect);
    $('#chatFile').change(handleFileSelect);

var filesToUploadImg = [] ;
var filesToUploadVideo = [] ;
var filesToUploadFile = [] ;
    
    function handleFileSelect(event) {
        
        var input = this;
        var totalPreviewImg = $('#totalPreviwImg').val();
            var j = totalPreviewImg;
        if (input.files && input.files.length) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                const file = input.files[i];

                const fileType = file.type.split('/')[0];
                //alert(fileType);
                var reader = new FileReader();
                this.enabled = false;
                reader.onload = (function(e) {
                    var span = document.createElement('span');
                    if (fileType === 'image') {
                        span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview removeimg" id=' + file.name + ' ></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();

                    } else if (fileType === 'video') {
                        span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+file.name+' class="remove_img_preview remove_video_preview"></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();
                    } else if (fileType === 'application') {
                        span.innerHTML = ['<embed id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+file.name+' class="remove_img_preview remove_application_preview"></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();
                    }
                });
                reader.readAsDataURL(input.files[i]);
            }


        }

                 
            const file = input.files[0];
            const fileType = file.type.split('/')[0];
            
            if(fileType=="image"){
                for (const file of input.files) {
                filesToUploadImg.push(file);
                }    
            }
             if(fileType=="video"){
                for (const file of input.files) {
                filesToUploadVideo.push(file);
                }
            }
             if(fileType=="application"){
                for (const file of input.files) {
                filesToUploadFile.push(file);
                }
            }

    }

    $("#chatimg").change(function() {
        var fileInput = document.getElementById('chatimg');
        var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
        $(".video").attr("src", fileUrl);
    });

    

    $('#chat_image').on('click', '.removeimg', function(e) {
        var id = $(this).attr('id');

        const dt = new DataTransfer();
        const input = document.getElementById('chatimg');
        const { files } = input;     
        filesToUploadImg = filesToUploadImg.filter(function( obj ) {
            return obj.name !== id;
            });
            if (files.length == 1) {               
                $("#chatimg").val("");
                 $('#chat_imgvideo').hide();
            }

        $(this).parent('span').remove();
        $(this).val("");
          var chatImg=$('#chat_image').html();        
          if(chatImg.length==1){
             $('#chat_imgvideo').hide();
            
          }
         
    });

   $('#chat_image').on('click', '.remove_video_preview', function(e) {
        var id = $(this).attr('id');

        const dt = new DataTransfer();
        const input = document.getElementById('chatvideo');
        const { files } = input;     
        filesToUploadVideo = filesToUploadVideo.filter(function( obj ) {
            return obj.name !== id;
            });
            if (files.length == 1) {

                $("#chatvideo").val("");
                 $('#chat_imgvideo').hide();
            }

        $(this).parent('span').remove();
        $(this).val("");
         var chatImg=$('#chat_image').html();        
          if(chatImg.length==1){
             $('#chat_imgvideo').hide();
            
          }
    });

     $('#chat_image').on('click', '.remove_application_preview', function(e) {
        var id = $(this).attr('id');

        const dt = new DataTransfer();
        const input = document.getElementById('chatFile');
        const { files } = input;     
        filesToUploadFile = filesToUploadFile.filter(function( obj ) {
            return obj.name !== id;
            });
            if (files.length == 1) {

                $("#chatFile").val("");
                 $('#chat_imgvideo').hide();
               
            }

        $(this).parent('span').remove();
        $(this).val("");
        var chatImg=$('#chat_image').html();        
          if(chatImg.length==1){
             $('#chat_imgvideo').hide();
            
          }
    });

function trimfield(str) 
{ 
    return str.replace(/^\s+|\s+$/g,''); 
}

    function chat_message_fn(id) {
       
        var isFriendBlock='<?php echo $isFriendBlock ; ?>' ;
        if(isFriendBlock==1){
            $('#chat_footer').hide();
            $('#blcked_bx_user').show();            
            return false ;
        }
        var message = $('#message').val();

        // if (message == '') {
        //     alert('Please enter message.');
        //     return false;
        // }
       
        if (trimfield(message)=="" && filesToUploadImg.length==0 && filesToUploadVideo.length==0 && filesToUploadFile.length==0) {
            $('#err_message').html('Please enter message.');
              setTimeout(function(){
                         $('#err_message').html('');
                    },1000);
            return false ;
        } 
       
        $('#loader_spineer').show();
        ajaxCsrf();

        var formData = new FormData($('#send-message')[0]);
        formData.delete('chatimg[]');
        formData.delete('chatvideo[]');
        formData.delete('chatFile[]');

        for (const file of filesToUploadImg) {
            formData.append('chatimg[]', file);
        }
        for (const file of filesToUploadVideo) {
            formData.append('chatvideo[]', file);
        }
        for (const file of filesToUploadFile) {
            formData.append('chatFile[]', file);
        }
 
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/message/' + id,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            success: function(html) {
                
                $('#loader_spineer').hide();
              
                  filesToUploadImg=[];
                  filesToUploadVideo=[];
                  filesToUploadFile=[];
             
            },
            error: function(jqXHR, status, err) {},
            complete: function() {
                
                //setTimeout(function(){
                $('#chat_imgvideo').hide();
                $('#loader_spineer').hide();
                $('#send-message')[0].reset();
                $("#chat_image").html("");
                  filesToUploadImg=[];
                  filesToUploadVideo=[];
                  filesToUploadFile=[];
                scrollToBottomFunc();
                //},1000)	;
            }
        });



    }

    function chatBack() {
          if (screen.width > 990) {
         $('.chat_dshbrd').html('<div id="Profile-menu" > <div class="dash_not_data"> <h3>Dashboard </h3> </div> </div>') ;
     }
     if (screen.width < 990) {
      $(".user_prof.chtmssgbx .section_right").removeClass("active");
  }
        // $.ajax({
        //     type: "get",
        //     url: baseUrl + '/message',
        //     dataType: 'html',
        //     success: function(html) {
        //         $("#web_container").load(location.href + " #web_container");
        //     }
        // });
    }

    function removeImg(type,index){
        // alert('removeImg'+type);
        //  debugger ;
        //  //name
        //  console.log(filesToUploadImg);
        //  filesToUploadImg.splice(index, 1);
        //  alert(filesToUploadImg.length);
          
    }

    function blockFriend(friendId){

          ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/blockFriend',
                data:{'friendId':friendId},
                dataType: 'json',
                success: function (res) {
                   var isBlock=res.isBlock ;
                    $('#block_friend').modal('hide');
                   if(isBlock==0){
                    $('#message_block').show();
                    $('#message_unblock').hide();
                    $('#block_user_succ').show();

                    $('#chat_footer').show();
                    $('#blcked_bx').hide();

                    setTimeout(function(){
                         $('#block_user_succ').hide();
                    },1000);
                   }else if(isBlock==1){
                    $('#message_block').hide();
                    $('#message_unblock').show();

                    $('#chat_footer').hide();
                    $('#blcked_bx').show();
                    
                   }
                   
                }
            });
    }   

    function dismissModal(){
        $('#send-message')[0].reset();
          var formData = new FormData($('#send-message')[0]);
        formData.delete('chatimg[]');
        formData.delete('chatvideo[]');
        formData.delete('chatFile[]');
          filesToUploadImg=[];
         filesToUploadVideo=[];
         filesToUploadFile=[];
        $('#chat_image').html('');
        $('#chat_footer').show();
        $('#blcked_bx_user').hide();
    } 
    
 function ajax_message(userId,page){

            receiver_id = userId;
                 
            $('#add_notfi_no_' + receiver_id + ' > span').remove();
             $('#loader_spineer').show();
            //alert(receiver_id);
            ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/loadmore_message/' + userId,
                data:{"page":parseInt(page)+1},
                dataType: 'html',
                success: function (res) {
                    $('#page_').remove();
                    $('#isShowmore').remove() ; 
                    $('#history').prepend(res);   
                     $('#loader_spineer').hide();                
                }
            });
        }


    jQuery(function($) { 
          
         $('#chat-inner').on('scroll', function() {
             


        let div = $(this).get(0);
        var userId='<?php echo $userInfo->id ; ?>' ;
        var page=$('#page_').val();
        var isShowMore=$('#isShowmore').val() ; 

        // console.log(div.scrollTop+' '+div.clientHeight+' '+div.scrollHeight);
        if(isShowMore==1 && div.scrollTop < 1){
            ajax_message(userId,page);
        }
        // if(div.scrollTop + div.clientHeight >= div.scrollHeight) {
        //     // do the lazy loading here
        //     alert('hj');
        // }
        });

     });
   

</script>
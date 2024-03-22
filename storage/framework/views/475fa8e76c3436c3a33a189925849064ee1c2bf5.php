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
<!--  -->


<div class="chat_write_messenger">
<div class="head_mg">
        <div class="user_mg">
            <div class="back_btn">
                <button type="button" onclick="groupChatBack()"><i class="ri-arrow-left-s-line"></i></button>

                <div class="mg_group_drop">
                   
                        <div class="mg_user_group">
                            <div class="mg_user_img">
                   <label for="edit_groupimg" class="add_img">
                                <?php if ($group->image != '') { ?>
                                    <img id="group_icon" src="<?php echo e($group->image); ?>" alt="">
                                <?php } else { ?>
                                    <img id="group_icon" src="<?php echo e(URL('/').'/public/user_image/group_icon.png'); ?>" alt="">
                                <?php } ?>
                                <?php if($group->admin_id==Auth::id()){ ?> 
                            <form id="updateGroupImg" action="javascript:void(0);">
                            <input type="hidden" name="groupId" id="groupId" value="<?php echo $group->id ; ?>">
                        <input type="file"  id="edit_groupimg" name="edit_groupimg" class="d-none" accept="image/png, image/gif, image/jpeg" >
                        </form>
                   <div class="edit_grp">
                        <svg viewBox="0 0 24 24" class="N5XGq UB1zOd"><path d="M20.41 4.94l-1.35-1.35c-.78-.78-2.05-.78-2.83 0L3 16.82V21h4.18L20.41 7.77c.79-.78.79-2.05 0-2.83zm-14 14.12L5 19v-1.36l9.82-9.82 1.41 1.41-9.82 9.83z"></path><path fill="none" d="M0 0h24v24H0V0z"></path></svg>
                    </div>
                    <?php } ?>
               </label>


                            </div>
                             
                             <a class="btn dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                              
                            

                            <div class="cont_mg" >
                                <?php //$t = array(4, 5, 6, 7); 
// data-bs-toggle="modal" data-bs-target="#creatgroupmodal"
                                ?>
                                <!-- onclick="selectedUser('<?php //echo json_encode($t); ?>')" -->
                                <!--  -->
                                <h3><?php echo e($group->group_name); ?></h3>
                                <h4><span id="group_member"><?php echo $groupMember ; ?></span> members</h4>
                                <!-- <p>last online 5 hours ago</p>  -->
                            </div>
                            </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                         <?php //if($group->admin_id==Auth::id()){ ?> 
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="groupManageMember('<?php echo $group->id ; ?>')" data-bs-toggle="modal" data-bs-target="#manage-members">
                                <span>
                                    <svg width="20px" height="20px">
                                        <path d="M10 12q-1.65 0-2.825-1.175Q6 9.65 6 8q0-1.65 1.175-2.825Q8.35 4 10 4q1.65 0 2.825 1.175Q14 6.35 14 8q0 1.65-1.175 2.825Q11.65 12 10 12Zm-8 8v-2.8q0-.825.425-1.55.425-.725 1.175-1.1 1.275-.65 2.875-1.1Q8.075 13 10 13h.35q.15 0 .3.05-.2.45-.338.938-.137.487-.212 1.012H10q-1.775 0-3.188.45-1.412.45-2.312.9-.225.125-.362.35-.138.225-.138.5v.8h6.3q.15.525.4 1.038.25.512.55.962Zm14 1-.3-1.5q-.3-.125-.563-.262-.262-.138-.537-.338l-1.45.45-1-1.7 1.15-1q-.05-.35-.05-.65 0-.3.05-.65l-1.15-1 1-1.7 1.45.45q.275-.2.537-.338.263-.137.563-.262L16 11h2l.3 1.5q.3.125.563.275.262.15.537.375l1.45-.5 1 1.75-1.15 1q.05.3.05.625t-.05.625l1.15 1-1 1.7-1.45-.45q-.275.2-.537.338-.263.137-.563.262L18 21Zm1-3q.825 0 1.413-.587Q19 16.825 19 16q0-.825-.587-1.413Q17.825 14 17 14q-.825 0-1.412.587Q15 15.175 15 16q0 .825.588 1.413Q16.175 18 17 18Zm-7-8q.825 0 1.413-.588Q12 8.825 12 8t-.587-1.412Q10.825 6 10 6q-.825 0-1.412.588Q8 7.175 8 8t.588 1.412Q9.175 10 10 10Zm0-2Zm.3 10Z"></path>
                                    </svg>
                                </span>
                                <span>Manage members</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a class="dropdown-item" href="#">
                                <span>
                                    <svg width="20px" height="20px" viewBox="0 0 48 48">
                                        <path d="M0 0h48v48H0z" fill="none"></path>
                                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                                    </svg>
                                </span>
                                <span>
                                    Block and report
                                </span>
                            </a>
                        </li> -->
                    <?php //} ?>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#leave-group">
                                <span>
                                    <svg width="20px" height="20px">
                                        <polygon points="16,18 6,18 6,8 9,8 9,12.8 16,6 18,8 11.1,15 16,15 "></polygon>
                                    </svg>
                                </span>
                                <span>
                                    Leave
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                        </div>
                    

                </div>

            </div>
        </div>

    </div>
    <div class="chat-body">
        <div class="chat-inner" id="chat-inner">
<input type="hidden" name="page_" id="page_" value="<?php echo $data['page'] ; ?>">
<input type="hidden" name="isShowmore" id="isShowmore" value="<?php echo $data['isShowMore'] ; ?>" />

            <div id="history">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php //echo "<pre>";print_r($message->image);die; 
                ?>

                <?php if($message->message_type==1){ ?>

                <div class="<?php echo e(($message->from == Auth::id()) ? 'chat-mss rply-mss' : 'chat-mss'); ?>">
                    <ul>
                        <li>
                            <?php if(($message->from != Auth::id())){ ?>
                                
                                <span class="chat_user_nme"><img src="<?php echo e($message->groupImg); ?>" alt="">
                                    <span><?php echo e($message->name); ?></span>

                                </span>

                                <!-- http://192.168.1.31:8080/golden/storage/app/public/user_image/user_holder.svg -->
                                

                            <?php } ?>
                        

                            <div class="replay-mss">
                                <div class="cont_bx">
                                    <?php if (!empty($message->message)) { ?>
                                        <p><?php echo e($message->message); ?></p>
                                    <?php } ?>
                                    <?php if (isset($message->image) && !empty($message->image)) {  ?>
                                        <div class="list_media">
                                        <?php foreach ($message->image as $image_data) {   ?>
                                            <?php if ($image_data->file_type == "image") { ?>
                                                <div class="media_img">
                                                <img src="<?php echo $image_data->image  ?>" class="img_thmb" alt="">
                                                </div>
                                            <?php } ?>

                                            <?php if ($image_data->file_type == "application") { ?>
                                                <div class="media_pdf">
                                                <embed src="<?php echo $image_data->image;  ?>" type="application/pdf" height="300px" width="100%">
                                                </div>
                                            <?php } ?>

                                            <?php if ($image_data->file_type == "video") { ?>
                                                <div class="media_video">
                                                <video width="320" height="240" controls>
                                                    <source src="<?php echo $image_data->image;  ?>">
                                                </video>
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
                                        </svg> 
                                        <?php } ?>
                                        <?php echo e($message->createdOn); ?>

                                    </div>

                                    <!-- <?php echo e(date('d M y, h:i a', strtotime($message->created_at))); ?> -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php } else{ ?> 
                <div class="message-notif">
                    
                    <p> <?php echo $message->message ; ?></p>
                </div>
                <?php } ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                

            </div>
        </div>
    </div>
    <div class="chat_footer">
        <form name="chatform" id="group_send_message" enctype="multipart/form-data">
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
            <!--<button class="like_thump">
<svg id="Smile_icon" data-name="Smile icon" xmlns="http://www.w3.org/2000/svg"
width="25.073" height="24" viewBox="0 0 25.073 24">
<g id="Ellipse" fill="none" stroke="#d7792d" stroke-width="2.5">
<ellipse cx="12.536" cy="12" rx="12.536" ry="12" stroke="none" />
<ellipse cx="12.536" cy="12" rx="11.286" ry="10.75" fill="none" />
</g>
<path id="Ellipse-2" data-name="Ellipse"
d="M9.117,0A5.146,5.146,0,0,1,4.559,2.727,5.146,5.146,0,0,1,0,0"
transform="translate(7.978 13.636)" fill="none" stroke="#d7792d"
stroke-linecap="round" stroke-width="2.5" />
<ellipse id="Ellipse_2" data-name="Ellipse 2" cx="1.14" cy="1.091" rx="1.14"
ry="1.091" transform="translate(7.978 7.636)" fill="#d7792d" />
<ellipse id="Ellipse_2.1" data-name="Ellipse 2.1" cx="1.14" cy="1.091"
rx="1.14" ry="1.091" transform="translate(14.816 7.636)"
fill="#d7792d" />
</svg>
</button> -->
            <button onclick="chat_message_fn(receiver_id);" class="btn_submit"><i class="ri-send-plane-fill"></i>
            </button>
        </div>
    </div>
</div>
<!-- Update Group -->
<!-- End -->
<script>
    $('#chatimg').change(handleFileSelect);
    $('#chatvideo').change(handleFileSelect);
    $('#chatFile').change(handleFileSelect);
    var filesToUploadImg = [] ;
var filesToUploadVideo = [] ;
var filesToUploadFile = [] ;
    
    function handleFileSelect(event) {
        var input = this;
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
                        span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id=' + file.name + ' class="remove_img_preview removeimg"></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();
                    } else if (fileType === 'video') {
                        span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id=' + file.name + ' class="remove_img_preview remove_video_preview"></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();
                    } else if (fileType === 'application') {
                        span.innerHTML = ['<embed id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id=' + file.name + ' class="remove_img_preview remove_application_preview"></span>'].join('');
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
    $('#chat_image').on('click', '.removeimg', function() {
         var id = $(this).attr('id');
         
        const dt = new DataTransfer();
        const input = document.getElementById('chatimg');
        const { files } = input;     
        filesToUploadImg = filesToUploadImg.filter(function( obj ) {
            return obj.name !== id;
            });
            if (files.length == 1) {
                $("#chatimg").val("");
            }

        $(this).parent('span').remove();
        $(this).val("");
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
            }

        $(this).parent('span').remove();
        $(this).val("");
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
            }

        $(this).parent('span').remove();
        $(this).val("");
    });


function trimfield(str) 
{ 
    return str.replace(/^\s+|\s+$/g,''); 
}

    function chat_message_fn(id) {
         
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
        var formData = new FormData($('#group_send_message')[0]);

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
            url: baseUrl + '/group_message/' + id,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            success: function(html) {
                 scrollToBottomFunc();
            },
            error: function(jqXHR, status, err) {},
            complete: function() {
                $('#loader_spineer').hide();
                $('#group_send_message')[0].reset();
                $("#chat_image").html("");
                  filesToUploadImg=[];
                  filesToUploadVideo=[];
                  filesToUploadFile=[];
                scrollToBottomFunc();

                
            }
        });



    }

    function groupChatBack() {
         if (screen.width > 990) {
         $('.chat_dshbrd').html('<div id="Profile-menu" > <div class="dash_not_data"> <h3>Dashboard </h3> </div> </div>') ;
     }
     if (screen.width < 990) {
      $(".user_prof.chtmssgbx .section_right").removeClass("active");
  }
        // $.ajax({
        //     type: "get",
        //     url: baseUrl + '/group',
        //     dataType: 'html',
        //     success: function(html) {
        //         $("#web_container").load(location.href + " #web_container");
        //     }
        // });
    }

    $('#groupUpdateUser').multiselect({
        columns: 1,
        placeholder: 'Select User',
        search: true

    });

    function selectedUser(option) {
        var gu = JSON.parse(option);

        for (let i = 0; i < gu.length; i++) {           
            $(":checkbox[value=4]").click();
        }
        //  console.log(JSON.stringify(groupUser));
        // 
    }

      $("#edit_groupimg").change(function(){

          $('#loader_spineer').show();

        ajaxCsrf();
        var groupId=$('#groupId').val();
        var formData = new FormData($('#updateGroupImg')[0]);
        

        
         $.ajax({
            type: "POST",
            url: baseUrl + '/update_groupImage',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            success: function(html) {
                  console.log(html);                  
                $('#loader_spineer').hide();
                 $('#updateGroupImg')[0].reset();
                if(html.status==1){
                  var imgUrl=html.imgUrl ;
                  $('#group_icon').attr('src',imgUrl);
                  $('#add_notfi_no_img_'+groupId).attr('src',imgUrl);
                }
               
            }

        });

      });





 function ajax_message(groupId,page){  
            receiver_id = groupId;                 
            $('#add_notfi_no_' + receiver_id + ' > span').remove();
             $('#loader_spineer').show();
            //alert(receiver_id);
            ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/loadmore_group_message/' + groupId,
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
        var groupId='<?php echo $group->id ; ?>' ;
        var page=$('#page_').val();
        var isShowMore=$('#isShowmore').val() ; 

        // console.log(div.scrollTop+' '+div.clientHeight+' '+div.scrollHeight);
        if(isShowMore==1 && div.scrollTop < 1){
            ajax_message(groupId,page);
        }
        // if(div.scrollTop + div.clientHeight >= div.scrollHeight) {
        //     // do the lazy loading here
        //     alert('hj');
        // }
        });

     });
 

</script>



  <!--  </form>

                    <div class="button-group">
                        <button type="button" class="btn">Save changes</button>
                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </div> -->

<div class="modal fade basic_infofrom mang_memb_modal" id="leave-group" tabindex="-1" aria-labelledby="manage-membersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
               <div class="modal-header ">              
                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>   
             <div class="modal-body">
                
                  <div class="creatgrou_modal members_popup aef_bx" >
                    <h5>Are you sure you want to leave this space?</h5>
                    <p>You will not able to find and rejoin this space again unless another user adds you.</p>
                    <div class="button-group">

                 <button class="btn "   onclick="leaveGroup(<?php echo $group->id ; ?>,<?php echo $group->admin_id ; ?>)">Submit</button>
                <button class="btn "  onclick="cancelLeaveGroup();" name="cancel">Cancel</button>   
            </div>
                </div>

             </div>
        </div>
    </div>
</div>

<div class="modal fade basic_infofrom mang_memb_modal" id="block-group" tabindex="-1" aria-labelledby="manage-membersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
               <div class="modal-header ">              
                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>   
             <div class="modal-body">
                
                  <div class="creatgrou_modal members_popup aef_bx" >
                    <h5>Are you sure you want to block from this space?</h5>
                   <!--  <p>You will not able to find and rejoin this space again unless another user adds you.</p> -->
                    <div class="button-group">

                 <button class="btn "   onclick="leaveGroup(<?php echo $group->id ; ?>,<?php echo $group->admin_id ; ?>)">Create</button>
                <button class="btn "  onclick="cancelLeaveGroup();" name="cancel">Cancel</button>   
            </div>
                </div>

             </div>
        </div>
    </div>
</div>

<div class="modal fade basic_infofrom mang_memb_modal" id="manage-members-add" tabindex="-1" aria-labelledby="manage-membersAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="manage-membersAddLabel">Add people to 'IOS Team'</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                <div class="members_popup">
                    <form id="" action="javascript:void(0);" method="post">
                        <div class="srch_mb_wrapp">
                            <div class="form-group srch_mb">
                                <input type="text" name="Search_members" id="hair_color" class="form-control" placeholder="Search for people or groups">
                                <div class="form-icon"><i class="ri-search-line"></i></div>
                            </div>
                        </div>
                    </form>

                    <div class="button-group">
                    <button type="button" class="btn">Add</button>
                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </div>

            </div>

        </div>
    </div>
</div><?php /**PATH D:\xampp\htdocs\golden\resources\views/website/group/message.blade.php ENDPATH**/ ?>
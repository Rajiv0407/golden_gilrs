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
<!-- <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('/public/website')); ?>/css/style.css?v=<?php echo e(time()); ?>"> -->

<div class="chat_write_messenger">
    <div class="head_mg">
        <div class="user_mg">
        <div class="back_btn">
                     <button type="button" onclick="chatBack()"><i class="ri-arrow-left-s-line"></i></button>
                <div class="mg_group_drop">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="mg_user_group">
                            <div class="mg_user_img">
                            <img src="<?php echo e($userInfo->image); ?>" alt="">
                            </div>
                            <div class="cont_mg">
                                <h3><?php echo e($userInfo->name); ?></h3>
                                <?php if($userInfo->isOnline): ?>
                                <span></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     
                        <li>
                            <a class="dropdown-item" href="#">
                                <span>
                                <svg viewBox="0 0 24 24" class="GfYBMd o50UJf"><path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path><path d="M9 8h2v9H9zM13 8h2v9h-2z"></path><path fill="none" d="M0 0h24v24H0V0z"></path></svg>
                                </span>
                                <span>
                                Delete conversation
                                </span>
                            </a>
                        </li>
                        <li>
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
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    <div class="chat-body">
        <div class="chat-inner">
            <div id="history">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php //echo "<pre>";print_r($message->image);die; 
                ?>
                <div class="<?php echo e(($message->from == Auth::id()) ? 'chat-mss rply-mss' : 'chat-mss'); ?>">
                    <ul>
                        <li>
                            <?php if($message->from != Auth::id()){ ?>
                                 <span><img src="<?php echo e($message->usrImg); ?>" alt=""></span>
                                 <!-- http://192.168.1.31:8080/golden/storage/app/public/user_image/user_holder.svg -->

                             <?php  } ?>


                            <div class="replay-mss">
                                <div class="cont_bx">
                                    <?php if (!empty($message->message)) { ?>
                                        <p><?php echo e($message->message); ?></p>
                                    <?php } ?>
                                    <?php if (!empty($message->image)) {  ?>
                                        <div class="list_media">
                                        <?php foreach ($message->image as $image_data) {   ?>
                                            <?php if ($image_data['file_type'] == "image") { ?>
                                                <div class="media_img">
                                                <img src="<?php echo $image_data['image']  ?>" class="img_thmb" alt="">
                                                </div>
                                            <?php } ?>
                                            <?php if ($image_data['file_type'] == "application") { ?>
                                                <div class="media_pdf">
                                                <embed src="<?php echo $image_data['image'];  ?>" type="application/pdf" height="300px" width="100%">
                                                </div>
                                            <?php } ?>
                                            <?php if ($image_data['file_type'] == "video" && isset($image_data['image'])) { ?>
                                                <div class="media_video">
                                                <video width="320" height="240" controls>
                                                    <source src="<?php echo $image_data['image'];  ?>">
                                                </video>
                                                </div>
                                            <?php } ?>
                                        <?php }  ?>
                                        </div>
                                    <?php }  ?>
                                    <div class="date">
                                    <svg viewBox="0 0 18 18" height="18" width="18" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 18 18">
                                            <title>status-dblcheck</title>
                                            <path fill="currentColor" d="M17.394,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-0.427-0.388c-0.171-0.167-0.431-0.15-0.578,0.038L7.792,13.13 c-0.147,0.188-0.128,0.478,0.043,0.645l1.575,1.51c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C17.616,5.456,17.582,5.182,17.394,5.035z M12.502,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-2.614-2.556c-0.171-0.167-0.447-0.164-0.614,0.007l-0.505,0.516 c-0.167,0.171-0.164,0.447,0.007,0.614l3.887,3.8c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C12.724,5.456,12.69,5.182,12.502,5.035z"></path>
                                        </svg> <?php echo e($message->createdOn); ?>

                                    </div>

                                    <!-- <?php echo e(date('d M y, h:i a', strtotime($message->created_at))); ?> -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
    <div class="chat_footer">
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
                        span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview" id=' + j + ' ></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();

                    } else if (fileType === 'video') {
                        span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join('');
                        document.getElementById('chat_image').insertBefore(span, null);
                        $('#chat_imgvideo').show();
                    } else if (fileType === 'application') {
                        span.innerHTML = ['<embed id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join('');
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
    $('#chat_image').on('click', '.remove_img_preview', function(e) {      
        // $(this).parent('span').remove();       
        // $(this).val("");
        var id = $(this).attr('id');

        const dt = new DataTransfer();
        const input = document.getElementById('image');
        const { files } = input;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (id != i) {
                dt.items.add(file) // here you exclude the file. thus removing it.
                input.files = dt.files
            } else {
                filesToUploadImg.splice(i, 1);
            }
            if (files.length == 1) {
                $("#chatimg").val("");
            }
        }
        $(this).parent('span').remove();
        $(this).val("");
    });




    function chat_message_fn(id) {


        var message = $('#message').val();

        if (message == '') {
            alert('Please enter message.');
            return false;
        }

        // if (post_text == '' && filesToUploadPost.length==0) {
        //     $('#error_post_text').html('Please enter post text');
        // } 

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
</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/chat/message.blade.php ENDPATH**/ ?>
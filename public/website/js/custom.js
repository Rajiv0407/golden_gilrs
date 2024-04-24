$(document).ready(function () {
    
    $("#singup_form").hide();
    $("#login_form").show();
    $("#forget_form").hide();
    $('#signup_form_hide').click(function () {
        $("#singup_form").hide();
        $("#login_form").show();
        $("#forget_form").hide();
    });

    $('#login_form_hide').click(function () {
        $("#singup_form").show();
        $("#login_form").hide();
        $("#forget_form").hide();
    });

    $('#forget_password').click(function () {
        $("#forget_form").show();
        $("#login_form").hide();
        $("#singup_form").hide();
    });

    $('#login_forget').click(function () {
        $("#login_form").show();
        $("#forget_form").hide();
        $("#singup_form").hide();
    });

   /* / ///$('#share_id').click(function () {
        $(".share_ul").toggle();
    }); */
    $('#event_share_id').click(function () {
        $(".share_ul").toggle();
    });

    $("#mind").on("click", function () {
        $("#post_message_id").toggle();
    });
    var tab_id = $("#tab_Id_data").val();
   // event_listing(tab_id);
    var user_id=$("#user_ids").val();
    //myabout(user_id);
    Fancybox.bind('[data-fancybox]', {});
    Fancybox.bind('[data-fancybox="gallery"]', {});


     $("#follow_tab").click(function (){
        $("#followers_list_data").show();
        $("#following_list_data").hide();
        $("#following_hide").hide();
        $("#followers_hide").show();
        $("#follow_tab").addClass('active');
        $("#following_tab").removeClass('active');
    });
    $("#following_tab").click(function (){
        $("#following_list_data").show();
        $("#followers_list_data").hide();
        $("#following_hide").show();
        $("#followers_hide").hide();
        $("#following_tab").addClass('active');
        $("#follow_tab").removeClass('active');
    });

});


 function ajax_myevent(requestId,page){

     $('#loader_spineer').show();
     if(page==0){
      $('#sm_gds').html('');
       $('#sm_evnt').html('');
     }
    
      ajaxCsrf();
     $.ajax({
          type: "post",
          url: baseUrl + '/ajax_myevent/'+requestId, 
          data:{"page":parseInt(page)+1},        
          beforeSend: function() {
          
          },
          success: function(res) {  
                if(parseInt(page) > 0){
                  $('#homeLoadmore').remove();
                }

               $('#loader_spineer').hide();
               $('#sm_evnt').append(res);
           
          }

        });
  }


    function ajax_mygoodies(requestId,page){
           
     $('#loader_spineer').show();
      if(page==0){

        $('#sm_evnt').html('');
       $('#sm_gds').html('');
     }
    
     ajaxCsrf();
     $.ajax({
          type: "post",
          url: baseUrl + '/ajax_mygoodies/'+requestId,    
          data:{"page":parseInt(page)+1},        
          beforeSend: function() {
          
          },
          success: function(res) {  
               
             if(parseInt(page) > 0){
                  $('#homeLoadmore').remove();
                }

               $('#loader_spineer').hide();
               $('#sm_gds').append(res);
           
          }

        });
  }

function cancelBooking(){
         
        //cnacelBooking_info
        var cancelReason = $('#cancelReason').val();
        var eventId = $('#bookingId').val();

            $('.err').html('');
        if(cancelReason==''){
            $('#err_cancelReason').html('Please enter event booking cancel reason.');
            return false ;
        }else{
             $('#loader_spineer').show(); 

              var formData = $('#cnacelBooking_info').serialize(); //new 
         ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/cancelEvent',
          data: formData,
          beforeSend: function() {
          
          },
          success: function(res) {
           
               $('#loader_spineer').hide();

                 $('#bookingId').val(0);
               if(res==1){
                $('#cancelledEventBooking_'+eventId).hide();
                $('#cancelledEvent_'+eventId).show();
                $('#cancel_event_succ').show();
                $('#cancel_booking').modal('hide');               
                
               }
               
            setTimeout(function(){
                $('#cancel_event_succ').hide();
            },2000);
          }

        });

        }
  }
   
function forgot_password() {
      var email = $('#forgot_email').val();
      $('.err').html('');
      if (email == '') {
        $('#error_forgot_email').html('Please enter email');
      }else if(!validateEmail(email)){
      $('#error_forgot_email').text('Please enter valid email.');
     } else {
       $('#loader_spineer').show();
        var formData = $('#forgotPasswordForm').serialize();
        ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/forgot_password',
          data: formData,
          beforeSend: function() {
            $('#floadingGife').show();
            //ajax_before();
          },
          success: function(res) {
      $('#loader_spineer').hide();
            // ajax_success() ;
            if (res == 2) {
             
              $('#forgot_email').val("");
              $("#forgot_user_name_password").html("Email has been sent on your registerd email id");

            } else if (res == 3) {
             
              $("#error_forgot_email").html("This email id not register with us");

            } else {
               $("#err_forgot_user_name_password").html("Something went wrong.");
            }

            setTimeout(function(){
              $("#err_forgot_user_name_password").html("");
               $("#error_forgot_email").html("");
               $("#forgot_user_name_password").html("");
            },2000);
          }

        });
      }
    }

 function loginUser(){
    
  var usrEmail=$('#user_email').val();
  var usrPassword = $('#user_password').val();

  $('.err').text('');

  if(usrEmail==''){
    $('#err_user_email').text('Please enter email');
  }else if(usrPassword==''){  
    $('#err_user_password').text('Please enter password');
  }else{
    
     $('#loader_spineer').show(); 
    
        var formData = $('#login_form').serialize(); //new 

    ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/do_login',
          data: formData,
          beforeSend: function() {
          
          },
          success: function(res) {
           
               $('#loader_spineer').hide();
                 
               if(res==1){
                $('#login_succ').show();
                $('#login_post').modal('hide');
                
                 location.reload();
               }else if(res==="2"){
                $('#err_login_form').text('Invalid Credentials.');
               }else{
                 $('#err_login_form').text('Something went wrong');
               }
             // 
            
            setTimeout(function(){
                $('#login_succ').hide();
              $('#err_login_form').text('');
            },2000);
          }

        });

  }
  }

  function usrSignup(){

     var firstName = $('#first_name').val();
     var last_name = $('#last_name').val();
     var signup_emal = $('#signup_emal').val();
     var usr_mobileNo = $('#usr_mobileNo').val();
     var usr_dob = $('#usr_dob').val();
     var usr_nationality = $('#usr_nationality').val();
     var signup_password = $('#signup_password').val();
     $('.err').text('');
     if(firstName==''){
      $('#err_first_name').text('Please enter first name.');
     }else if(last_name==''){
      $('#err_last_name').text('Please enter last name.');
     }else if(signup_emal==''){
      $('#err_signup_emal').text('Please enter email.');
     }else if(!validateEmail(signup_emal)){
      $('#err_signup_emal').text('Please enter valid email.');
     }else if(usr_mobileNo==''){
      $('#err_usr_mobileNo').text('Please enter mobile number.');
     } else if (usr_mobileNo.length < 8) {
        $('#err_usr_mobileNo').html('Please enter minimum 8 digits');
      } else if (usr_mobileNo.length > 14) {
        $('#err_usr_mobileNo').html('Please enter maximum 14 digits');
      }else if(usr_dob==''){  
      $('#err_usr_dob').text('Pleas select Date of birth');
     }else if(usr_nationality==''){
      $('#err_usr_nationality').text('Please enter nationality');
     }else if(signup_password==''){
      $('#err_signup_password').text('Please enter password');
     }else if (signup_password.length < 8) {
        $('#err_signup_password').html('Please enter maximum 8 characters');
      } else{

       $('#loader_spineer').show();
       
  
         var formData = new FormData($('#usrRegisterForm')[0]);

        ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/Signup',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',    
          beforeSend: function() {
          },
          success: function(res) {
            if(res.status == 1) {           
              $('#usrRegisterForm')[0].reset();
                $('#signup_succ').show();
                $('#login_post').modal('hide');
                
                 location.reload();
             
            } else if (res.status == 2) {
              $('#loader_spineer').hide();
              $('#err_signup_emal').html('Email id already Registered');
            } else {
              $('#loader_spineer').hide();
              $('#err_signup_form').text('Something went wrong');
            }
          }

        });
     }

  }

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

 function mobilepost(){        
        $("#post_message_id").show();            
        $("#post_message_id").addClass('active');
        $("body").addClass('overflow-hidden');
    }

    function mobilepostclose(){
        $("#post_message_id").hide();            
        $("#post_message_id").removeClass('active');
        $("body").removeClass('overflow-hidden');
    }


if(window.matchMedia("(max-width: 767px)").matches){
    
    function mobilepost(){        
        $("#post_message_id").show();            
        $("#post_message_id").addClass('active');
        $("body").addClass('overflow-hidden');
    }

    function mobilepostclose(){
        $("#post_message_id").hide();            
        $("#post_message_id").removeClass('active');
        $("body").removeClass('overflow-hidden');
    }

    
    
    
    
} else{ } 


function update_profile(){   
        var hair_color = $('#hair_color').val();
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
        
        // console.log($.trim(waist));
        // $('.err').html('');

        // if(hair_color==''){
        //     $('#error_edit_hair_color').html('Please enter hair color') ;
        // }
        // else if(waist==''){
        //     $('#error_edit_waist').html('Please enter waist size') ;
        // }
        // else if(height==''){
        //     $('#error_edit_height').html('Please enter height') ;
        // }
        // else if(bust== ''){
        //     $('#error_edit_bust').html('Please enter Bust (Inches)') ;
        // }
        // else if(weight== ''){
        //     $('#error_edit_weight').html('Please enter weight') ;
        // }
        // else if(hips== ''){
        //     $('#error_edit_hips').html('Please enter hips size') ;
        // }
        // else if(hair_style== ''){
        //     $('#error_edit_hair_style').html('Please enter hair style') ;
        // }
        // else if(eye_color== ''){
        //     $('#error_edit_eye_color').html('Please enter eye color') ;
        // }
        // else if(smoking== ''){
        //     $('#error_edit_smoking').html('Please select smoking') ;
        // }
        // else if(interests== ''){
        //     $('#error_edit_interests').html('Please enter interests') ;
        // }
        // else if(marital_status== ''){
        //     $('#error_edit_marital_status').html('Please enter marital status');
        // }
        // else if(about_self== ''){
        //     $('#error_edit_about').html('Please enter about');
        // }
        // else{
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
            if(res){
                $(".rgt_usrinfo").load(".rgt_usrinfo");
                $('#editbasicinfo').modal('hide');
                $('#basic_profile_info').show();
                location.reload();
                //$(".right_menu").load(location.href + " .right_menu");
                setTimeout(function() {
                   $("#basic_profile_info").hide();  
                }, 2000);               
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
        //   }
    }
function refreshDiv(){
         $("#web_container").load(location.href + " #web_container");
      } 
function deleteVideo(id){
      
    var check = confirm("Are you sure want to delete this video ?");
    if (check) {
        $('#loadmorebtn_loader').show();
        ajaxCsrf();
        $.ajax({
            type: "post",    
            url: baseUrl + '/deleteVideo',
            data:{"id":id},
            dataType: 'html',
            beforeSend: function () {
                      //$('#loader_spineer').show();
                    },
            success: function (html) {  
               $('#loadmorebtn_loader').hide();
               $('#delete_img_'+id).remove();
               $('#profileVideo').click();
            }
        });    
    }
}



function story_like_model(storyId){
 
     
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/story_like_model/'+storyId,
            dataType: 'html',
            success: function (res) {
                loadHTMLLikeModal(res);
            }
        });

}


function home_page(type=0,userId=0) {   
    $('#loader_spineer').show(); 
    ajaxCsrf();
    $.ajax({
        type: "post",    
        url: baseUrl + '/home_page',
        data:{"type":type,"userId":userId},
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                $("#golden_home_page").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

function postSlider(){
    // / $("#pv_slider").not('.slick-initialized').slick({

    //     //$('#pv_slider').slick({
    //     infinite: false,
    //     speed: 100,
    //     fade: true,
    //     cssEase: 'linear'
    //     // // dots: true,
    //     // infinite: true,
    //     // speed: 300,
    //     // slidesToShow: 1,
    //     // adaptiveHeight: true,
    //     // navbar:false
    // });
}

$(function () {




   // $('#urslider').slick({
   //   $("#urslider").not('.slick-initialized').slick({
   //      slidesToShow: 1,
   //      slidesToScroll: 1,
   //      autoplay: true,
   //      autoplaySpeed: 2000,
   //    });



   //   $("#story_view_slider").not('.slick-initialized').slick({
   //      infinite: false,
   //      speed: 100,
   //      fade: true,
   //      cssEase: 'linear'

   //  });

})

function updateComment(postId){
     ajaxCsrf();

      var fromData=$("#edit_comment_forms_id").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/updateComment',
        data:fromData,
        success: function (response) {

            $("#edit_comment_forms_id")[0].reset();
            $('#editComment').modal('hide');
            save_comment(postId, 1);
        }
    });
}

function editComment(postId,commentId){

     ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/editComment',
        data:{'postId':postId,'commentId':commentId},
        success: function (response) {
            $('#edit_comment_model_id').html(response);
        }
    });
}



function updateReplyComment(postId){
     ajaxCsrf();

      var fromData=$("#edit_reply_comment_forms_id").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/updateReplyComment',
        data:fromData,
        success: function (response) {

            $("#edit_reply_comment_forms_id")[0].reset();
            $('#editReplyComment').modal('hide');
            save_comment(postId, 1);
        }
    });
}


function editReplyComment(replyId,postId){

     ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/editReplyComment',
        data:{'postId':postId,'replyId':replyId},
        success: function (response) {
            $('#edit_reply_comment_model_id').html(response);
        }
    });
}

function ajaxCsrf() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}



$(document).on('click', '#like_id', function (e) {
    e.preventDefault();
    var like_id = $(this).val();
   
      
    if(like_id==="0"){        
        $('#login_post').modal('show');
        return false ;
    }

    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/post_like/' + like_id,
        success: function (response) {
            //alert(response.status);
            if (response.status == '1') {
                $("#like_count_" + like_id).html('<span id="like_count_' + like_id + '">' + response.count + '</span>');
                $("#post_like_span_id_" + like_id).html('<i class="ri-thumb-up-fill"></i>');
                post_like_listing(like_id);
            }
            if (response.status == '2') {
                $("#like_count_" + like_id).html('<span id="like_count_' + like_id + '">' + response.count + '</span>');
                $("#post_like_span_id_" + like_id).html('<i class="ri-thumb-up-line"></i>');
                post_like_listing(like_id);
            }

        }
    });
})

function goodies_like_model(goodies_like_id){
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/goodies_like_model/'+goodies_like_id,
            dataType: 'html',
            success: function (res) {
                loadHTMLLikeModal(res);
            }
        });

}



function event_like_model(event_like_id){
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/event_like_model/'+event_like_id,
            dataType: 'html',
            success: function (res) {
                loadHTMLLikeModal(res);
            }
        });

}

function notification_list(id){
     ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/notification_list/'+id,
            dataType: 'html',
            success: function (res) {
                //$('#notification_list').html(res) ;
                //$(".notify_bx").toggleClass('show');
               //loadHTMLLikeModal(res);
            }
        });

}

function read_notification(id){

$("#remove_notification_"+id).removeClass('active');
    ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/read_notification/'+id,
            dataType: 'json',
            success: function (res) {

                 if(res.status == 1){

                    //alert(res.count);
                   //notification_list(ids);
                   if(res.count > 0){
                    $('.nt_icon_n').html(res.count);
                    //$("#remove_notification_"+id).remove();
                   }else{
                      //  $("#remove_notification_"+id).remove();
                        // $(".notify_bx").hide();
                        $('.nt_icon_n').html("");
                        $(".nt_icon_n").removeClass();
                        //$(".isactive").addClass('hide');
                       // $(".isactive").removeClass();
                        //$("#web_container").load(location.href + " #web_container");
                   }


                 }
            }
        });
}
//
function accept_request(id){
    //alert("gfhghfg");
    ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/accept_request/'+id,
            //dataType: 'html',
            success: function (res) {

                if(res.status == 1){
                    if(res.count > 0){
                    $('.nt_icon_n').html(res.count);
                    $("#friend_request_id_"+id).remove();

                    }else{
                        $(".nt_icon_n").find("span").remove();
                        $("#friend_request_id_"+id).remove();

                    //$('.nt_icon_n').remove();
                    }

                  //$(".notify_bx").addClass('isactive');
                  //$("frend_request_id_"+id).remove();
                }
            }
        });
}

/**/

function post_like_model(like_id,isLogin=""){
 
     if(isLogin===0){
        $('#login_post').modal('show');
        return false ;
     }
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/post_like_model/'+like_id,
            dataType: 'html',
            success: function (res) {
                loadHTMLLikeModal(res);
            }
        });

}

function editPost(post_id,type){
   ///alert(post_id);
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/editPost/'+post_id,
            data:{"type":type},
            dataType: 'html',
            success: function (res) {
                $("#edit_post_model_id").html(res);
            }
        });

}
function stories_popup(){
      ajaxCsrf();
        $.ajax({
            type: "get",
            url: baseUrl + '/Stories',
            dataType: 'html',
            success: function (res) {
                $("#add_stories_popup_model").html(res);
            }
        });

}

    


   

function view_stroy_model(id){
    ajaxCsrf();
    $("#view_story_model_data_info").html('');
        $.ajax({
            type: "post",
            url: baseUrl + '/viewStoryModel/'+id,
            dataType: 'html',
            beforeSend: function () {
                    $('#loader_spineer').show();
                },
            success: function (res) {
                $('#loader_spineer').hide();
                 $("#view_story_model_data_info").html(''); 
                    $("#view_story_model_data_info").html(res);                
                
            }
        });

}

function delete_story_image(id){
    $("#stroy_image_delete_id").val(id);
    $("#story_image_delete_model").show();
    //$("#viewstory").hide();
    $('#viewstory').modal('hide');
}

function story_no(){
    $("#story_image_delete_model").hide();
}
function story_yes(){
    ajaxCsrf();
     var delete_id =$("#stroy_image_delete_id").val();
        $.ajax({
            type: "post",
            url: baseUrl + '/deleteStoryImage/'+delete_id,
            dataType: 'html',
            success: function (res) {
                if(res==1){
                    $('#story_image_'+delete_id).remove();
                    $("#story_image_delete_model").hide();
                    $(".up_story_id").load(location.href + " .up_story_id");
                    $("#story_success_delete").show();
                    setTimeout(function() {
                           $("#story_success_delete").hide();
                        }, 2000);
                }
            }
        });

}





function post_image_delete(image_id){
     //alert(image_id);
    ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/post_image_delete/'+image_id,
            dataType: 'html',
            success: function (res) {
               if(res== 1){
                 $('#image_id_'+image_id).remove();
               }
            }
        });
}

function loadHTMLLikeModal(htmlContent) {
    // Create a new modal element
    var modal = $('');
    var modal = $(htmlContent);
    var modal = $(htmlContent);
    modal.appendTo('body');
    modal.modal('show');
    modal.on('hidden.bs.modal', function () {
    modal.remove();
    });

}

function post_like_listing(like_id){
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/post_like_listing/'+like_id,
            dataType: 'json',
            success: function (res) {

                $("#like_name_"+like_id).html('');
                var i=0;
                //alert(res.like.length);
                //$.each(res.like, function (key, like_data) {
                // if(i < 1){
    //                 // '+like_data.name+'
                // $("#like_name_"+like_id).append('<div class="ol_n">1</div>');
                // }
               //  i++;
                //});
                //if(i > 0 ){
                if(res.like > 0){
                    res.like=res.like ;
                }else{
                    res.like='';
                }
                $("#like_name_"+like_id).append('<div class="ol_odbx"><button type="button" class="btn" onclick="post_like_model('+like_id+')">'+res.like+' </button></div>');
                //}
            }
        });

}

function delete_post(id){


}

function delete_post_no(){
     $("#tsk_mdlBox_body").hide();

}

function delete_post_yes(){
    //alert(delete_id);
      var delete_id =$("#post_id_delete").val();
      ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/post_delete/' + delete_id,
        success: function (response) {
             $("#tsk_mdlBox_body").hide();
             $("#success_delete").show();
             setTimeout(function() {
               $("#success_delete").hide();
            }, 2000);
            $('#post_card_lisitng_' + delete_id).remove();
        }
    });

}

$(document).on('click', '#delete_id', function (e) {
    e.preventDefault();
    var delete_id = $(this).val();
    $("#post_id_delete").val(delete_id);
    $("#tsk_mdlBox_body").show();
     /* ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/post_delete/' + delete_id,
        success: function (response) {
            $('#post_card_lisitng_' + delete_id).remove();
        }post_list_chat_

    });  */
})
$(document).on('click', '#message_id', function (e) {
    e.preventDefault();
    var post_id = $(this).val();
    $("#post_chat_sect_" + post_id).toggle();
    $("#post_list_chat_" + post_id).toggle();
    save_comment(post_id, 1);
})


$(document).on('click', '#event_message_id', function (e) {
    e.preventDefault();
    var post_id = $(this).val();
    $("#event_chat_sect_" + post_id).toggle();
    $("#event_list_chat_" + post_id).toggle();
    event_save_comment(post_id, 1);
})


/* $(document).on('click','#comment_id',function(e){
e.preventDefault();
var comment_id=$(this).val();
ajaxCsrf();
    $.ajax({
    type: "post",
    url: baseUrl+'/comment_like/'+comment_id,
    success: function(response){
     //$("#count_"+comment_id).html('');
     $("#count_"+comment_id).html('<span id="count_'+comment_id+'">'+response+'</span>');
    }
    });
}) */
/* $(document).on('click','#reply_like_id',function(e){
e.preventDefault();
var reply_like_id=$(this).val();
//alert(reply_like_id);
ajaxCsrf();
    $.ajax({
    type: "post",
    url: baseUrl+'/reply_comment_like/'+reply_like_id,
    success: function(response){
     //$("#reply_count_"+reply_like_id).html('');
     //$('#reply_count_'+reply_like_id+' span').html(response);
    $("#reply_count_"+reply_like_id).html('<span id="reply_count_'+reply_like_id+'">'+response+'</span>');
    }
    });
}) */



function comment_like(id, post_id,isLogin='') {
         

        if(isLogin===0){
        $('#login_post').modal('show');
        return false ;
        }

    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/comment_like/' + id,
        success: function (response) {
            save_comment(post_id, 1);
        }
    });

}

function event_comment_like(id, event_id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/event_comment_like/' + id,
        success: function (response) {
            event_save_comment(event_id, 1);
        }
    });

}

$(document).on('click', '#reply_from_hide', function (e) {
    e.preventDefault();
    var form_id = $(this).val();
    $("#reply_comment_id_" + form_id).toggle();
})


$(document).on('click', '#goodies_reply_from_hide', function (e) {
    e.preventDefault();
    var form_id = $(this).val();
    $("#reply_goodies_form_id_" + form_id).toggle();
    $("#goodies_chat_reply_list_" + form_id).toggle();
})

$(document).on('click', '#event_reply_from_hide', function (e) {
    e.preventDefault();
    var form_id = $(this).val();
    $("#reply_event_form_id_" + form_id).toggle();
    $("#event_chat_reply_list_" + form_id).toggle();
})

function reply_like(id, post_id,isLogin='') {
    //alert(id);

      if(isLogin===0){
        $('#login_post').modal('show');
        return false ;
        }

    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/reply_comment_like/' + id,
        success: function (response) {
            save_comment(post_id, 1);
        }
    });

}

function save_reply_comment(id, post_id) {

    var reply_comment = $('#reply_coment_id_' + id).val();
    $('.err').html('');
    if (reply_comment == '') {
        $('#error_reply_comment').html('Please enter comment');
    } else {
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_reply_comment',
            data: { 'comment_id': id, 'reply_comment': reply_comment, 'post_id': post_id },
            dataType: 'json',
            success: function (response) {
                $("#reply_comment_id_" + id)[0].reset();
                save_comment(post_id, 1);
                // $("#count_"+comment_id).html('');
                //$("#count_"+comment_id).html('<span id="count_'+comment_id+'">'+response+'</span>');
            }
        });
    }
}

function save_event_reply_comment(id, event_id) {
    var reply_comment = $('#reply_event_comment_id_' + id).val();
    $('.err').html('');
    if (reply_comment == '') {
        $('#error_event_reply_comment').html('Please enter comment');
    } else {
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_event_reply_comment',
            data: { 'comment_id': id, 'reply_comment': reply_comment, 'event_id': event_id },
            dataType: 'json',
            success: function (response) {
                $("#reply_event_form_id_" + id)[0].reset();
                event_save_comment(event_id, 1);
                // $("#count_"+comment_id).html('');
                //$("#count_"+comment_id).html('<span id="count_'+comment_id+'">'+response+'</span>');
            }
        });
    }
}

function event_reply_comment_like(id, event_id) {
    //alert(id);
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/event_reply_comment_like/' + id,
        success: function (response) {
            event_save_comment(event_id, 1);
        }
    });

}

function save_goodies_reply_comment(id, goodies_id) {
    var reply_comment = $('#reply_goodies_comment_id_' + id).val();
    $('.err').html('');
    if (reply_comment == '') {
        $('#error_goodies_reply_comment').html('Please enter comment');
    } else {
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_goodies_reply_comment',
            data: { 'comment_id': id, 'reply_comment': reply_comment, 'goodies_id': goodies_id },
            dataType: 'json',
            success: function (response) {
                $("#reply_goodies_form_id_" + id)[0].reset();
                goodies_save_comment(goodies_id, 1);
                // $("#count_"+comment_id).html('');
                //$("#count_"+comment_id).html('<span id="count_'+comment_id+'">'+response+'</span>');
            }
        });
    }
}


function goodies_comment_like(id, goodies_id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/goodies_comment_like/' + id,
        success: function (response) {
            goodies_save_comment(goodies_id, 1);
        }
    });

}

function goodies_reply_like(id, goodies_id) {
    //alert(id);
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/goodies_reply_comment_like/' + id,
        success: function (response) {
            goodies_save_comment(goodies_id, 1);
        }
    });

}

function post_comment_delete(post_id, comment_id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/post_comment_delete/' + comment_id,
        success: function (response) {
            $('#commmnet_listing_' + comment_id).remove();
            save_comment(post_id, 1);
        }
    });

}

function reply_comment_delete(id, post_id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/reply_comment_delete/' + id,
        success: function (response) {
            $('#reply_comment_' + id).remove();
            //$('#post_list_chat_'+post_comment_id).removeClass('#post_list_chat_'+post_comment_id);
            save_comment(post_id, 1);
        }
    });

}

function save_comment_old(id, type = 0) {

    var comment = $('#comment_' + id).val();
    $('.err').html('');
    if (comment == '' && type == 0) {
        $('#error_comment').html('Please enter comment');
    } else {
        // var formData=new FormData($('#comment_save_id')[0]);
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_comment',
            data: { 'post_id': id, 'comment': comment, 'type': type },
            dataType: 'json',
            beforeSend: function () {
                //ajax_before();
            },
            success: function (res) {

                // ajax_success() ;
                if (res) {
                    //alert(res.comment_info.length);
                    if (res.comment_info.length == 0) {
                        $("#message_count_" + id).html('');
                    }
                    $("#comment_save_id_" + id)[0].reset();
                    $("#post_list_chat_" + id).html('');
                    //Post_listing();
                    $.each(res.comment_info, function (key, comment_data) {
                        $("#message_count_" + id).html('<sup id="message_count_' + id + '">' + comment_data.comment_count + '</sup>');
                        if (comment_data.is_comment == 'Yes') {
                            var yes = '<div class="chat_reply_list" id="chat_reply_list_' + comment_data.id + '"></div>';
                        } else {
                            var yes = '';
                        }
                        if (comment_data.user_id == comment_data.session_user_id) {
                            var comment_reply = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment" onclick="editComment(' + id + ',' + comment_data.id + ');">Edit</a></li><li onclick="post_comment_delete(' + id + ',' + comment_data.id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                        } else {
                            var comment_reply = '';
                        }
                        $("#post_list_chat_" + id).append('<div class="post_bx" id="commmnet_listing_' + comment_data.id + '"><div class="user_avtar"><img src="' + comment_data.image + '" alt=""></div><div class="post_details"><div class="cont_user"><h3><span>' + comment_data.name + '</span>' + comment_reply + '</h3><p>' + comment_data.time + '</p></div><div class="post_descrip"><p>' + comment_data.comment + '</p></div><div class="post_commit"><ul><li onclick="comment_like(' + comment_data.id + ',' + id + ')"> <a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g> <defs><clipPath id="clip0_1421_4501"><rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="count_' + comment_data.id + '">' + comment_data.comment_likes + '</span></div></div></a> </li> <li id="reply_from_hide" value=' + comment_data.id + '><a><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7258)"><path d="M17.25 18.0017C17.0511 18.0017 16.8604 17.9227 16.7197 17.782C16.5791 17.6414 16.5 17.4506 16.5 17.2517C16.4989 16.0586 16.0244 14.9147 15.1807 14.071C14.3371 13.2274 13.1932 12.7529 12 12.7517H7.62754V13.9412C7.62748 14.2378 7.53947 14.5278 7.37465 14.7744C7.20982 15.021 6.97558 15.2132 6.70153 15.3267C6.42748 15.4402 6.12593 15.4699 5.835 15.4121C5.54407 15.3542 5.27682 15.2114 5.06704 15.0017L0.657793 10.5924C0.235983 10.1705 -0.000976563 9.5983 -0.000976562 9.00168C-0.000976563 8.40506 0.235983 7.83287 0.657793 7.41093L5.06704 3.00168C5.27682 2.79197 5.54407 2.64916 5.835 2.59131C6.12593 2.53345 6.42748 2.56316 6.70153 2.67666C6.97558 2.79017 7.20982 2.98238 7.37465 3.22899C7.53947 3.47561 7.62748 3.76555 7.62754 4.06218V5.25168H11.25C13.0396 5.25367 14.7554 5.96546 16.0208 7.2309C17.2863 8.49634 17.9981 10.2121 18 12.0017V17.2517C18 17.4506 17.921 17.6414 17.7804 17.782C17.6397 17.9227 17.449 18.0017 17.25 18.0017ZM6.12754 4.06218L1.71829 8.47143C1.57769 8.61208 1.4987 8.80281 1.4987 9.00168C1.4987 9.20055 1.57769 9.39128 1.71829 9.53193L6.12754 13.9412V12.0017C6.12754 11.8028 6.20656 11.612 6.34721 11.4714C6.48787 11.3307 6.67863 11.2517 6.87754 11.2517H12C12.8517 11.2514 13.6937 11.4329 14.4697 11.7839C15.2457 12.1349 15.9379 12.6474 16.5 13.2872V12.0017C16.4985 10.6098 15.9448 9.27535 14.9606 8.29112C13.9764 7.3069 12.6419 6.75327 11.25 6.75168H6.87754C6.67863 6.75168 6.48787 6.67266 6.34721 6.53201C6.20656 6.39136 6.12754 6.20059 6.12754 6.00168V4.06218Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7258"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></span><span>' + comment_data.reply_comment_count + '</span></a></li></ul></div><div class="post_chat_sect"><div class="send-message"><form id="reply_comment_id_' + comment_data.id + '" action="javascript:void(0);"><div class="user_img"><img src="' + comment_data.session_image + '" alt=""></div><div class="post_text_area"><textarea  rows="1" type="text" placeholder="Reply" id="reply_coment_id_' + comment_data.id + '"  class="msg_int_style"></textarea><span id="error_reply_comment" class="err"></span></div><button class="btn_post" onclick="save_reply_comment(' + comment_data.id + ',' + id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath>defs></svg></button><div class="attachment-file_post"><button class="btn"></button><button class="btn"></button></div></form></div></div>' + yes + '</div></div></div>')
                        $('#chat_reply_list_' + id).html('');
                        $.each(comment_data.reply_info, function (key1, rep_info) {

                            if (rep_info.user_id == rep_info.session_user_id) {
                                var reply_edit = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath> </defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReplyComment" onclick="editReplyComment(' + rep_info.id + ',' + rep_info.post_id + ');">Edit</a></li><li onclick="reply_comment_delete(' + rep_info.id + ',' + rep_info.post_id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                            } else {
                                var reply_edit = '';
                            }

                            $('#chat_reply_list_' + rep_info.comment_id).append('<div class="crd_bx" id="reply_comment_' + rep_info.id + '"><div class="user_avtar"><img src=' + rep_info.image + ' alt=""></div><div class="user_details"><div class="user_cont"><h3><span>' + rep_info.name + '</span>' + reply_edit + '</h3><p>' + rep_info.time + '</p></div><div class="reply_descrip"><p>' + rep_info.reply_comment + '</p></div><div class="post_commit"><ul><li onclick="reply_like(' + rep_info.id + ',' + id + ')"><a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1421_4501"> <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="reply_count_' + rep_info.id + '">' + rep_info.reply_like_count + '</span></div></div></a></li></ul></div></div></div>')
                        })
                    })
                    if (type == 0) {
                        $("#post_chat_sect_" + id).show();
                        $("#post_list_chat_" + id).show();
                    }
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

$(document).on('click', '#goodies_message', function (e) {
    e.preventDefault();
    var goodies_id = $(this).val();
    //alert(goodies_id);
    $("#goodies_post_chat_sect_" + goodies_id).toggle();
    $("#goodies_post_list_chat_" + goodies_id).toggle();
    goodies_save_comment(goodies_id, 1);
})

function save_reply_comment(id, post_id) {
    var reply_comment = $('#reply_coment_id_' + id).val();
    $('.err').html('');
    if (reply_comment == '') {
        $('#error_reply_comment').html('Please enter comment');
    } else {
        $('#loader_spineer').show();
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_reply_comment',
            data: { 'comment_id': id, 'reply_comment': reply_comment, 'post_id': post_id },
            dataType: 'json',
            success: function (response) {
                $('#loader_spineer').hide();
                $("#reply_comment_id_" + id)[0].reset();
                save_comment(post_id, 1);
                // $("#count_"+comment_id).html('');
                //$("#count_"+comment_id).html('<span id="count_'+comment_id+'">'+response+'</span>');
            }
        });
    }
}

function save_comment(id, type = 0,isLogin=0) {
   
    var comment = $('#comment_' + id).val();

    $('.err').html('');
    if (comment == '' && type == 0) {
        $('#error_comment').html('Please enter comment');
    } else {
        $('#loader_spineer').show();
        // var formData=new FormData($('#comment_save_id')[0]);             
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_comment',
            data: { 'post_id': id, 'comment': comment, 'type': type },
            dataType: 'json',
            beforeSend: function () {
                //ajax_before();
            },
            success: function (res) {
            // debugger ;
            
                // ajax_success() ;
                $('#loader_spineer').hide();
                if (res) {
                    //alert(res.comment_info.length);
                    if (res.comment_info.length == 0) {
                        $("#message_count_" + id).html('');
                    }
                    $("#comment_save_id_" + id)[0].reset();
                    $("#post_list_chat_" + id).html('');
                    //Post_listing();
                    $.each(res.comment_info, function (key, comment_data) {
                        $("#message_count_" + id).html('<sup id="message_count_' + id + '">' + comment_data.comment_count + '</sup>');
                        if (comment_data.is_comment == 'Yes') {
                            var yes = '<div class="chat_reply_list" id="chat_reply_list_' + comment_data.id + '"></div>';
                        } else {
                            var yes = '';
                        }

                        if (comment_data.session_user_id!==0 &&  comment_data.user_id == comment_data.session_user_id) {
                           
                            var comment_reply ='<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment" onclick="editComment(' + id + ',' + comment_data.id + ');">Edit</a></li><li onclick="post_comment_delete(' + id + ',' + comment_data.id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                        } else {
                           
                            var comment_reply = '';
                        }

                        var postRC='<div class="post_bx" id="commmnet_listing_' + comment_data.id + '"><div class="user_avtar"><img src="' + comment_data.image + '" alt=""></div><div class="post_details"><div class="cont_user"><h3><span>' + comment_data.name + '</span>' + comment_reply + '</h3><p>' + comment_data.time + '</p></div><div class="post_descrip"><p>' + comment_data.comment + '</p></div><div class="post_commit"><ul><li onclick="comment_like(' + comment_data.id + ',' + id + ','+comment_data.session_user_id+')"> <a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g> <defs><clipPath id="clip0_1421_4501"><rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="count_' + comment_data.id + '">' + comment_data.comment_likes + '</span></div></div></a> </li> <li id="reply_from_hide" value=' + comment_data.id + '><a><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7258)"><path d="M17.25 18.0017C17.0511 18.0017 16.8604 17.9227 16.7197 17.782C16.5791 17.6414 16.5 17.4506 16.5 17.2517C16.4989 16.0586 16.0244 14.9147 15.1807 14.071C14.3371 13.2274 13.1932 12.7529 12 12.7517H7.62754V13.9412C7.62748 14.2378 7.53947 14.5278 7.37465 14.7744C7.20982 15.021 6.97558 15.2132 6.70153 15.3267C6.42748 15.4402 6.12593 15.4699 5.835 15.4121C5.54407 15.3542 5.27682 15.2114 5.06704 15.0017L0.657793 10.5924C0.235983 10.1705 -0.000976563 9.5983 -0.000976562 9.00168C-0.000976563 8.40506 0.235983 7.83287 0.657793 7.41093L5.06704 3.00168C5.27682 2.79197 5.54407 2.64916 5.835 2.59131C6.12593 2.53345 6.42748 2.56316 6.70153 2.67666C6.97558 2.79017 7.20982 2.98238 7.37465 3.22899C7.53947 3.47561 7.62748 3.76555 7.62754 4.06218V5.25168H11.25C13.0396 5.25367 14.7554 5.96546 16.0208 7.2309C17.2863 8.49634 17.9981 10.2121 18 12.0017V17.2517C18 17.4506 17.921 17.6414 17.7804 17.782C17.6397 17.9227 17.449 18.0017 17.25 18.0017ZM6.12754 4.06218L1.71829 8.47143C1.57769 8.61208 1.4987 8.80281 1.4987 9.00168C1.4987 9.20055 1.57769 9.39128 1.71829 9.53193L6.12754 13.9412V12.0017C6.12754 11.8028 6.20656 11.612 6.34721 11.4714C6.48787 11.3307 6.67863 11.2517 6.87754 11.2517H12C12.8517 11.2514 13.6937 11.4329 14.4697 11.7839C15.2457 12.1349 15.9379 12.6474 16.5 13.2872V12.0017C16.4985 10.6098 15.9448 9.27535 14.9606 8.29112C13.9764 7.3069 12.6419 6.75327 11.25 6.75168H6.87754C6.67863 6.75168 6.48787 6.67266 6.34721 6.53201C6.20656 6.39136 6.12754 6.20059 6.12754 6.00168V4.06218Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7258"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></span><span>' + comment_data.reply_comment_count + '</span></a></li></ul></div>' ;
                        
                        var postRC_ ='<div class="post_chat_sect"><div class="send-message"><form id="reply_comment_id_' + comment_data.id + '" action="javascript:void(0);"><div class="user_img"><img src="' + comment_data.session_image + '" alt=""></div><div class="post_text_area"><textarea  rows="1" type="text" placeholder="Reply" id="reply_coment_id_' + comment_data.id + '"  class="msg_int_style"></textarea><span id="error_reply_comment" class="err"></span></div><button class="btn_post" onclick="save_reply_comment(' + comment_data.id + ',' + id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath>defs></svg></button><div class="attachment-file_post"><button class="btn"></button><button class="btn"></button></div></form></div></div>' ;
                           
                           if(comment_data.session_user_id!==0){
                             $("#post_list_chat_" + id).append(postRC+postRC_+yes+'</div></div></div>');
                           }else{
                            $("#post_list_chat_" + id).append(postRC+yes+'</div></div></div>')
                           }
                          
                        $('#chat_reply_list_' + id).html('');
                        $.each(comment_data.reply_info, function (key1, rep_info) {

                            if (rep_info.session_user_id!==0 && rep_info.user_id == rep_info.session_user_id) {
                                var reply_edit = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath> </defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReplyComment" onclick="editReplyComment(' + rep_info.id + ',' + rep_info.post_id + ');">Edit</a></li><li onclick="reply_comment_delete(' + rep_info.id + ',' + rep_info.post_id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                            } else {
                                var reply_edit = '';
                            }

                            $('#chat_reply_list_' + rep_info.comment_id).append('<div class="crd_bx" id="reply_comment_' + rep_info.id + '"><div class="user_avtar"><img src=' + rep_info.image + ' alt=""></div><div class="user_details"><div class="user_cont"><h3><span>' + rep_info.name + '</span>' + reply_edit + '</h3><p>' + rep_info.time + '</p></div><div class="reply_descrip"><p>' + rep_info.reply_comment + '</p></div><div class="post_commit"><ul><li onclick="reply_like(' + rep_info.id + ',' + id +','+comment_data.session_user_id+')"><a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1421_4501"> <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="reply_count_' + rep_info.id + '">' + rep_info.reply_like_count + '</span></div></div></a></li></ul></div></div></div>')
                        })
                    })
                    if (isLogin!='NA') {
                        $("#post_chat_sect_" + id).show();
                        
                    }

         
                   
                   
                   
                   if(type==2 && res.data.isShowMore){
                    var isLogin_ = (isLogin==='NA')?0:isLogin ;
                    $('#loadmorePDetail').html('');
                    $('#loadmorePDetail').html('<span id="postDetailViewMore" onclick="ajax_comment_load_more('+id+','+res.data.type+','+res.data.page+','+isLogin_+')"><b>View more comments...</b></span>');
                   }
                    
                    
                    $("#post_list_chat_" + id).show();
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

function ajax_comment_load_more(id, type = 0,page=1,isLogin=0) {  
    
    
   // $('.err').html('');
  
        $('#loader_spineer').show();
        // var formData=new FormData($('#comment_save_id')[0]);             
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/ajax_comment',
            data: { 'post_id': id,'type': type,'page':page },
            dataType: 'json',
            beforeSend: function () {
                //ajax_before();
            },
            success: function (res) {
            // debugger ;

                // ajax_success() ;
                $('#loader_spineer').hide();
                if(res){

                    //alert(res.comment_info.length);
                    // if (res.comment_info.length == 0) {
                    //     $("#message_count_" + id).html('');
                    // }

                   // $("#comment_save_id_" + id)[0].reset();
                    //$("#post_list_chat_" + id).html('');
                    //Post_listing();
                    $.each(res.comment_info, function (key, comment_data) {
                        $("#message_count_" + id).html('<sup id="message_count_' + id + '">' + comment_data.comment_count + '</sup>');
                        if (comment_data.is_comment == 'Yes') {
                            var yes = '<div class="chat_reply_list" id="chat_reply_list_' + comment_data.id + '"></div>';
                        } else {
                            var yes = '';
                        }

                        if (comment_data.session_user_id!==0 &&  comment_data.user_id == comment_data.session_user_id) {
                           
                            var comment_reply ='<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment" onclick="editComment(' + id + ',' + comment_data.id + ');">Edit</a></li><li onclick="post_comment_delete(' + id + ',' + comment_data.id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                        } else {
                           
                            var comment_reply = '';
                        }

                        var postRC='<div class="post_bx" id="commmnet_listing_' + comment_data.id + '"><div class="user_avtar"><img src="' + comment_data.image + '" alt=""></div><div class="post_details"><div class="cont_user"><h3><span>' + comment_data.name + '</span>' + comment_reply + '</h3><p>' + comment_data.time + '</p></div><div class="post_descrip"><p>' + comment_data.comment + '</p></div><div class="post_commit"><ul><li onclick="comment_like(' + comment_data.id + ',' + id + ','+comment_data.session_user_id+')"> <a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g> <defs><clipPath id="clip0_1421_4501"><rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="count_' + comment_data.id + '">' + comment_data.comment_likes + '</span></div></div></a> </li> <li id="reply_from_hide" value=' + comment_data.id + '><a><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7258)"><path d="M17.25 18.0017C17.0511 18.0017 16.8604 17.9227 16.7197 17.782C16.5791 17.6414 16.5 17.4506 16.5 17.2517C16.4989 16.0586 16.0244 14.9147 15.1807 14.071C14.3371 13.2274 13.1932 12.7529 12 12.7517H7.62754V13.9412C7.62748 14.2378 7.53947 14.5278 7.37465 14.7744C7.20982 15.021 6.97558 15.2132 6.70153 15.3267C6.42748 15.4402 6.12593 15.4699 5.835 15.4121C5.54407 15.3542 5.27682 15.2114 5.06704 15.0017L0.657793 10.5924C0.235983 10.1705 -0.000976563 9.5983 -0.000976562 9.00168C-0.000976563 8.40506 0.235983 7.83287 0.657793 7.41093L5.06704 3.00168C5.27682 2.79197 5.54407 2.64916 5.835 2.59131C6.12593 2.53345 6.42748 2.56316 6.70153 2.67666C6.97558 2.79017 7.20982 2.98238 7.37465 3.22899C7.53947 3.47561 7.62748 3.76555 7.62754 4.06218V5.25168H11.25C13.0396 5.25367 14.7554 5.96546 16.0208 7.2309C17.2863 8.49634 17.9981 10.2121 18 12.0017V17.2517C18 17.4506 17.921 17.6414 17.7804 17.782C17.6397 17.9227 17.449 18.0017 17.25 18.0017ZM6.12754 4.06218L1.71829 8.47143C1.57769 8.61208 1.4987 8.80281 1.4987 9.00168C1.4987 9.20055 1.57769 9.39128 1.71829 9.53193L6.12754 13.9412V12.0017C6.12754 11.8028 6.20656 11.612 6.34721 11.4714C6.48787 11.3307 6.67863 11.2517 6.87754 11.2517H12C12.8517 11.2514 13.6937 11.4329 14.4697 11.7839C15.2457 12.1349 15.9379 12.6474 16.5 13.2872V12.0017C16.4985 10.6098 15.9448 9.27535 14.9606 8.29112C13.9764 7.3069 12.6419 6.75327 11.25 6.75168H6.87754C6.67863 6.75168 6.48787 6.67266 6.34721 6.53201C6.20656 6.39136 6.12754 6.20059 6.12754 6.00168V4.06218Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7258"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></span><span>' + comment_data.reply_comment_count + '</span></a></li></ul></div>' ;
                        
                        var postRC_ ='<div class="post_chat_sect"><div class="send-message"><form id="reply_comment_id_' + comment_data.id + '" action="javascript:void(0);"><div class="user_img"><img src="' + comment_data.session_image + '" alt=""></div><div class="post_text_area"><textarea  rows="1" type="text" placeholder="Reply" id="reply_coment_id_' + comment_data.id + '"  class="msg_int_style"></textarea><span id="error_reply_comment" class="err"></span></div><button class="btn_post" onclick="save_reply_comment(' + comment_data.id + ',' + id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath>defs></svg></button><div class="attachment-file_post"><button class="btn"></button><button class="btn"></button></div></form></div></div>' ;
                           
                           if(comment_data.session_user_id!==0){
                             $("#post_list_chat_" + id).append(postRC+postRC_+yes+'</div></div></div>');
                           }else{
                            $("#post_list_chat_" + id).append(postRC+yes+'</div></div></div>')
                           }
                          
                        $('#chat_reply_list_' + id).html('');
                        $.each(comment_data.reply_info, function (key1, rep_info) {

                            if (rep_info.session_user_id!==0 && rep_info.user_id == rep_info.session_user_id) {
                                var reply_edit = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath> </defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReplyComment" onclick="editReplyComment(' + rep_info.id + ',' + rep_info.post_id + ');">Edit</a></li><li onclick="reply_comment_delete(' + rep_info.id + ',' + rep_info.post_id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                            } else {
                                var reply_edit = '';
                            }

                            $('#chat_reply_list_' + rep_info.comment_id).append('<div class="crd_bx" id="reply_comment_' + rep_info.id + '"><div class="user_avtar"><img src=' + rep_info.image + ' alt=""></div><div class="user_details"><div class="user_cont"><h3><span>' + rep_info.name + '</span>' + reply_edit + '</h3><p>' + rep_info.time + '</p></div><div class="reply_descrip"><p>' + rep_info.reply_comment + '</p></div><div class="post_commit"><ul><li onclick="reply_like(' + rep_info.id + ',' + id +','+comment_data.session_user_id+')"><a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1421_4501"> <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="reply_count_' + rep_info.id + '">' + rep_info.reply_like_count + '</span></div></div></a></li></ul></div></div></div>')
                        })
                    })
                    if (isLogin!='NA') {
                        $("#post_chat_sect_" + id).show();
                        
                    }
                    
                    $("#post_list_chat_" + id).show();

                     $('#loadmorePDetail').html('');
                   if(res.data.isShowMore){                  
                    
                     var isLogin_ = (isLogin==='NA')?0:isLogin ;
                    $('#loadmorePDetail').html('<span id="postDetailViewMore" onclick="ajax_comment_load_more('+id+','+res.data.type+','+res.data.page+','+isLogin_+')"><b>View more comments...</b></span>');
                   }

                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    

}

function goodies_save_comment(id, type = 0) {
    var comment = $('#goodies_comment_' + id).val();
    $('.err').html('');
    if (comment == '' && type == 0) {
        $('#error_goodies_comment').html('Please enter comment');
    } else {
        //var formData=new FormData($('#goodies_comment_save_id')[0]);
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/goodies_save_comment',
            data: { 'goodies_id': id, 'comment': comment, 'type': type },
            dataType: 'json',
            beforeSend: function () {
                //ajax_before();
            },
            success: function (res) {
                // ajax_success() ;
                if (res) {
                    if (res.comment_info.length == 0) {
                        $("#goodies_message_count_" + id).html('');
                    }
                    $("#goodies_comment_save_id_" + id)[0].reset();
                    $("#goodies_post_list_chat_" + id).html('');
                    $.each(res.comment_info, function (key, comment_data) {
                        $("#goodies_message_count_" + id).html('<sup id="goodies_message_count_' + id + '">' + comment_data.comment_count + '</sup>');
                        if (comment_data.is_comment == 'Yes') {
                            var yes = '<div class="chat_reply_list" id="goodies_chat_reply_list_' + comment_data.id + '"></div>';
                        } else {
                            var yes = '';
                        }
                        if (comment_data.user_id == comment_data.session_user_id) {
                            var comment_reply = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment" onclick="editGoodiesComment(' + id + ',' + comment_data.id + ');">Edit</a></li><li onclick="goodies_comment_delete(' + id + ',' + comment_data.id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                        } else {
                            var comment_reply = '';
                        }
                        $("#goodies_post_list_chat_" + id).append('<div class="post_bx" id="goodies_commnet_listing_' + comment_data.id + '"><div class="user_avtar"><img src="' + comment_data.image + '" alt=""></div><div class="post_details"><div class="cont_user"><h3><span>' + comment_data.name + '</span>' + comment_reply + '</h3><p>' + comment_data.time + '</p></div><div class="post_descrip"><p>' + comment_data.comment + '</p></div><div class="post_commit"><ul><li onclick="goodies_comment_like(' + comment_data.id + ',' + id + ')"> <a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g> <defs><clipPath id="clip0_1421_4501"><rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="count_' + comment_data.id + '">' + comment_data.comment_likes + '</span></div></div></a> </li> <li id="goodies_reply_from_hide" value=' + comment_data.id + '><a><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7258)"><path d="M17.25 18.0017C17.0511 18.0017 16.8604 17.9227 16.7197 17.782C16.5791 17.6414 16.5 17.4506 16.5 17.2517C16.4989 16.0586 16.0244 14.9147 15.1807 14.071C14.3371 13.2274 13.1932 12.7529 12 12.7517H7.62754V13.9412C7.62748 14.2378 7.53947 14.5278 7.37465 14.7744C7.20982 15.021 6.97558 15.2132 6.70153 15.3267C6.42748 15.4402 6.12593 15.4699 5.835 15.4121C5.54407 15.3542 5.27682 15.2114 5.06704 15.0017L0.657793 10.5924C0.235983 10.1705 -0.000976563 9.5983 -0.000976562 9.00168C-0.000976563 8.40506 0.235983 7.83287 0.657793 7.41093L5.06704 3.00168C5.27682 2.79197 5.54407 2.64916 5.835 2.59131C6.12593 2.53345 6.42748 2.56316 6.70153 2.67666C6.97558 2.79017 7.20982 2.98238 7.37465 3.22899C7.53947 3.47561 7.62748 3.76555 7.62754 4.06218V5.25168H11.25C13.0396 5.25367 14.7554 5.96546 16.0208 7.2309C17.2863 8.49634 17.9981 10.2121 18 12.0017V17.2517C18 17.4506 17.921 17.6414 17.7804 17.782C17.6397 17.9227 17.449 18.0017 17.25 18.0017ZM6.12754 4.06218L1.71829 8.47143C1.57769 8.61208 1.4987 8.80281 1.4987 9.00168C1.4987 9.20055 1.57769 9.39128 1.71829 9.53193L6.12754 13.9412V12.0017C6.12754 11.8028 6.20656 11.612 6.34721 11.4714C6.48787 11.3307 6.67863 11.2517 6.87754 11.2517H12C12.8517 11.2514 13.6937 11.4329 14.4697 11.7839C15.2457 12.1349 15.9379 12.6474 16.5 13.2872V12.0017C16.4985 10.6098 15.9448 9.27535 14.9606 8.29112C13.9764 7.3069 12.6419 6.75327 11.25 6.75168H6.87754C6.67863 6.75168 6.48787 6.67266 6.34721 6.53201C6.20656 6.39136 6.12754 6.20059 6.12754 6.00168V4.06218Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7258"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></span><span>' + comment_data.reply_comment_count + '</span></a></li></ul></div><div class="post_chat_sect"><div class="send-message"><form id="reply_goodies_form_id_' + comment_data.id + '" action="javascript:void(0);"><div class="user_img"><img src="' + comment_data.session_image + '" alt=""></div><div class="post_text_area"><textarea  rows="1" type="text" placeholder="Reply" id="reply_goodies_comment_id_' + comment_data.id + '"  class="msg_int_style"></textarea><span id="error_goodies_reply_comment" class="err"></span></div><button class="btn_post" onclick="save_goodies_reply_comment(' + comment_data.id + ',' + id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath>defs></svg></button><div class="attachment-file_post"><button class="btn"></button><button class="btn"></button></div></form></div></div>' + yes + '</div></div></div>')
                        $('#goodies_chat_reply_list_' + id).html('');
                        $.each(comment_data.reply_info, function (key1, rep_info) {

                            if (rep_info.user_id == rep_info.session_user_id) {
                                var reply_edit = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath> </defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReplyComment" onclick="editGoodiesReplyComment(' + rep_info.id + ',' + rep_info.goodies_id + ');">Edit</a></li><li onclick="goodies_reply_comment_delete(' + rep_info.id + ',' + rep_info.goodies_id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                            } else {
                                var reply_edit = '';
                            }
                            $('#goodies_chat_reply_list_' + rep_info.comment_id).append('<div class="crd_bx" id="goodies_reply_comment_' + rep_info.id + '"><div class="user_avtar"><img src=' + rep_info.image + ' alt=""></div><div class="user_details"><div class="user_cont"><h3><span>' + rep_info.name + '</span>' + reply_edit + '</h3><p>' + rep_info.time + '</p></div><div class="reply_descrip"><p>' + rep_info.reply_comment + '</p></div><div class="post_commit"><ul><li onclick="goodies_reply_like(' + rep_info.id + ',' + id + ')"><a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1421_4501"> <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="reply_count_' + rep_info.id + '">' + rep_info.reply_like_count + '</span></div></div></a></li></ul></div></div></div>')
                        })
                    })
                    if (type == 0) {
                        $("#goodies_post_chat_sect_" + id).show();
                        $("#goodies_post_list_chat_" + id).show();
                    }
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

function goodies_comment_delete(post_id, comment_id) {

    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/goodies_comment_delete/' + comment_id,
        success: function (response) {
            $('#goodies_commnet_listing_' + comment_id).remove();
            goodies_save_comment(post_id, 1);
        }
    });

}

function goodies_reply_comment_delete(id, post_id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/goodies_reply_comment_delete/' + id,
        success: function (response) {
            $('#reply_comment_' + id).remove();
            goodies_save_comment(post_id, 1);
        }
    });

}


function Post_listing() {
    $.ajax({
        type: "get",
        url: baseUrl + '/Post_listing',
        dataType: 'json',
        beforeSend: function () {
            //ajax_before();
        },
        success: function (res) {
            $('#post_listing').html('');
            $.each(res.post_info, function (key, item) {
                $('#post_listing').html('');
                var post_id = item.id;

                if (item.post_user_id == item.session_user_id) {
                    var post_delete = '<div class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-line"></i></a><ul class="dropdown-menu" aria-labelledby="navbarDropdown"><li id="delete_id" value="' + item.id + '"><a class="dropdown-item" href="">Delete</a></li></ul></div>'
                } else {
                    var post_delete = '';
                }
                $.each(item.image, function (key1, item1) {
                    $('#post_listing').append('<div class="post_card"><div class="post_hd"><div class="post_user"><div class="user_avtar"><div class="img_bx"><img src="' + item.user_image + '" alt=""></div><div class="user_details"><div><h3>' + item['name'] + '</h3><p>' + item['time'] + '</p></div></div></div></div>' + post_delete + '</div><div class="description_post"><p>' + item['post_text'] + '</p></div><div class="post_banner" id="banner_image' + item.id + '"><img src=' + item1 + ' alt=""></div><div class="post_footer"><ul id="d_post_div"><li id="like_id" value="' + item.id + '"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072"><g id="Group" opacity="0.49"><path id="Vector" d="M0,0H25.444V27.072H0Z" fill="none"/><g id="Group-2" data-name="Group"><path id="Vector-2" data-name="Vector" d="M10.7,7.249c1.233.4,1.3,1.944.264,2.951a1.865,1.865,0,0,1,0,2.881,2.137,2.137,0,0,1-.176,2.857c.946,1.616-.286,2.365-1.1,2.365H.137a68.809,68.809,0,0,1,0-8.595A9.5,9.5,0,0,1,3.879,3.057S3.967.082,4.693.012c.726-.094,1.893.3,2.047,2.881A7.119,7.119,0,0,1,5.485,7.249s3.962-.4,5.216,0Z" transform="translate(9.988 3.852)" fill="#9f866f"/><path id="Vector-3" data-name="Vector" d="M4.754,10.234H.22A.228.228,0,0,1,0,10V.234A.228.228,0,0,1,.22,0H4.754a.228.228,0,0,1,.22.234V9.976a.235.235,0,0,1-.22.258Z" transform="translate(3.764 12.997)" fill="#9f866f"/></g></g></svg><sup>' + item.post_like_count + '</sup></a></li><li id="message_id" value="' + item.id + '"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072"><g id="Group" transform="translate(-45)" opacity="0.49"><path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(45)" fill="none"/><path id="Vector-2" data-name="Vector" d="M19.787,2.506V11.92a2.437,2.437,0,0,1-2.355,2.506H7.946L4.138,18.2a.305.305,0,0,1-.528-.234V14.426H2.355A2.437,2.437,0,0,1,0,11.92V2.506A2.437,2.437,0,0,1,2.355,0H17.41a2.469,2.469,0,0,1,2.377,2.506ZM12.04,10.328a.35.35,0,0,0-.33-.351H3.852a.35.35,0,0,0-.33.351v.164a.35.35,0,0,0,.33.351h7.858a.35.35,0,0,0,.33-.351ZM16.266,7.4a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,7.4Zm0-3a.432.432,0,0,0-.418-.445H3.94a.418.418,0,0,0-.418.445.432.432,0,0,0,.418.445H15.847A.432.432,0,0,0,16.266,4.4Z" transform="translate(47.839 4.379)" fill="#9f866f"/></g></svg><sup id="message_count_' + item.id + '">' + item.post_comment_count + '</sup></a></li><li><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="27.072" viewBox="0 0 25.444 27.072"><g id="Group" transform="translate(-90)" opacity="0.49"><path id="Vector" d="M0,0H25.444V27.072H0Z" transform="translate(90)" fill="none"/><path id="Vector-2" data-name="Vector" d="M17.806,17.681a3.048,3.048,0,0,1-2.949,3.138,3.048,3.048,0,0,1-2.949-3.138,3.727,3.727,0,0,1,.044-.515L5.172,12.459a2.909,2.909,0,0,1-2.223,1.077A3.048,3.048,0,0,1,0,10.4,3.048,3.048,0,0,1,2.949,7.26,2.89,2.89,0,0,1,5.194,8.384L12,3.864a2.62,2.62,0,0,1-.088-.726A3.048,3.048,0,0,1,14.857,0a3.048,3.048,0,0,1,2.949,3.138,3.048,3.048,0,0,1-2.949,3.138,2.826,2.826,0,0,1-1.915-.749L5.877,10.211v.422l6.911,4.777a2.883,2.883,0,0,1,2.047-.89,3.087,3.087,0,0,1,2.971,3.162Z" transform="translate(93.83 3.138)"         fill="#9f866f"/></g></svg><sup>2</sup></a></li></ul></div><div class="post_chat_sect" id="post_chat_sect_' + item.id + '" style="display:none"><div class="user_img"><img src="' + item.session_image + '" alt=""></div><div class="send-message"><form id="comment_save_id_' + post_id + '" action="javascript:void(0);" ><textarea rows="1" formcontrolname="ComentMeassge" type="text" id="comment_' + post_id + '" placeholder="Comment"class="msg_int_style ng-valid ng-pristine ng-touched"ng-reflect-name="ComentMeassge"></textarea><span id="error_comment" class="err"></span><button class="btn_post" onclick="save_comment(' + post_id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath></defs></svg></button><div class="attachment-file_post"></div></form></div></div><div class="post_list_chat" id="post_list_chat_' + item.id + '" style="display:none"></div></div>')

                })
            })
        }
    });

}

function goodiesdsfds() {
    $.ajax({
        type: "get",
        url: baseUrl + '/goodies',
        dataType: 'json',
        beforeSend: function () {
            //ajax_before();
        },
        success: function (res) {
        }
    })
}



//Event Listing start

$(document).on('click', '#All-tab', function (e) {
    e.preventDefault();
    var paid_id = $(this).val();
    $('#tab_Id_data').val(paid_id);

    clearEventFilter();
    event_listing(paid_id);
});

$(document).on('click', '#Paid-tab', function (e) {
    e.preventDefault();
    var paid_id = $(this).val();
    $('#tab_Id_data').val(paid_id);
    event_listing(paid_id);
});

$(document).on('click', '#Unpaid-tab', function (e) {
    e.preventDefault();
    var paid_id = $(this).val();
    $('#tab_Id_data').val(paid_id);
    event_listing(paid_id);
});

$(document).on('click', '#event_like_id', function (e) {
    var event_like_id = $(this).val();
    e.preventDefault();
    var tab_id = $('#tab_Id_data').val();
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/event_like/' + event_like_id,
        success: function (response) {
            //event_listing(tab_id);
            if(response == 1){

                $("#event_span_id_" + event_like_id).html('<i class="ri-thumb-up-fill"></i>');
                event_like_listing(event_like_id);
            }
            if(response == 2){

                $("#event_span_id_" + event_like_id).html('<i class="ri-thumb-up-line"></i>');
                event_like_listing(event_like_id);
            }

        }
    });
})



function event_like_listing(event_like_id){
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/event_like_listing/'+event_like_id,
            dataType: 'json',
            success: function (res) {
                $("#event_like_name_"+event_like_id).html('');
                var i=0;
                //alert(res.like.length);
                // $.each(res.like, function (key, like_data) {
                // if(i < 1){
                // $("#event_like_name_"+event_like_id).append('<div class="ol_n">'+like_data.name+'</div>');
                // }
    //              i++;
                // });
                if(res.like < 1){
                    res.like='' ;
                }
                //if(i > 0){
                $("#event_like_name_"+event_like_id).append('<div class="ol_odbx"><button type="button" class="btn" onclick="event_like_model('+event_like_id+')">'+res.like+'</button></div>');
                //}


            }
        });

}

$(document).on('click', '#event_delete', function (e) {
    e.preventDefault();
    var delete_id = $(this).val();
    var tab_id = $('#tab_Id_data').val();
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/event_delete/' + delete_id,
        success: function (response) {
            event_listing(tab_id);
        }
    });
})

function inclickbx() {
    $('.textarea_inpt #post_text').show();
    $('.textarea_inpt .inclickbx').hide();
}

function filter_event(paid_id) {
    $('#eventFilterModal').click();
    event_listing(paid_id);
}

// <li> <a href="https://twitter.com/share?text=<?php //echo $blog_title;?>&url=' + item.share_url + '" target="_blank"><i class="fa fa-twitter"></i></a></li>
// <li><a href="" target="_blank"><i class="fa fa-youtube"></i></a></li>
// <li><a href="https://www.instagram.com/theunitedindian/" target="_blank"><i class="fa fa-instagram"></i></a></li>
function event_listing(paid_id) {
    if(paid_id==undefined){
        return true ;
    }


  $('#loader_spineer').show();
    var s_event_name = $("#s_event_name").val();
    var s_event_date = $("#s_event_date").val();
    var s_event_country = $("#s_event_country").val();
    var s_event_city = $("#s_event_city").val();
    var details_url = baseUrl + '/eventDetails/';
    $.ajax({
        type: "get",
        url: baseUrl + '/event_listing',
        data: { 'status': paid_id, 's_event_name': s_event_name, 's_event_date': s_event_date, 's_event_country': s_event_country, 's_event_city': s_event_city },
        dataType: 'json',
       beforeSend: function () {
                  //  $('#loader_spineer').show();
                },

        success: function (res) {

            $('#event_listing_' + paid_id).html('');
            clearEventFilter();
            if (res.event_info.length > 0) {
                $("#event_not_found").hide();

                $.each(res.event_info, function (key, item) {
                    var a='';
                        var i=0;
                        //alert(res.like.length);
                        if (item.event_like_listing.length > 0) {
                        $.each(item.event_like_listing, function (key, like_data) {
                        if(i < 1){
                         //a += '<div class="ol_n">'+like_data.name+'</div>';
                        }
                         i++;
                        });
                        if(i > 0){
                        //a +='<div class="ol_odbx"><button type="button" class="btn" onclick="event_like_model('+item.id+')">'+i+' Other</button></div>'
                        }
                    }
                    if(i==0){
                        i='' ;
                    }
                a ='<div class="ol_odbx"><button type="button" class="btn" onclick="event_like_model('+item.id+')">'+i+' </button></div>'
                    /* <li><span><i class="ri-road-map-fill"></i></span><span>2.5 Miles</span></li> */
                    if (item.event_fee_type == 3) {
                        var price = '<div class="offer_box"><h3>Free</h3></div>';
                    } else {
                        // <p>'+item.event_price+'</p>
                        var price = '<div class="offer_box bg_brn"><h3>Paid</h3></div>';
                    }
                    if (item.user_is_like == 'Yes') {
                        var is_like = '<i class="ri-thumb-up-fill"></i>';
                    } else {
                        var is_like = '<i class="ri-thumb-up-line"></i>';
                    }

                      var  cityCountry='' ;
                    if(item.country!=undefined && item.city!=undefined){
                        cityCountry='<p>'+item.country+' : '+item.city+'<p>' ;
                    }else if(item.country!=undefined){
                        cityCountry='<p>'+item.country+'</p>' ;
                    }

                    $('#event_listing_' + paid_id).append('<div class="post_card"><div class="post_head"><h3><a href="' + details_url + item.id + '">' + item.event_name + '</a></h3><p>' + item.time + '</p>'+cityCountry+'</div><div class="description_post"><p>' + item.event_descrption + '</p></div><div class="post_l_banner"><img class="media" src="' + item.image + '" alt="">' + price + '</div><div class="lctn_view"><ul class="lctn_ul"><li><span><i class="ri-calendar-todo-fill"></i></span><span>' + item.start_date + '-'+item.end_date+'</span></li><li><span><i class="ri-eye-fill"></i></span><span>' + item.event_view_count + ' View</span></li><li><span><i class="ri-time-fill"></i></span><span>'+item.event_time+'</span></li><li><span><i class="ri-map-pin-fill"></i></span><span>' + item.address + '</span></li></ul></div><div class="post_likeshare"><ul class="likeshare_ul"><li><button type="button" class="btn_line" id="event_like_id" value="' + item.id + '"><span id="event_span_id_'+item.id+'">' + is_like + '</span><span>Like</span><sup></sup></button><div id="event_like_name_'+item.id+'" class="otherlikebx">'+a+'</div></li><li><button type="button" class="btn_line" id="event_message_id" value="' + item.id + '"><span><i class="ri-message-2-line"></i></span><span>Comment</span><sup id="event_message_count_' + item.id + '">' + item.event_comment_count + '</sup></button></li><li class="share"><a href="javascript:void(0);" id="event_share_id"  value="' + item.id + '"><span><i class="ri-share-fill"></i></span><span>Share</span></a><ul class="share_ul social_icons"><li><a href="https://www.facebook.com/share.php?u=' + item.share_url + '" target="_blank"><i class="fa fa-facebook-f"></i></a></li><li><a href="https://www.linkedin.com/shareArticle?mini=true&url=' + item.share_url + '" target="_blank"><i class="fa fa-linkedin"></i></a></li></ul></li><li><a href="' + details_url + item.id + '"><button type="button" class="btn" >Join</button></li></ul></div><div class="post_chat_sect" id="event_chat_sect_' + item.id + '" style="display:none"><div class="user_img"><img src="' + item.session_image + '" alt=""></div><div class="send-message"><form id="event_comment_save_id_' + item.id + '" action="javascript:void(0);"><div class="post_text_area"><textarea rows="1" formcontrolname="ComentMeassge" type="text" id="event_comment_' + item.id + '" placeholder="Comment" class="msg_int_style ng-valid ng-pristine ng-touched" ng-reflect-name="ComentMeassge"></textarea><span id="error_event_comment" class="err"></span> </div><button class="btn_post" onclick="event_save_comment(' + item.id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z" fill="#C5963A"></path></g><defs> <clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath></defs></svg></button><div class="attachment-file_post"></div></form></div></div><div class="post_list_chat" id="event_list_chat_' + item.id + '" style="display:none"></div></div>')


                })
            } else {
                $("#event_not_found").show();
            }
            //$("#search_event")[0].reset();
            $('#loader_spineer').hide();
        }
    });

}

function model_data(post_id,imageId=0,isLogin="") {
   
   if(isLogin===0){
    $('#login_post').modal('show');
    return false ;
   }
       
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/postDetails/' + post_id,  
        data:{'imageId':imageId},     
        dataType: 'html',
        success: function (response) {
             $('video').trigger('pause');
            loadHTMLIntoModal(response);


            //console.log(response);
            //$("#postvewmodal").html(response);

            //$("#postvewmodal").html(response);
            // $("#postvewmodal").modal('show');

        }
    });
}


function loadHTMLIntoModal(htmlContent) {
    
    // Create a new modal element
    $('#homePostSlider').html(htmlContent);
    $('#postvewmodal').modal('show');


    // var modal = $('');
    // var modal = $('<div class="modal fade postview_modal" id="postvewmodal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-body">' + htmlContent + '</div></div></div></div>');

    // // Append the modal to the body
    // modal.appendTo('body');

    // // Show the modal
    //  modal.modal('show');
    // // setTimeout(() => {

    // // }, "3000");


    // // Remove the modal from the DOM when closed
    // modal.on('hidden.bs.modal', function () {
    //     //alert("jghjg");
    //     modal.remove();
    // });

}


function event_save_comment(id, type = 0) {
    var comment = $('#event_comment_' + id).val();
    $('.err').html('');
    if (comment == '' && type == 0) {
        $('#error_event_comment').html('Please enter comment');
    } else {
        //var formData=new FormData($('#goodies_comment_save_id')[0]);
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/event_save_comment',
            data: { 'event_id': id, 'comment': comment, 'type': type },
            dataType: 'json',
            beforeSend: function () {
                //ajax_before();
            },
            success: function (res) {
                // ajax_success() ;
                if (res) {

                    if (res.comment_info.length == 0) {
                        $("#event_message_count_" + id).html('');
                    }

                    $("#event_comment_save_id_" + id)[0].reset();
                    $("#event_list_chat_" + id).html('');
                    $.each(res.comment_info, function (key, comment_data) {
                        $("#event_message_count_" + id).html('<sup id="event_message_count_' + id + '">' + comment_data.comment_count + '</sup>');
                        if (comment_data.is_comment == 'Yes') {
                            var yes = '<div class="chat_reply_list" id="event_chat_reply_list_' + comment_data.id + '"></div>';
                        } else {
                            var yes = '';
                        }
                        if (comment_data.user_id == comment_data.session_user_id) {
                            var comment_reply = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment" onclick="editEventComment(' + id + ',' + comment_data.id + ');">Edit</a></li><li onclick="event_comment_delete(' + id + ',' + comment_data.id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                        } else {
                            var comment_reply = '';
                        }
                        $("#event_list_chat_" + id).append('<div class="post_bx" id="event_commnet_listing_' + comment_data.id + '"><div class="user_avtar"><img src="' + comment_data.image + '" alt=""></div><div class="post_details"><div class="cont_user"><h3><span>' + comment_data.name + '</span>' + comment_reply + '</h3><p>' + comment_data.time + '</p></div><div class="post_descrip"><p>' + comment_data.comment + '</p></div><div class="post_commit"><ul><li onclick="event_comment_like(' + comment_data.id + ',' + id + ')"> <a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g> <defs><clipPath id="clip0_1421_4501"><rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="count_' + comment_data.id + '">' + comment_data.comment_likes + '</span></div></div></a> </li> <li id="event_reply_from_hide" value=' + comment_data.id + '><a><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7258)"><path d="M17.25 18.0017C17.0511 18.0017 16.8604 17.9227 16.7197 17.782C16.5791 17.6414 16.5 17.4506 16.5 17.2517C16.4989 16.0586 16.0244 14.9147 15.1807 14.071C14.3371 13.2274 13.1932 12.7529 12 12.7517H7.62754V13.9412C7.62748 14.2378 7.53947 14.5278 7.37465 14.7744C7.20982 15.021 6.97558 15.2132 6.70153 15.3267C6.42748 15.4402 6.12593 15.4699 5.835 15.4121C5.54407 15.3542 5.27682 15.2114 5.06704 15.0017L0.657793 10.5924C0.235983 10.1705 -0.000976563 9.5983 -0.000976562 9.00168C-0.000976563 8.40506 0.235983 7.83287 0.657793 7.41093L5.06704 3.00168C5.27682 2.79197 5.54407 2.64916 5.835 2.59131C6.12593 2.53345 6.42748 2.56316 6.70153 2.67666C6.97558 2.79017 7.20982 2.98238 7.37465 3.22899C7.53947 3.47561 7.62748 3.76555 7.62754 4.06218V5.25168H11.25C13.0396 5.25367 14.7554 5.96546 16.0208 7.2309C17.2863 8.49634 17.9981 10.2121 18 12.0017V17.2517C18 17.4506 17.921 17.6414 17.7804 17.782C17.6397 17.9227 17.449 18.0017 17.25 18.0017ZM6.12754 4.06218L1.71829 8.47143C1.57769 8.61208 1.4987 8.80281 1.4987 9.00168C1.4987 9.20055 1.57769 9.39128 1.71829 9.53193L6.12754 13.9412V12.0017C6.12754 11.8028 6.20656 11.612 6.34721 11.4714C6.48787 11.3307 6.67863 11.2517 6.87754 11.2517H12C12.8517 11.2514 13.6937 11.4329 14.4697 11.7839C15.2457 12.1349 15.9379 12.6474 16.5 13.2872V12.0017C16.4985 10.6098 15.9448 9.27535 14.9606 8.29112C13.9764 7.3069 12.6419 6.75327 11.25 6.75168H6.87754C6.67863 6.75168 6.48787 6.67266 6.34721 6.53201C6.20656 6.39136 6.12754 6.20059 6.12754 6.00168V4.06218Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7258"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></span><span>' + comment_data.reply_comment_count + '</span></a></li></ul></div><div class="post_chat_sect"><div class="send-message"><form id="reply_event_form_id_' + comment_data.id + '" action="javascript:void(0);"><div class="user_img"><img src="' + comment_data.session_image + '" alt=""></div><div class="post_text_area"><div class="post_text_area"><textarea  rows="1" type="text" placeholder="Reply" id="reply_event_comment_id_' + comment_data.id + '"  class="msg_int_style"></textarea><span id="error_event_reply_comment" class="err"></span></div></div><button class="btn_post" onclick="save_event_reply_comment(' + comment_data.id + ',' + id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath>defs></svg></button><div class="attachment-file_post"><button class="btn"></button><button class="btn"></button></div></form></div></div>' + yes + '</div></div></div>')
                        $('#event_chat_reply_list_' + id).html('');
                        $.each(comment_data.reply_info, function (key1, rep_info) {

                            if (rep_info.user_id == rep_info.session_user_id) {
                                var reply_edit = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath> </defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReplyComment" onclick="editEventReplyComment(' + rep_info.id + ',' + rep_info.event_id + ');">Edit</a></li><li onclick="event_reply_comment_delete(' + rep_info.id + ',' + rep_info.event_id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
                            } else {
                                var reply_edit = '';
                            }
                            $('#event_chat_reply_list_' + rep_info.comment_id).append('<div class="crd_bx" id="event_reply_comment_' + rep_info.id + '"><div class="user_avtar"><img src=' + rep_info.image + ' alt=""></div><div class="user_details"><div class="user_cont"><h3><span>' + rep_info.name + '</span>' + reply_edit + '</h3><p>' + rep_info.time + '</p></div><div class="reply_descrip"><p>' + rep_info.reply_comment + '</p></div><div class="post_commit"><ul><li onclick="event_reply_comment_like(' + rep_info.id + ',' + id + ')"><a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1421_4501"> <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="reply_count_' + rep_info.id + '">' + rep_info.reply_like_count + '</span></div></div></a></li></ul></div></div></div>')
                        })
                    })
                    if (type == 0) {
                        $("#event_chat_sect_" + id).show();
                        $("#event_list_chat_" + id).show();
                    }
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

function event_comment_delete(event_id, comment_id) {

    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/event_comment_delete/' + comment_id,
        success: function (response) {
            $('#event_commnet_listing_' + comment_id).remove();
            event_save_comment(event_id, 1);
        }
    });

}
function event_reply_comment_delete(id, event_id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/event_reply_comment_delete/' + id,
        success: function (response) {
            $('#event_reply_comment_' + id).remove();
            event_save_comment(event_id, 1);
        }
    });

}
function life_style() {
    ajaxCsrf();
    $.ajax({
        type: "GET",
        url: baseUrl + '/life_style',
        cache: 'FALSE',
        dataType: 'html',
        beforeSend: function () { },
        success: function (response) {
            $('#mydata').html(response);
        }
    });
}

function send_booking_confirm(isLogin=0) {
   if(isLogin===0){
        $('#login_post').modal('show');
        return false ;
     }else{
        $("#tsk_mdlBox_body1").modal('show');       
     }
 

}
function Booking_yes(){
    //$("#tsk_mdlBox_body1").hide();
     $("#tsk_mdlBox_body1").modal('hide');
  save_event_booking();
}

function Booking_no(){
    //$("#tsk_mdlBox_body1").hide();
    $("#tsk_mdlBox_body1").modal('hide');
}

function save_event_booking() {
    ajaxCsrf();
    var no_ticket = $('#no_ticket').val();
    $('.err').html('');
    if (no_ticket == '') {
        $('#error_post_text').html('Please select number of ticket');
    } else {
        var formData = new FormData($('#booking_event')[0]);
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_booking',
            data: formData,
            contentType: false,
            processData: false,
            async:false,
            dataType: 'json',
            beforeSend: function () {
                 $('#loader_spineer').show();
            },
            success: function (res) {
                 $('#loader_spineer').hide();
                if (res == 1) {
                    //alert("hello");
                    $("#booking_event")[0].reset();
                    $('#event_booking_modal').modal('show');
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

function send_goodies_confirm(isLogin=0) {

     if(isLogin===0){
        $('#login_post').modal('show');
        return false ;
     }else{
        $("#tsk_mdlBox_body2").modal('show');
     }
    
        //save_goodies_booking();
}

function goodies_Booking_yes(){
     $("#tsk_mdlBox_body2").modal('hide');
  save_goodies_booking();
}

function goodies_Booking_no(){
    $("#tsk_mdlBox_body2").modal('hide');
}

function save_goodies_booking() {
    ajaxCsrf();
    var no_ticket = $('#no_ticket').val();
    $('.err').html('');
    if (no_ticket == '') {
        $('#error_post_text').html('Please select number of ticket');
    } else {
        var formData = new FormData($('#booking_goodies')[0]);
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_booking',
            data: formData,
            contentType: false,
            processData: false,
            async:false,
            dataType: 'json',
            beforeSend: function () {
                 $('#loader_spineer').show();
            },
            success: function (res) {
                $('#loader_spineer').hide();
                if (res == 1) {
                    //alert("hello");
                    $("#booking_goodies")[0].reset();
                    $("#tsk_mdlBox_body2").hide();
                    $('#goodies_booking_modal').modal('show');
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}


$(document).on('click', '#Goodies-All-tab', function (e) {
    e.preventDefault();
    var paid_id = $(this).val();
    //$('#goodies_Id_data').val(paid_id);
    filter_goodies(paid_id);
    $('#Goodies-All-tab').addClass('active');
    $('#Goodies-Paid-tab').removeClass('active');
    $('#Goodies-Unpaid-tab').removeClass('active');
});

$(document).on('click', '#Goodies-Paid-tab', function (e) {
    e.preventDefault();
    var paid_id = $(this).val();
    //$('#goodies_Id_data').val(paid_id);
    filter_goodies(paid_id);
    $('#Goodies-Paid-tab').addClass('active');
    $('#Goodies-All-tab').removeClass('active');
    $('#Goodies-Unpaid-tab').removeClass('active');
});

$(document).on('click', '#Goodies-Unpaid-tab', function (e) {
    e.preventDefault();
    var paid_id = $(this).val();
    //$('#goodies_Id_data').val(paid_id);
    filter_goodies(paid_id);
    $('#Goodies-Unpaid-tab').addClass('active');
    $('#Goodies-Paid-tab').removeClass('active');
    $('#Goodies-All-tab').removeClass('active');
});


    function filter_goodies(paid_id) {
    //var paid_id=$('#goodies_Id_data').val();
    if(paid_id=='all'){
        clearGoodiesFilter();
    }

    ajaxCsrf();
    var S_goodies_name = $('#S_goodies_name').val();
    var S_goodies_date = $('#S_goodies_date').val();
    var S_goodies_country = $('#s_goodies_country').val();
    var S_goodies_city = $('#S_goodies_city').val();

    //var formData = new FormData($('#find_goodies')[0]);
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/filterGoodies',
        data: { 'S_goodies_name': S_goodies_name, 'S_goodies_date': S_goodies_date, 'status': paid_id, 'S_goodies_country': S_goodies_country, 'S_goodies_city': S_goodies_city},
        dataType: 'html',
        beforeSend: function () {
             $('#loader_spineer').show();
        },
        success: function (html) {


             $('#loader_spineer').hide();
            if (html) {

                $('#goodiesFilterModal').click();
                //alert("hello");
                //$("#find_goodies")[0].reset();

                clearGoodiesFilter();
                $("#goodiesAjaxData").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }

    });



}

function clearEventFilter(){
    $("#search_event")[0].reset();

     $('.cty > .ms-options-wrap > button').text('Select City');
     $('#eventCity').html('<label for="">City</label><select name="s_event_city" id="s_event_city" class="form-control" ><option value="">Select City</option></select>');
}

function clearGoodiesFilter(){
    $("#find_goodies")[0].reset();

     $('.cty > .ms-options-wrap > button').text('Select City');
     $('#goodiesCity').html('<label for="">City</label><select name="S_goodies_city" id="S_goodies_city" class="form-control" ><option value="">Select City</option></select> ');
}

function myPosts(id) {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/myPosts/'+id,
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },

        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                $("#myposts").html(html);
                $("#myposts").show();
                $("#myabout").hide();
                $("#myphoto_").hide();
                $("#myphoto_").hide();
                $("#myvedio").hide();
                $("#myevents").hide();
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
    $("#tabmyposts").addClass('active');
    $("#tabmyabout").removeClass('active');
    $("#tabmyphoto").removeClass('active');
    $("#tabmyvideo").removeClass('active');
    $("#tabmyevents").removeClass('active');
    $("#tabmygroups").removeClass('active');
}


function myabout(id) {
    
     if(id==undefined){
        return true ;
     }
  $('#myposts').html('');
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/myabout/'+id,
        dataType: 'html',
         beforeSend: function () {
                  //$('#loader_spineer').show();
                },
        success: function (html) {
            //$('#loader_spineer').hide();
            if (html) {
                $("#myabout").html(html);
                $("#myabout").show();
                $("#myphoto_").hide();
                $("#myposts").hide();
                $("#myvedio").hide();
                //$("#myevents").hide();
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
    $("#tabmyposts").removeClass('active');
    $("#tabmyabout").addClass('active');
    $("#tabmyphoto").removeClass('active');
    $("#tabmyvideo").removeClass('active');
    $("#tabmyevents").removeClass('active');
    $("#tabmygroups").removeClass('active');
}


function myphoto(id) {
    $('#myvedio').html('');
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/myphoto/'+id,
        dataType: 'html',
         beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
             $('#loader_spineer').hide();
            if (html) {
                $("#myphoto_").html(html);
                $("#myphoto_").show();
                $("#myvedio").hide();
                $("#myabout").hide();
                $("#myposts").hide();
                $("#myevents").hide();

            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
    $("#tabmyposts").removeClass('active');
    $("#tabmyabout").removeClass('active');
    $("#tabmyphoto").addClass('active');
    $("#tabmyvideo").removeClass('active');
    $("#tabmyevents").removeClass('active');
    $("#tabmygroups").removeClass('active');
}

function deletePhoto(id,deleteType){
      
    var check = confirm("Are you sure want to delete this image ?");
    if (check) {
        $('#loadmorebtn_loader').show();
        ajaxCsrf();
        $.ajax({
            type: "post",    
            url: baseUrl + '/delete_myphoto',
            data:{"id":id,"deleteType":deleteType},
            dataType: 'html',
            beforeSend: function () {
                      //$('#loader_spineer').show();
                    },
            success: function (html) {  
               $('#loadmorebtn_loader').hide();
               $('#delete_img_'+id+'_'+deleteType).remove();
               $('#profilePhoto').click();
            }
        });    
    }
}

function ajax_myvideo(id) {

   $('#loadmorebtn_loader').css('display','block');
    var page=$('#myphoto_page').val();
     
    ajaxCsrf();
    $.ajax({
        type: "post",    
        url: baseUrl + '/ajax_myvideo/'+id,
        data:{"page":parseInt(page)+1},
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();

                },
        success: function (html) {  

          $('#loadmorebtn_loader').css('display','none');
          $('#homeLoadmore').remove();
             $('#isShowMore').remove();
            if (html) {
                $('#myphoto_page').val(parseInt(page)+1);
                $('#profile_photo_listing').append(html);
                var isShowMore=$('#isShowMore').val();
                 if(isShowMore){
                    $('.loadmorebtn').html('<button id="homeLoadmore" class="btn" onclick="ajax_myvideo('+id+')"><div class="spinner-border" id="loadmorebtn_loader" style="display:none;" role="status"><span class="sr-only">Loading...</span></div> <div class="text"> Load More</div></button>');             
                 }
               

            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

function ajax_myphoto(id) {

   $('#loadmorebtn_loader').css('display','block');
    var page=$('#myphoto_page').val();
    
    ajaxCsrf();
    $.ajax({
        type: "post",    
        url: baseUrl + '/ajax_myphoto/'+id,
        data:{"page":parseInt(page)+1},
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();

                },
        success: function (html) {  

          $('#loadmorebtn_loader').css('display','none');
          $('#homeLoadmore').remove();
             $('#isShowMore').remove();
            if (html) {
                $('#myphoto_page').val(parseInt(page)+1);
                $('#profile_photo_listing').append(html);
                var isShowMore=$('#isShowMore').val();
                 if(isShowMore){
                    $('.loadmorebtn').html('<button id="homeLoadmore" class="btn" onclick="ajax_myphoto('+id+')"><div class="spinner-border" id="loadmorebtn_loader" style="display:none;" role="status"><span class="sr-only">Loading...</span></div> <div class="text"> Load More</div></button>');             
                 }
               

            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

function myvedio(id) {
    $('#myphoto_').html('');
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/myvedio/'+id,
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                $("#myvedio").html(html);
                $("#myvedio").show();
                $("#myphoto_").hide();
                $("#myabout").hide();
                $("#myposts").hide();
                $("#myevents").hide();
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
    $("#tabmyposts").removeClass('active');
    $("#tabmyabout").removeClass('active');
    $("#tabmyphoto").removeClass('active');
    $("#tabmyvideo").addClass('active');
    $("#tabmyevents").removeClass('active');
    $("#tabmygroups").removeClass('active');
}
function myevents(id) {

    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/myevent/'+id,
        dataType: 'html',
          beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                $("#myevents").html(html);
                $("#myevents").show();
                $("#myvedio").hide();
                $("#myphoto_").hide();
                $("#myabout").hide();
                $("#myposts").hide();
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
    $("#tabmyposts").removeClass('active');
    $("#tabmyabout").removeClass('active');
    $("#tabmyphoto").removeClass('active');
    $("#tabmyvideo").removeClass('active');
    $("#tabmyevents").addClass('active');
    $("#tabmygroups").removeClass('active');
}




function profile_tab() {
    ajaxCsrf();
    //window.location = baseUrl + '/profile';
    $.ajax({
        type: "get",
        url: baseUrl + '/profile',
        data: { 'pro_tab': 'Yes' },
        dataType: 'html',
         beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {

                //$('.grid-container').load(baseUrl + '/profile');
                $("#profile_tab_id").addClass("active");
                $("#marches_tab_idsss").removeClass("active");
                $("#my_event_tab_id").removeClass("active");
                $("#network_tab_id").removeClass("active");
                $(".center_menu_data").html(html);
                myPosts();
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}


// profile_tab_id
//
function marches_tab(id) {
    ajaxCsrf();
    $('#responsiveButton').click();
    window.scrollTo({top: 0, behavior: 'smooth'});

    $.ajax({
        type: "get",
        url: baseUrl + '/marches_info/'+id,
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                $("#marches_tab_idsss").addClass("active");
                $("#my_event_tab_id").removeClass("active");
                $("#network_tab_id").removeClass("active");
                $("#profile_tab_id").removeClass("active");
                $(".center_menu_data").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}
function network_tab() {
    ajaxCsrf();
    window.scrollTo({top: 0, behavior: 'smooth'});

    $.ajax({
        type: "post",
        url: baseUrl + '/network_info',
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                $("#network_tab_id").addClass("active");
                $("#marches_tab_idsss").removeClass("active");
                $("#my_event_tab_id").removeClass("active");
                $("#profile_tab_id").removeClass("active");
                $(".center_menu_data").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

function my_event_tab(id=0) {
    
    ajaxCsrf();
    $('#responsiveButton').click();
    window.scrollTo({top: 0, behavior: 'smooth'});

    $.ajax({
        type: "post",
        url: baseUrl + '/myevent_info/'+id,
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
            $('#loader_spineer').hide();
            if (html) {
                //history.pushState({ foo: 'bar' }, '', baseUrl + '/myevent/'+id);
                $("#my_event_tab_id").addClass("active");
                $("#network_tab_id").removeClass("active");
                $("#marches_tab_idsss").removeClass("active");
                $("#profile_tab_id").removeClass("active");
                $(".center_menu_data").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}
function media_tab() {
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/media_info',
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
              $('#loader_spineer').hide();
            if (html) {
                $(".center_menu_data").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

function home() {
    alert('hello');
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/home',
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();
                },
        success: function (html) {
            //$('#loader_spineer').hide();
            if (html) {
                $(".center_menu_data").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

function following_page() {
    ajaxCsrf();
    $.ajax({
        type: "get",
        url: baseUrl + '/following_page',
        dataType: 'html',
        beforeSend: function () {
                  $('#loader_spineer').show();
                },
        success: function (html) {
               $('#loader_spineer').hide();
            if (html) {
                $(".center_menu_data").html(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}



function save_post1() {
    var post_text = $('#post_text').val();
    var user_id=$('#session_user_id').val();
    $('.err').html('');
    if (post_text == '') {
        $('#error_post_text').html('Please enter post text');
    } else {
        var formData = new FormData($('#post_forms_id')[0]);
        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/save_post',
            data: formData,
            contentType: false,
            processData: false,
            async:false,
            dataType: 'json',
            beforeSend: function () {
                $('#loader_spineer').show();
            },
            success: function (res) {
                $('#loader_spineer').hide();
                if (res.status == 1) {
                    $("#post_forms_id")[0].reset();
                    $("#post_message_id").hide();
                     myPosts(user_id);
                     $("#add_post_succ").show();
                        setTimeout(function() {
                            $("#add_post_succ").hide();
                        }, 2000);
                    //$(".main_cont").load(location.href + " .main_cont");
                    //location.reload()
                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

function post_update(type=0) {

    var post_text = $('#edit_post_des').val();
    $('.err').html('');
    if (post_text == '' && filesToUploadPostUpdate.length==0) {
        $('#edit_error_post_text').html('Please enter post text');
    } else {

         $('#loader_spineer').show();

        var formData = new FormData($('#edit_post_forms_id')[0]);

       // var formData = new FormData($('#post_forms_id')[0]);
            //const formData = new FormData(event.target);
            formData.delete('image[]');
            // debugger ;
            // //       console.log('ddd'+JSON.stringify(filesToUploadPost.values()));
            for (const file of filesToUploadPostUpdate) {
                formData.append('image[]', file);
            }

        ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/updatePost',
            data: formData,
            contentType: false,
            processData: false,
            async:true,
            dataType: 'json',
             beforeSend: function () {
               
            },
            success: function (res) {
                $('#loader_spineer').hide();
                if (res.status == 1) {
                    $("#edit_post_forms_id")[0].reset();
                    //location.reload()
                    //$("#editpost").hide();
                    $("#editpost").modal("hide");
                    $("#edit_post_succ").show();
                    if(type===2){
                        location.reload();
                    }else{
                        home_page(type);    
                    }
                    
                    //$(".main_cont").load(location.href + " .main_cont");
                     setTimeout(function() {
                           $("#edit_post_succ").hide();
                        }, 2000);

                } else {
                    statusMesage('something went wrong', 'error');
                }
            }

        });
    }

}

//goodies data



$(document).on('click', '#goodies_like', function (e) {
    var goodies_like_id = $(this).val();
    //alert(goodies_like_id);
    e.preventDefault();
    ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/goodies_like/' + goodies_like_id,
        success: function (response) {
            if (response == 1) {
                $("#goodies_like_count_" + goodies_like_id).html('<sup>' + response + '</sup>');
                $("#goodies_span_id_" + goodies_like_id).html('<i class="ri-thumb-up-fill"></i>');
                goodies_like_listing(goodies_like_id);
            } else {
                $("#goodies_like_count_" + goodies_like_id).html('<sup>' + response + '</sup>');
                $("#goodies_span_id_" + goodies_like_id).html('<i class="ri-thumb-up-line"></i>');
                goodies_like_listing(goodies_like_id);
            }
        }
    });
});
//
function goodies_like_listing(goodies_like_id){
      ajaxCsrf();
        $.ajax({
            type: "post",
            url: baseUrl + '/goodies_like_listing/'+goodies_like_id,
            dataType: 'json',
            success: function (res) {
                $("#goodies_like_name_"+goodies_like_id).html('');
                var i=0;
                //alert(res.like.length);
                if(res.like < 1){
                    res.like='' ;
                }

                // $.each(res.like, function (key, like_data) {
                // if(i < 1){
                // $("#goodies_like_name_"+goodies_like_id).append('<div class="ol_n">'+like_data.name+'</div>');
                // }
    //              i++;
                // });

                //if(i > 0){
                $("#goodies_like_name_"+goodies_like_id).append('<div class="ol_odbx"><button type="button" class="btn" onclick="goodies_like_model('+goodies_like_id+')">'+res.like+' </button></div>');
                //}


            }
        });

}


 // $('#image').change(function(event){
 //    con
 //    handleFileSelect(event);
 // });
var filesToUploadPost = [];

 $("#image").change(function() {
       alert('hello');
        var fileUploadSize = this.files[0].size ;
        var fileSize = 100 * 1000000 ;
        if(fileUploadSize > fileSize){
            alert('Please upload file less then 100 MB');

        }else{
                $('#view_imgvideo').hide();
        $('#output_image').html('');
    var filesToUploadPost = [];
    var input = this;
    var totalPreviewImg = $('#totalPreviwImg').val() ;
    var j=totalPreviewImg;
    if (input.files && input.files.length) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            const file = input.files[i];
            const fileType = file.type.split('/')[0];

            var reader = new FileReader();
            this.enabled = false;
            reader.onload = (function (e) {
                var span = document.createElement('span');
                if (fileType === 'image') {
                    span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+j+' class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image').insertBefore(span, null);
                    $('#view_imgvideo').show();
                } else if (fileType === 'video') {
                    span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+j+' class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image').insertBefore(span, null);
                    $('#view_imgvideo').show();
                }
                filesToUploadPost.push({
                      id: j,
                      file: file
                  });
                var total = $('#totalPreviwImg').val() ;
                $('#totalPreviwImg').val(parseInt(total+1));
                j++;
            });
            reader.readAsDataURL(input.files[i]);
        }
    }
        }


    });
function handleFileSelect11(event) {
    console.log(event);
    var filesToUploadPost = [];
   alert('hellowe');
    var input = this;
    var j=0;
    if (input.files && input.files.length) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            const file = input.files[i];
            const fileType = file.type.split('/')[0];

            var reader = new FileReader();
            this.enabled = false;
            reader.onload = (function (e) {
                var span = document.createElement('span');
                if (fileType === 'image') {
                    span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+j+' class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image').insertBefore(span, null);
                    $('#view_imgvideo').show();
                } else if (fileType === 'video') {
                    span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+j+' class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image').insertBefore(span, null);
                    $('#view_imgvideo').show();
                }
                filesToUploadPost.push({
                      id: j,
                      file: file
                  });
                j++;
            });
            reader.readAsDataURL(input.files[i]);
        }
    }
}




$('.search_btn').click(function () {
    $('.search_list').addClass('d-block');
});

$(document).mouseup(function (e) {
    if ($(e.target).closest(".search_li").length === 0) {
        $('.search_list').removeClass('d-block');
    }
});

$("#image").change(function () {
    var fileInput = document.getElementById('image');
    var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
    $(".video").attr("src", fileUrl);
});

$('#output_image').on('click', '.remove_img_preview', function () {
    var id = $(this).attr('id');

          const dt = new DataTransfer();
          const input = document.getElementById('image');
          const { files } = input;

          for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (id != i){
             dt.items.add(file) // here you exclude the file. thus removing it.
            input.files = dt.files
            }else{
                filesToUploadPost.splice(i, 1);
            }
            if(files.length == 1){
            $("#image").val("");
            }
          }
    $(this).parent('span').remove();
    $(this).val("");
});

function ajax_before(){
     var over = '<div class="overlay" style="margin-left:20%;margin-top:20%;position:absolute;z-index:1;"><img id="loading" width="" src="' + baseUrl + '/public/admin/images/loader.gif"></div>';
          $(over).prependTo('.main_site_data');
}

function ajax_success(){
     $('.overlay').remove();
}


// jQuery(window).on("load", function(){
//     if (screen.width < 990) {
//     $('.menu_inner_list .nav-tabs .nav-item').click(function () {
//         $(".user_prof.chtmssgbx .section_right").addClass("active");
//     });

//     $('.back_btn button').click( function() {
//         $(".user_prof.chtmssgbx .section_right").removeClass("active");
//     });

// }});




// (function ($) {
//     $.fn.mySelectDropdown = function (options) {
//       return this.each(function () {
//         var $this = $(this);

//         $this.each(function () {
//           var dropdown = $("<div />").addClass("f-dropdown selectDropdown");

//           if ($(this).is(":disabled")) dropdown.addClass("disabled");

//           $(this).wrap(dropdown);

//           var label = $("<span />")
//             .append($("<span />").text($(this).attr("placeholder")))
//             .insertAfter($(this));
//           var list = $("<ul />");

//           $(this)
//             .find("option")
//             .each(function () {
//               var image = $(this).data("image");
//               if (image) {
//                 list.append(
//                   $("<li />").append(
//                     $("<a />")
//                       .attr("data-val", $(this).val())
//                       .html($("<span />").append($(this).text()))
//                       .prepend('<img src="' + image + '">')
//                   )
//                 );
//               } else if ($(this).val() != "") {
//                 list.append(
//                   $("<li />").append(
//                     $("<a />")
//                       .attr("data-val", $(this).val())
//                       .html($("<span />").append($(this).text()))
//                   )
//                 );
//               }
//             });

//           list.insertAfter($(this));

//           if (
//             $(this).find("option:selected").length > 0 &&
//             $(this).find("option:selected").val() != ""
//           ) {
//             list
//               .find(
//                 'li a[data-val="' + $(this).find("option:selected").val() + '"]'
//               )
//               .parent()
//               .addClass("active");
//             $(this).parent().addClass("filled");
//             label.html(list.find("li.active a").html());
//           }
//         });

//         if (!$(this).is(":disabled")) {
//           $(this)
//             .parent()
//             .on("click", "ul li a", function (e) {
//               e.preventDefault();

//               var dropdown = $(this).parent().parent().parent();
//               var active = $(this).parent().hasClass("active");
//               var label = active
//                 ? $("<span />").text(dropdown.find("select").attr("placeholder"))
//                 : $(this).html();

//               dropdown.find("option").prop("selected", false);
//               dropdown.find("ul li").removeClass("active");

//               dropdown.toggleClass("filled", !active);
//               dropdown.children("span").html(label);

//               if (!active) {
//                 dropdown
//                   .find('option[value="' + $(this).attr("data-val") + '"]')
//                   .prop("selected", true);
//                 $(this).parent().addClass("active");
//               }

//               dropdown.removeClass("open");
//             });

//           $this.parent().on("click", "> span", function (e) {
//             var self = $(this).parent();
//             self.toggleClass("open");
//           }); 
         
//         }
//       });
//     };
//   })(jQuery);

//   $("select.f-dropdown").mySelectDropdown();

  
//   $(document).on("click", function(event){
//     var $trigger = $(".f-dropdown");
//     if($trigger !== event.target && !$trigger.has(event.target).length){
//         $(".frm-country .lang-select .b").css('display','none');
//     }
// });


  const langArray = [];

$('.select option').each(function(){
  const img = $(this).attr("data-thumbnail");

  const country = $(this).attr("data-country");
  const text = this.innerText;
  const value = $(this).val();
  const item = `<li><img src="${img}" alt="" data-country="${country}" value="${value}"/><span>${text}</span></li>`;
  langArray.push(item);
})

$('#a').html(langArray);

//Set the button value to the first el of the array
$('.btn-select').html(langArray[0]).attr('value', 'en');

//change button stuff on click
$('#a li').click(function(){
   const img = $(this).find('img').attr("src");
   const value = $(this).find('img').attr('value');
   const country = $(this).find('img').attr('data-country');
   const text = this.innerText;
   const item = `<li><img src="${img}" alt="" value="${value}"/><span>${text}</span></li>`;
  $('.btn-select').html(item).attr('value', value);
  $('.lang-select').toggleClass("open");
   
    ggCountry(country,value,img);
});

$(".btn-select").click(function(){
$('.lang-select').toggleClass("open");
});


$(document).on("click", function(event){
    var $trigger = $(".lang-select");
      if($trigger !== event.target && !$trigger.has(event.target).length){
        $(".lang-select").removeClass('open');
       }
 });


 function ggCountry(countryName,value,imgUrl){   
         
    var flag_ ='<?php echo $flag ; ?>' ;
    var gc=$('#gg_country').val() ;
    $('#ggCountrId').text(countryName);
       ajaxCsrf();
      $.ajax({
        type: "post",
        url: baseUrl + '/updateCountrySession',
        data:{'countryName':countryName,'value':value,'imgUrl':imgUrl},
        success: function (response) {
          //if(flag_==1){
            location.reload();
         // }
           
        }
    });

}

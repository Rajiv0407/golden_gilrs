<?php //if($users['tab_info'] == 'No'){  ?>


<?php //} ?>

<?php $__env->startSection('content'); ?>

<?php $user_id=request()->segment(2);  ?>

<?php $data=session()->get('user_session');?>


<style type="text/css">
   .image_area {
      position: relative;
    }

    .crop_img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px; 
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg{
        max-width: 1000px !important;
    }

    .overlay {
      position: absolute;
      bottom: 10px;
      left: 0;
      right: 0;
      background-color: rgba(255, 255, 255, 0.5);
      overflow: hidden;
      height: 0;
      transition: .5s ease;
      width: 100%;
    }

    .image_area:hover .overlay {
      height: 50%;
      cursor: pointer;
    }

  /*  .text {
      color: #333;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
    }*/

</style>

<div class="sell_box" id="profile">
  <div class="head mobile_hide">
    <h3>Profile</h3>
  </div>
  <div class="prl_section" id="profile_banner">
    <div class="profilebx">
      <?php //echo "<pre>";print_r($data['userId']);die;  ?>
      
        <div class="cover_img">
          <?php if($users['isPrivate']==1 && $data['userId']!=$users['id']){ ?>
             <img id="user_ban_image_id" src="<?php echo $users['banner_image'] ?>" alt="">
          <?php }else{ ?>
             <a href="<?php echo $users['banner_image'] ?>" id="profileBannerFancy" data-fancybox data-caption="Cover Image">
        <img id="user_ban_image_id" src="<?php echo $users['banner_image'] ?>" alt="">
      </a>
          <?php } ?>
           
        </div>

        <?php /*if($user_id == $data['userId']){ ?>
          <div class="cover_img">
            <a href="<?php echo $users['banner_image'] ?>" id="profileBannerFancy" data-fancybox data-caption="Cover Image">
        <img id="user_ban_image_id" src="<?php echo $users['banner_image'] ?>" alt="">
      </a>
        </div>
        <?php }else{ ?>
          <div class="cover_img">
            <a href="<?php echo $users1['banner_image'] ?>" id="profileBannerFancy" data-fancybox data-caption="Cover Image">
        <img id="user_ban_image_id" src="<?php echo $users1['banner_image'] ?>" alt="">
      </a>
        </div>
        <?php } */ ?>
      


      <?php if($user_id== $data['userId']){ ?>
      <form id="banner_image_form">
        <div class="Banner_edit ">
          <input type="hidden" name="user_id" id="user_id" value="<?php echo !empty($users['id'])? $users['id']:""; ?>">
          <input type="file" class="BannerUpload" name="BannerUpload" id="BannerUpload" accept=".png, .jpg, .jpeg">
          <label for="BannerUpload">
            <i class="fa fa-camera"></i> Change Cover
          </label>
        </div>
      </form>
      <?php } ?>

      <div class="pro_user">
        <div class="cover_cont">
          <div class="user_avtar">
            <form id="my_profile_pic">
 <?php if($users['isPrivate']==1 && $data['userId']!=$users['id']){ ?>
 <img id="user_pro_image_id" src="<?php echo $users['image'] ?>" alt="">
 <?php }else{ ?>
 <a href="<?php echo $users['image'] ?>" id="profileFancy" data-fancybox data-caption="Profile Image">
              <img id="user_pro_image_id" src="<?php echo $users['image'] ?>" alt="">
            </a>
 <?php } ?>
              

              <?php  /*if($user_id == $data['userId']){ ?>
                <a href="<?php echo $users['image'] ?>" id="profileFancy" data-fancybox data-caption="Profile Image">
              <img id="user_pro_image_id" src="<?php echo $users['image'] ?>" alt="">
              </a>
              <?php }else{ ?>
                <a href="<?php echo $users1['image'] ?>" id="profileFancy" data-fancybox data-caption="Profile Image">
              <img id="user_pro_image_id" src="<?php echo $users1['image'] ?>" alt="">
            </a>
              <?php } */ ?>


              <?php if($user_id == $data['userId']){ ?>
              <div class="profile_edit ">
                <input type="hidden" name="user_id" id="user_id"
                  value="<?php echo !empty($users['id'])? $users['id']:""; ?>">
                <input type="file" class="myfile" name="myfile" id="myfile" accept=".png, .jpg, .jpeg">
                <label for="myfile">
                  <i class="ri-camera-fill"></i>
                </label>
              </div>
              <?php }?>
            </form>
          </div>
          <div class="prof_cont">
            <h3>
                <?php echo $users['first_name'].' '.$users['last_name'];  ?><img
                src="<?php echo e(URL::to('/public/website')); ?>/images/star.svg" alt="">

              <?php /*if($user_id == $data['userId']){  ?>
              <?php echo $users['first_name'].' '.$users['last_name'];  ?><img
                src="{{URL::to('/public/website')}}/images/star.svg" alt="">
              <?php }else{ ?>
              <?php echo $users1['first_name'].' '.$users1['last_name'];  ?><img
                src="{{URL::to('/public/website')}}/images/star.svg" alt="">
              <?php } */ ?>
            </h3>
            <div class="nwlst">
              <!-- Only show count on private accout -->
                <?php 
                 $followingList_ = "javascript:void(0);" ;
                 $followerList_ = "javascript:void(0);" ;
                if($data['userId']!=$users['id'] && ($users['isPrivate']==0 || ($users['isPrivate']==1 && $users['isFriend']==1))){ 
                     $followingList_=URL::to('/').'/following_page/'.$user_id ;
                     $followerList_=URL::to('/').'/following_page/'.$user_id.'/follower' ;                     

                    }else if($data['userId']==$users['id']){
                       $followingList_=URL::to('/').'/following_page/'.$user_id ; ;
                        $followerList_=URL::to('/').'/following_page/'.$user_id.'/follower' ;   
                    }


                  ?>


              <li>
                <a href="<?php echo e($followerList_); ?>">
                  <span>
                    <?php echo $users['followers_count']; ?>
                  </span>
                  <span>Followers</span>
                </a>
              </li>
              <li>
                <a href="<?php echo e($followingList_); ?>">
                  <span>
                    <?php echo $users['following_count']; ?>
                  </span>
                  <span>Following</span>
                </a>
              </li>


              <?php //} ?>
               <?php if(!empty($users['city'] && $users['country'])){ ?>
              <li>
                <span><img src="<?php echo e(URL::to('/public/website')); ?>/images/map-marker-alt.svg" alt=""></span>
                <span>
                  <?php echo !empty($users['city'])?$users['city']:"" ?>,
                </span>
                <span>
                  <?php echo !empty($users['country'])?$users['country']:""; ?>
                </span>
              </li>
                <?php } ?>  
            </div>
            <!-- <p><//?php echo $users['self_des'];  ?></p>   -->
           
          </div>

          <div class="ffp_group">
          <?php if($user_id != $data['userId']){ ?>
            
              <?php if($status=='Pending'){ ?>

              <button class="btn pndng" id="pending_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','pending')"><i class="ri-time-line"></i>Pending</button>
              <button class="btn follow" id="follow_<?php echo $user_id ?>" style="display:none" onclick="follow1('<?php echo $user_id ?>','follow')">Follow</button>

              <?php } else if($status=='Accept'){ ?>

              <button class="btn unfollow" id="unfollowing_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','unfollow')">Unfollow</button>
              <button class="btn follow" id="follow_<?php echo $user_id ?>" style="display:none" onclick="follow1('<?php echo $user_id ?>','follow')">Follow</button>
              <button class="btn pndng" id="pending_<?php echo $user_id ?>" style="display:none" onclick="follow1('<?php echo $user_id ?>','pending')"><i class="ri-time-line"></i>Pending</button>

              <?php } else if($status=='FollowBack'){ ?>
              
                   <button class="btn follow" id="followback_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','followback')">Follow Back</button>
                   <button class="btn pndng" id="pending_<?php echo $user_id ?>" style="display:none" onclick="follow1('<?php echo $user_id ?>','pending1')"><i class="ri-time-line"></i>Pending</button>
              
              <?php }else if($status=='not_follow'){ ?>

              <button class="btn follow" id="follow_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','follow')">Follow</button>
              
              <button class="btn pndng" id="pending_<?php echo $user_id ?>" style="display:none" onclick="follow1('<?php echo $user_id ?>','pending')"><i class="ri-time-line"></i>Pending</button>
              
              <?php }else if($status=='Accept_Cancel'){ ?> 

                   <button class="btn follow" id="cancel_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','cancel')">Cancel</button>
              
              <button class="btn follow"    id="accept_<?php echo $user_id ?>"  onclick="follow1('<?php echo $user_id ?>','accept')">Accept</button>
                  <button class="btn follow" style="display: none;" id="follow_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','follow')">Follow</button>
                   <button class="btn pndng" id="pending_<?php echo $user_id ?>" style="display:none" onclick="follow1('<?php echo $user_id ?>','pending')"><i class="ri-time-line"></i>Pending</button>
              
                  <button class="btn unfollow" style="display: none;" id="unfollowing_<?php echo $user_id ?>" onclick="follow1('<?php echo $user_id ?>','unfollow')">Unfollow</button>

              <?php } ?>
            
            <?php } ?>
          </div>







        </div>
  



        <?php if($data['userId']!=$users['id'] && ($users['isPrivate']==0 || ($users['isPrivate']==1 && $users['isFriend']==1))){ ?>

        <div class="abtinfotab">
          <ul class="ulpiflst">
		    <li id="tabmyabout"><a href="javascript:void(0);" onclick="myabout(<?php echo $user_id; ?>)">About</a></li>
            <li id="tabmyposts" class="active"><a href="javascript:void(0);"
                onclick="myPosts(<?php echo $users['id']; ?>)">Posts</a></li>
            <li id="tabmyphoto"><a href="javascript:void(0);" onclick="myphoto(<?php echo $user_id; ?>)" id="profilePhoto">Photo</a></li>
            <li id="tabmyvideo"><a href="javascript:void(0);" onclick="myvedio(<?php echo $user_id; ?>)">Video</a></li>
			<?php if($user_id == $data['userId']){ ?>
            <li id="tabmyevents"><a href="javascript:void(0);" onclick="myevents(<?php echo $user_id; ?>);">Events</a>
            </li>
			<?php } ?>
            <!-- <li id="tabmygroups"><a href="javascript:void(0);" onclick="mygroups()">Groups</a></li> -->
          </ul>
        </div>
        <?php } else if($data['userId']==$users['id']){ ?> 
          <div class="abtinfotab">
          <ul class="ulpiflst">
        <li id="tabmyabout"><a href="javascript:void(0);" onclick="myabout(<?php echo $user_id; ?>)">About</a></li>
            <li id="tabmyposts" class="active"><a href="javascript:void(0);"
                onclick="myPosts(<?php echo $user_id; ?>)">Posts</a></li>
            <li id="tabmyphoto"><a href="javascript:void(0);" onclick="myphoto(<?php echo $user_id; ?>)" id="profilePhoto">Photo</a></li>
            <li id="tabmyvideo"><a href="javascript:void(0);" onclick="myvedio(<?php echo $user_id; ?>)" id="profileVideo">Video</a></li>
      <?php if($user_id == $data['userId']){ ?>
            <li id="tabmyevents"><a href="javascript:void(0);" onclick="myevents(<?php echo $user_id; ?>);">Events</a>
            </li>
      <?php } ?>
            <!-- <li id="tabmygroups"><a href="javascript:void(0);" onclick="mygroups()">Groups</a></li> -->
          </ul>
        </div>

        <?php } ?>
          


      </div>

    </div>

  </div>

   

<?php if($data['userId']!=$users['id'] && $users['isFriend']!=1 && $users['isPrivate']==1){ ?> 
<section class="private_sec">
<div id="privateAccount" class="privte_bx">
<span class="icon">
<!-- <img src="<?php //echo URL('/').'/public/website/images/icon/only_me.png' ?>" title="Friends" id="accountT" alt=""> -->
<i class="ri-lock-2-line"></i>
</span>
<div>
  <h4>This Account is Private.</h4>
  <span>Follow this account to see their photos and videos.</span>  
  </div>
</div>
</section>
<?php } ?>

<?php if($data['userId']!=$users['id'] && ($users['isPrivate']==0 || ($users['isPrivate']==1 && $users['isFriend']==1))){ ?>
  <div id="myposts" style="display:none"></div>
  <div id="myabout" style="display:none"></div>
  <div id="myphoto_" style="display:none"></div>
  <div id="myvedio" style="display:none"></div>
  <div id="myevents" style="display:none"></div>
<?php }else if($data['userId']==$users['id']){ ?> 
  <div id="myposts" style="display:none"></div>
  <div id="myabout" style="display:none"></div>
  <div id="myphoto_" style="display:none"></div>
  <div id="myvedio" style="display:none"></div>
  <div id="myevents" style="display:none"></div>

<?php } ?>





</div>
<?php //if($users['tab_info'] == 'No'){ ?>

<?php  //} ?>


<input type="hidden" id="imageCropType" value="0" >
<!-- <div class="modal fade" id="modal" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Crop Image Before Upload</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="img-container">
                      <div class="row">
                          <div class="col-md-8">
                              <img src="" id="sample_image" />
                          </div>
                          <div class="col-md-4">
                              <div class="preview"></div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="crop" class="btn btn-primary">Crop</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
          </div>
      </div> -->

<div class="modal fade abut_editfrom imageCroper" style="display:none;" id="modal" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                  <div class="img-container">
                      <div class="row">
                          <div class="col-md-8">
                              <img class="crop_img" src="" id="sample_image" />
                          </div>
                          <div class="col-md-4">
                              <div class="preview"></div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" id="crop" class="btn btn-primary">Crop</button>
                  <button type="button" class="btn btn-secondary close"   data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
                </div>
                </div>
           
        </div>
    </div>
</div>
    
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>

<script type="text/javascript">
  
  $(document).ready(function(){
    myabout('<?php echo $users['id']; ?>');
$('#imageCropType').val(0);
  var $modal = $('#modal');

  var image = document.getElementById('sample_image');

  var cropper;

  $('#BannerUpload').change(function(event){
   $('#imageCropType').val(1);

    var files = event.target.files;

    var done = function(url){
      image.src = url;
      $modal.modal('show');
    };

    if(files && files.length > 0)
    {
      reader = new FileReader();
      reader.onload = function(event)
      {
        done(reader.result);
      };
      reader.readAsDataURL(files[0]);
    }
  });


  $('#myfile').change(function(event){
   $('#imageCropType').val(2);

    var files = event.target.files;

    var done = function(url){
      image.src = url;
      $modal.modal('show');
    };

    if(files && files.length > 0)
    {
      reader = new FileReader();
      reader.onload = function(event)
      {
        done(reader.result);
      };
      reader.readAsDataURL(files[0]);
    }
  });

  $modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
     aspectRatio: 1,
      viewMode: 3,
      preview:'.preview',
    //   data:{ //define cropbox size
    //   width:1024,
    //   height:1024,
    // },
    });
  }).on('hidden.bs.modal', function(){
    cropper.destroy();
      cropper = null;
  });

  $('#crop').click(function(){
    $('#loader_spineer').show(); 
    canvas = cropper.getCroppedCanvas({
      width:1024,
      height:1024
    });

    canvas.toBlob(function(blob){
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function(){
        var base64data = reader.result;
        var cropType=$('#imageCropType').val();
        // $.ajax({
        //   url:'upload.php',
        //   method:'POST',
        //   data:{image:base64data},
        //   success:function(data)
        //   {
        //     $modal.modal('hide');
        //     $('#uploaded_image').attr('src', data);
        //   }
        // });
        /* Start */
  
        
        ajaxCsrf();
        if(cropType==1){


        $.ajax({
          url: baseUrl + '/banner_upload',
          type: 'POST',
           data:{image:base64data},         
          success: function (res) {
            $('#loader_spineer').hide(); 
            if (res) {
               $modal.modal('hide');           

              $("#user_ban_image_id").attr('src', res);
              $("#profileBannerFancy").attr('href',res);
              $("#banner_upolded_succ").show();
              setTimeout(function () {
                $("#banner_upolded_succ").hide();
              }, 2000);
            } else {
              return false;
            }
          }
        });
      } else if(cropType==2){

        $.ajax({
          url: baseUrl + '/profile_image_upload',
          type: 'POST',
          data:{image:base64data},   
          success: function (res) {
            $('#loader_spineer').hide(); 
            if (res) {
              $modal.modal('hide');     
              $("#user_pro_image_id").attr('src', res);
              $("#heder_profile_pic").attr('src', res)
              $("#profileFancy").attr('href',res);
              $("#profie_img_upolded_succ").show();
              setTimeout(function () {
                $("#profie_img_upolded_succ").hide();
              }, 2000);
            } else {
              return false;
            }
          }
        });
      }
     
        
        /* End */
      };
    });
  });
  
});
</script>

<!--  End crop image -->
<script>

  
  function follow1(id, status) {

    ajaxCsrf();
    $.ajax({
      type: "post",
      url: baseUrl + '/follow',
      data: { id: id, status: status },
      beforeSend: function () {
        //$('#loadingGife').show();
        //ajax_before();
      },
      success: function (res) {
        // ajax_success() ;

        if(status=='pending' || status=='Pending'){
            $('#pending_'+id).css('display','none');
            $('#follow_'+id).css('display','block');
        }else if(status=='pending1'){
           $('#followback_'+id).css('display','block');
          $('#pending_'+id).css('display','none');   
        }else if(status=='cancel'){
             $('#cancel_'+id).css('display','none');
             $('#accept_'+id).css('display','none');
             $('#follow_'+id).css('display','block');
             $('#unfollowing_'+id).css('display','none');
        }else if(status=='accept'){
            $('#cancel_'+id).css('display','none');
            $('#accept_'+id).css('display','none');
            $('#unfollowing_'+id).css('display','block');
            $('#follow_'+id).css('display','none');
        }else if(status=='followback'){
          $('#followback_'+id).css('display','none');
          $('#pending_'+id).css('display','block');             
        }else if(status=='unfollow'){
            $('#unfollowing_'+id).css('display','none');
            $('#follow_'+id).css('display','block');
        }else if(status=='follow'){

            $('#pending_'+id).css('display','block');             
            $('#follow_'+id).css('display','none');
        }else{
           statusMesage('something went wrong', 'error');
        }
        // if (res==1 && status=='Unfollow') {

        //   $('#' + id + '_follow').show();
        //   $('#' + id + '_following').hide();
        // } else if(res==1 && status=='Follow'){

        //   $('#' + id + '_follow').hide();
        //   $('#' + id + '_following').show();
        // }else if(){

        // }  else {
        //   statusMesage('something went wrong', 'error');
        // }
      }
    });

  }
  // else if (res == 2) {
  //         $('#' + id + '_follow').show();
  //         $('#' + id + '_following').hide();

  //       }


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.website.ajax_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/Profile/Profile.blade.php ENDPATH**/ ?>
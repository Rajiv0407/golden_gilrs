<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />



    <!-- Facebook Share -->




  <!-- End -->






  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <title>Golden Girls </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(URL::to('/public/website')); ?>/css/intlTelInput.css">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('/public/website')); ?>/css/style.css?v=<?php echo e(time()); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('/public/website')); ?>/css/responsive.css?v=<?php echo e(time()); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="<?php echo e(URL::to('/public/website')); ?>/lib/css/emoji.css?v=<?php echo e(time()); ?>" rel="stylesheet">
  <link rel="icon" href="<?php echo e(URL::to('/public/admin')); ?>/images/fav.png?v=<?php echo e(time()); ?>">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/css/uikit.min.css" />   --->


</head>

<body>


  <?php  $mobileDeduct=isMobileDev();  ?>
  <script type="text/javascript">
    var baseUrl = "<?php echo e(url('/')); ?>";
    var imageUrl = "<?php echo e(url('/public/website')); ?>";
  </script>
  <input type="hidden" id="post_id_delete" value="0">
  <input type="hidden" id="stroy_image_delete_id" value="0">
  <div class="grid-container" id="web_container">
    <header class="navbar_menu">
      <?php echo $__env->make('includes.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <div class="main_cont">
      <?php if($mobileDeduct && request()->segment(1) == 'home'){ ?>
      <div class="mobile_story">
        <?php echo $__env->make('rightmenu.stories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <?php } ?>

      <div class="user_prof ">
        <div class="left_section">

          <?php if(request()->segment(1) == 'home'){  ?>
          <div class="sell_box">
            <?php echo $__env->make('leftmenu.onlinecontacts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <?php }else{  ?>
          <div class="sell_box">
            <?php echo $__env->make('website.profile_left_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <?php } ?>

        </div>

        <div class="center_menu center_menu_data">
          <?php if(request()->segment(1) != 'home'){  ?>

          <?php echo $__env->yieldContent('content'); ?>
          <input type="hidden" id="tab_Id_data" value="all">
          <input type="hidden" id="goodies_Id_data" value="all">
          <!-- <?php echo $__env->make('website.profile_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  -->
          <?php }else{ ?>
          <?php echo $__env->yieldContent('content'); ?>
          <?php } ?>
        </div>
        <div class="right_menu">
          <!-- || request()->segment(1) == 'profile' -->
          <?php if(request()->segment(1) == 'home'  || request()->segment(1) == 'profile') { ?>

          <?php 
           $data=session()->get('user_session');

          if (!$mobileDeduct && isset($data['userId']) && isset($users['id']) && $data['userId']==$users['id'] ){ ?>
          <div class="sell_box hide_moble_view up_story_id"><?php echo $__env->make('rightmenu.stories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
          <?php } ?>


          <div class="sell_box muserinfobx"><?php echo $__env->make('website.user_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>

          <?php if(request()->segment(1) != 'network') { ?>
          <div class="sell_box hide_moble_view"><?php echo $__env->make('rightmenu.follow', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
          <?php } ?>
          <?php }else{  ?>
          <div class="sell_box"><?php echo $__env->make('website.user_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
          <?php } ?>
        </div>

      </div>
    </div>
    <footer class="footer_copy">
      <?php echo $__env->make('includes.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </footer>
  </div>

  <!-- partial -->

  <!-- Success Modal -->
  <div class="sucmssg_box" id="about_info_id" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Profile Has Been updated Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Success Modal End -->

  <!-- Banner Upolded Success Modal -->
  <div class="sucmssg_box" id="banner_upolded_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Banner image Has Been updated Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Upolded Success Modal End -->

  <!-- Banner Upolded Success Modal -->
  <div class="sucmssg_box" id="profie_img_upolded_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Profile image Has Been updated Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>


  <div class="sucmssg_box" id="profie_privacy_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Profile privacy Has Been updated Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
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
  <!-- Banner Upolded Success Modal End -->


  <!-- Basic profile Success Modal -->
  <div class="sucmssg_box" id="basic_profile_info" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Basic info Has Been updated Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!--Basic profile Success Modal End -->


  <!-- Post Edit Success Modal -->
  <div class="sucmssg_box" id="edit_post_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Post Has Been updated Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Post Success Modal End -->
  <!-- Post Add Success Modal -->
  <div class="sucmssg_box" id="add_post_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Post Has Been added Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Post Success Modal End -->

  <!-- Delete Success Modal -->
  <div class="sucmssg_box" id="success_delete" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Post Has Been deleted Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Success Modal End -->

  <!--Story Success Modal -->
  <div class="sucmssg_box" id="story_upload_succ" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Stories Has Been uploded Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Story Success Modal End -->



  <!-- Delete Modal -->
  <div class="dlet_tsk_mdlBox_body" id="tsk_mdlBox_body" style="display:none">
    <div class="dtmbbx">
      <header class="css-h2i4hf">
        <h4 class="css-1aseh1t">
          <span class="css-uq1bvn">
            <span role="img" aria-label="danger icon" class="sc-bwzfXH ufyYh">
              <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" role="presentation">
                <g fill-rule="evenodd">
                  <path
                    d="M13.416 4.417a2.002 2.002 0 0 0-2.832 0l-6.168 6.167a2.002 2.002 0 0 0 0 2.833l6.168 6.167a2.002 2.002 0 0 0 2.832 0l6.168-6.167a2.002 2.002 0 0 0 0-2.833l-6.168-6.167z"
                    fill="currentColor"></path>
                  <path d="M12 14a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1m0 3a1 1 0 0 1 0-2 1 1 0 0 1 0 2"
                    fill="inherit"></path>
                </g>
              </svg>
            </span>
          </span>
          <span class="css-vjdnif">
            <span>Delete Post?</span>
          </span>
        </h4>
      </header>
      <h3 class="mat-dialog-title">Are you sure to delete this Post ?</h3>
      <div class="mat-dialog-actions dlt_ftr_btn">
        <div class="dlt_ftr_btn_left r">
          <button class="dtm_no" onclick="delete_post_no();">No Thanks</button>
        </div>
        <div class="dlt_ftr_btn_left">
          <button class="dtm_dlet" onclick="delete_post_yes();">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Modal End -->




  <!-- start Event join model-->
  <div class="dlet_tsk_mdlBox_body" id="tsk_mdlBox_body1_old" style="display:none">
    <div class="dtmbbx">
      <header class="css-h2i4hf">
        <h4 class="css-1aseh1t">
          <span class="css-uq1bvn">
            <span role="img" aria-label="danger icon" class="sc-bwzfXH ufyYh">
              <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" role="presentation">
                <g fill-rule="evenodd">
                  <path
                    d="M13.416 4.417a2.002 2.002 0 0 0-2.832 0l-6.168 6.167a2.002 2.002 0 0 0 0 2.833l6.168 6.167a2.002 2.002 0 0 0 2.832 0l6.168-6.167a2.002 2.002 0 0 0 0-2.833l-6.168-6.167z"
                    fill="currentColor"></path>
                  <path d="M12 14a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1m0 3a1 1 0 0 1 0-2 1 1 0 0 1 0 2"
                    fill="inherit"></path>
                </g>
              </svg>
            </span>
          </span>
          <span class="css-vjdnif">
            <span>Join this Event</span>
          </span>
        </h4>
      </header>
      <h3 class="mat-dialog-title">Are you sure to join this Event?</h3>
      <div class="mat-dialog-actions dlt_ftr_btn">
        <div class="dlt_ftr_btn_left r">
          <button class="dtm_no" onclick="Booking_no();">No Thanks</button>
        </div>
        <div class="dlt_ftr_btn_left">
          <button class="dtm_dlet" onclick="Booking_yes();">Yes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Event join model-->

  <div class="modal fade basic_infofrom notify_modal" id="tsk_mdlBox_body1" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="css-1aseh1t">
            <span class="css-uq1bvn">
              <span role="img" aria-label="danger icon" class="sc-bwzfXH ufyYh">
                <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" role="presentation">
                  <g fill-rule="evenodd">
                    <path
                      d="M13.416 4.417a2.002 2.002 0 0 0-2.832 0l-6.168 6.167a2.002 2.002 0 0 0 0 2.833l6.168 6.167a2.002 2.002 0 0 0 2.832 0l6.168-6.167a2.002 2.002 0 0 0 0-2.833l-6.168-6.167z"
                      fill="#de350b"></path>
                    <path d="M12 14a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1m0 3a1 1 0 0 1 0-2 1 1 0 0 1 0 2"
                      fill="#fff"></path>
                  </g>
                </svg>
              </span>
            </span>
            <span class="css-vjdnif">
              <span>Join this Event</span>
            </span>
          </h4>
        </div>
        <div class="modal-body">
          <div class="dlet_tsk_mdlBox_body">
            <h3 class="mat-dialog-title">Are you sure to join this Event?</h3>
            <div class="mat-dialog-actions dlt_ftr_btn">
              <div class="dlt_ftr_btn_left r">
                <button class="dtm_no" onclick="Booking_no();">No Thanks</button>
              </div>
              <div class="dlt_ftr_btn_left">
                <button class="dtm_dlet" onclick="Booking_yes();">Yes</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- start Goodies join model-->
  <div class="dlet_tsk_mdlBox_body" id="tsk_mdlBox_body2_old" style="display:none">
    <header class="css-h2i4hf">
      <h4 class="css-1aseh1t">
        <span class="css-uq1bvn">
          <span role="img" aria-label="danger icon" class="sc-bwzfXH ufyYh">
            <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" role="presentation">
              <g fill-rule="evenodd">
                <path
                  d="M13.416 4.417a2.002 2.002 0 0 0-2.832 0l-6.168 6.167a2.002 2.002 0 0 0 0 2.833l6.168 6.167a2.002 2.002 0 0 0 2.832 0l6.168-6.167a2.002 2.002 0 0 0 0-2.833l-6.168-6.167z"
                  fill="currentColor"></path>
                <path d="M12 14a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1m0 3a1 1 0 0 1 0-2 1 1 0 0 1 0 2"
                  fill="inherit"></path>
              </g>
            </svg>
          </span>
        </span>
        <span class="css-vjdnif">
          <span>Join this Goodies</span>
        </span>
      </h4>
    </header>
    <h3 class="mat-dialog-title">Are you sure to join this Goodies?</h3>
    <div class="mat-dialog-actions dlt_ftr_btn">
      <div class="dlt_ftr_btn_left r">
        <button class="dtm_no" onclick="goodies_Booking_no();">No Thanks</button>
      </div>
      <div class="dlt_ftr_btn_left">
        <button class="dtm_dlet" onclick="goodies_Booking_yes();">Yes</button>
      </div>
    </div>
  </div>

  <!-- Goodies -->
  <div class="modal fade basic_infofrom notify_modal" id="tsk_mdlBox_body2" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="css-1aseh1t">
            <span class="css-uq1bvn">
              <span role="img" aria-label="danger icon" class="sc-bwzfXH ufyYh">
                <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" role="presentation">
                  <g fill-rule="evenodd">
                    <path
                      d="M13.416 4.417a2.002 2.002 0 0 0-2.832 0l-6.168 6.167a2.002 2.002 0 0 0 0 2.833l6.168 6.167a2.002 2.002 0 0 0 2.832 0l6.168-6.167a2.002 2.002 0 0 0 0-2.833l-6.168-6.167z"
                      fill="#de350b"></path>
                    <path d="M12 14a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1m0 3a1 1 0 0 1 0-2 1 1 0 0 1 0 2"
                      fill="#fff"></path>
                  </g>
                </svg>
              </span>
            </span>
            <span class="css-vjdnif">
              <span>Join this Goodies</span>
            </span>
          </h4>
        </div>
        <div class="modal-body">
          <div class="dlet_tsk_mdlBox_body">
            <h3 class="mat-dialog-title">Are you sure to join this Goodies?</h3>
            <div class="mat-dialog-actions dlt_ftr_btn">
              <div class="dlt_ftr_btn_left r">
                <button class="dtm_no" onclick="goodies_Booking_no();">No Thanks</button>
              </div>
              <div class="dlt_ftr_btn_left">
                <button class="dtm_dlet" onclick="goodies_Booking_yes();">Yes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Goodies -->
  
  <!-- Goodies join model-->

  <!-- start story image delete model-->
  <div class="dlet_tsk_mdlBox_body" id="story_image_delete_model" style="display:none">
    <div class="dtmbbx">
      <header class="css-h2i4hf">
        <h4 class="css-1aseh1t">
          <span class="css-uq1bvn">
            <span role="img" aria-label="danger icon" class="sc-bwzfXH ufyYh">
              <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" role="presentation">
                <g fill-rule="evenodd">
                  <path
                    d="M13.416 4.417a2.002 2.002 0 0 0-2.832 0l-6.168 6.167a2.002 2.002 0 0 0 0 2.833l6.168 6.167a2.002 2.002 0 0 0 2.832 0l6.168-6.167a2.002 2.002 0 0 0 0-2.833l-6.168-6.167z"
                    fill="currentColor"></path>
                  <path d="M12 14a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1m0 3a1 1 0 0 1 0-2 1 1 0 0 1 0 2"
                    fill="inherit"></path>
                </g>
              </svg>
            </span>
          </span>
          <span class="css-vjdnif">
            <span>Delete Story Image?</span>
          </span>
        </h4>
      </header>
      <h3 class="mat-dialog-title">Are you sure to delete this Image ?</h3>
      <div class="mat-dialog-actions dlt_ftr_btn">
        <div class="dlt_ftr_btn_left r">
          <button class="dtm_no" onclick="story_no();">No Thanks</button>
        </div>
        <div class="dlt_ftr_btn_left">
          <button class="dtm_dlet" onclick="story_yes();">Yes</button>
        </div>
      </div>
    </div>
  </div>
  <!--End story image delete  model-->.

  <!-- Delete Success Modal -->
  <div class="sucmssg_box" id="story_success_delete" style="display:none">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Story image Has Been deleted Successfully!! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Success Modal End -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


  <script type="text/javascript" src="<?php echo e(URL::to('/public/website')); ?>/js/intlTelInput.js"></script>
  <script type="text/javascript" src="<?php echo e(URL::to('/public/website')); ?>/js/utils.js"></script>
  <script type="text/javascript" src="<?php echo e(URL::to('/public/website')); ?>/js/custom.js?v=<?php echo e(time()); ?>"></script>
  <script type="text/javascript" src="<?php echo e(URL::to('/public/website')); ?>/lib/js/config.min.js?v=<?php echo e(time()); ?>"></script>
  <script type="text/javascript" src="<?php echo e(URL::to('/public/website')); ?>/lib/js/util.min.js?v=<?php echo e(time()); ?>"></script>

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit-icons.min.js"></script>
  <script src="<?php echo e(URL::to('/public/website')); ?>/lib/js/vanillaEmojiPicker.js?v=<?php echo e(time()); ?>"></script>


  <script>
    $(document).ready(function () {
      $(".dropdown-toggle").dropdown();
    });
    $('.search_btn').click(function () {
      $('.search_list').addClass('d-block');
    });
    /* $(document).mouseup(function (e) {
      if ($(e.target).closest(".search_li").length
        === 0) {
        $('.search_list').removeClass('d-block');
      }
    }); */
  </script>
  <script>
    $(document).ready(function () {
      // $('#BannerUpload').on('change', function () {
      //   var formData = new FormData($('#banner_image_form')[0]);
      //   ajaxCsrf();
      //   $.ajax({
      //     url: baseUrl + '/banner_upload',
      //     type: 'POST',
      //     data: formData,
      //     processData: false,
      //     contentType: false,
      //     dataType: 'html',
      //     success: function (res) {
      //       if (res) {
      //         $("#user_ban_image_id").attr('src', res);
      //         $("#profileBannerFancy").attr('href',res);
      //         $("#banner_upolded_succ").show();
      //         setTimeout(function () {
      //           $("#banner_upolded_succ").hide();
      //         }, 2000);
      //       } else {
      //         return false;
      //       }
      //     }
      //   });
      // });

/**/
      // $('#myfile').on('change', function () {
        
      //   var formData = new FormData($('#my_profile_pic')[0]);
      //   ajaxCsrf();
      //   $.ajax({
      //     url: baseUrl + '/profile_image_upload',
      //     type: 'POST',
      //     data: formData,
      //     processData: false,
      //     contentType: false,
      //     dataType: 'html',
      //     success: function (res) {
      //       if (res) {
      //         $("#user_pro_image_id").attr('src', res);
      //         $("#heder_profile_pic").attr('src', res)
      //         $("#profileFancy").attr('href',res);
      //         $("#profie_img_upolded_succ").show();
      //         setTimeout(function () {
      //           $("#profie_img_upolded_succ").hide();
      //         }, 2000);
      //       } else {
      //         return false;
      //       }
      //     }
      //   });
      // });
   



    });
  </script>
  <script type="text/javascript">
    var primaryColor = '#6fa362',
      dangerColor = '#b55151',
      infoColor = '#466baf',
      successColor = '#yellow',
      warningColor = '#ab7a4b',
      inverseColor = '#45484d';
    var themerPrimaryColor = primaryColor;

    function statusMesage(message, notifyType) {

      // $.notyfy.closeAll();
      /* $('#lblErrorMsg').notyfy({
          layout: 'bottom',
          modal: false,
          dismissQueue: false,
          timeout:3000,
          text: message,
          type: notifyType
      }); */
      //                var main_check = document.getElementById('input_c');
      //                main_check.checked = false;
      //$('input[id="input_c"]').prop('checked', false);

    }  
  </script>
  <script>
    new EmojiPicker({
      trigger: [
        {
          selector: '.first-btn',
          insertInto: ['.post_text_area'] // '.selector' can be used without array
        }
      ],
      closeButton: true,
    });
  </script>
</body>

</html><?php /**PATH D:\xampp\htdocs\golden\resources\views/includes/website/ajax_template.blade.php ENDPATH**/ ?>
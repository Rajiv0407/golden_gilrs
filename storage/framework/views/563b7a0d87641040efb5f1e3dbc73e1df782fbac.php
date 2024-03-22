
<?php $__env->startSection('content'); ?>

<div class="sell_box" id="event_detail">
  <div class="head">
    <ul class="step_bar">
      <li><a href="<?php echo e(URL::to('/')); ?>/life_style">Event</a></li>
      <li>Event Details</li>
    </ul>
  </div>

  <?php //print_r($event_info);die;   
  ?>

  <!-- <//?php echo $event_info['time']; ?>     -->

  <div class="post_detailbx">
    <div class="pd_card">
      <div class="pd_media"><img class="media" src="<?php echo $event_info['image']  ?>" alt=""></div>

      <div class="pd_head">
        <div class="pd_date">
          <span class="month"><?php echo $event_info['event_day']; ?></span>
          <span class="day"><?php echo $event_info['event_month']; ?></span>
        </div>
        <div class="pd_name">
          <h3><?php echo $event_info['event_name']; ?></h3>
          <p data-bs-toggle="modal" data-bs-target="#manage-members"><i class="ri-group-fill"></i><?php echo $event_info['event_view_count'];   ?> people responded</p>
        </div>
      </div>

      <div class="pd_dscrpn">
        <p><?php echo $event_info['event_descrption']; ?></p>
      </div>

      <div class="lctn_view">
        <ul class="lctn_ul">
          <li>
            <span><i class="ri-calendar-todo-fill"></i></span>
            <span><?php echo $event_info['event_date']; ?></span>
          </li>
          <li>
            <span><i class="ri-eye-fill"></i></span>
            <span><?php echo $event_info['event_view_count'];   ?> View</span>
          </li>
          <li>
            <span><i class="ri-time-fill"></i></span>
            <span><?php echo $event_info['event_time']; ?></span>
          </li>
          <!-- <li>
            <span><i class="ri-road-map-fill"></i></span>
            <span>2.5 Miles</span>
          </li> -->
          <li>
            <span><i class="ri-map-pin-fill"></i></span>
            <span><?php echo $event_info['address']; ?></span>
          </li>
        </ul>
      </div>

    </div>

    <div class="pd_card">
      <div class="head">
        <h3><i class="ri-coupon-fill"></i> Tickets</h3>
      </div>

      <form id="booking_event" action="javascript:void(0);" method="post">
        <!-- <div id="field1">Please select number of ticket</div> -->
        <div class="pd_tkt_bx">
          <div class="pdt_name">
            <p>Standard Price</p>
          </div>
          <div class="pdt_fr">
            <div class="wrap">
              <input type="hidden" name="booking_type" value="1">
              <input type="hidden" name="type_id" value="<?php echo $event_info['id']; ?>">

              <button type="button" class="sub" id="sub">-</button>
              <input type="text" class="count" name="no_ticket" id="no_ticket" value="1" min="1" max="10" readonly />
              <button type="button" class="add" id="add">+</button>
            </div>

            <button type="button" class="btn" onclick="send_booking_confirm();">Join</button>
          </div>
        </div>
      </form>

    </div>

  </div>

</div>


<div class="modal fade small_modal" id="event_booking_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-0 p-0">
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body">

        <div class="join_cont">

          <div class="jc_head">
            <i class="ri-checkbox-circle-fill"></i>
            <h3>You have Succeeded</h3>
          </div>

          <p class="jc_dec">Now sit back and relax. Now it was our work to check out your details. We will send you Email Confirmation once we are done.</p>

          <div class="jc_name">
            <p>In mean time, Know about</p>
            <h4>Golden Girls</h4>
          </div>

          <div class="button-group">
            <a href="<?php echo e(URL::to('/')); ?>/life_style">
              <button type="button" class="btn">About Golden Girls</button>
          </div></a>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade basic_infofrom mang_memb_modal" id="manage-members" tabindex="-1" aria-labelledby="manage-membersLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="manage-membersLabel">Gulf bank 2023</h5>
        <p>3 people responded</p>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body">
        <div class="members_popup">
          <form id="" action="javascript:void(0);" method="post">
            <div class="srch_mb_wrapp">
              <div class="form-group srch_mb">
                <input type="text" name="Search_members" id="hair_color" class="form-control" placeholder="Search members">
                <div class="form-icon"><i class="ri-search-line"></i></div>
              </div>
            </div>
            <div class="member_list">
              <div class="head_table">
                <h3>Name</h3>
                <h3>Email</h3>
                <div class="copy_all">
                  <button class="cpy_btn"><i class="ri-file-copy-line"></i></button>
                </div>
              </div>
              <div class="body_table">
                <div class="member_item">
                  <div class="avtar_grp">
                    <div class="mg_user_img">
                      <img src="<?php echo e(URL::to('/public/website')); ?>/images/user_holder.svg" alt="">
                    </div>
                    <div class="cont_mg">
                      <h3>Vivek Gupta</h3>
                    </div>
                  </div>
                  <div class="email_mber">
                    <h3>vivekgupta.intigate@gmail.com</h3>
                  </div>
                  <div class="CopyLink_btn">
                    <a class="btn dropdown-toggle" href="#" role="button" id="CopyLink" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-2-fill"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="CopyLink">
                      <li>
                        <a class="dropdown-item">
                          <span>
                            <svg width="24px" height="24px" viewBox="0 0 24 24" class="GfYBMd">
                              <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H4V4h16v12zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"></path>
                              <path fill="none" d="M0 0h24v24H0V0z"></path>
                            </svg>
                          </span>
                          <span>Message</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="dropdown-item">
                          <span>
                            <svg class="GfYBMd PmnIPc" width="20px" height="20px" viewBox="0 0 48 48" fill="#000000">
                              <path d="M0 0h48v48H0z" fill="none"></path>
                              <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                            </svg>
                          </span>
                          <span>Block</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="member_item">
                  <div class="avtar_grp">
                    <div class="mg_user_img">
                      <img src="<?php echo e(URL::to('/public/website')); ?>/images/user_holder.svg" alt="">
                    </div>
                    <div class="cont_mg">
                      <h3>Gungun Dubey</h3>
                    </div>
                  </div>
                  <div class="email_mber">
                    <h3>gungun.dubey@intigate.in</h3>
                  </div>
                  <div class="CopyLink_btn">
                    <a class="btn dropdown-toggle" href="#" role="button" id="CopyLink" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-2-fill"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="CopyLink">
                      <li>
                        <a class="dropdown-item">
                          <span>
                            <svg width="24px" height="24px" viewBox="0 0 24 24" class="GfYBMd">
                              <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H4V4h16v12zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"></path>
                              <path fill="none" d="M0 0h24v24H0V0z"></path>
                            </svg>
                          </span>
                          <span>Message</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="dropdown-item">
                          <span>
                            <svg class="GfYBMd PmnIPc" width="20px" height="20px" viewBox="0 0 48 48" fill="#000000">
                              <path d="M0 0h48v48H0z" fill="none"></path>
                              <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                            </svg>
                          </span>
                          <span>Block</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="member_item">
                  <div class="avtar_grp">
                    <div class="mg_user_img">
                      <img src="<?php echo e(URL::to('/public/website')); ?>/images/user_holder.svg" alt="">
                    </div>
                    <div class="cont_mg">
                      <h3>Jerin Varghese</h3>
                    </div>
                  </div>
                  <div class="email_mber">
                    <h3>jerin.varghese@intigate.in</h3>
                  </div>
                  <div class="CopyLink_btn">
                    <a class="btn dropdown-toggle" href="#" role="button" id="CopyLink" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-2-fill"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="CopyLink">
                      <li>
                        <a class="dropdown-item">
                          <span>
                            <svg width="24px" height="24px" viewBox="0 0 24 24" class="GfYBMd">
                              <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H4V4h16v12zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"></path>
                              <path fill="none" d="M0 0h24v24H0V0z"></path>
                            </svg>
                          </span>
                          <span>Message</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="dropdown-item">
                          <span>
                            <svg class="GfYBMd PmnIPc" width="20px" height="20px" viewBox="0 0 48 48" fill="#000000">
                              <path d="M0 0h48v48H0z" fill="none"></path>
                              <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                            </svg>
                          </span>
                          <span>Block</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="member_item">
                  <div class="avtar_grp">
                    <div class="mg_user_img">
                      <img src="<?php echo e(URL::to('/public/website')); ?>/images/user_holder.svg" alt="">
                    </div>
                    <div class="cont_mg">
                      <h3>Shubham</h3>
                    </div>
                  </div>
                  <div class="email_mber">
                    <h3>shubham.oneto11@gmail.com</h3>
                  </div>
                  <div class="CopyLink_btn">
                    <a class="btn dropdown-toggle" href="#" role="button" id="CopyLink" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-2-fill"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="CopyLink">
                      <li>
                        <a class="dropdown-item">
                          <span>
                            <svg width="24px" height="24px" viewBox="0 0 24 24" class="GfYBMd">
                              <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H4V4h16v12zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"></path>
                              <path fill="none" d="M0 0h24v24H0V0z"></path>
                            </svg>
                          </span>
                          <span>Message</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="dropdown-item">
                          <span>
                            <svg class="GfYBMd PmnIPc" width="20px" height="20px" viewBox="0 0 48 48" fill="#000000">
                              <path d="M0 0h48v48H0z" fill="none"></path>
                              <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                            </svg>
                          </span>
                          <span>Block</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="member_item">
                  <div class="avtar_grp">
                    <div class="mg_user_img">
                      <img src="<?php echo e(URL::to('/public/website')); ?>/images/user_holder.svg" alt="">
                    </div>
                    <div class="cont_mg">
                      <h3>Tanya Mohit</h3>
                    </div>
                  </div>
                  <div class="email_mber">
                    <h3>tanya.mohit@intigate.in</h3>
                  </div>
                  <div class="CopyLink_btn">
                    <a class="btn dropdown-toggle" href="#" role="button" id="CopyLink" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ri-more-2-fill"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="CopyLink">
                      <li>
                        <a class="dropdown-item">
                          <span>
                            <svg width="24px" height="24px" viewBox="0 0 24 24" class="GfYBMd">
                              <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H4V4h16v12zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"></path>
                              <path fill="none" d="M0 0h24v24H0V0z"></path>
                            </svg>
                          </span>
                          <span>Message</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="dropdown-item">
                          <span>
                            <svg class="GfYBMd PmnIPc" width="20px" height="20px" viewBox="0 0 48 48" fill="#000000">
                              <path d="M0 0h48v48H0z" fill="none"></path>
                              <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                            </svg>
                          </span>
                          <span>Block</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>

          </form>

          <div class="button-group">
            <button type="button" class="btn">Save changes</button>
            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>

          </div>
        </div>

      </div>

    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $("#life_style_id").addClass("active");
  $("#goodies_style_id").removeClass("");
  $('.add').click(function() {
    var th = $(this).closest('.wrap').find('.count');
    if (th.val() < 10) th.val(+th.val() + 1);
  });
  $('.sub').click(function() {
    var th = $(this).closest('.wrap').find('.count');
    if (th.val() > 1) th.val(+th.val() - 1);
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.website.ajax_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/eventDetails.blade.php ENDPATH**/ ?>
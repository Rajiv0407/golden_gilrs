@extends('includes.website.ajax_template')
@section('content')

<div class="sell_box " id="event_detail">
  <div class="head">
    <ul class="step_bar">
      <li><a href="{{URL::to('/')}}/life_style">Event</a></li>
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
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
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
            <a href="{{URL::to('/')}}/life_style">
              <button type="button" class="btn">About Golden Girls</button></a>
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
@stop
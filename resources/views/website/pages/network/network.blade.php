@extends('includes.website.ajax_template')
@section('content')
<div class="sell_box" id="Network">
  <div class="head">
    <h3>Network</h3>
  </div>
  <div class="Box_details_sect">
    <?php if(!empty($user_request)) { ?>
    <div class="Invitations_sect mt-3">
      <h3>Invitations</h3>
      <?php // echo "<pre>" ; print_r($user_request);  ?>
      <div class="invit_inner">
        <?php foreach($user_request as $user_requests) { //print_r($user_requests);  ?>
        <div class="crd_bx">
          <a href="{{URL('/').'/profile/'.$user_requests->id }}" style=" text-decoration: none !important;">
          <div class="user_avtar">
            <div class="img_bx">
              <img src="<?php echo $user_requests->image ; ?>" alt="">
            </div>
            <div class="user_details">
              <h3>
                <?php echo $user_requests->name ; ?>
              </h3>
              <?php if($user_requests->country != '' && $user_requests->city !=''){  ?>
              <div class="prof_location"><img src="{{URL::to('/public/website')}}/images/map-marker-alt.svg" alt="">
                <ul>
                  <li>
                    <?php echo $user_requests->country; ?>
                  </li>
                  <li>
                    <?php echo $user_requests->city; ?>
                  </li>
                </ul>
              </div>
              <?php } ?>
              <!-- <p>2 mutual network</p> -->
            </div>
          </div>
        </a>
          <div class="btn_grp">
            <button class="btn btcncl" id="<?php echo $user_requests->id; ?>_cancal" onclick="cancal_friend_request('<?php echo $user_requests->id; ?>')">Cancel</button>
            <button class="btn" id="<?php echo $user_requests->id;?>_cancelled" style="display:none">Cancelled</button>
            <button class="btn btacct" id="<?php echo $user_requests->id; ?>_accept" onclick="accept_friend_request('<?php echo $user_requests->id; ?>','accept')">Accept</button>
            <button class="btn btaptd" id="<?php echo $user_requests->id; ?>_request_accepted" style="display:none">Accepted</button>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
    <?php } ?>

    <div class="myntwrkbx">
      <div class="f_head border-0">
        <h3>People You May Know</h3>
      </div>
 
      <div class="f_card">
        
      <?php foreach($neartest_friends as $neartest_friend){ //echo "<pre>";print_r($neartest_friend); 
            if($neartest_friend->isInvition==1 || $neartest_friend->is_follow==2){
              continue ;
            }

      ?>
        <div class="fcrd_rptr">
          <div class="fpbx">

            <div class="media">
              <?php if($neartest_friend->image!='' && $neartest_friend->image!= null){ ?>
              <img src="<?php echo $neartest_friend->image; ?>" alt="">
              <?php }else{ ?>
              <img src="<?php echo $neartest_friend->image; ?>" alt="">
              <?php } ?>
            </div>

            <div class="data">
              <h3><a href="{{URL::to('/')}}/profile/<?php echo $neartest_friend->id; ?>"><?php echo $neartest_friend->name; ?></a></h3>
              
                
                <?php if($neartest_friend->country!='' && $neartest_friend->city!=''){ ?>
                  <h5>
                  <i class="fa fa-map-marker"></i>
                  <?php echo $neartest_friend->country; ?>, <?php echo $neartest_friend->city; ?>
                  </h5>
                <?php } ?>
              <?php if($neartest_friend->mutual_friend!=''){ ?>
              <p><?php echo $neartest_friend->mutual_friend; ?> mutual network</p>
			  <?php } ?>
            </div>

           
            <div class="button-group">
            <?php if($neartest_friend->is_follow==1){ ?>
               <button class="btn" id="<?php echo $neartest_friend->id ?>_follow" onclick="follow('<?php echo $neartest_friend->id; ?>','Follow')" style="display:none">Follow</button>
              <button class="btn pndng" id="<?php echo $neartest_friend->id ?>_following" onclick="follow('<?php echo $neartest_friend->id; ?>','pending')"><i class="ri-time-line"></i> Pending</button>
              <?php }else{ ?>
                <button class="btn" id="<?php echo $neartest_friend->id ?>_follow" onclick="follow('<?php echo $neartest_friend->id; ?>','Follow')">Follow</button>
                <button class="btn pndng" id="<?php echo $neartest_friend->id ?>_following" onclick="follow('<?php echo $neartest_friend->id; ?>','Pending')" style="display:none"><i class="ri-time-line"></i>Pending</button>
              <?php } ?>

            </div>       
            
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
@stop  
<script>



  function refreshDiv() {
    $(".grid-container").load(location.href + " .grid-container");
  }


  function accept_friend_request(id, status) {
    ajaxCsrf();
    $.ajax({
      type: "post",
      url: baseUrl + '/accept_friend_request',
      data: { id: id, status: status },
      beforeSend: function () {
        //$('#loadingGife').show();
        //ajax_before();
      },
      success: function (res) {
        // ajax_success() ;
        if (res == 2) {
          $('#' + id + '_accept').hide();
          $('#' + id + '_cancal').hide();
          $('#' + id + '_request_accepted').show();

        } else {
          statusMesage('something went wrong', 'error');
        }
      }

    });

  }

  function cancal_friend_request(id, status) {
    ajaxCsrf();
    $.ajax({
      type: "post",
      url: baseUrl + '/cancal_friend_request',
      data: { id: id, status: status},
      beforeSend: function () {
        //$('#loadingGife').show();
        //ajax_before();
      },
      success: function (res) {
        // ajax_success() ;
        if (res == 2) {
          $('#' + id + '_accept').hide();
          $('#' + id + '_cancal').hide();
          $('#' + id + '_cancelled').show();

        } else {
          statusMesage('something went wrong', 'error');
        }
      }

    });

  }
//
  function follow(id, status) {
  
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
        if (res == 1 && status=='Follow') {
          $('#' + id + '_follow').hide();
          $('#' + id + '_following').show();

        }else if(res == 1 && status=='Pending'){
          $('#' + id + '_follow').show();
          $('#' + id + '_following').hide();
        } else {
          statusMesage('something went wrong', 'error');
        }
      }

    });

  }


</script>
<div class="rgt_flwbx">
<?php $data=session()->get('user_session');   ?>
  <div class="head">
    <h3>Who to Follow</h3>
    <a class="ank_btn text-decoration-underline" href="{{URL::to('/')}}/network/<?php echo $data['userId'];  ?>">View All</a>  
  </div>
  <div class="follow_sect">
    <div class="follow_list">

      <?php //echo "<pre>" ;

               //  print_r($get_neartest_follow); exit ;
       ?>
      <?php if(!empty($get_neartest_follow)){ ?> 
	 <?php foreach($get_neartest_follow as $follow){ 

 if($follow->isInvition==1 || $follow->is_follow==2){
              continue ;
            }

    ?>
      <div class="crs_bx">
        <div class="user_avtar">
          <div class="img_bx">
            <img src="<?php echo $follow->image;  ?>" alt="">
          </div>
          <div class="user_details">
            <div>
			  
              <h3><a class="ank_btn text-decoration-underline" href="{{URL::to('/')}}/profile/<?php echo $follow->id ;  ?>">
                <span>
                  <?php echo $follow->name;  ?></span>
                  <span>
                  <svg id="Frame" xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14">
                    <rect id="Frame-2" data-name="Frame" width="15" height="14" fill="none" opacity="0.5" />
                    <path id="Vector"
                      d="M15,6.976c0,.776-.763,1.39-1,2.069-.232.711,0,1.649-.431,2.231-.465.582-1.46.679-2.058,1.1s-.962,1.326-1.692,1.552c-.7.226-1.56-.291-2.323-.291s-1.626.517-2.323.291c-.73-.226-1.1-1.132-1.692-1.552-.631-.453-1.626-.517-2.058-1.1S1.228,9.757,1,9.046C.763,8.367,0,7.752,0,7.009c0-.776.763-1.39,1-2.069.232-.711,0-1.649.431-2.231s1.46-.679,2.058-1.1S4.447.284,5.177.057c.7-.226,1.56.291,2.323.291S9.126-.169,9.823.057c.73.226,1.1,1.132,1.692,1.552.631.453,1.626.517,2.058,1.1s.2,1.52.431,2.231c.232.679,1,1.293,1,2.037Zm-3.352-2.1-.431-.485L6.073,8.884,3.85,5.942l-.531.388L5.973,9.854Z"
                      transform="translate(0 0.008)" fill="#d7792d" />
                  </svg>
                </span>
                </a></h3>
              
            </div>

          </div>
        </div>
        <div class="btn_follow">
        <!--  <button class="btn" id="<?php //echo $follow->id ; ?>_follow" onclick="follow('<?php //echo $follow->id ; ?>','Follow')">Follow</button>
                <button class="btn pndng" id="<?php //echo $follow->id ?>_following" style="display:none" onclick="follow('<?php //echo $follow->id ; ?>','Unfollow')">Pending</button>  -->
                      <?php if($follow->is_follow==1){ ?>
               <button class="btn" id="<?php echo $follow->id ?>_follow" onclick="follow('<?php echo $follow->id; ?>','Follow')" style="display:none">Follow</button>
              <button class="btn pndng" id="<?php echo $follow->id ?>_following" onclick="follow('<?php echo $follow->id; ?>','pending')"><i class="ri-time-line"></i> Pending</button>
              <?php }else{ ?>
                <button class="btn" id="<?php echo $follow->id ?>_follow" onclick="follow('<?php echo $follow->id; ?>','Follow')">Follow</button>
                <button class="btn pndng" id="<?php echo $follow->id ?>_following" onclick="follow('<?php echo $follow->id; ?>','Pending')" style="display:none"><i class="ri-time-line"></i>Pending</button>
              <?php } ?>
        </div>

      </div>
     <?php } ?>  
<?php } ?>
    </div>
  </div>
</div>
	<script> 
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

        }else if(res == 1 && (status=='pending' || status=='Pending')){
          $('#' + id + '_follow').show();
          $('#' + id + '_following').hide();
        } else {
          statusMesage('something went wrong', 'error');
        }
		  }
		});

	  }
	</script>
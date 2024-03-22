<?php $data=session()->get('user_session');// echo "<pre>";print_r($data); die;  ?> 
<div class="notify_list_wrap">
                   <?php if(count($notification) > 0){ ?>
                  <div class="notify_head">
                    <h4>New</h4>
                    <a href="{{URL::to('/')}}/notification/<?php echo $data['userId'];  ?>">See all</a>
                  </div>
                  <div class="notify_list">
				    <?php foreach($notification as $notifications){   ?>
                    <a href="javascript:void(0);" onclick="read_notification(<?php echo $notifications['id'] ?>,<?php echo $data['userId']; ?>)">
                      <div class="notify_img">   
                        <img src="<?php echo $notifications['image']; ?>" alt="">
                        <div class="bell_i">
                          <i class="fa fa-bell" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="notify_details">
                        <h5><?php echo $notifications['message']; ?></h5>
                        <p><?php echo $notifications['time']; ?></p>
                      </div>
                    </a>
					<?php } ?>  
                  </div>
				   <?php } ?>
                </div>
                <div class="notify_list_wrap">
				<?php if(count($friend_request) > 0){ ?>
                  <div class="notify_head">
                    <h4>Friend Requests</h4>
                    <a href="{{URL::to('/')}}/network/<?php echo $data['userId'];  ?>">See all</a>
                  </div>
				   <?php foreach($friend_request as $friend_requests){   ?>
				    <div class="notify_list frnd_rqst" id="frend_request_id_<?php echo $friend_requests['id'];?>">
                    <a href="javascript:void(0);">
                      <div class="notify_img">	
                        <img src="<?php echo $friend_requests['image']; ?>" alt="">
                        <div class="bell_i">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="notify_details">
                        <h5><?php echo $friend_requests['message']; ?></h5>
                        <p><?php echo $friend_requests['time']; ?></p>
                        <div class="friend_rqst_btn">  
                          <button class="btn confirm_btn" id="<?php echo $friend_requests['id'] ?>" onclick="accept_request(<?php echo $friend_requests['id'] ?>)">Confirm</button>
                          <button class="btn decline_btn">Decline</button>
                        </div>
                      </div>
                    </a>
				   
                  </div>
				  <?php } ?>  
                   <?php } ?>  
                </div>

    
     <!--   -->
     
      
        <?php //echo "<pre>";print_r($goodies_listing);die;  ?>
        <?php if(count($goodies_listing)> 0){ ?>
        <div class="post_list">
        <?php foreach($goodies_listing as $goodies_listings){ ?>
          
            <div class="post_card">
              
              <div class="post_head">
                <h3><?php echo $goodies_listings['title']; ?></h3>
                <p><?php echo $goodies_listings['goodies_date']; ?></p>
                 <?php if($goodies_listings['country']!='' && $goodies_listings['city']!=''){ ?> 
                  <p><?php echo $goodies_listings['country']; ?> : <?php echo $goodies_listings['city']; ?> </p>
                <?php } else if($goodies_listings['country']!=''){ ?> 
                    <p><?php echo $goodies_listings['country']; ?></p>
                <?php } ?>
              </div>
              
              <div class="description_post">
                <p><?php echo $goodies_listings['goodies_descrption']; ?></p>
              </div>

              <div class="post_l_banner">
                <img class="media" src="<?php echo $goodies_listings['image']; ?>" alt="">
				<div class="offer_box bg_brn"><h3><?php echo $goodies_listings['goodies_fee_type']; ?></h3></div>    
              </div>  


              <div class="lctn_view">
                <ul class="lctn_ul">
                  <li>
                    <span><i class="ri-calendar-todo-fill"></i></span>
                    <span><?php echo $goodies_listings['start_date'].' - '.$goodies_listings['end_date']?></span>
                  </li>
                  <li>
                    <span><i class="ri-eye-fill"></i></span>
                    <span>12K View</span>
                  </li>
                  <li>
                    <span><i class="ri-time-fill"></i></span>
                    <span><?php echo $goodies_listings['goodies_time']; ?></span>
                  </li>
                  <li>
                    <span><i class="ri-road-map-fill"></i></span>
                    <span>2.5 Miles</span>
                  </li>
                  <li>
                    <span><i class="ri-map-pin-fill"></i></span>
                    <span><?php echo $goodies_listings['goodies_address']; ?></span>
                  </li>
                </ul>           
              </div>


              <div class="post_likeshare">
                <ul class="likeshare_ul">
                  <li>
                    <button type="button" class="btn_line" id="goodies_like" value="<?php echo $goodies_listings['id']; ?>">
                      <span id="goodies_span_id_<?php echo $goodies_listings['id']; ?>">
					    <?php if($goodies_listings['user_like_goodies_yes_no'] == 'Yes'){ ?>
						 <i class="ri-thumb-up-fill"></i>
                        <?php }else{ ?>
                          <i class="ri-thumb-up-line"></i>
                        <?php } ?>						
                      </span>
                      <span>Like</span>
                      <sup id="goodies_like_count_<?php echo $goodies_listings['id']; ?>">
                        <?php echo !empty($goodies_listings['like_count'])?$goodies_listings['like_count']:""; ?>
                      </sup>
                    </button>                    
                  </li>

                  <li>
                  <button type="button" class="btn_line" id="goodies_message" value="<?php echo $goodies_listings['id'] ?>">
                    <span>
                      <i class="ri-message-2-line"></i>
                      <!-- <i class="ri-message-2-fill"></i> -->
                    </span>
                    <span>Comment</span>
                    <sup id="goodies_message_count_<?php echo $goodies_listings['id']  ?>"><?php echo $goodies_listings['message_count']; ?></sup>
                  </button>
                  </li>

                  <li>
                    <a href="javascript:void(0);" id="share_id" class="share" value="<?php echo $goodies_listings['id'] ?>">
                      <span><i class="ri-share-fill"></i></span>
                      <span>Share</span>
                    </a>
                    <ul class="share_ul">
                      <li>
                        <a href="https://www.facebook.com/share.php?u=<?php echo $goodies_listings['share_url'];?>" target="_blank"><i class="fa fa-facebook-f"></i></a>
                      </li>
                      <li>
                        <a href="https://twitter.com/share?text=<?php //echo $blog_title;?>&url=<?php echo $goodies_listings['share_url'];?>" target="_blank">
                          <i class="fa fa-twitter"></i>
                        </a>
                      </li>
                      <li><a href="javascript:void(0);" target="_blank"><i class="fa fa-youtube"></i></a></li>
                      <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $goodies_listings['share_url'];?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                      <li><a href="https://www.instagram.com/theunitedindian/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                      <li><a href="javascript:void(0);"><i class="ri-file-copy-fill"></i></a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="<?php echo $goodies_listings['goodies_url'].'/'.$goodies_listings['id'] ?>"><button type="button" class="btn" >Join</button></a>
                  </li>
                </ul>
              </div>


					    <div class="post_chat_sect" id="goodies_post_chat_sect_<?php echo $goodies_listings['id']; ?>" style="display:none">    
                        <div class="user_img"><img src="<?php echo URL('/') ; ?>/public/website/images/user1.jpg" alt=""></div>
                        <div class="send-message">
                          <form id="goodies_comment_save_id_<?php echo $goodies_listings['id']; ?>" action="javascript:void(0);" >
						  <div class="post_text_area">
						  <textarea rows="1"
                              formcontrolname="ComentMeassge" type="text" id="goodies_comment_<?php echo $goodies_listings['id']; ?>" placeholder="Comment"
                              class="msg_int_style ng-valid ng-pristine ng-touched"
                              ng-reflect-name="ComentMeassge"></textarea>
							  <span id="error_goodies_comment" class="err"></span></div>
							  <button class="btn_post" onclick="goodies_save_comment(<?php echo $goodies_listings['id'] ?>)"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <g clip-path="url(#clip0_1052_7993)">
                                  <path
                                    d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"
                                    fill="#C5963A">
                                  </path>
                                </g>
                                <defs>
                                  <clipPath id="clip0_1052_7993">
                                    <rect width="20" height="20" fill="white"></rect>
                                  </clipPath>
                                </defs>
                              </svg></button>
                            <div class="attachment-file_post"></div>
                          </form>
                        </div>
                      </div>

					  <div class="post_list_chat" id="goodies_post_list_chat_<?php echo $goodies_listings['id']; ?>" style="display:none"></div>     

                    </div>
                  

        <?php } ?>
        </div>
		<?php }else{ ?>
		<div class="no_record_box">
				<div class="media"><img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/c_norecrd.png" alt=""> </div>
				<h3>No record Found</h3>
				<p>Goodies Not found</p>    

			  </div>  
		<?php } ?>  
       


 
 

<!-- Modal -->


<?php /**PATH C:\xampp\htdocs\golden\resources\views/website/filterGoodies.blade.php ENDPATH**/ ?>
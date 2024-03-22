<section class="banner_sect mb-5">
    <div class="inner_img">
      <div class="Banner_upload">
        <div class="Banner_preview">  
		<?php if(!empty($userInfo['banner_image'])){ ?>
          <div class="BannerPreview" id="BannerPreview" style="background: url(<?php echo $userInfo['banner_image'] ?>);">
		<?php }else{?>
		 <div class="BannerPreview" id="BannerPreview" style="background: url({{URL::to('/public/website')}}/img/banner.png);">
		<?php  }  ?>
            <div class="uer_prof">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
				  <form id="banner_image_form" >
				  <input type="hidden" name="user_id" id="user_id" value="<?php echo !empty($userInfo[0]->id)? $userInfo[0]->id:""; ?>">
                    <div class="Banner_edit ">
                      <input type="file" class="BannerUpload" name="BannerUpload" id="BannerUpload" accept=".png, .jpg, .jpeg">
                      <label for="BannerUpload">  
                        <i class="fa fa-camera"></i> Change Cover
                      </label>
                    </div>
					</form>  
                  </div>
                  <div class="col-sm-12">
                    <div class="prof_wrapp">
                      <div class="lft_bx">
                        <form id="my_profile_pic" >
                        <div class="prof_pic">
                          <img src="<?php echo $userInfo['image'] ?>" alt=""> 
					   <div class="filecabinet">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo !empty($userInfo[0]->id)? $userInfo[0]->id:""; ?>">
						<input type="file" name="myfile" id="myfile">
						<label class="cabinet" for="myfile">
							<img class="cabinetimg"  <img src="{{URL::to('/public/website')}}/img/edit_p.png" alt="image">
						</label>
			            </div>   
                        </div>
						 </form> 
                        <div class="pro_cont">
                          <h3><?php echo !empty($userInfo[0]->name)?$userInfo[0]->name:"" ?> <img src="{{URL::to('/public/website')}}/img/check_b.png" alt=""></h3>
                          <h4><?php echo $userInfo['age'] ?> year</h4>    
                          <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo !empty($userInfo[0]->country)?$userInfo[0]->country:"" ?>, <?php echo !empty($userInfo[0]->city)?$userInfo[0]->city:"" ?></p>
                        </div>
                      </div>   
                      <div class="rgt_bx">
                        <ul class="social_prof">
                          <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                          </li>
                          <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                          </li>
                          <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                          </li>
                        </ul>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-12 col-sm-12">
          <div class="box_sect">
            <div class="comm_navtab">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="Profile-tab" data-bs-toggle="tab" data-bs-target="#Profile"
                    type="button" role="tab" aria-controls="Profile" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Marches-tab" data-bs-toggle="tab" data-bs-target="#Marches" type="button"
                    role="tab" aria-controls="Marches" aria-selected="false">Marches</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends" type="button"
                    role="tab" aria-controls="Friends" aria-selected="false">Friends</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Media-tab" data-bs-toggle="tab" data-bs-target="#Media" type="button"
                    role="tab" aria-controls="Media" aria-selected="false">Media</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Settings-tab" data-bs-toggle="tab" data-bs-target="#Settings"
                    type="button" role="tab" aria-controls="Settings" aria-selected="false">Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Notification-tab" data-bs-toggle="tab" data-bs-target="#Notification"
                    type="button" role="tab" aria-controls="Notification" aria-selected="false">Notification</button>
                </li>
              </ul>
            </div>

            <div class="tab-content" id="myTabContent">
			<?php //profile tab start ?>
              <div class="tab-pane fade show active pd-30" id="Profile" role="tabpanel" aria-labelledby="Profile-tab">
                <div class="profile_wrap">
                  <div class="hd_top">
                    <h3 class="heading_title">My Self Summary</h3>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_profile_des"><img src="{{URL::to('/public/website')}}/img/feather-edit.svg" alt=""></a>
                  </div>
                  <div class="cont_prof">
                    <p>
                      <?php echo !empty($userInfo[0]->self_des)? $userInfo[0]->self_des:"N/A"; ?>  
                    </p>

                  </div>
                </div>
                <div class="video_bx">
                  <img src="{{URL::to('/public/website')}}/img/bg-6.png" alt="">
                  <div class="paly_icon">
                    <div class="sm_py_pu_btn ">
                      <div class="sm_nme_btn play_anims">
                        <a href="javascript:void(0);">
                          <i class="fa fa-play"></i>
                        </a>
                      </div>
                    </div>

                  </div>

                </div>
                <div class="hd_top mt-4">
                  <h3 class="heading_title">My Self Summary</h3>
				  <a href="#" data-bs-toggle="modal" data-bs-target="#edit_profile"><img src="{{URL::to('/public/website')}}/img/feather-edit.svg" alt=""></a>
                </div>
                <div class="profile_fullDetails">

                  <div class="left_list">
                    <ul>
                      <li><span>Gender :</span> <span> <?php echo !empty($userInfo[0]->gender)? $userInfo[0]->gender:"N/A"; ?></span></li>
                      <li><span>Age :</span><span><?php echo !empty($userInfo[0]->age)? $userInfo[0]->age:"N/A"; ?> Years old</span></li>
                      <li><span>Country :</span><span> <?php echo !empty($userInfo[0]->country)? $userInfo[0]->country:"N/A"; ?></span></li>
                      <li><span>City :</span><span><?php echo !empty($userInfo[0]->city)? $userInfo[0]->city:"N/A"; ?></span></li>
                      <li><span>Birthday :</span><span><?php echo !empty($userInfo['date'])? $userInfo['date']:"N/A"; ?></span></li>  
                      <li><span>Relationship :</span><span><?php echo !empty($userInfo[0]->relationship)? $userInfo[0]->relationship:"N/A"; ?></span></li>
                      <li><span>Height :</span><span> <?php echo !empty($userInfo[0]->height)? $userInfo[0]->height:"N/A"; ?></span></li>
                      <li><span>Weight :</span><span><?php echo !empty($userInfo[0]->weight)? $userInfo[0]->weight:"N/A"; ?></span></li>
                    </ul>
                  </div>

                  <div class="right_list">    
                    <ul>
                      <li><span>Education :</span> <span><?php echo !empty($userInfo[0]->education)? $userInfo[0]->education:"N/A"; ?></span></li>
                      <li><span>Know :</span><span><?php echo !empty($userInfo[0]->know)? $userInfo[0]->know:"N/A"; ?>n</span></li>
                      <li><span> Interests :</span><span><?php echo !empty($userInfo[0]->interests)? $userInfo[0]->interests:"N/A"; ?></span></li>
                      <li><span> Smoking :</span><span><?php echo !empty($userInfo[0]->smoking)? $userInfo[0]->smoking:"N/A"; ?></span></li>
                      <li><span>Eye Color :</span><span><?php echo !empty($userInfo[0]->eye_color)? $userInfo[0]->eye_color:"N/A"; ?></span></li>
                      <li><span>Marital Status :</span><span><?php echo !empty($userInfo[0]->marital_status)? $userInfo[0]->marital_status:"N/A"; ?></span></li>
                      <li><span>Looking Man For A :</span><span> <?php echo !empty($userInfo[0]->looking_man_for)? $userInfo[0]->looking_man_for:"N/A"; ?></span></li>
                      <li><span>Work as :</span><span><?php echo !empty($userInfo[0]->work_as)? $userInfo[0]->work_as:"N/A"; ?></span></li>  
                    </ul>
                  </div>
                </div>
              </div>
			  
			  <?php //profile tab end ?>  
              <div class="tab-pane fade" id="Marches" role="tabpanel" aria-labelledby="Marches-tab">
                <div class="marches_wrapp">
                  <div class="list_sugg">
                    <ul>
					
                     <?php foreach($frnd_data as $frnd_infos){  ?>
                      <li>
                        <div class="card">
                          <div class="img_card">
						  <?php if(!empty($frnd_infos->image)){?>
						   <img src="<?php echo  url('/').'/storage/app/public/user_image/'.$frnd_infos->image ?>" alt="">
						  <?php } else {?>
						  <img src="<?php echo  url('/').'/storage/app/public/user_image/'.'user.png' ?>" alt="">  
						   <?php } ?>
                          </div>
                          <div class="cont_bx">
                            <div>
                              <div class="list_btm">
                                <h3><?php echo !empty($frnd_infos->name)?$frnd_infos->name:""; ?>,  24</h3>        
                                <div class="chat_icon"> <img src="img/message-circle.svg" alt=""></div>
                              </div>
                              <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>
                              <div class="list_btm">
                                <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt=""><?php echo !empty($frnd_infos->height)?$frnd_infos->height:""; ?>cm</p>
                                <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                              </div>
                            </div>  

                          </div>
                          <div class="like_heart">
                            <div class="heart_icon"></div>
                          </div>
                        </div>
                      </li>
					<?php  }  ?>
                      
                      
                    </ul>

                  </div>
                </div>



              </div>
              <div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
                <div class="marches_wrapp">
                  <div class="list_sugg">
                    <ul>
					<?php foreach($frnd_data as $frnd_infos){  ?>
                      <li>
                        <div class="card">
                          <div class="img_card">
						  <?php if(!empty($frnd_infos->image)){?>
						   <img src="<?php echo  url('/').'/storage/app/public/user_image/'.$frnd_infos->image ?>" alt="">
						  <?php } else {?>
						  <img src="<?php echo  url('/').'/storage/app/public/user_image/'.'user.png' ?>" alt="">  
						   <?php } ?>
                          </div>
                          <div class="cont_bx">
                            <div>
                              <div class="list_btm">
                                <h3><?php echo !empty($frnd_infos->name)?$frnd_infos->name:""; ?>,  24</h3>        
                                <div class="chat_icon"> <img src="img/message-circle.svg" alt=""></div>
                              </div>
                              <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>
                              <div class="list_btm">
                                <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt=""><?php echo !empty($frnd_infos->height)?$frnd_infos->height:""; ?>cm</p>
                                <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                              </div>
                            </div>  

                          </div>
                          <div class="like_heart">
                            <div class="heart_icon"></div>
                          </div>
                        </div>
                      </li>
					<?php  }  ?>
                    </ul>

                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="Media" role="tabpanel" aria-labelledby="Media-tab">

                <div class="marches_wrapp media_list">
                  <div class="list_sugg">
                    <ul>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg1.png" alt="">
                          </div>

                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg2.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg3.png" alt="">
                          </div>

                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg4.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg5.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg6.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg7.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg8.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg9.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg10.png" alt="">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="card">
                          <div class="img_card">
                            <img src="{{URL::to('/public/website')}}/img/sugg11.png" alt="">
                          </div>
                        </div>
                      </li>

                    </ul>

                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="Settings" role="tabpanel" aria-labelledby="Settings-tab">Settings</div>
              <div class="tab-pane fade" id="Notification" role="tabpanel" aria-labelledby="Notification-tab">
                Notification</div>

            </div>





          </div>

        </div>
        <div class="col-lg-4 col-sm-12 col-sm-12">
          <div class="box_sect pd-30">
            <div class="hd_top">
              <h3 class="heading_title">Filter Search</h3>
              <a href="#">Clear</a>
            </div>
            <div class="frm_wrap">
              <div class="frm_itm">
                <select name="" id="" class="form-control">
                  <option value="">Male</option>
                  <option value="">Female</option>
                </select>
                <span class="icon">
                  <img src="{{URL::to('/public/website')}}/img/feather-users.svg" alt="">
                </span>
              </div>
              <div class="frm_itm">
                <input type="text" class="form-control" placeholder="Age">
                <span class="icon">
                  <img src="{{URL::to('/public/website')}}/img/calendar.svg" alt="">
                </span>
              </div>

              <div class="frm_itm">
                <input type="text" class="form-control" placeholder="Choose Your Country">
                <span class="icon">
                  <img src="{{URL::to('/public/website')}}/img/location-on.svg" alt="">
                </span>
              </div>
              <button class="btn">Find Your Partner</button>
            </div>
          </div>
          <div class="box_sect pd-30 mt-4">
            <div class="hd_top">
              <h3 class="heading_title">You May Like</h3>
              <a href="#">View All</a>
            </div>
            <div class="may_like_sect">
              <ul>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>
                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg1.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg2.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg3.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg4.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg5.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg6.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg7.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>
                <li>
                  <div class="img_inner">
                    <img src="{{URL::to('/public/website')}}/img/sugg8.png" alt="">
                    <a href="#" class="add_btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </div>

                </li>

              </ul>

            </div>

          </div>
        </div>


      </div>

    </div>
  </section>
  <section>
    <div class="counter_sect mt-5">
      <div class="container">
        <div class="col-sm-12">
          <div class="counter_list">
            <div class="counter_item">
              <div class="icon_bx">
                <img src="{{URL::to('/public/website')}}/img/count1.png" alt="">
              </div>
              <div class="item" data-number="260" style="visibility: visible;">
                <div class="count_txt">
                  <p id="number1" class="number">260</p>
                  <span>+</span>
                </div>
                <h5>Users</h5>
              </div>
            </div>
            <div class="counter_item">
              <div class="icon_bx">
                <img src="{{URL::to('/public/website')}}/img/count12.png" alt="">
              </div>
              <div class="item" data-number="210" style="visibility: visible;">
                <div class="count_txt">
                  <p id="number2" class="number">210</p>
                  <span> +</span>
                </div>
                <h5>Brands</h5>

              </div>
            </div>
            <div class="counter_item">
              <div class="icon_bx">
                <img src="{{URL::to('/public/website')}}/img/count3.png" alt="">
              </div>
              <div class="item" data-number="190" style="visibility: visible;">

                <div class="count_txt">
                  <p id="number3" class="number">190</p>
                  <span>+</span>
                </div>
                <h5>Venues</h5>

              </div>
            </div>
            <div class="counter_item">
              <div class="icon_bx">
                <img src="{{URL::to('/public/website')}}/img/count4.png" alt="">
              </div>
              <div class="item" data-number="560" style="visibility: visible;">

                <div class="count_txt">
                  <p id="number4" class="number">560</p>
                  <span>+</span>
                </div>
                <h5>Market Size</h5>

              </div>
            </div>

          </div>

        </div>

      </div>


    </div>

  </section>
  <section class="Suggestions_sect mt-5 mb-5">
    <div class="container">
      <div class="col-sm-12">
        <div class="box_sect pd-30">
          <div class="hd_top">
            <h3 class="heading_title">Suggestions </h3>
          </div>
          <div class="list_sugg">
            <ul>
              <li>
                <div class="card">
                  <div class="img_card">
                    <img src="{{URL::to('/public/website')}}/img/sugg.png" alt="">
                  </div>
                  <div class="cont_bx">
                    <div>
                      <h3>Simran, 24</h3>
                      <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>
                      <div class="list_btm">
                        <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt="">165 cm</p>
                        <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                      </div>
                    </div>


                  </div>
                  <div class="like_heart">
                    <div class="heart_icon"></div>
                  </div>
                </div>
              </li>
              <li>
                <div class="card">
                  <div class="img_card">
                    <img src="{{URL::to('/public/website')}}/img/sugg1.png" alt="">
                  </div>
                  <div class="cont_bx">
                    <div>
                      <h3>Simran, 24</h3>
                      <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>

                      <div class="list_btm">
                        <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt="">165 cm</p>
                        <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                      </div>
                    </div>


                  </div>
                  <div class="like_heart">
                    <div class="heart_icon"></div>
                  </div>
                </div>
              </li>
              <li>
                <div class="card">
                  <div class="img_card">
                    <img src="{{URL::to('/public/website')}}/img/sugg2.png" alt="">
                  </div>
                  <div class="cont_bx">
                    <div>
                      <h3>Simran, 24</h3>
                      <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>

                      <div class="list_btm">
                        <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt="">165 cm</p>
                        <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                      </div>
                    </div>
                  </div>
                  <div class="like_heart">
                    <div class="heart_icon"></div>
                  </div>
                </div>
              </li>
              <li>
                <div class="card">
                  <div class="img_card">
                    <img src="{{URL::to('/public/website')}}/img/sugg3.png" alt="">
                  </div>
                  <div class="cont_bx">
                    <div>
                      <h3>Simran, 24</h3>
                      <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>
                      <div class="list_btm">
                        <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt="">165 cm</p>
                        <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                      </div>
                    </div>


                  </div>
                  <div class="like_heart">
                    <div class="heart_icon"></div>
                  </div>
                </div>
              </li>
              <li>
                <div class="card">
                  <div class="img_card">
                    <img src="{{URL::to('/public/website')}}/img/sugg4.png" alt="">
                  </div>
                  <div class="cont_bx">
                    <div>
                      <h3>Simran, 24</h3>
                      <h4><img src="{{URL::to('/public/website')}}/img/feather-clock.png" alt=""> Active Yesteerday</h4>
                      <div class="list_btm">
                        <p><img src="{{URL::to('/public/website')}}/img/surface1.png" alt="">165 cm</p>
                        <p><img src="{{URL::to('/public/website')}}/img/feather-instagram.png" alt=""> 2251</p>
                      </div>
                    </div>


                  </div>
                  <div class="like_heart">
                    <div class="heart_icon"></div>
                  </div>

                </div>
              </li>

            </ul>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="Subscribe_sect">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <p>Want To Hear More Story, Subscribe For Our Newsletter</p>
          <button class="btn">Subscribe</button>

        </div>

      </div>
    </div> 
  </section>
  <div class="modal fade modat_dft" id="edit_profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">My Self Summary</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
        </div>
        <div class="modal-body">
          <div class="prof_edit">
           <form id="edit_my_self" action="javascript:void(0);" method="post"  autocomplete="off">
            <div class="row">
              <div class="col-lg-4 col-sm-12 col-sm-12">
			  <input type="hidden" name="user_id" id="user_id" value="<?php echo !empty($userInfo[0]->id)? $userInfo[0]->id:""; ?>">
				     
                <div class="frm_itm icon_select">
                  <label for="">Gender</label>
                  <select name="gender" id="gender" class="form-control">
				     <option value="">Select Gender</option>    
                    <option <?php echo ($userInfo[0]->gender == 'Male')?"selected":"" ?>>Male</option>
                    <option <?php echo ($userInfo[0]->gender == 'Female')?"selected":"" ?>>Female</option>
                  </select> 
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/feather-users.svg" alt="">
                  </span>
				  <span id="error_gender" class="err"></span>  
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Education</label>
                  <input type="text" name="education" id="education" value="<?php echo !empty($userInfo[0]->education)? $userInfo[0]->education:""; ?>" class="form-control" placeholder="Education">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/book-reader.svg" alt="">
                  </span>
				  <span id="error_education" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Know</label>
                  <input type="text" name="know" id="know" value="<?php echo !empty($userInfo[0]->know)? $userInfo[0]->know:""; ?>" class="form-control" placeholder="Know">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/location-on.svg" alt="">
                  </span>
				  <span id="error_know" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm ">
                  <label for="">Country </label>
                  <input type="text" name="country" id="country" value="<?php echo !empty($userInfo[0]->country)? $userInfo[0]->country:""; ?>" class="form-control" placeholder="Country">
				  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/location-on.svg" alt="">
                  </span>
				  <span id="error_country" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">City</label>
                  <input type="text"  name="city" id="city" value="<?php echo !empty($userInfo[0]->city)? $userInfo[0]->city:""; ?>"  class="form-control" placeholder="City">
				  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/location-on.svg" alt="">  
                  </span>
				  <span id="error_city" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Birthday</label>
                  <input type="date" name="dob" id="dob" value="<?php echo !empty($userInfo[0]->dob)? $userInfo[0]->dob:""; ?>" class="form-control" placeholder="Birthday">
                  <span class="icon">  
                    <img src="{{URL::to('/public/website')}}/img/calendar.svg" alt="">
                  </span>
				  <span id="error_birthday" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Interests</label>
                  <input type="text" name="interests" id="interests" value="<?php echo !empty($userInfo[0]->interests)? $userInfo[0]->interests:""; ?>" class="form-control" placeholder="Interests"> 
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/heart.svg" alt="">
                  </span>
				  <span id="error_interests" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Relationship</label>
                  <input type="text" name="relationship" id="relationship" value="<?php echo !empty($userInfo[0]->relationship)? $userInfo[0]->relationship:""; ?>" class="form-control" placeholder="Relationship">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/user-friends.svg" alt="">
                  </span>
				  <span id="error_relationship" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Height</label>
                  <input type="text" name="height" id="height" value="<?php echo !empty($userInfo[0]->height)? $userInfo[0]->height:""; ?>" class="form-control" placeholder="Height">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/resize-height.svg" alt="">  
                  </span>
				  <span id="error_height" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Weight</label>
                  <input type="text" name="weight" id="weight" value="<?php echo !empty($userInfo[0]->weight)? $userInfo[0]->weight:""; ?>" class="form-control" placeholder="Weight">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/weight.svg" alt="">
                  </span>
				  <span id="error_weight" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm icon_select">
                  <label for="">Smoking</label>
                  <select name="smoking" id="smoking"  class="form-control">
                    <option value="">Select Somking</option>
					<option <?php echo ($userInfo[0]->smoking == 'Yes')?"selected":"" ?>>Yes</option>
                    <option <?php echo ($userInfo[0]->smoking == 'No')?"selected":"" ?>>No</option>
                  </select>
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/smoking.svg" alt="">
                  </span>
				  <span id="error_smoking" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Eye Color</label>
                  <input type="text" name="eye_color" id="eye_color" value="<?php echo !empty($userInfo[0]->eye_color)? $userInfo[0]->eye_color:""; ?>" class="form-control" placeholder="Eye Color">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/weight.svg" alt="">
                  </span>
				  <span id="error_eye_color" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm icon_select">
                  <label for="">Marital Status</label>
                  <select name="marital_status" id="marital_status"  placeholder="Marital Status" class="form-control">
                   <option value="">Select Marital Status</option>
					<option <?php echo ($userInfo[0]->marital_status == 'Single')?"selected":"" ?>>Single</option>
                    <option <?php echo ($userInfo[0]->marital_status == 'Married')?"selected":"" ?>>Married</option>  
                  </select>
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/weight.svg" alt="">
                  </span>
				  <span id="error_marital_status" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm icon_select">
                  <label for="">Looking Man For A</label>
                  <input type="text" name="looking_man_or_a" id="looking_man_or_a" value="<?php echo !empty($userInfo[0]->looking_man_for)? $userInfo[0]->looking_man_for:""; ?>" class="form-control" placeholder="Woman">
                  <span class="icon">
                    <img src="{{URL::to('/public/website')}}/img/user-alt.svg" alt="">
                  </span>
				  <span id="error_looking_for_man" class="err"></span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Work as</label>      
                  <input type="text" name="work_as" id="work_as" value="<?php echo !empty($userInfo[0]->work_as)? $userInfo[0]->work_as:""; ?>" class="form-control" placeholder="Work as">
                  <span class="icon">    
                    <img src="{{URL::to('/public/website')}}/img/work.svg" alt="">
                  </span>
				  <span id="error_work_as" class="err"></span>
                </div>
              </div>
           
              <div class="col-lg-12 col-sm-12 col-sm-12">
                <div class="text-center">
                  <button class="btn" Onclick="update_profiless()">Save</button>    
                </div>
              </div>


            </div>
           </form>


          </div>
          
        </div>
       
      </div>
    </div>
  </div>
<div class="modal fade modat_dft" id="edit_profile_des" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">My Self Descrption</h5>   
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
        </div>
        <div class="modal-body">
          <div class="prof_edit">
           <form id="edit_my_self_des" action="javascript:void(0);" method="post"  autocomplete="off">
            <div class="row">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo !empty($userInfo[0]->id)? $userInfo[0]->id:""; ?>">
			
              <div class="col-lg-12 col-sm-12 col-sm-12">
                <div class="frm_itm">
                  <label for="">Descrption</label>
                  <textarea id="self_des" name="self_des" rows="30" cols="4" class="ckeditor"><?php echo !empty($userInfo[0]->self_des)? $userInfo[0]->self_des:""; ?></textarea> 
				  <span id="error_self_des" class="err"></span>  
                </div>   
              </div>
             
              <div class="col-lg-12 col-sm-12 col-sm-12">
                <div class="text-center">
                  <button class="btn" href="javascript:void(0);" Onclick="update_self_des()">Save</button>    
                </div>
              </div>


            </div>
           </form>


          </div>
          
        </div>
       
      </div>
    </div>
  </div> 
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
        $('.ckeditor').ckeditor();  
       
    </script>  
  <script>
  
  $(document).ready(function(){
  $('#BannerUpload').on('change', function(){
    var formData = new FormData($('#banner_image_form')[0]);
 
	ajaxCsrf(); 
    $.ajax({
      url:baseUrl+'/banner_upload',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType:'json',
      success:function(res) 
            {    			
             if(res.status==1){
              location.reload();     			  
			  //window.location = baseUrl + '/user/index#index';  
            }else{
               statusMesage('something went wrong','error');
            }  
            }
    });
  });


$('#myfile').on('change', function(){
    var formData = new FormData($('#my_profile_pic')[0]);
 
	ajaxCsrf(); 
    $.ajax({
      url:baseUrl+'/profile_image_upload',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType:'json',
      success:function(res) 
            {    			
             if(res.status==1){
              window.location.reload(true);   
    			  
			  //window.location = baseUrl + '/user/index#index';  
            }else{
               statusMesage('something went wrong','error');
            }  
            }
    });
  });


});




  function update_self_des(){  
	   
		var self_des = $('#self_des').val(); 
        //alert(self_des);  		
        $('.err').html('');
        if(self_des==''){
            $('#error_self_des').html('Please select self descrption') ;    
        }else{
               var formData = $('#edit_my_self_des').serialize();		   
                 ajaxCsrf();
        $.ajax({
            type:"POST",
            url:baseUrl+'/update_descrption',
            data:formData,
            dataType:'json',    			
            beforeSend:function()
            {
                 //ajax_before();
            },
            success:function(res) 
            {  
                //ajax_success() ; 
              	//alert(res.status);  			
             if(res.status==1){
              $("#edit_profile_des").modal('hide'); 
              //window.location.reload(); 
              location.reload();   			  
			  window.location = baseUrl + '/user/index#index';  
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          }
    }
  function update_profiless(){
	   
		var gender = $('#gender').val();   		
		var education = $('#education').val();
		var know = $('#know').val();
		var country = $('#country').val();
		var city = $('#city').val();
		var dob = $('#dob').val();
		var interests = $('#interests').val();
		var relationship = $('#relationship').val();
		var height = $('#height').val();
		var weight = $('#weight').val();
		var smoking = $('#smoking').val();
		var eye_color = $('#eye_color').val();
		var marital_status = $('#marital_status').val();
		var looking_man_or_a = $('#looking_man_or_a').val();
		var work_as = $('#work_as').val();
	 
        $('.err').html('');
        if(gender==''){
            $('#error_gender').html('Please select gender') ;  
        }else if (education=='') { 
         $('#error_education').html('Please enter education') ;
        }else if (know=='') { 
         $('#error_know').html('Please enter know') ;  
        }else if(country== ''){
            $('#error_country').html('Please enter country');
        }else if(city== ''){
            $('#error_city').html('Please enter city');
        }else if(dob== ''){
            $('#error_birthday').html('Please select birthday');   
        }else if(interests== ''){
            $('#error_interests').html('Please enter interests');
        }else if(relationship== ''){
            $('#error_relationship').html('Please enter relationship');
        }else if(height== ''){
            $('#error_height').html('Please enter height');
        }else if(weight== ''){
            $('#error_weight').html('Please enter weight');
        }else if(smoking== ''){
            $('#error_smoking').html('Please select smoking');
        }else if(eye_color== ''){
            $('#error_eye_color').html('Please select eye color');
        }else if(marital_status== ''){
            $('#error_marital_status').html('Please select marital status');
        }else if(looking_man_or_a== ''){
            $('#error_looking_for_man').html('Please enter looking man for a');
        }else if(work_as== ''){
            $('#error_work_as').html('Please enter work as');
        }else{
               var formData = $('#edit_my_self').serialize();		   
                 ajaxCsrf();
        $.ajax({
            type:"POST",
            url:baseUrl+'/update_profile',
            data:formData,
            dataType:'json',    			
            beforeSend:function()
            {
                 //ajax_before();
            },
            success:function(res) 
            {  
                //ajax_success() ; 
              	//alert(res.status);  			
             if(res.status==1){
              $("#edit_profile").modal('hide'); 
                location.reload();		  	  
			  window.location = baseUrl + '/user/index#index';  
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
          }
    }
  
  
  </script>
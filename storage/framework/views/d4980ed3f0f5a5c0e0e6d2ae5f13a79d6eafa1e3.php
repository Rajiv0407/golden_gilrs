<div class="sell_box">
  <div class="head">
    <h3>Menu</h3>
  </div>
  <?php $data=session()->get('user_session');   ?>
  <?php $user_id=request()->segment(2); ?>
  <?php if(request()->segment(1) != 'goodiesDetails' && request()->segment(1) != 'eventDetails'){ ?>
  <?php if(!empty(request()->segment(2))){  $user_id=request()->segment(2); ?>
  <?php }else{ $user_id=$data['userId']; ?>
  <?php } ?>
  <?php }else{ ?>
  <?php $user_id=$data['userId']; ?>
  <?php } ?>
  <div class="memu_inner">
    <div class="menu_inner_list user_profile_menu">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <!-- <a class="dropdown-item" href="<?php echo e(URL::to('/')); ?>/profile/</?php echo $user_id;  ?>"></a> -->
          <a class="dropdown-item" href="<?php echo e(URL::to('/')); ?>/profile/<?php echo $user_id;  ?>">
          <button class="nav-link <?php if (request()->segment(1) == 'profile'  ) { echo 'active';} ?>" id="profile_tab_id">
              <span class="nk-menu-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="14.627" height="14.627" viewBox="0 0 14.627 14.627">
                  <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt"
                    d="M7.313,8.228A4.114,4.114,0,1,0,3.2,4.114,4.115,4.115,0,0,0,7.313,8.228Zm3.657.914H9.4a4.973,4.973,0,0,1-4.165,0H3.657A3.656,3.656,0,0,0,0,12.8v.457a1.372,1.372,0,0,0,1.371,1.371H13.256a1.372,1.372,0,0,0,1.371-1.371V12.8A3.656,3.656,0,0,0,10.97,9.142Z"
                    fill="#d7792d" />
                </svg>
              </span>
              <span class="nk-menu-text">
                <h3>Profile</h3>
              </span>
          </button>
        </a>
        </li>
<?php if($user_id == $data["userId"]){ ?>
        <li class="nav-item" role="presentation">
           <a class="dropdown-item" href="<?php echo e(URL::to('/')); ?>/marches_info/<?php echo $data['userId'];  ?>" >
            <!-- onclick="marches_tab(<?php //echo $user_id; ?>)" -->
          <button class="nav-link <?php if (request()->segment(1) == 'marches_info'  ) { echo 'active';} ?>"   id="marches_tab_idsss">
            <span class="nk-menu-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="14.627" height="14.627" viewBox="0 0 14.627 14.627">
                <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt"
                  d="M7.313,8.228A4.114,4.114,0,1,0,3.2,4.114,4.115,4.115,0,0,0,7.313,8.228Zm3.657.914H9.4a4.973,4.973,0,0,1-4.165,0H3.657A3.656,3.656,0,0,0,0,12.8v.457a1.372,1.372,0,0,0,1.371,1.371H13.256a1.372,1.372,0,0,0,1.371-1.371V12.8A3.656,3.656,0,0,0,10.97,9.142Z"
                  fill="#d7792d" />
              </svg>
            </span>
            <span class="nk-menu-text">
              <h3>Matches</h3>  
            </span>
          </button>
        </a>
        </li>
      <?php } ?>
        <li class="nav-item" role="presentation">
          <!-- <a class="dropdown-item" href="<?php echo e(URL::to('/')); ?>/network/</?php echo $user_id;  ?>"></a> -->
          <?php 

          if($user_id==$data['userId']){
            $networkUrl=URL::to('/').'/network/'.$user_id ;
          }else{
            $networkUrl=URL::to('/').'/following_page/'.$user_id ;
          } 
        
         
          ?>

         
          <a class="dropdown-item" href="<?php echo $networkUrl ; ?>">
            <button class="nav-link <?php if (request()->segment(1) == 'network' || request()->segment(1) == 'following_page' ) { echo 'active';} ?>"
              id="network_tab_id">
              <span class="nk-menu-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.896" height="14.627" viewBox="0 0 20.896 14.627">
                  <path id="Icon_awesome-user-friends" data-name="Icon awesome-user-friends"
                    d="M6.269,9.563A3.657,3.657,0,1,0,2.612,5.907,3.655,3.655,0,0,0,6.269,9.563Zm2.507,1.045H8.505a5.049,5.049,0,0,1-4.473,0H3.761A3.762,3.762,0,0,0,0,14.369v.94a1.568,1.568,0,0,0,1.567,1.567h9.4a1.568,1.568,0,0,0,1.567-1.567v-.94A3.762,3.762,0,0,0,8.776,10.608Zm6.9-1.045a3.134,3.134,0,1,0-3.134-3.134A3.135,3.135,0,0,0,15.672,9.563Zm1.567,1.045h-.124a4.117,4.117,0,0,1-2.886,0H14.1a3.626,3.626,0,0,0-1.819.5,4.778,4.778,0,0,1,1.3,3.258v1.254c0,.072-.016.14-.02.209h5.766A1.568,1.568,0,0,0,20.9,14.265a3.655,3.655,0,0,0-3.657-3.657Z"
                    transform="translate(0 -2.25)" fill="#d7792d" />
                </svg>
              </span>
              <span class="nk-menu-text">
                <h3>Network</h3>
              </span>
            </button>
            </a>
        </li>
        <?php if($user_id == $data["userId"]){ ?>
         <!-- onclick="my_event_tab(<?php //echo $user_id; ?>);" -->
        <li class="nav-item" role="presentation">
           <a class="dropdown-item" href="<?php echo e(URL::to('/')); ?>/myevent_info/<?php echo $data['userId'];  ?>"  >
          <button class="nav-link <?php if (request()->segment(1) == 'myevent_info'  ) { echo 'active';} ?>" id="my_event_tab_id">
            <span class="nk-menu-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="16.149" height="16.87" viewBox="0 0 16.149 16.87">
                <path id="Icon_awesome-cog" data-name="Icon awesome-cog"
                  d="M17.254,11.031l-1.449-.837a6.551,6.551,0,0,0,0-2.388l1.449-.837a.411.411,0,0,0,.187-.476,8.471,8.471,0,0,0-1.86-3.217.409.409,0,0,0-.5-.078l-1.449.837A6.419,6.419,0,0,0,11.56,2.841V1.171a.407.407,0,0,0-.32-.4,8.55,8.55,0,0,0-3.714,0,.407.407,0,0,0-.32.4V2.845A6.621,6.621,0,0,0,5.139,4.039L3.694,3.2a.4.4,0,0,0-.5.078A8.42,8.42,0,0,0,1.33,6.5a.407.407,0,0,0,.187.476l1.449.837a6.551,6.551,0,0,0,0,2.388l-1.449.837a.411.411,0,0,0-.187.476,8.471,8.471,0,0,0,1.86,3.217.409.409,0,0,0,.5.078l1.449-.837A6.419,6.419,0,0,0,7.21,15.164v1.673a.407.407,0,0,0,.32.4,8.55,8.55,0,0,0,3.714,0,.407.407,0,0,0,.32-.4V15.164a6.621,6.621,0,0,0,2.068-1.194l1.449.837a.4.4,0,0,0,.5-.078,8.42,8.42,0,0,0,1.86-3.217.42.42,0,0,0-.19-.48Zm-7.87.69A2.721,2.721,0,1,1,12.1,9,2.725,2.725,0,0,1,9.384,11.722Z"
                  transform="translate(-1.311 -0.569)" fill="#d7792d" />
              </svg>
            </span>
            <span class="nk-menu-text">
              <h3>My Event </h3>
            </span>
          </button>
        </a>
        </li>

		 <?php } ?>
      </ul>
    </div>
  </div>
</div><?php /**PATH D:\xampp\htdocs\golden\resources\views/website/profile_left_bar.blade.php ENDPATH**/ ?>
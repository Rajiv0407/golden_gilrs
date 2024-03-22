<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="cover_pic" >
    <form id="banner_image_form">
      <div class="cover_img">
        <?php //echo "<pre>";print_r($users);die;  ?>
        <img src="<?php echo $users['banner_image'] ?>" alt="">
      </div>
      <div class="Banner_edit ">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo !empty($users['id'])? $users['id']:""; ?>">
        <input type="file" class="BannerUpload" name="BannerUpload" id="BannerUpload" accept=".png, .jpg, .jpeg">
        <label for="BannerUpload">
          <i class="fa fa-camera"></i> Change Cover
        </label>
      </div>
    </form>
    <div class="cover_cont">
      <div class="user_avtar">
        <form id="my_profile_pic">
          <img src="<?php echo $users['image'] ?>" alt="">
          <div class="profile_edit ">
            <input type="hidden" name="user_id" id="user_id"
              value="<?php echo !empty($users['id'])? $users['id']:""; ?>">
            <input type="file" class="myfile" name="myfile" id="myfile" accept=".png, .jpg, .jpeg">
            <label for="myfile">
              <i class="fa fa-pencil"></i>
            </label>
          </div>
        </form>
      </div>
      <div class="prof_cont">
        <h3>
          <?php echo $users['first_name'].' '.$users['last_name'];  ?><img
            src="{{URL::to('/public/website')}}/images/star.svg" alt="">
        </h3>
        <?php if(!empty($users['city'] && $users['country'])){ ?>
        <div class="prof_location"><img src="{{URL::to('/public/website')}}/images/map-marker-alt.svg" alt="">
          <ul>
            <li>
              <?php echo !empty($users['city'])?$users['city']:"" ?>
            </li>
            <li>
              <?php echo !empty($users['country'])?$users['country']:""; ?>
            </li>
          </ul>
        </div>
        <!-- <p><//?php echo $users['self_des'];  ?></p>   -->
        <?php } ?>
      </div>

    </div>
  </div>
</div>
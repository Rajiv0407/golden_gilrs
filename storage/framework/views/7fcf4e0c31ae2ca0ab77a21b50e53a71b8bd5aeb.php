<?php $data=session()->get('user_session');   //echo "<pre>";print_r($data); die;  ?>


<div class="story_follow_box">
  <div class="head">
    <h3>Stories</h3>
  </div>
  <div class="stories_sect">
    <div class="list_stories">
      <div class="urstory active">
        <form id="add_stories" class="<?php echo (isset($storiesType) && $storiesType!=1)?'active':'' ; ?>">
          <div class="add_status">
            <div class="inner_bx">
            <div class="media_stories">
           <?php $u_image="<?php echo URL('/') ; ?>/storage/app/public/user_image/user_holder.svg"; ?>
            <?php /*if($data['image'] == $u_image ) {?>
            <img src="{{URL::to('/public/website')}}/images/no_record/story_default.png" alt="">
            <?php }else{ ?>
            <img src="<?php echo $data['image']; ?>" alt="">
            <?php } */ ?>
            <?php if(isset($selfStoryImg) && $selfStoryImg!='' && $storiesType=='image'){ ?>
              <img src="<?php echo $selfStoryImg; ?>" alt="">
            <?php }else if(isset($selfStoryImg) && $selfStoryImg!='' && $storiesType=='video'){ ?>
                  <video class="media_video" controls>
                            <source src="<?php echo $selfStoryImg; ?>" type="video/mp4">
                          </video>
            <?php }else{  ?>
              <img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/story_default.png" alt="">
            <?php } ?>
           </div>
            <?php if($story_count > 0){  ?>			
            <button type="button" class="stryvewbtn" data-bs-toggle="modal" data-bs-target="#viewstory" onclick="view_stroy_model(<?php echo $data['userId']; ?>);"></button>
			<?php } ?>  
            </div>
       
            <div class="addnewstry">
              <button type="button" data-bs-toggle="modal" data-bs-target="#addstory1" class="lbl_btn" onclick="stories_popup();"><i class="ri-add-fill"></i></button>
              <h3>Create Story</h3>
            </div>
          </div>  
        </form> 
      </div>
      <div id="storyslide" class="slidersrty">
	    <?php 


      if(!empty($stories_info) && request()->segment(1) == 'home'){ ?>
        <?php foreach($stories_info as $stories_infos){ 


          ?>
        <div class="item item_info">
          <div class="gallary_img" id="story_uploaded_ids_<?php echo $stories_infos->id;  ?>">
          <div class="inner_bx">
            <div class="media_stories">
            <?php if($stories_infos->file_type=='video'){ ?>
              <video class="media_video" controls>
                            <source src="<?php echo $stories_infos->image; ?>" type="video/mp4">
                          </video>
            <?php } else { ?>
              <img src="<?php echo $stories_infos->image;  ?>" alt="">
            <?php } ?>
          
            
          </div>
          </div>
            <div class="cont_stories">
              <?php echo $stories_infos->name;  ?>
            </div>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#viewstory" onclick="view_stroy_model(<?php echo $stories_infos->id; ?>);"></button>
          </div>
        </div>
        <?php } ?>
		<?php } ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade add_story_modal" id="addstory1" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Story</h5>  
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body" id="add_stories_popup_model"> 
                </div>
            </div>
        </div>
    </div>
	
 <div class="modal fade small_modal viewstory_modal" id="viewstory" tabindex="-1" role="dialog"
  aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" >
        <div class="viewstory_wrapp">
        <button type="button" class="close" data-bs-dismiss="modal"  onclick="stopvideo()" aria-bs-label="Close">
			<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
	  	</button>
       
        <div id="view_story_model_data_info">

        </div>
        </div>

      
  
      </div>
    </div>
  </div>  
</div>   
<!--  -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#storyslide').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
      }); 
  })
function stopvideo(){
  $('video').trigger('pause');
}

</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/rightmenu/stories.blade.php ENDPATH**/ ?>
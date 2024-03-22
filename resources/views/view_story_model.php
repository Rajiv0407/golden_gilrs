<?php $data=session()->get('user_session');  ?>
<div class="oursdrb">
  <div class="pv_slider story_slk">
    <div id="pv_slider2" class="slider_slk">
      <?php foreach($story as $storys){ ?>
      <div class="item" id="story_image_<?php echo $storys['id']; ?>">
        <div class="sldigi">
          <?php if(isset($storys['file_type']) && $storys['file_type']=='video'){ ?>

          <video class="media_video"  data-id="<?php echo $storys['id']; ?>" controls>
            <source src="<?php echo $storys['file'].'#t=0.1'; ?>" type="video/mp4">
          </video>

          <?php }else{ ?>
          <img src="<?php echo $storys['file']; ?>" data-id="<?php echo $storys['id']; ?>" alt="">
          <?php } ?>

          <?php if($storys['session_id'] == $storys['story_user_id']){ ?>

          <button type="button" class="btn" onclick="delete_story_image(<?php echo $storys['id']; ?>);"><i
              class="ri-delete-bin-line"></i></button>

          <?php } ?>
         
         
        </div>
         <?php if($storys['session_id'] == $storys['story_user_id']){ ?>
          <div class="stry_lk">
          <div class="slbx">
          <button type="button" class="btn" onclick="story_like_model(<?php echo $storys['id']; ?>)">
          <i class="ri-eye-fill"></i>
          View (<?php echo $storys['viewSotry'] ; ?>)
          </button>
          </div>
          </div>
         <?php } ?>
        
          <?php if($storys['session_id'] != $storys['story_user_id']){ 

            ?>
          <div class="stry_like">
        <div class="sl_frm">
          <div class="form-group">
            <input type="hidden" name="sotry_id_<?php echo $storys['id']; ?>" id="sotry_id_<?php echo $storys['id']; ?>"  value="<?php echo $storys['id']; ?>">
            <input type="text" class="form-control" id="story_comment_<?php echo $storys['id']; ?>" value="" placeholder="Enter Comment" onkeypress="return storyComment(event,<?php echo $storys['id']; ?>)" >
            
          </div>
            <div class="form-button">
            <button type="button" class="btn">
            <i class="ri-heart-line" id="st_like_<?php echo $storys['id']; ?>" onclick="story_like(1,<?php echo $storys['id']; ?>,<?php echo $storys['is_like'] ; ?>)" <?php if($storys['is_like']==1){ ?> style="display:none;" <?php } ?>></i>
            <i class="ri-heart-fill" id="st_unlike_<?php echo $storys['id']; ?>"  onclick="story_like(0,<?php echo $storys['id']; ?>,<?php echo $storys['is_like'] ; ?>)" <?php if($storys['is_like']==0){ ?> style="display:none;" <?php } ?> ></i>
            </button> 
          </div></div></div>
        <?php } ?>
          
      </div>
      
      <?php } ?>
    </div>
  
<!-- 
    <div class="stry_lk">
      <div class="slbx">
        <button type="button" class="btn">
          <i class="ri-eye-fill"></i>
          View (5)
        </button>
      </div>
    </div> -->

    <!-- <form action="javascript:void(0);">
      <div class="stry_like">
        <div class="sl_frm">
          
          <div class="form-group">
            <input type="text" class="form-control" id="story_comment" placeholder="Enter Comment">
            <a href=""></a>
          </div>
         
          <div class="form-button">
            <button type="button" class="btn">
            <i class="ri-heart-line" id="st_like" onclick="story_like(1)"></i>
            <i class="ri-heart-fill" id="st_unlike" style="display:none;" onclick="story_like(0)"></i>
            </button> 
          </div>
        </div>
      </div>
      </form> -->
      
   

  </div>
</div>
<script>

function story_like(type,storyId,storyView=0){

  if(type==1){
    $('#st_like_'+storyId).css('display','none');
    $('#st_unlike_'+storyId).css('display','block');
    saveStoryLike(type,storyId,storyView);
  }else {
    $('#st_like_'+storyId).css('display','block');
    $('#st_unlike_'+storyId).css('display','none');
    saveStoryLike(type,storyId,storyView)
  }

}

function saveStoryLike(type,storyId,storyView){

    $('#loader_spineer').show(); 
        ajaxCsrf();
    $.ajax({
        type: "post",    
        url: baseUrl + '/story_like',
        data:{"type":type,"storyId":storyId,"storyView":storyView},
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();
                },
        success: function (html) {
         $('#story_comment_'+storyId).val('');
            $('#loader_spineer').hide();            
        }
    });
}

function storyComment(e,storyId){
    var storyComment=$('#story_comment_'+storyId).val();
  if (e.which == 13 && storyComment!='') { 
     $('#loader_spineer').show(); 
        ajaxCsrf();
    $.ajax({
        type: "post",    
        url: baseUrl + '/story_comment',
        data:{"storyComment":storyComment,"storyId":storyId},
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();
                },
        success: function (html) {
         $('#story_comment_'+storyId).val('');
            $('#loader_spineer').hide();            
        }
    });
      
  }
}



  $(document).ready(function () {

    setTimeout(function () {
     
      $('#pv_slider2').slick({
        infinite: false,
        speed: 100,
        fade: true,
        cssEase: 'linear'
      });

      var storyDisabled=0 ;
        $('.slick-next').click(function(e){
        $('video').trigger('pause');
        var viewStoryVideoId=$('.slick-active > .sldigi video').attr('data-id');
        var viewStoryImgId=$('.slick-active > .sldigi img').attr('data-id');
        var className=$('.slick-next').attr('class');
        const nextClass = className.split(" ");
       
        //&& nextClass[2]!=='slick-disabled'
        if(nextClass[2]!=='slick-disabled'){ storyDisabled=0 ;}

        if(viewStoryImgId==undefined  && storyDisabled!=1){          
          saveStoryLike(0,viewStoryVideoId,1);
           if(nextClass[2]=='slick-disabled'){ storyDisabled=1 ;}
        }else if(viewStoryVideoId==undefined && storyDisabled!=1){          
           saveStoryLike(0,viewStoryImgId,1);
            if(nextClass[2]=='slick-disabled'){ storyDisabled=1 ;}
        }
       
        // 
        });

        $('.slick-prev').click(function(e){
        $('video').trigger('pause');
        });
              
    }, 20);

  });



</script>
<!--  -->
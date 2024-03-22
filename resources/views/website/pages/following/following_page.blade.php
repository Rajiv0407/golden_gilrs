@extends('includes.website.ajax_template')
@section('content')

<?php $data=session()->get('user_session');   ?>
<script type="text/javascript">
  $(document).ready(function(){
     $('#loader_spineer').show(); 
  });
 
</script>
<div id="following" class="sell_box">
    <div class="head">
        <h3>Network</h3>
    </div>

    <div class="myntwrkbx">
        <div class="f_head">
            <h3>
                <?php 
              
                        /**/
                echo isset($users['name'])?$users['name']:'' ; ?> Network’s
            </h3>
        </div>
        <div class="f_menu">
            <ul class="menu_tb">
                <li class=""><button id="following_tab"  type="button" class="btn active">Following</button></li>
                <li><button type="button" id="follow_tab"  class="btn">Followers</button></li>
            </ul>
            <h4 id="following_hide" >You are following
                <?php echo  count($following); ?> people out of your network
            </h4>
			<h4 id="followers_hide" style="display:none">You are followers 
                <span id="follower_count"><?php echo  count($followers); ?></span> people out of your network
            </h4>
        </div>

        <div class="f_card" id="followers_list_data" style="display:none">
            <?php foreach($followers as $follow){ //echo   "<pre>";print_r($follow);die;   ?>
            <div class="fcrd_rptr" id="followerDiv_<?php echo $follow->id ;?>">
                <div class="fpbx">
                     <a href="{{URL::to('/')}}/profile/<?php echo $follow->id  ?>">
                    <div class="media"><img src="<?php echo $follow->image ;  ?>" alt=""></div>
                </a>
                    <div class="data">
                        <a href="{{URL::to('/')}}/profile/<?php echo $follow->id ;  ?>">
                            <h3>
                                <?php echo $follow->name ;  ?>
                            </h3>
                        </a>
                        <?php if(!empty($follow->city) && $follow->country){ ?>
                        <h5><i class="fa fa-map-marker"></i>
                            <?php echo $follow->city ;  ?>,
                            <?php echo $follow->country ;  ?>
                        </h5>
                        <?php } ?>
                        <?php if(!empty($follow->mutual_friend)){ ?>
                        <p><?php echo $follow->mutual_friend; ?> mutual network</p>
						<?php }  ?>
                    </div>
                    <div class="button-group">
                            <?php if($users['id']==$data['userId']){ ?>

                        <?php if($follow->followBack==0){ ?> 
                            <button type="button" class="btn" style="margin-top: 10px;" id="backfollow_<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'backfollow')"> Follow Back</button>

                            <button type="button" id="pending_<?php echo $follow->id ; ?>" class="btn pndng" style="display: none;" onclick="followBack(<?php echo $follow->id ; ?>,'pending')"><i class="ri-time-line"></i>Pending</button>

                            
                            
                            <button type="button" style="margin-top: 10px;" id="remove_<?php echo $follow->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $follow->id ; ?>,'remove')">Remove</button>
                            

                        <?php }else if($follow->followBack==1){ ?> 
                            <button type="button" id="pending_<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'pending')" class="btn pndng"><i class="ri-time-line"></i>Pending</button>
                             
                              

                             <button type="button" id="backfollow_<?php echo $follow->id ; ?>" style="display: none;" class="btn" onclick="followBack(<?php echo $follow->id ; ?>,'backfollow')">Follow Back</button>

                             <button type="button" style="margin-top: 10px;" id="remove_<?php echo $follow->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $follow->id ; ?>,'remove')">Remove</button>

                        <?php } else if($follow->followBack==2){ ?>
                            
                              
                            <button type="button" style="display: none;" id="pending_<?php echo $follow->id ; ?>" class="btn pndng" style="display: none;" onclick="followBack(<?php echo $follow->id ; ?>,'pending')"><i class="ri-time-line"></i>Pending</button>

                             <button type="button" id="remove_<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'remove')"  class="btn pndng">Remove</button>
                        <?php } ?>
<?php }else{ ?>
   
<?php if($follow->isFollow=="" && $follow->id!=$data['userId']){ ?>
  
       <button type="button" id="follow__<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'follow__')"  class="btn">Follow</button> 
     <button type="button"  style="display: none;" id="pending__<?php echo $follow->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $follow->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>

<?php }else if($follow->isFollow==1 && $follow->id!=$data['userId']){ ?> 

     <button type="button" id="unfollow__<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'unfollow__')"  class="btn">Unfollow </button>
      <button type="button" style="display: none;" id="follow__<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'follow__')"  class="btn">Follow</button> 
     <button type="button"  style="display: none;" id="pending__<?php echo $follow->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $follow->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>
<?php }else if($follow->isFollow==0 && $follow->id!=$data['userId']){ ?>
     <button type="button"  id="pending__<?php echo $follow->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $follow->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>
       <button type="button" style="display: none;" id="follow__<?php echo $follow->id ; ?>" onclick="followBack(<?php echo $follow->id ; ?>,'follow__')"  class="btn">Follow</button>

<?php } ?>

                            <?php  } ?>
                    </div>
                     
                </div>
            </div>
            <?php } ?>
        </div>


        <div class="f_card" id="following_list_data" >
            <?php 
        //    $followerData=count($following);
        //    <?php echo ($followerData < 3)?'fstbxf':'' ; ?/>
        
            foreach($following as $followings){ //echo "<pre>";print_r($follow);die;   ?>
            <div class="fcrd_rptr" >
                <div class="fpbx">
                     <a href="{{URL::to('/')}}/profile/<?php echo $followings->id  ?>">
                    <div class="media"><img src="<?php echo $followings->image  ?>" alt=""></div>
                </a>
                    <div class="data">
                        <a href="{{URL::to('/')}}/profile/<?php echo $followings->id  ?>">
                            <h3>
                                <?php echo $followings->name  ?>
                            </h3>
                        </a>
                        <?php if(!empty($followings->city) && $followings->country){ ?>
                        <h5><i class="fa fa-map-marker"></i>
                            <?php echo $followings->city ;  ?>,
                            <?php echo $followings->country ;  ?>
                        </h5>
                        <?php } ?>
						<?php if($followings->mutual_friend!=''){ ?>
                        <p><?php echo $followings->mutual_friend ; ?> mutual network</p>
						<?php }  ?>
                    </div>
                    <div class="button-group">
                     <?php if($users['id']==$data['userId']){ ?>
                       
  <button type="button" style="display: none;" id="1follow__<?php echo $followings->id ; ?>" onclick="followBack(<?php echo $followings->id ; ?>,'follow__')"  class="btn">Follow </button> 
  <button type="button"  style="display: none;" id="1pending__<?php echo $followings->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $followings->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>
  <button type="button" id="1unfollow__<?php echo $followings->id ; ?>" onclick="followBack(<?php echo $followings->id ; ?>,'unfollow__')"  class="btn">Following </button>

                   
                  <?php } else if($followings->id!=$data['userId']){ ?>
                       
 <?php if($followings->isFollow=="" && $followings->id!=$data['userId']){ ?>

<button type="button" id="1follow__<?php echo $followings->id ; ?>" onclick="followBack(<?php echo $followings->id ; ?>,'follow__')"  class="btn">Follow </button> 
<button type="button"  style="display: none;" id="1pending__<?php echo $followings->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $followings->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>

<?php }else if($followings->isFollow==1 && $followings->id!=$data['userId']){ ?> 

<button type="button" id="1unfollow__<?php echo $followings->id ; ?>" onclick="followBack(<?php echo $followings->id ; ?>,'unfollow__')"  class="btn">Unfollow </button>
<button type="button" style="display: none;" id="1follow__<?php echo $followings->id ; ?>" onclick="followBack(<?php echo $followings->id ; ?>,'follow__')"  class="btn">Follow</button> 
<button type="button"  style="display: none;" id="1pending__<?php echo $followings->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $followings->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>
<?php }else if($followings->isFollow==0 && $followings->id!=$data['userId']){ ?>
<button type="button"  id="1pending__<?php echo $followings->id ; ?>" class="btn pndng"  onclick="followBack(<?php echo $followings->id ; ?>,'pending__')"><i class="ri-time-line"></i>Pending</button>
<button type="button" style="display: none;" id="1follow__<?php echo $followings->id ; ?>" onclick="followBack(<?php echo $followings->id ; ?>,'follow__')"  class="btn">Follow</button>

<?php } ?>

                  
                   
                  <?php } ?>
                   </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function(){
      var type='<?php echo $type ; ?>' ;

      if(type=='follower'){
        setTimeout(function(){
           $('#follow_tab').click();
            $('#loader_spineer').hide(); 
         },1000);
       
      }else{
        //$('#following_list_data').css('display','block');
         $('#loader_spineer').hide(); 
      }

    });

    function followBack(id, status) {
  
    ajaxCsrf();
    $.ajax({
      type: "post",
      url: baseUrl + '/backfollow',
      data: { id: id, status: status },
      beforeSend: function () {
        //$('#loadingGife').show();
        //ajax_before();
      },
          
      success: function (res) {
        // ajax_success() ;

        if(status=='backfollow') {
            $('#pending_'+id).css('display','block');
            $('#backfollow_'+id).css('display','none');
            $('#following_'+id).css('display','none');
        }else if(status=='pending'){
          $('#backfollow_'+id).css('display','block');
          $('#pending_'+id).css('display','none');
          $('#following_'+id).css('display','none');
        } else if(status=='following') {
          $('#backfollow_'+id).css('display','block');
          $('#pending_'+id).css('display','none');
          $('#following_'+id).css('display','none');
        }else if(status=='remove'){
             $('#remove'+id).css('display','none');
          $('#backfollow_'+id).css('display','none');
          $('#pending_'+id).css('display','none');
          $('#follow_'+id).css('display','block');
          $('#followerDiv_'+id).remove();
          var followerCount = $('#follower_count').text() ;
           $('#follower_count').text(parseInt(followerCount)-1);
          
        }else if(status=='following_'){
              
                 $('#follow__'+id).css('display','block');
                 $('#following__'+id).css('display','none');
                $('#pending__'+id).css('display','none');
        }else if(status=='follow__'){
                $('#follow__'+id).css('display','none');
                 $('#following__'+id).css('display','none');
                $('#pending__'+id).css('display','block');
                 $('#1follow__'+id).css('display','none');
                 $('#1following__'+id).css('display','none');
                $('#1pending__'+id).css('display','block');
        }else if(status=='pending__'){
                $('#follow__'+id).css('display','block');
                 $('#following__'+id).css('display','none');
                $('#pending__'+id).css('display','none');
                $('#1follow__'+id).css('display','block');
                 $('#1following__'+id).css('display','none');
                $('#1pending__'+id).css('display','none');
        }else if(status=='unfollow__'){
          $('#unfollow__'+id).css('display','none');
          $('#follow__'+id).css('display','block');
          $('#pending__'+id).css('display','none');
           $('#1unfollow__'+id).css('display','none');
          $('#1follow__'+id).css('display','block');
          $('#1pending__'+id).css('display','none');
        }
        else{
            statusMesage('something went wrong', 'error');
        }
      }

    });

  }

</script>
@stop


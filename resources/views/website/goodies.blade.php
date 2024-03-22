@extends('includes.website.ajax_template')
@section('content')  
    <?php //echo "<pre>";print_r($users);  ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#loader_spineer').show();
  })
</script>
    
  <link rel="stylesheet" href="{{asset('public/website/css/fm.selectator.jquery.css')}}">

    <link href="{{ URL('/').'/public/website/group_chat/jquery.multiselect.css' }}" rel="stylesheet" type="text/css">
    <div class="sell_box" id="Goodies">
      <div class="head">
        <h3>Goodies</h3>
        <div class="tabmenu">
          <button type="button" class="btn_filter" data-bs-toggle="modal" data-bs-target="#filter_modal"><i class="ri-filter-2-fill"></i> Filter</button>
          <ul class="nav nav-tabs" id="get_tab_id" role="tablist">                        
          <li class="nav-item" role="presentation" id="all">
            <button class="nav-link active" id="Goodies-All-tab" value="all" onClick="resetFilter()" data-bs-toggle="tab" data-bs-target="#all-menu" type="button" role="tab" aria-selected="true">All</button>
          </li>
          <li class="nav-item" role="presentation" id="paid">
            <button class="nav-link" id="Goodies-Paid-tab" value="paid" data-bs-toggle="tab" data-bs-target="#paid-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
              Paid
            </button>
          </li>  
          <li class="nav-item" role="presentation" id="unpaid">
            <button class="nav-link" id="Goodies-Unpaid-tab" value="unpaid" data-bs-toggle="tab" data-bs-target="#uUnpaid-menu" type="button" role="tab" aria-selected="false" tabindex="-1">
              Unpaid
            </button>
          </li>
        </ul>
      </div>
      </div>

      <div class="Box_details_sect" id="goodiesAjaxData">
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
				  <?php if($goodies_listings['goodies_view_count'] > 0){ ?>
                  <li>
                    <span><i class="ri-eye-fill"></i></span>
                    <span><?php echo $goodies_listings['goodies_view_count']  ?> View</span>
                  </li> 
				  <?php } ?>				  
                  <li>
                    <span><i class="ri-time-fill"></i></span>
                    <span><?php echo $goodies_listings['goodies_time']; ?></span>
                  </li>
                <!--  <li>
                    <span><i class="ri-road-map-fill"></i></span>
                    <span>2.5 Miles</span>
                  </li> -->
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
                      <sup class="d-none" id="goodies_like_count_<?php echo $goodies_listings['id']; ?>">  
                        <?php echo !empty($goodies_listings['like_count'])?$goodies_listings['like_count']:""; ?>
                      </sup>
                    </button>
                     <div id="goodies_like_name_<?php echo $goodies_listings['id']; ?>" class="otherlikebx">
								<?php $y=0; ?> 
								<?php if(!empty($goodies_listings['goodies_like_listing'])){  ?>
									<?php /* foreach($goodies_listings['goodies_like_listing'] as $val){  ?>
									  
										<?php if($y < 1){ ?>
											<div class="ol_n">
												<?php echo $val['name']; ?>
											</div>
										<?php }   ?>										
									<?php $y++; } */ ?>
									<div class="ol_odbx">
										<button type="button" class="btn" onclick="goodies_like_model(<?php echo $goodies_listings['id']; ?>)"><?php echo !empty($goodies_listings['like_count'])?$goodies_listings['like_count']:""; ?><?php  //echo $y; ?> </button>  
									</div>      
								<?php } ?>  
							</div>                    
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

                  <li class="share">
                    <a href="javascript:void(0);" id="share_id"  value="<?php echo $goodies_listings['id'] ?>">
                      <span><i class="ri-share-fill"></i></span>
                      <span>Share</span>
                    </a>
                    <ul class="share_ul social_icons">
                      <li>
                        <a href="https://www.facebook.com/share.php?u=<?php echo $goodies_listings['share_url'];?>" target="_blank"><i class="fa fa-facebook-f"></i></a>
                      </li>
                     <!--  <li>
                        <a href="https://twitter.com/share?text=<?php //echo $blog_title;?>&url=<?php //echo $goodies_listings['share_url'];?>" target="_blank">
                          <i class="fa fa-twitter"></i>
                        </a>
                      </li> -->
                    <!--  <li><a href="javascript:void(0);" target="_blank"><i class="fa fa-youtube"></i></a></li> -->
                      <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $goodies_listings['share_url'];?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                      <!-- <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>   -->
                     </ul>
                  </li>
                  <li>
                    <a href="<?php echo $goodies_listings['goodies_url'].'/'.$goodies_listings['id'] ?>"><button type="button" class="btn" >Join</button></a>
                  </li>
                </ul>
              </div>
					    <div class="post_chat_sect" id="goodies_post_chat_sect_<?php echo $goodies_listings['id']; ?>" style="display:none">    
                        <div class="user_img"><img src="<?php echo  $users['image'] ; ?>" alt=""></div>
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
				<div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt=""> </div>
				<h3>No record Found</h3>
				<p>Goodies Not found</p>
			  </div>
		<?php } ?>
        </div>
      </div>  

<!-- Modal -->
<div class="modal fade small_modal" id="filter_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Find Goodies</h5>
        <button type="button" class="close" data-bs-dismiss="modal" id="goodiesFilterModal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">          
        </button>
      </div>
      <form id="find_goodies" action="javascript:void(0);" method="post">
      <div class="modal-body">
        <div class="form_feel">
          <div class="form-group">
            <label for="">Goodies Name</label>
            <input type="text" name="S_goodies_name" id="S_goodies_name" class="form-control">
			<span id="err_s_goodies_name" class="err"></span>
          </div>
          <div class="form-group">
            <label for="">Goodies Date</label>
            <input type="date" name="S_goodies_date" id="S_goodies_date" class="form-control">
          </div>   
          <div class="form-group ctr">
            <label for="s_goodies_country">Country</label>
           <!--  <input type="text" name="S_goodies_country" id="S_goodies_country" class="form-control"> -->
             <select name="S_goodies_country"  id="s_goodies_country" class="form-control">
              <!--  <option value="">Select Country</option> -->
                <?php foreach($country_list as $countryData){  ?>
                    <option value="<?php echo $countryData->id ; ?>" id="ctr_<?php echo $countryData->id ; ?>" selected><?php echo $countryData->name ; ?></option>
                <?php } ?>  

            </select> 
          </div>

          

          <div class="form-group cty" id="goodiesCity">
            <label for="">City</label>           
            <select name="S_goodies_city1" id="S_goodies_city1" class="form-control" >
                <option value="">Select City</option>
            </select> 
             
          </div> 
          <div class="button-group">   
            <button type="button" class="btn" onclick="filter_goodies('')">Find</button>  
          </div>
        </div>        
      </div> 
     </form>      
    </div>
  </div>
</div>

<div class="modal fade small_modal" id="join_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">      
      <div class="modal-header border-0 p-0">        
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">       
        </button>
      </div>
      <div class="modal-body">

        <div class="join_cont">

          <div class="jc_head">
            <i class="ri-checkbox-circle-fill"></i>
            <h3>You have Succeeded</h3>
          </div>
          
          <p class="jc_dec">Now sit back and relax. Now it was our work to check out your details. We will send you Email Confirmation once we are done.</p>

          <div class="jc_name">
            <p>In mean time, Know about</p>
            <h4>Golden Girls</h4>
          </div>

          <div class="button-group">
            <button type="button" class="btn">About Golden Girls</button>
          </div>

        </div>
      </div>       
    </div>
  </div>
</div>

<div class="modal fade edit_post_modal" id="editComment" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Comment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body" id="edit_comment_model_id">

      </div>

    </div>
  </div>
</div>

<div class="modal fade edit_post_modal" id="editReplyComment" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Reply Comment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body" id="edit_reply_comment_model_id">

      </div>

    </div>
  </div>
</div>

<script src="{{ URL('/').'/public/website/group_chat/jquery.min.js' }}"></script>
  <script src="{{ URL('/').'/public/website/group_chat/jquery.multiselect.js' }}"></script>
<script type="text/javascript">


window.onload = function(){
  setTimeout(function(){
    $('#loader_spineer').hide();
  },500);
   
}

  
   $('#s_goodies_country').change(function(e) {
     
        var selected = $('#s_goodies_country').val();
         
      if(selected!=''){

        ajaxCsrf();

         var fromData=$("#find_goodies").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/getCity',
        data:fromData,
        success: function (response) {
          if(response.trim()!=='fail'){

            $('#goodiesCity').html(response);

          }else{
             $('#goodiesCity').html('<label for="">City</label><select name="S_goodies_city" id="S_goodies_city" class="form-control" ><option value="">Select City</option></select> ');
          }
        }
    });
      }else{
        $('#goodiesCity').html('<label for="">City</label><select name="S_goodies_city" id="S_goodies_city" class="form-control" ><option value="">Select City</option></select> ');
      } 
    }); 

function resetFilter(){

}



function editGoodiesComment(goodiesId,commentId){          
      ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/editGoodiesComment',
        data:{'postId':goodiesId,'commentId':commentId},
        success: function (response) {
            $('#edit_comment_model_id').html(response);
        }
    });
}

function updateGoodiesComment(goodiesId){
     ajaxCsrf();

      var fromData=$("#edit_comment_forms_id").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/updateGoodiesComment',
        data:fromData,
        success: function (response) {
            $("#edit_comment_forms_id")[0].reset();
            $('#editComment').modal('hide');
            goodies_save_comment(goodiesId, 1);
        }
    });
}

function editGoodiesReplyComment(replyId,goodiesId){      
     ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/editGoodiesReplyComment',
        data:{'postId':goodiesId,'replyId':replyId},
        success: function (response) {
            $('#edit_reply_comment_model_id').html(response);
        }
    });
}

function updateGoodiesReplyComment(goodiesId){
     ajaxCsrf();

      var fromData=$("#edit_reply_comment_forms_id").serialize() ;
    $.ajax({
        type: "post",
        url: baseUrl + '/updateGRComment',
        data:fromData,
        success: function (response) {

            $("#edit_reply_comment_forms_id")[0].reset();
            $('#editReplyComment').modal('hide');
            goodies_save_comment(goodiesId, 1);
        }
    });
}

</script>


@stop


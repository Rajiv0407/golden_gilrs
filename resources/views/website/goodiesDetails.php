@extends('includes.website.ajax_template') 
@section('content')
                    
				   <ul class="step_bar">
					<li><a href="{{URL::to('/')}}/life_style">Goodies</a></li>
					<li><a href="">Goodies Details</a></li>    
				  </ul>
                  
                 <?php //print_r($goodies_info);die;   ?>				   
				   <div class="post_list">
                   <div class="post_card">
                      <div class="post_hd">
                      <div class="post_user">
                        <div class="user_avtar">
                          <div class="user_details">
                         <div>
                          <h3><?php echo $goodies_info['goodies_name']; ?></h3>
                          <p><?php echo $goodies_info['time']; ?></p>
                         </div>
                           
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="description_post">
                        <p><?php echo $goodies_info['goodies_descrption']; ?></p>
                      </div>
                      <div class="post_banner">
                        <img src="<?php echo $goodies_info['image']; ?>" alt="">
                        <div class="offer_box bg_brn">
                            <h3>Paid</h3>
                        </div>
                      </div>
                      <div class="list_inform">
                        <div class="crd_bx">
                            <h3><span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14.654" height="16.748" viewBox="0 0 14.654 16.748">
                                  <path id="Icon_awesome-calendar-alt" data-name="Icon awesome-calendar-alt" d="M0,15.178a1.571,1.571,0,0,0,1.57,1.57H13.084a1.571,1.571,0,0,0,1.57-1.57V6.28H0ZM10.467,8.766a.394.394,0,0,1,.393-.393h1.308a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H10.86a.394.394,0,0,1-.393-.393Zm0,4.187a.394.394,0,0,1,.393-.393h1.308a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H10.86a.394.394,0,0,1-.393-.393ZM6.28,8.766a.394.394,0,0,1,.393-.393H7.981a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H6.673a.394.394,0,0,1-.393-.393Zm0,4.187a.394.394,0,0,1,.393-.393H7.981a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H6.673a.394.394,0,0,1-.393-.393ZM2.093,8.766a.394.394,0,0,1,.393-.393H3.794a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H2.486a.394.394,0,0,1-.393-.393Zm0,4.187a.394.394,0,0,1,.393-.393H3.794a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H2.486a.394.394,0,0,1-.393-.393ZM13.084,2.093h-1.57V.523A.525.525,0,0,0,10.991,0H9.944a.525.525,0,0,0-.523.523v1.57H5.234V.523A.525.525,0,0,0,4.71,0H3.664A.525.525,0,0,0,3.14.523v1.57H1.57A1.571,1.571,0,0,0,0,3.664v1.57H14.654V3.664A1.571,1.571,0,0,0,13.084,2.093Z" fill="#d7792d"></path>
                                </svg>
                                </span><span><?php echo $goodies_info['goodies_date']; ?></span></h3>
                             <h3>
                                <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="13.333" viewBox="0 0 20 13.333">
                                  <path id="Icon_awesome-eye" data-name="Icon awesome-eye" d="M19.879,10.66A11.137,11.137,0,0,0,10,4.5,11.138,11.138,0,0,0,.121,10.66a1.123,1.123,0,0,0,0,1.014A11.137,11.137,0,0,0,10,17.833a11.138,11.138,0,0,0,9.879-6.16A1.123,1.123,0,0,0,19.879,10.66ZM10,16.167a5,5,0,1,1,5-5A5,5,0,0,1,10,16.167Zm0-8.333a3.309,3.309,0,0,0-.879.132A1.661,1.661,0,0,1,6.8,10.288,3.326,3.326,0,1,0,10,7.833Z" transform="translate(0 -4.5)" fill="#d7792d"></path>
                                </svg>
                                </span>
                                <span>12K View</span></h3>
                          </div>
                          <div class="crd_bx">
                            <h3><span>
                             
							<svg xmlns="http://www.w3.org/2000/svg" width="15.065" height="15.065" viewBox="0 0 15.065 15.065">
								<path id="Icon_awesome-clock" data-name="Icon awesome-clock" d="M8.1.563A7.533,7.533,0,1,0,15.628,8.1,7.531,7.531,0,0,0,8.1.563ZM9.829,11.2,7.15,9.249A.367.367,0,0,1,7,8.955V3.843a.366.366,0,0,1,.364-.364H8.824a.366.366,0,0,1,.364.364V8.025l1.929,1.4a.364.364,0,0,1,.079.51l-.857,1.178A.367.367,0,0,1,9.829,11.2Z" transform="translate(-0.563 -0.563)" fill="#d7792d"/>
							  </svg>
  
                                </span><span><span><?php echo $goodies_info['goodies_time']; ?></span></h3>
                             <h3>
                                <span>
                              
							<svg xmlns="http://www.w3.org/2000/svg" width="19.749" height="17.555" viewBox="0 0 19.749 17.555">
								<path id="Icon_awesome-map-marked-alt" data-name="Icon awesome-map-marked-alt" d="M9.875,0a4.32,4.32,0,0,0-4.32,4.32c0,1.929,2.824,5.445,3.905,6.721a.541.541,0,0,0,.83,0c1.082-1.276,3.905-4.792,3.905-6.721A4.32,4.32,0,0,0,9.875,0Zm0,5.76a1.44,1.44,0,1,1,1.44-1.44A1.44,1.44,0,0,1,9.875,5.76ZM.69,7.4A1.1,1.1,0,0,0,0,8.423v8.583a.549.549,0,0,0,.752.51l4.734-2.155V7.369a10.383,10.383,0,0,1-.729-1.592Zm9.185,4.928a1.638,1.638,0,0,1-1.252-.582c-.674-.8-1.391-1.7-2.04-2.631v6.24l6.583,2.194V9.12c-.649.929-1.365,1.835-2.04,2.631A1.639,1.639,0,0,1,9.875,12.332ZM19,5.526,14.263,7.68v9.875l4.8-1.918a1.1,1.1,0,0,0,.69-1.019V6.035A.549.549,0,0,0,19,5.526Z" fill="#d7792d"/>
							  </svg>
  
                                </span>
                                <span>2.5 Miles</span></h3>
                          </div>
                          <div class="crd_bx">
                            <h3><span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14.654" height="16.748" viewBox="0 0 14.654 16.748">
                                  <path id="Icon_awesome-calendar-alt" data-name="Icon awesome-calendar-alt" d="M0,15.178a1.571,1.571,0,0,0,1.57,1.57H13.084a1.571,1.571,0,0,0,1.57-1.57V6.28H0ZM10.467,8.766a.394.394,0,0,1,.393-.393h1.308a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H10.86a.394.394,0,0,1-.393-.393Zm0,4.187a.394.394,0,0,1,.393-.393h1.308a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H10.86a.394.394,0,0,1-.393-.393ZM6.28,8.766a.394.394,0,0,1,.393-.393H7.981a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H6.673a.394.394,0,0,1-.393-.393Zm0,4.187a.394.394,0,0,1,.393-.393H7.981a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H6.673a.394.394,0,0,1-.393-.393ZM2.093,8.766a.394.394,0,0,1,.393-.393H3.794a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H2.486a.394.394,0,0,1-.393-.393Zm0,4.187a.394.394,0,0,1,.393-.393H3.794a.394.394,0,0,1,.393.393v1.308a.394.394,0,0,1-.393.393H2.486a.394.394,0,0,1-.393-.393ZM13.084,2.093h-1.57V.523A.525.525,0,0,0,10.991,0H9.944a.525.525,0,0,0-.523.523v1.57H5.234V.523A.525.525,0,0,0,4.71,0H3.664A.525.525,0,0,0,3.14.523v1.57H1.57A1.571,1.571,0,0,0,0,3.664v1.57H14.654V3.664A1.571,1.571,0,0,0,13.084,2.093Z" fill="#d7792d"></path>
                                </svg>
                                </span><span><?php echo $goodies_info['goodies_address']; ?></span></h3>
                          </div>
                     </div>
					 <li>  
					 <form id="booking_goodies" action="javascript:void(0);"  method="post">
					 <div id="field1">Please select number of ticket</div>
					 <div class="wrap">  
					      <input type="hidden" name="booking_type" value="2">
					      <input type="hidden" name="type_id" value="<?php echo $goodies_info['id']; ?>">
						  <button type="button" id="sub" class="sub">-</button>
						  <input class="count" type="text" name="no_ticket" id="no_ticket" value="1" min="1" max="10" />
						  <button type="button" id="add" class="add">+</button>
						</div>
					 <button type="button" class="btn" onclick="send_goodies_confirm();">Join</button>
					 </form>
					 </li>
                    </div>
                   </div>
				   
				   
				   
<div class="modal fade small_modal" id="goodies_booking_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">  
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


				   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				   <script>
				   $("#goodies_style_id").addClass("active");
                   $("#life_style_id").removeClass("");				   
					$('.add').click(function () {		
					  var th = $(this).closest('.wrap').find('.count'); 					  
					  if(th.val() < 10) th.val(+th.val() + 1);
					});
					$('.sub').click(function () {
					  var th = $(this).closest('.wrap').find('.count');    	
							if (th.val() > 1) th.val(+th.val() - 1);
					});
				   </script>
@stop 
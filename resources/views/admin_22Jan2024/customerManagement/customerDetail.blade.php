<?php 
$userId=isset($userInfo->id)?$userInfo->id:'' ; 
$name = $userInfo->first_name.' '.$userInfo->last_name;
$mobileNumber = isset($userInfo->phone)?$userInfo->phone:'' ;
$email = isset($userInfo->email)?$userInfo->email:'' ;
$dob = isset($userInfo->dob)?$userInfo->dob:'' ;
$gender = isset($userInfo->gender)?$userInfo->gender:'' ;
$status = isset($userInfo->status)?$userInfo->status:'' ;
$country = isset($userInfo->country)?$userInfo->country:'' ;
$city = isset($userInfo->city)?$userInfo->city:'' ;
$relationship = isset($userInfo->relationship)?$userInfo->relationship:'' ;
$height = isset($userInfo->height)?$userInfo->height:'' ;
$smoking = isset($userInfo->smoking)?$userInfo->smoking:'' ;
$marital_status = isset($userInfo->marital_status)?$userInfo->marital_status:'' ;
$know = isset($userInfo->know)?$userInfo->know:'' ;
$interests = isset($userInfo->interests)?$userInfo->interests:'' ;
$eye_color = isset($userInfo->eye_color)?$userInfo->eye_color:'' ;
$looking_man_for = isset($userInfo->looking_man_for)?$userInfo->looking_man_for:'' ;
$self_des = isset($userInfo->self_des)?$userInfo->self_des:'' ;
$hip_size = isset($userInfo->hip_size)?$userInfo->hip_size:'' ;
$bust = isset($userInfo->bust)?$userInfo->bust:'' ;
$hair_style = isset($userInfo->hair_style)?$userInfo->hair_style:'' ;
$hair_color = isset($userInfo->hair_color)?$userInfo->hair_color:'' ;
$waist = isset($userInfo->waist)?$userInfo->waist:'' ;
$address_line_1 = isset($userInfo->address_line_1)?$userInfo->address_line_1:'' ;
$address_line_2 = isset($userInfo->address_line_2)?$userInfo->address_line_2:'' ;
$zip_code = isset($userInfo->zip_code)?$userInfo->zip_code:'' ;

$appImg = isset($userInfo->image)?$userInfo->image:'' ;
$imgPath = url('/').'/public/admin/images/avtar_i.png';

if($appImg!=''){
    $imgPath_=url('/').'/storage/app/public/user_image/'.$appImg ;
}else{
    $imgPath_ = $imgPath ;
}    
 ?>
            <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Customer Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard();">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#customer_management" onclick="customerManagement()">Customer Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $name ; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="carDetail__wrapper main_bx">
                    <div class="filterWrapper">
                    <div class="bcc__wrapper custm_dtls">
                    <h3>Customer Details</h3> 
                        <div class="custom_img">
                        @if($appImg!='')
                            <img src="{{$imgPath_}}" alt="">
                            @else
                            <img src="{{URL::to('/')}}/public/admin/images/avtar_i.png" alt="">
                            @endif 
                        </div>
                       <div class="custmer_dtls">
					         
                            <p>
                                <span>Name : </span>
                                 <span><?php echo $name; ?></span>
                            </p>
                            <p>
                                <span>Email Id : </span>
								   <?php if(!empty($email)){ ?>
                                   <span><?php echo $email; ?></span>
									<?php }else{ ?>
									<span>NA</span>
									<?php } ?>								   
                            </p>
                            <p>
                                <span>Mobile Number : </span>
								<?php if(!empty($mobileNumber)){ ?>
                                <span><?php echo $mobileNumber; ?></span>
                                <?php }else{ ?>
								<span>NA</span>
								<?php } ?>								
                            </p>
                            <p>
                                <span>Gender :</span>
								<?php if(!empty($gender)){ ?>
                                <span><?php echo $gender; ?></span>
                                <?php }else{ ?>
								<span>NA</span>
								<?php } ?>								
                            </p>
							<p>
                                <span>DOB :</span>
								<?php if(!empty($dob)){ ?>
                                <span><?php echo $dob; ?></span>  
                                <?php }else{ ?>
								<span>NA</span>
								<?php } ?>								
                            </p>
                    
						     
                            <p>
                                <span>Height : </span>
								<?php if(!empty($height)){ ?>
                                 <span><?php echo $height; ?></span>
								<?php }else{ ?>
								<span>NA</span>
								<?php } ?>
                            </p>
							<p>
                                <span>Weight : </span>
								<?php if(!empty($weight)){ ?>
                                 <span><?php echo $weight; ?></span>
								 <?php }else{ ?>
								<span>NA</span>
								<?php } ?>
                            </p>
                            <p>
                                <span>Eye Color : </span>
								    <?php if(!empty($eye_color)){ ?>  
                                   <span><?php echo $eye_color; ?></span>
								<?php }else{ ?>
									<span>NA</span>
									<?php } ?>								   
                            </p>
                            <p>
                                <span>Hip Size : </span>
								<?php if(!empty($hip_size)){ ?>
                                <span><?php echo $hip_size; ?></span> 
								 <?php }else{ ?>
								<span>NA</span>
								<?php } ?>								
                            </p>
                            <p>
                                <span>Hair Style :</span>
								<?php if(!empty($hair_style)){ ?>
                                <span><?php echo $hair_style; ?></span>   
								 <?php }else{ ?>
								<span>NA</span>
								<?php } ?>
                            </p>
							<p>
                                <span>Hair Color :</span>
								<?php if(!empty($hair_color)){ ?>
                                <span><?php echo $hair_color; ?></span> 
                                 <?php }else{ ?>
								<span>NA</span>
								<?php } ?>								
                            </p>
							<p>
                                <span>Address :</span> 
								<?php if(!empty($address_line_1)){ ?>
                                <span><?php echo $address_line_1.' '.$address_line_2.' '.$zip_code; ?></span> 
                                 <?php }else{ ?>
								<span>NA</span>
								<?php } ?>								
                            </p>
                        </div>
                    </div>
                </div>
                </div>
				<div class="c_Doc c_dtl">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Advertisement-tab" data-bs-toggle="tab" data-bs-target="#Image" type="button" role="tab" aria-controls="Advertisement" aria-selected="true" onclick="userDetailData('{{$userId}}',1,'Image')" >Image</button>
                        </li>   
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="followers-tab" data-bs-toggle="tab" data-bs-target="#followers" type="button" role="tab" aria-controls="followers" aria-selected="true" onclick="userDetailData('{{$userId}}',2,'followers')" >Followers</button>
                        </li>  
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="follows-tab" data-bs-toggle="tab" data-bs-target="#follows" type="button" role="tab" aria-controls="follows" aria-selected="true" onclick="userDetailData('{{$userId}}',3,'follows')" >Follows</button>
                        </li>                       
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Image" role="tabpanel" aria-labelledby="Image-tab">  
                          Image
						</div>
                        <div class="tab-pane fade show" id="followers" role="tabpanel" aria-labelledby="followers-tab">
                            Followers
                        </div>
                        <div class="tab-pane fade show" id="follows" role="tabpanel" aria-labelledby="follows-tab">
                            Follows
                        </div>
                    </div>
                </div>
            </div>
			<script type="text/javascript">
				$(document).ready(function(){
					var userId ='<?php echo $userId ; ?>' ;
					userDetailData(userId,1,'Image'); 
				});    
			</script>
               

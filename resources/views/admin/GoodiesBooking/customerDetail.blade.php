<?php 
$userId=isset($userInfo->id)?$userInfo->id:'' ; 
$name = $userInfo->first_name.' '.$userInfo->last_name;
$mobileNumber = isset($userInfo->phoneNumber)?$userInfo->phoneNumber:'' ;
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

$appImg = isset($userInfo->image)?$userInfo->image:'' ;
$imgPath = url('/').'/public/admin/images/avtar_i.png';

if($appImg!=''){
    $imgPath_=url('/').'/public/storage/profile_image/'.$appImg ;
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
                <div class="carDetail__wrapper">
                    <div class="cd_if_1 filterWrapper">
                        <div>
                        @if($appImg!='')
                            <img src="{{$imgPath_}}" alt="">
                            @else
                            <img src="{{URL::to('/')}}/public/admin/images/avtar_i.png" alt="">
                            @endif 
                        </div>
                        <div class="ownerDetail">
                            <div class="c_D">
                                <h3><?php echo isset($userInfo->name)?$userInfo->name:'' ; ?></h3> 
                                <p><span>Email ID</span> : <span><?php echo $email ; ?></span></p>
                                <p><span>Mobile Number</span> : <span><?php echo $mobileNumber ; ?></span></p>
								<p><span>Gender</span> : <span><?php echo $gender ; ?></span></p>
								<p><span>Country</span> : <span><?php echo $country ; ?></span></p>
		                        <p><span>City</span> : <span><?php echo $city ; ?></span></p>
								<p><span>Relationship</span> : <span><?php echo $relationship ; ?></span></p>
								<p><span>Height</span> : <span><?php echo $height ; ?></span></p>
								<p><span>Smoking</span> : <span><?php echo $smoking ; ?></span></p>
								
								<p><span>Know</span> : <span><?php echo $know ; ?></span></p>
								
                                <p><span>Eye Color:</span> : <span><?php echo $eye_color ;  ?></span></p>
                                
                                <p><span>Hip Size:</span> : <span><?php echo $hip_size ;  ?></span></p>
								<p><span>Bust:</span> : <span><?php echo $bust ;  ?></span></p>
								<p><span>Hair Style:</span> : <span><?php echo $hair_style ;  ?></span></p>
								<p><span>Hair Color:</span> : <span><?php echo $hair_color ;  ?></span></p>
								<p><span>Waist:</span> : <span><?php echo $waist ;  ?></span></p>
								<p><span>Interest:</span> : <span><?php echo $interests ;  ?></span></p>
								
                            </div>
                        </div>
                    </div>
                </div>
               

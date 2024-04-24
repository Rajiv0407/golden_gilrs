<?php 
use Carbon\Carbon;


function auth_chat(){

    $get_SessionData = Session::get('user_session');
    
    if(empty($get_SessionData)){
      
        return redirect()->to('/')->send();
    }

}

function checkIsloginOrNot(){

    $get_SessionData = Session::get('user_session');
    
    if(empty($get_SessionData)){
      
        return false ;
    }else{
      return true ;
    }

}

function isMobileDev(){
    if(!empty($_SERVER['HTTP_USER_AGENT'])){
       $user_ag = $_SERVER['HTTP_USER_AGENT'];
       if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
          return true;
       };
    };
    return false;
}

function test($id=null){
	echo "hello123";
}

function notification_count($id=null){
	$friend_info=0;
	$noti_info=0;
	//$friend_info=DB::table('friend_list')->where('request_id',$id)->where('status',1)->count();
  // ->where('created_at','>','now() - interval 1 month')
	$noti_info=DB::table('notification') 
  ->whereBetween('created_at',[Carbon::now()->subMonth(1), Carbon::now()])
  ->where('reciver_id',$id)->where('is_read',1)->count();
	return $noti_info;
}

function notification_list($id=null){

//DB::enableQueryLog();
   $noti_info = DB::table('notification')->where('reciver_id',$id)
  ->whereBetween('created_at',[Carbon::now()->subMonth(1), Carbon::now()])
    ->orderBy('id', 'desc')->get();

    // $noti_info = DB::table('notification')->select("select * from notification where reciver_id=".$id." and created_at > (now() - interval 1 month) order by id desc")->get();
   
    // print_r(DB::getQueryLog());
    // print_r($noti_info);

    // exit ;
    //$noti_info = DB::table('notification')->where('reciver_id',$id)->orderBy('id', 'desc')->get();
      //echo "<pre>";print_r($noti_info);die; 
    $res=array();  
    if(!empty($noti_info)){
      foreach($noti_info as $noti_infos){
        if($noti_infos->type == 5){  

         $goodies_info = DB::table('goodies')->where('id',$noti_infos->sender_id)->first();
         if(!empty($goodies_info)){
           $not['image']=url('/').'/storage/app/public/goodies_image/'.$goodies_info->image; 
         }else{
          $not['image']=url('/').'/storage/app/public/user_image/'.'user.png';
         }

        }else if($noti_infos->type == 6){
          //$event_info = DB::table('events')->where('id',$noti_infos->sender_id)->first();
          $event_info = DB::table('event_images')->where('event_id',$noti_infos->sender_id)->first();
            
          //echo "<pre>";print_r($event_info);die; 
          if(!empty($event_info)){
            $not['image']=url('/').'/storage/app/public/event_image/'.$event_info->image;
          }else{
             $not['image']=url('/').'/storage/app/public/user_image/'.'user.png';
          }
       
        }else{
          $user_info = DB::table('users')->where('id',$noti_infos->sender_id)->first();
          if(!empty($user_info->image)){
            $not['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
            }else{
             $not['image']=url('/').'/storage/app/public/user_image/'.'user.png';
            }
          }
        $date = Carbon::parse($noti_infos->created_at);
        $elapsed = $date->diffForHumans(Carbon::now());
        $elapsed=createdAt($elapsed);
        $not['is_read']=$noti_infos->is_read;
        $not['message']=$noti_infos->message;
        $not['id']=$noti_infos->id;
        $not['time']=!empty($elapsed)?$elapsed:"";
        $not['type']=isset($noti_infos->type)?$noti_infos->type:1;
        $res[]=!empty($not)?$not:"";
      }
    }
     
     /*
    $friend_info = DB::table('friend_list')->where('request_id',$id)->where('status',1)->orderBy('id', 'desc')->get();
    $res2=array();
    if(!empty($friend_info)){
      foreach($friend_info as $friend_infos){
        $fr_user_info = DB::table('users')->where('id',$friend_infos->user_id)->first();
        
          $date1 = Carbon::parse($friend_infos->created_at);
          $elapsed1 = $date1->diffForHumans(Carbon::now());
          $elapsed1=createdAt($elapsed1);
          
          
        if(!empty($fr_user_info->image)){
        $friend['image']=url('/').'/storage/app/public/user_image/'.$fr_user_info->image;
        }else{
         $friend['image']=url('/').'/storage/app/public/user_image/'.'user.png';
        }
        $friend['time']=$elapsed1;
        $friend['id']=$friend_infos->id;
                $friend['message']=$fr_user_info->first_name.' '.$fr_user_info->last_name.' send you friend request';         
                $res2[]=!empty($friend)?$friend:"";         
      }
    }
    */
     $count= count($res);
     //+ count($res2)
        // echo "<pre>";print_r($res);
     //'friend_request'=>$res2,
    $ab=array('notification'=>$res,'count'=>$count);
    return $ab;
       
  //


}

function notification_list_old_18_2024($id=null){
		//->where('is_read',1)
  //DB::enableQueryLog();
		$noti_info = DB::table('notification')->where('reciver_id',$id)
    ->where('created_at','>','now() - interval 1 month')
    ->orderBy('id', 'desc')->get();
    //print_r(DB::getQueryLog())
	    //echo "<pre>";print_r($noti_info);die; 
		$res=array();  
		if(!empty($noti_info)){
			foreach($noti_info as $noti_infos){
			$user_info = DB::table('users')->where('id',$noti_infos->sender_id)->first();
			if(!empty($user_info->image)){
				$not['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
				}else{
				 $not['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
                $date = Carbon::parse($noti_infos->created_at);
				$elapsed = $date->diffForHumans(Carbon::now());
				$elapsed=createdAt($elapsed);
				$not['message']=$noti_infos->message;
				$not['id']=$noti_infos->id;
				$not['time']=!empty($elapsed)?$elapsed:"";
				$res[]=!empty($not)?$not:"";
			}
		}
		 
		$friend_info = DB::table('friend_list')->where('request_id',$id)->where('status',1)->orderBy('id', 'desc')->get();
		$res2=array();
		if(!empty($friend_info)){
			foreach($friend_info as $friend_infos){
				$fr_user_info = DB::table('users')->where('id',$friend_infos->user_id)->first();
				
				  $date1 = Carbon::parse($friend_infos->created_at);
				  $elapsed1 = $date1->diffForHumans(Carbon::now());
				  $elapsed1=createdAt($elapsed1);
				  
				  
				if(!empty($fr_user_info->image)){
				$friend['image']=url('/').'/storage/app/public/user_image/'.$fr_user_info->image;
				}else{
				 $friend['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
				$friend['time']=$elapsed1;
				$friend['id']=$friend_infos->id;
                $friend['message']=$fr_user_info->first_name.' '.$fr_user_info->last_name.' send you friend request'; 				
                $res2[]=!empty($friend)?$friend:"";			  	
			}
		}
		 $count= count($res)+ count($res2);
        // echo "<pre>";print_r($res);
		$ab=array('friend_request'=>$res2,'notification'=>$res,'count'=>$count);
		return $ab;
		   
	}

function user_permission($id=null){
	
	$permission=DB::table('roles_permission')->where('userId',$id)->get();
	return $permission;
	
}

function checkRole($data,$id){
	 
	foreach($data as $datas){
		//echo "<pre>";print_r($datas);die;
		if($datas->roleId == $id && $datas->view_== 1){
			return 1;
		}
		
		
	}
	
}

function checkAddRole($data,$id){
	 
	foreach($data as $datas){
		if($datas->roleId == $id && $datas->add_== 1){
			return 1;
		}	
	}
	
}

function checkEditRole($data,$id){
	 
	foreach($data as $datas){
		if($datas->roleId == $id && $datas->edit_== 1){
			return 1;
		}			
	}
	
}
function checkDeleteRole($data,$id){
	 
	foreach($data as $datas){
		if($datas->roleId == $id && $datas->delete_== 1){
			return 1;
		}			
	}
	
}
function checkStatusRole($data,$id){
	 
	foreach($data as $datas){
		if($datas->roleId == $id && $datas->status_== 1){
			return 1;
		}		
	}
	
}  

   
			
			

function user_search($data=null,$userId=0){
	 
	$sqlquery = [];
	$querydata = ""; 	
 
	 if($data){
             $sqlquery[] ="CONCAT(first_name,' ',last_name) LIKE '".trim($data)."%'";
	       }

			if(!empty($sqlquery))
            {
             $querydata = " and ".implode(' and ',$sqlquery);
            }
          $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';

	      $typeQry = "select u.id,u.first_name,u.last_name,case when u.image is null then concat('".$defaultImgPath."') else concat('".$defaultImgPath."',image)  end as image,up.country,up.city from users as u left join user_profile as up on u.id=up.user_id 
          left join user_follows as uf on uf.followed_user_id=
        where u.id!=".$userId." and status=1  $querydata  order by u.id desc" ;

		   //echo $typeQry;die;  
		  $Data = DB::select($typeQry);
         return !empty($Data)?$Data:"";		 
}

function authguard(){

 $token=Auth::guard('api')->user();
 return $token ;
 // if(empty($token)){
 // 	$token=array();
 // }
}
   function sendPasswordToEmail(Array $data){   

       $data = array(
        'email' => $data['email'],
        'subject' =>  $data['subject'],
        'messages' => $data['message'],
        'name' => $data['name']
        );

       
    
         Mail::send('emails.password', $data, function($message) use ($data) {
          $to= $data['email'] ;
          $recieverName = "" ;
          $subject = $data['subject'] ;
         
            $message->to($to,$recieverName)->subject($subject);
                    
        });
 
        if (Mail::failures()) {
          // return response()->Fail('Sorry! Please try again latter');
          //echo "Something Error Occured" ;
          return false ;
         }else{
          return true ;
          //echo "Mail send successfully" ;
          // return response()->success('Great! Successfully send in your mail');
         }
   }
   
     function sendCancelledBookingEmail(Array $data,$type=1){   
      //
       $data = array(
                'email' => $data['email'],
                'user_name' => $data['user_name'],
                'booking_id' => $data['booking_id'],
                'booking_name' => $data['booking_name'],
                'address' => $data['address'],
                'date' => $data['date'],
                'subject' =>  $data['subject'],
                'status' => $data['status'],
                'time' => $data['time'],
                'booking_type'=>$data['booking_type'],
                'cityName'=>$data['cityName'] ,
                'countryName'=>$data['countryName'] ,
                'no_ticket'=>$data['no_ticket'],
                'contact_number'=>$data['contact_number'],
                'cancel_reason'=>$data['cancel_reason']
         );

       //  $data = array(
       //    'email' => 'amitshukla.intigate@gmail.com',
       //    'user_name' => 'Amit Shukla',
       //    'booking_id' => 1021,
       //    'booking_name' => 'Test',
       //    'address' => 'Gijhore',
       //    'date' => '2024-01-05',
       //    'subject' =>'Test',
       //    'status' => 'Captured',
       //    'time' => '20:50:00',
       //    'booking_type'=>'Event',
       //    'cityName'=>'Noida' ,
       //    'countryName'=>'India' ,
       //    'no_ticket'=>5,
       //    'contact_number'=>'7289057538'
       //  );

       // echo view('emails.cancel_booking',$data);
       //        exit ;
       if($type==1){
           Mail::send('emails.cancel_booking', $data, function($message) use ($data) {
          $to= $data['email'] ;
          $recieverName = "" ;
          $subject = $data['subject'] ;
          $message->to($to,$recieverName)->subject($subject);
                    
        });
       }else if($type==2){
           Mail::send('emails.admin_cancel_booking', $data, function($message) use ($data) {
            $contactus_email = config('constants.contactus_email');
            $to=$contactus_email ;
          $recieverName = "" ;
          $subject = $data['subject'] ;
          $message->to($to,$recieverName)->subject($subject);
                    
        });
       }
       
        
        if (Mail::failures()) {
          return false ;
         }else{
          return true ;
         }
   }


   function sendBookingToEmail(Array $data){   

       $data = array(
        'email' => $data['email'],
		'user_name' => $data['user_name'],
		'booking_id' => $data['booking_id'],
		'booking_name' => $data['booking_name'],
		'address' => $data['address'],
		'date' => $data['date'],
        'subject' =>  $data['subject'],
        'status' => $data['status'],
		'time' => $data['time'],
    'booking_type'=>$data['booking_type'],
    'cityName'=>$data['cityName'] ,
    'countryName'=>$data['countryName'] ,
    'no_ticket'=>$data['no_ticket']

        );

       
         Mail::send('emails.booking', $data, function($message) use ($data) {
          $to= $data['email'] ;
          $recieverName = "" ;
          $subject = $data['subject'] ;
          $message->to($to,$recieverName)->subject($subject);
                    
        });
        if (Mail::failures()) {
          return false ;
         }else{
          return true ;
         }
   }
   
   function sendRegistrationToEmail(Array $data){   
        
       $data = array(
        'email' => $data['email'],
		'name' => $data['name'],
		'pass'=> $data['pass']
        );
         Mail::send('emails.registration', $data, function($message) use ($data) {
          $to= $data['email'] ;  
          $recieverName = "" ;
          $subject = 'Registration' ;
          $message->to($to,$recieverName)->subject($subject);
                    
        });
        if (Mail::failures()) {
          return true ;
         }else{
          return true ;
         }
   }


function createdAt($created_at)
    { 
        $created_at = str_replace([' seconds', ' second'], ' sec', $created_at);
        $created_at = str_replace([' minutes', ' minute'], ' min', $created_at);
        $created_at = str_replace([' hours', ' hour'], ' hour', $created_at);
        $created_at = str_replace([' months', ' month'], ' month', $created_at);
        $created_at = str_replace([' before'], ' ago', $created_at);
        if(preg_match('(years|year)', $created_at)){
            $created_at = $this->created_at->toFormattedDateString();
        }

        return $created_at;
    }




   function do_upload_unlink($unlink_data=array()){ 
    try{
	    if(!empty($unlink_data)){
			foreach($unlink_data as $val){   
			  if(file_exists($val)) { 
         
			  unlink($val);
			  }
	        }
        }
      } catch(\Exception $e)
    { 
  
    }  
    }


 function printQuery($query){
  DB::enableQueryLog();
   $query ;
   
   print_r(\DB::getQueryLog());
 }


function auth_check(){

    $get_SessionData = Session::get('admin_session');
    
    if(empty($get_SessionData)){
      
        return redirect()->to('/administrator')->send();
    }

}
//
function successResponse($data,$msg=''){
    $response = array(
      "status"=>1,
      "data"=>$data,
      "message"=>$msg
    );

    echo json_encode($response);
}

function checkResponse($data,$msg=''){
    $response = array(
      "status"=>2,
      "data"=>$data,
      "message"=>$msg
    );

    echo json_encode($response);
}
function checkResponse1($data,$msg=''){
    $response = array(
      "status"=>3,
      "data"=>$data,
      "message"=>$msg
    );

    echo json_encode($response);
}


function errorResponse($data,$msg=''){
    $response = array(
      "status"=>0,
      "message"=>$msg
    );

    echo json_encode($response);
}

function siteTitle(){
  return 'Golden Girls';
}

function getCountry(){
      $country=DB::table("countries")->select('id','name','logo')->where('status',1)->get();
      return $country ;
 }

function getDefaultCountryInfo($param){
  if(session()->has('defaultCountry')){
    $data=session()->get('defaultCountry') ;

      return $data[$param];
  }else{
     return 5;
  }
  
}

function getStringWithLink($text){
  $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
  $text= preg_replace($pattern, "<a href=\"\\0\" target=\"\_blank\"\ rel=\"nofollow\">\\0</a>", $text);

return $text;
}

function getPrivacyIcon($type){

  $imagePath=URL('/').'/public/website/images/icon/' ;
 
  if($type==1){
    $imagePath=$imagePath.'public.png' ;
  }else if($type==2){  
    $imagePath=$imagePath.'friends.png' ;
  }else if($type==3){  
    $imagePath=$imagePath.'only_me.png' ;
  }else{
    $imagePath='' ;
  }

  return  $imagePath ;
}

function getPrivacyToolTip($type){

  if($type==1){
    $imagePath='Public' ;
  }else if($type==2){  
    $imagePath="Friends" ;
  }else if($type==3){  
    $imagePath='Only me' ;
  }else{
    $imagePath='' ;
  }

  return  $imagePath ;
}


function getFollowerAndFollowing($userId){

  $following=getFollowing($userId);

  //DB::table("user_follows")->where('followed_user_id',$userId)->where('isAccept',1)->count();

  //$follower=DB::table("user_follows")->where('follower_user_id',$userId)->where('isAccept',1)->count();
  $follower = getFollowerList($userId);


  return array('total_following'=>count($following),'total_follower'=>count($follower));

}


function getFollowerList($userId){

  $s3BaseURL = config('constants.s3_baseURL');
  $usrImg = config('constants.user_profile_img_s3'); 
  $usrImgPath=$s3BaseURL.$usrImg ;

   //$usrImgPath=url('/').'/storage/app/public/user_image/' ;
   $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';
//DB::enableQueryLog();
   $data=session()->get('user_session');
   $loginUserId=$data['userId'] ;
// DB::raw(" case when user_follows.followed_user_id=$loginUserId then 1 else 0 end as isFollow"),
   //DB::enableQueryLog();
   $followerList_ = DB::table('user_follows')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'followBack','users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.id,'/',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend"),'user_profile.height','users.dob','users.login_date','user_follows.isAccept'              
        )
            ->addSelect(DB::raw("case when (select isAccept from user_follows as uf where followed_user_id=$loginUserId and follower_user_id=user_follows.followed_user_id limit 1) is null then '' else (select isAccept from user_follows as uf where followed_user_id=$loginUserId and follower_user_id=user_follows.followed_user_id limit 1) end as isFollow"))  

        ->join('users','users.id','=','user_follows.followed_user_id')       
        ->leftjoin('user_profile','user_profile.user_id','=','users.id')   
            
            ->where('user_follows.follower_user_id','=',$userId)  
            ->where('user_follows.isAccept','=',1) 
            ->where('users.id','!=',$userId)       
            ->get()->toArray();  
// DB::raw(" case when user_follows.followed_user_id=$loginUserId then 1 else 0 end as isFollow"),
 // print_r(DB::getQueryLog());
 // exit ;
    $followerListback =DB::table('user_follows')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'followBack','users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.id,'/',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend"),'user_profile.height','users.dob','users.login_date',                
        )      
       ->addSelect(DB::raw("(select isAccept from user_follows as uf where followed_user_id=$loginUserId and follower_user_id=user_follows.followed_user_id limit 1) as isFollow"))  
        ->join('users','users.id','=','user_follows.follower_user_id')       
        ->leftjoin('user_profile','user_profile.user_id','=','users.id')   
            
            ->where('user_follows.followed_user_id','=',$userId)  
            ->where('user_follows.isAccept','=',1) 
             ->where('user_follows.followBack','=',2)    
            ->where('users.id','!=',$userId)       
            ->get()->toArray();  


            $followerList=array_merge($followerList_,$followerListback);
            //
  //print_r(DB::getQueryLog());
  return $followerList_ ; 

}

function getFollowing($userId){
     $data=session()->get('user_session');

     $s3BaseURL = config('constants.s3_baseURL');
     $usrImg = config('constants.user_profile_img_s3');             
     $usrImgPath=$s3BaseURL.$usrImg ;

   //$usrImgPath=url('/').'/storage/app/public/user_image/' ;
   $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';
   $loginUserId=$data['userId'] ;

   $followingList_ = DB::table('user_follows')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'followBack','users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.id,'/',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend"),'user_profile.height','users.dob','users.login_date'                    
        )  ->addSelect(DB::raw("case when (select isAccept from user_follows as uf where followed_user_id=$loginUserId and follower_user_id=user_follows.follower_user_id limit 1) is null then '' else (select isAccept from user_follows as uf where followed_user_id=$loginUserId and follower_user_id=user_follows.follower_user_id limit 1) end as isFollow"))             
            ->join('users','users.id','=','user_follows.follower_user_id')
            ->leftjoin('user_profile','user_profile.user_id','=','users.id') 
            ->where('user_follows.followed_user_id','=',$userId)  
            ->where('user_follows.isAccept','=',1)        
            ->where('users.id','!=',$userId)->get()->toArray();  

    $followingListback = DB::table('user_follows')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'followBack','users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.id,'/',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend"),'user_profile.height','users.dob','users.login_date'                    
        )   ->addSelect(DB::raw("case when (select isAccept from user_follows as uf where followed_user_id=user_follows.followed_user_id and follower_user_id=$loginUserId limit 1) is null then '' else (select isAccept from user_follows as uf where followed_user_id=user_follows.followed_user_id and follower_user_id=$loginUserId limit 1) end as isFollow"))              
            ->join('users','users.id','=','user_follows.followed_user_id')
            ->leftjoin('user_profile','user_profile.user_id','=','users.id') 
            ->where('user_follows.follower_user_id','=',$userId)  
            ->where(function ($query) {
                 $query->where('user_follows.isAccept', '=', 1)
                 ->orWhere('user_follows.isAccept', '=', 2);
            })->where('user_follows.followBack','=',2)        
            ->where('users.id','!=',$userId)->get()->toArray();

            $followingList=array_merge($followingList_,$followingListback);
  return $followingList ; 

}



function checkIsFriendOrNot($loginUserId,$otherUserId){

  $checkUser=DB::table("user_follows")->where("followed_user_id",$loginUserId)->where('follower_user_id',$otherUserId)->where('isAccept',1)->count();


  $checkUser1=DB::table("user_follows")->where("followed_user_id",$otherUserId)->where('follower_user_id',$loginUserId)->where('isAccept',1)->count();

  if($checkUser > 0 || $checkUser1 > 0){
    return 1 ;
  }else{
    return 0 ;
  }

}


function aboutInfo($userId){

    //$usrImgPath=url('/').'/storage/app/public/user_image/' ;
    $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';

    //$usrBannerImage=url('/').'/storage/app/public/banner_image/' ;
    $usrDefaultBannerImg = url('/').'/storage/app/public/user_image/banner_defualt.jpg';

    $s3BaseURL = config('constants.s3_baseURL');  
    $userProflieImg = config('constants.user_profile_img_s3');
    $usrImgPath=$s3BaseURL.$userProflieImg ;
    $usrBannerImage=$usrImgPath ;

    $users = DB::table('users')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name"),'users.first_name','users.last_name',DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.id,'/',image) end as image"),'users.email','users.dob','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.weight','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','know','bust','hair_style','hair_color','waist',DB::raw(" case when banner_image is null then concat('".$usrDefaultBannerImg."') else concat('".$usrBannerImage."',users.id,'/',banner_image) end as banner_image"),'isPrivate','instagram','youtube','snapchat','users.phone','address_line_1','address_line_2','zip_code','brand_name','brand_website','isSocialPrivacy','isDOBPrivacy','isMNPrivacy','isEmailIdPrivacy','isAddressPrivacy',DB::raw(" case when isPrivate=1 then 'Private' else 'Public' end as isPrivate_"),'isPrivate')
            ->leftjoin('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$userId)
            ->first();       




        $array['users'] = json_decode(json_encode($users), true);
       
    $followFollowerCount=getFollowerAndFollowing($userId);
      $array['users']['following_count']=isset($followFollowerCount['total_following'])?$followFollowerCount['total_following']:0; 
      $array['users']['followers_count']=isset($followFollowerCount['total_follower'])?$followFollowerCount['total_follower']:0; 

      return $array ;
}

function peopleYouMayKnow($type=0){
/* type== 1 Network page 2 >> right menu whow follow */
  $limit=10000 ;
  if($type==2){
    $limit=5 ;
  }
 
  $data=session()->get('user_session');
  $s3BaseURL = config('constants.s3_baseURL');
  $usrImg = config('constants.user_profile_img_s3');
   //$usrImgPath=url('/').'/storage/app/public/user_image/' ;
    $usrImgPath=$s3BaseURL.$usrImg ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';
          //DB::enableQueryLog();
          $loginUserId = $data['userId'] ;
          $peopleYouMayKnow = DB::table('users')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.id,'/',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend")              
        )->addSelect(DB::raw("(select case when isAccept=0 then 1 else 2 end  from user_follows where (followed_user_id=".$loginUserId." and follower_user_id=users.id) or (followed_user_id=users.id and follower_user_id=".$loginUserId.")  limit 1) as is_follow"))
            ->addSelect(DB::raw("(select count(id) from user_follows where followed_user_id=users.id  and follower_user_id=".$loginUserId." and isAccept=0 limit 1) as isInvition"))
            ->leftjoin('user_profile','user_profile.user_id','=','users.id') 
            ->where('users.id','!=',$data['userId'])
          
           ->limit($limit)
            ->get()->toArray(); 
    return  $peopleYouMayKnow ;
}

function dateTimeFormat($date){
    $date = Carbon::parse($date);
    $elapsed = $date->diffForHumans(Carbon::now());
    $elapsed=createdAt($elapsed);
    return $elapsed ;
}

function getFriendListUserId($userId){
//->select(DB::raw("follower_user_id as userId"))
    $following=DB::table("user_follows")->where("followed_user_id",$userId)->where("isAccept",1)->get()->pluck('follower_user_id')->toArray();
//->select(DB::raw("followed_user_id as userId"))
    $follower =DB::table("user_follows")->where("follower_user_id",$userId)->where("isAccept",1)->get()->pluck('followed_user_id')->toArray();


  return $response=array_merge($following,$follower);
   

     
}

function profileAboutInfo($id){
  $data=session()->get('user_session');
    if(empty($data)){  
      return redirect('/');   
    }
       
    $user_id=isset($id)?$id:0;
  
        
        if($id==="undefined"){
          return true ;
        }

    $array=aboutInfo($user_id);
       
         
         if($data['userId']!=$id){
          $isFriend=checkIsFriendOrNot($data['userId'],$id);  
         }else{
          $isFriend=0 ;
         } 
        
         $array['users']['isFriend']=$isFriend;
         $country=DB::table('countries')->select('id','name')->get()->toArray();

         return array('users'=>$array['users'],'country'=>$country);
        
}

function getImageHeight($imagePath){
    $imageSize = getimagesize($imagePath);
    $width=isset($imageSize[0])?$imageSize[0]:0;
    $height=isset($imageSize[1])?$imageSize[1]:0;
     if($width > 0 && $height > 0){
       $scale = $width / $height ;

    $newWidth=1024 ;

    $newHeight=$newWidth / $scale ;

    return $newHeight ;
  }else{
    return null ;
  }

}

function logUrl($imgUrl){
  $insertArray=array(
          'request'=>$imgUrl
        );

        DB::table('log')->insert($insertArray);
}


  function sendContactUsEmail(Array $data){   
        

      $data = array(
        'name' => $data['name'],
        'email' => $data['email'],
        'mobile_number'=> $data['mobile_number'],
        'enquiryType'=> $data['enquiryType'] ,
        'message_text'=>$data['message_text']
      );


         Mail::send('emails.contactusEmail', $data, function($message) use ($data) {
            $contactus_email = config('constants.contactus_email');
          $to=$contactus_email ; //"amit.shukla@intigate.in" ;  
          $recieverName = "Amit Shukla" ;
          $subject = 'Contact Us' ;
          $message->to($to,$recieverName)->subject($subject);
                    
        });
        if (Mail::failures()) {
          return true ;
         }else{
          return true ;
         }
   }

  function chatMessageNotification(){
      $data=session()->get('user_session');
      $friendList=getFriendListUserId($data['userId']);

       
        $unfriendUser=DB::table("messages")->where("from",$data['userId'])->groupby("to")->get()->pluck('to')->toArray();
        $unfriendUser_=DB::table("messages")->where("to",$data['userId'])->groupby("from")->get()->pluck('from')->toArray();
        $chatUser=array_unique(array_merge($unfriendUser,$unfriendUser_,$friendList));        

        $users = DB::table("users")->select(DB::raw("count(is_read) as unread "))->leftjoin("messages",function($join){
            $join->on('users.id','=','messages.from')->where('is_read',0)->where('messages.to',Auth::id());
        })->where('users.id','!=',Auth::id())
        ->whereIn('users.id',$chatUser)->orderby('is_read','Desc')
        ->groupBy('is_read')->first();     

        return isset($users->unread)?$users->unread:0 ;

  }

  function groupUnreadMessge(){
      $data=session()->get('user_session');
      $userId=$data['userId'] ;
       $groupList = DB::select("select sum(unread) as unread from (select (select count(*) from group_messages where group_id=groups.id and user_id=group_participants.user_id
            and is_read = 0) as unread from `groups` inner JOIN  group_participants ON groups.id = group_participants.group_id 
        where group_participants.user_id=".$userId."
        and group_participants.isBlock = 0
        group by groups.id, groups.group_name) as g");  

      return isset($groupList[0]->unread)?$groupList[0]->unread:0 ;
    
  }

  function userProfileImgPath(){      
      $s3BaseURL = config('constants.s3_baseURL');
      $user_profile_img_s3 = config('constants.user_profile_img_s3');

      return $s3BaseURL.$user_profile_img_s3 ;
  }

    function postImgPath(){      
      $s3BaseURL = config('constants.s3_baseURL');
      $user_post_s3 = config('constants.user_post_s3');

      return $s3BaseURL.$user_post_s3 ;
  }
  
   function eventImgPath(){      
      $s3BaseURL = config('constants.s3_baseURL');
      $event_image = config('constants.event_image');

      return $s3BaseURL.$event_image ;
  }

  function goodiesImgPath(){      
      $s3BaseURL = config('constants.s3_baseURL');
      $goodies_image = config('constants.goodies_image');

      return $s3BaseURL.$goodies_image ;
  }

   function storiesImgPath(){      
      $s3BaseURL = config('constants.s3_baseURL');
      $user_stories_s3 = config('constants.user_stories_s3');

      return $s3BaseURL.$user_stories_s3 ;
  }

?>
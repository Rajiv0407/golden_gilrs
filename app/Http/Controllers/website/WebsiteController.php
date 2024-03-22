<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\website\PrivacyController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserProfile; 
use App\Models\EventImage;
use App\Models\PostLike;
use App\Models\EventLike;
use App\Models\GoodiesLike;  
use App\Models\CommentLike;
use App\Models\GoodiesComment;  
use App\Models\GoodiesReply;
use App\Models\GoodiesCommentLike;  
use App\Models\GoodiesReplyLike; 
use App\Models\Goodies;     
use App\Models\ReplyLike;  
use App\Models\Event;
use App\Models\Notification;
use App\Models\EventView;
use App\Models\GoodiesView;      
use App\Models\Stories;  
use App\Models\EventCommentLike;      
use App\Models\EventComment;
use App\Models\EventReplyCommentLike;
use App\Models\EventReply;    
use App\Models\Post;
use App\Models\Comment; 
use App\Models\FriendList;     
use App\Models\Follow;
use App\Models\PostImage;
use App\Models\BookingRequest;  
use App\Models\ReplyComment;  
use App\Models\user_follow;  
use File;
use Hash;  
use Session ;
use DB ;
use Auth ;
use Image ;
use Cookie;
use Config;  
use Carbon\Carbon;
use App\Helper;
use Pusher\Pusher;
use DateTime;
use Thumbnail ;
use VideoThumbnail ;


/////
class WebsiteController extends Controller
{

	 protected $privacyController;
 
    public function __construct(PrivacyController $privacyController)
    {
        $this->follow = new Follow;
        $this->privacyController = $privacyController;

    }
    public function index(Request $request){

        $data=session()->get('user_session');
        if(!empty($data)){  
			return redirect('/home');   
		}

    	$url=Url('/').'/public/website/logo/flag_london.png' ;
    	session()->put('defaultCountry', array('image'=>$url,'value'=>5,'name'=>'UK'));
    	

      if($request->hasCookie('userName') != false){
        $data['userName']=Cookie::get('userName') ;
      }else{
        $data['userName']="" ;
      }

      if($request->hasCookie('userPassword') != false){
         $data['userPassword']=Cookie::get('userPassword') ;
      }else{
         $data['userPassword']="" ;
      }
	  
    	return view('/login');  
    }

    public function resetPassword(Request $request){
    	$url=Url('/').'/public/website/logo/flag_london.png' ;
    	session()->put('defaultCountry', array('image'=>$url,'value'=>5,'name'=>'UK'));
  		$encryption=$request->encryption ; 
    	return view('/resetPassword')->with('encryption',$encryption);  
    }

    public function following_page(Request $request){     
        $data=session()->get('user_session');

		if(empty($data)){  
			return redirect('/');   
		}
		
		$type=isset($request->type)?$request->type:0 ;
		$user_id=$request->id;
     	$array=aboutInfo($user_id);
		$followFollowerCount=getFollowerAndFollowing($user_id);
		
		$array['users']['following_count']=isset($followFollowerCount['total_following'])?$followFollowerCount['total_following']:0; 

		$array['users']['followers_count']=isset($followFollowerCount['total_follower'])?$followFollowerCount['total_follower']:0; 


		$following_info=getFollowing($user_id);
        $followers_Info=getFollowerList($user_id);

    
        // echo "<pre>";
        // print_r($followers_Info);
        // exit ;
        	
    	return view('website.pages.following.following_page',$array)->with("following",$following_info)->with("followers",$followers_Info)->with('type',$type);        
    }
	
	public function about(Request $request,$id=0){
        $data=session()->get('user_session');
		if(empty($data)){  
			return redirect('/');   
		}
       
		 $user_id=isset($id)?$id:0;
	
  //       $user_id=$request->id;
  //       if($user_id==="undefined"){
  //       	return true ;
  //       }

		// $array=aboutInfo($user_id);
       
         
  //        if($data['userId']!=$id){
  //        	$isFriend=checkIsFriendOrNot($data['userId'],$id);  
  //        }else{
  //        	$isFriend=0 ;
  //        } 
        
  //        $array['users']['isFriend']=$isFriend;
  //        $country=DB::table('countries')->select('id','name')->get()->toArray();
      		
    	//return view('website.pages.Profile.about',$array)->with('country',$country);     

    	return view('website.pages.Profile.about')->with('userId',$user_id);
    }
	
	public function delete_myphoto(Request $request){

			$deleteType=isset($request->deleteType)?$request->deleteType:0 ;
			$deleteId=isset($request->id)?$request->id:0 ;

			if($deleteType > 0 && $deleteId > 0 && $deleteType==1){
				$postData=DB::table("post_images")->where('id',$deleteId)->first();
				$postFile=isset($postData->image)?$postData->image:'' ;
				$postThumb=isset($postData->thumbnail)?$postData->thumbnail:'' ;
				$postId=isset($postData->post_id)?$postData->post_id:'' ;
				
				 $imgPath='app/public/post_image/'.$postId.'/'.$postFile ;
				 $thumbPath='app/public/post_image/'.$postId.'/'.$postThumb ;
		         $unlinkPath = storage_path($imgPath) ;
		         $unlinkPath_ = storage_path($thumbPath) ;
	            do_upload_unlink(array($unlinkPath,$unlinkPath_));
				DB::table('post_images')->where('id',$deleteId)->delete();
			}else if($deleteType > 0 && $deleteId > 0 && $deleteType==2){
				$postData=DB::table("user_profile_image")->where('id',$deleteId)->first();
				$postFile=isset($postData->image)?$postData->image:'' ;
				$imageType=isset($postData->image_type)?$postData->image_type:'' ;

				if($imageType==1){
				  $imgPath='app/public/user_image/'.$postFile ;	
				  $unlinkPath = storage_path($imgPath) ;
				  do_upload_unlink(array($unlinkPath));			 
				}else if($imageType==2){
				  $imgPath='app/public/banner_image/'.$postFile ;
				  $unlinkPath = storage_path($imgPath) ;
				  do_upload_unlink(array($unlinkPath));		
				}
				
				DB::table('user_profile_image')->where('id',$deleteId)->delete();
			}
	}

	public function deleteVideo(Request $request){
			$deleteId=isset($request->id)?$request->id:0 ;
			$postData=DB::table("post_images")->where('id',$deleteId)->first();
			$postFile=isset($postData->image)?$postData->image:'' ;
			$postThumb=isset($postData->thumbnail)?$postData->thumbnail:'' ;
			$postId=isset($postData->post_id)?$postData->post_id:'' ;

			 $imgPath='app/public/post_image/'.$postId.'/'.$postFile ;
			 $thumbPath='app/public/post_image/'.$postId.'/'.$postThumb ;
	         $unlinkPath = storage_path($imgPath) ;
	         $unlinkPath_ = storage_path($thumbPath) ;
	          do_upload_unlink(array($unlinkPath,$unlinkPath_));

			if($deleteId > 0)
			DB::table('post_images')->where('id',$deleteId)->delete();

			
	}



	public function myphoto(Request $request,$id=0){  

		$data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$id;    	      	
	      	$page = $request->has('page') ? $request->get('page') : 1;
	        $limit = $request->has('per_page') ? $request->get('per_page') :21;
	        $offset = ($page - 1) * $limit ;

	      $postImgPath=url('/').'/storage/app/public/post_image/' ;
	      $loginUserId=$data['userId'];
	      $profileCoverImgPath=url('/').'/storage/app/public/banner_image/' ;
	      $profileImgPath=url('/').'/storage/app/public/user_image/' ;
		  $usrPCImg=DB::table('user_profile_image')->select('id',DB::raw("case when image_type=2 then concat('".$profileCoverImgPath."',image) else concat('".$profileImgPath."',image) end as image"),DB::raw("'image' as image_type"),DB::raw(" 2 as deleteType"))->where('userId',$user_id)
		  	;

		  $friendQuery="(select count(*) from user_follows where ((followed_user_id=$loginUserId and follower_user_id=post_images.user_id) or 
		 (followed_user_id=post_images.user_id and follower_user_id=$loginUserId)) and isAccept=1)" ;
		  $typeQry = DB::table('post_images')->select('post_images.id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),'image_type',DB::raw(" 1 as deleteType"))
		   ->leftjoin('posts','posts.id','=','post_images.post_id')
		   ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	       ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)		  
		  ->where('post_images.user_id',$user_id)->where('image_type','image')->union($usrPCImg)->orderBy('id','DESC')->skip($offset)->take($limit)
		    ->get()->toArray();

				 
	      $response=$typeQry ; // array_merge($typeQry,$usrPCImg);

	      $totalRecord=DB::table('post_images')->select('post_images.id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),'image_type',DB::raw(" 1 as deleteType"))
	      ->leftjoin('posts','posts.id','=','post_images.post_id')
		   ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	       ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)	
	      ->where('post_images.user_id',$user_id)->where('image_type','image')->union($usrPCImg)->count();
		    	
	      if(($offset+$limit) < $totalRecord){
		  $data['isShowMore']=true ;  
		}else{
		  $data['isShowMore']=false ;  
		}

         $data['page']=$page ; 
         $data['user_id']=$user_id ;
         $data['loginUserId']=$data['userId'] ;



		return view('website.pages.Profile.Photos')->with('post_image',$response)->with('data',$data); 

	  }else{
		 return redirect('/');  
	  } 
	 }
	 

	 	public function ajax_myphoto(Request $request,$id=0){  

		$data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$id;    
	      	
	      	$page = $request->has('page') ? $request->get('page') : 1;
	        $limit = $request->has('per_page') ? $request->get('per_page') : 21;
	        $offset = ($page - 1) * $limit ;
	      
  
		   
	        
		 

	        $loginUserId=$data['userId'] ;
	      $postImgPath=url('/').'/storage/app/public/post_image/' ;

	      $profileCoverImgPath=url('/').'/storage/app/public/banner_image/' ;
	      $profileImgPath=url('/').'/storage/app/public/user_image/' ;
		  $usrPCImg=DB::table('user_profile_image')->select('id',DB::raw("case when image_type=2 then concat('".$profileCoverImgPath."',image) else concat('".$profileImgPath."',image) end as image"),DB::raw("'image' as image_type"),DB::raw(" 2 as deleteType"))->where('userId',$user_id);
		   $friendQuery="(select count(*) from user_follows where ((followed_user_id=$loginUserId and follower_user_id=post_images.user_id) or 
		 (followed_user_id=post_images.user_id and follower_user_id=$loginUserId)) and isAccept=1)" ;
		     $typeQry = DB::table('post_images')->select('post_images.id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),'image_type',DB::raw(" 1 as deleteType"))
		     ->leftjoin('posts','posts.id','=','post_images.post_id')
		     ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
		      ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)		

		     ->where('post_images.user_id',$user_id)->where('image_type','image')->union($usrPCImg)->orderBy('id', 'DESC')->skip($offset)->take($limit)->get()->toArray();

		 
	         $response=$typeQry ; // array_merge($typeQry,$usrPCImg);

	       // $totalRecord=DB::table('post_images')->select('id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),'image_type',DB::raw(" 1 as deleteType"))->where('user_id',$user_id)->where('image_type','image')->union($usrPCImg)->count();
	         $totalRecord=DB::table('post_images')->select('post_images.id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),'image_type',DB::raw(" 1 as deleteType"))
	      ->leftjoin('posts','posts.id','=','post_images.post_id')
		   ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	       ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)	
	      ->where('post_images.user_id',$user_id)->where('image_type','image')->union($usrPCImg)->count();
		    	
	      if(($offset+$limit) < $totalRecord){
		  $data['isShowMore']=true ;  
		}else{
		  $data['isShowMore']=false ;  
		}

         $data['page']=$page ; 
         $data['user_id']=$user_id ;



		return view('website.pages.Profile.ajax_photo')->with('post_image',$response)->with('data',$data); 

	  }

	 }
	 public function myvedio(Request $request){  
		 
		$data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$request->id;  		
	  		$page = $request->has('page') ? $request->get('page') : 1;
	        $limit = $request->has('per_page') ? $request->get('per_page') :21;
	        $offset = ($page - 1) * $limit ;
	        $loginUserId=$data['userId'];
	      
	      /*
			Post privacy
case when (p.user_id!=$loginUserId && post_type=3) then 0 else 1 end as onlymePrivacy
	     
	(case when (post_type=2 && p.user_id!=$loginUserId)  then $friendQuery else 1 end)=1

	      */
		 $friendQuery="(select count(*) from user_follows where ((followed_user_id=$loginUserId and follower_user_id=post_images.user_id) or 
		 (followed_user_id=post_images.user_id and follower_user_id=$loginUserId)) and isAccept=1)" ;
		  $postImgPath=url('/').'/storage/app/public/post_image/' ;
	      $typeQry = DB::table('post_images')->select('post_images.id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),DB::raw("concat('".$postImgPath."',post_id,'/',thumbnail) as thumbnail"),'image_type','posts.post_type')
	      	 ->leftjoin('posts','posts.id','=','post_images.post_id')
	         ->where('post_images.user_id',$user_id)
	         ->where('image_type','video')
	         ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	         ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)
	         ->orderBy('post_images.id', 'DESC')
	         ->skip($offset)
	         ->take($limit)
	         ->get()
	         ->toArray();	  

	          $totalRecord = DB::table('post_images')
	      	 ->leftjoin('posts','posts.id','=','post_images.post_id')
	         ->where('post_images.user_id',$user_id)
	         ->where('image_type','video')
	         ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	         ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)
	         ->orderBy('post_images.id', 'DESC')	        
	         ->count();
	        	  
	       //$totalRecord=DB::table('post_images')->where('user_id',$user_id)->where('image_type','video')->count();
		    	
	    if(($offset+$limit) < $totalRecord){
		  $data['isShowMore']=true ;  
		}else{
		  $data['isShowMore']=false ;  
		}

         $data['page']=$page ; 
         $data['user_id']=$user_id ;
         $data['loginUserId']=$data['userId'] ;

		return view('website.pages.Profile.Videos')->with('post_image',$typeQry)->with('data',$data); 
	  }else{
		 return redirect('/');  
	  } 
	 }

	 public function ajax_myvideo(Request $request,$id=0){  

		$data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$id;    
	      	
	      	$page = $request->has('page') ? $request->get('page') : 1;
	        $limit = $request->has('per_page') ? $request->get('per_page') :21;
	        $offset = ($page - 1) * $limit ;
	        $loginUserId=$data['userId'];

         
	      // $typeQry = DB::table('post_images')->select('id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),DB::raw("concat('".$postImgPath."',post_id,'/',thumbnail) as thumbnail"),'image_type')->where('user_id',$user_id)->where('image_type','video')->orderBy('id', 'DESC')->skip($offset)->take($limit)->get()->toArray();	  

	      //  $totalRecord=DB::table('post_images')->where('user_id',$user_id)->where('image_type','video')->count();
	       $friendQuery="(select count(*) from user_follows where ((followed_user_id=$loginUserId and follower_user_id=post_images.user_id) or 
		 (followed_user_id=post_images.user_id and follower_user_id=$loginUserId)) and isAccept=1)" ;
		  $postImgPath=url('/').'/storage/app/public/post_image/' ;
	      $typeQry = DB::table('post_images')->select('post_images.id',DB::raw("concat('".$postImgPath."',post_id,'/',image) as image"),DB::raw("concat('".$postImgPath."',post_id,'/',thumbnail) as thumbnail"),'image_type','posts.post_type')
	      	 ->leftjoin('posts','posts.id','=','post_images.post_id')
	         ->where('post_images.user_id',$user_id)
	         ->where('image_type','video')
	         ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	         ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)
	         ->orderBy('post_images.id', 'DESC')
	         ->skip($offset)
	         ->take($limit)
	         ->get()
	         ->toArray();	  

	          $totalRecord = DB::table('post_images')
	      	 ->leftjoin('posts','posts.id','=','post_images.post_id')
	         ->where('post_images.user_id',$user_id)
	         ->where('image_type','video')
	         ->where(DB::raw("case when (posts.post_type=3 and posts.user_id!=$loginUserId) then 0 else 1 end"),1)
	         ->where(DB::raw("case when (posts.post_type=2 and posts.user_id!=$loginUserId) then $friendQuery else 1 end"),1)
	         ->orderBy('post_images.id', 'DESC')	        
	         ->count();
	        	  
		    	
	      if(($offset+$limit) < $totalRecord){
		  $data['isShowMore']=true ;  
		}else{
		  $data['isShowMore']=false ;  
		}

         $data['page']=$page ; 
         $data['user_id']=$user_id ;      

		return view('website.pages.Profile.ajax_myvideo')->with('post_image',$typeQry)->with('data',$data); 

	  }

	 }
	 
	 public function myevent(Request $request,$id=0){  
		$data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$id;

			//echo $user_id;die;
		 $booking_info=BookingRequest::where('user_id',$user_id)->where('user_id',$user_id)->where('booking_type',1)->get();
		 //echo "<pre>";print_r($booking_info);die; 
		 $res=array();
		 $res1=array();
		 if(!empty($booking_info)){
			 foreach($booking_info as $booking_infos){
			  $user_info=User::where('id',$booking_infos->user_id)->first();
			  $event_info=Event::where('id',$booking_infos->type_id)->first();
			  if(empty($event_info)){
			  	continue ;
			  }
			  //echo "<pre>";print_r($event_info);die; 
			  $order['name']=$user_info->first_name.' '.$user_info->last_name;
			  $order['event_name']=$event_info->event_name;
			  $order['event_address']=$event_info->address;
			  $order['order_id']=$booking_infos->id;
			  $order['no_ticket']=$booking_infos->number_of_ticket;
			  if($booking_infos->status == 1){
				$order['order_status']='Pending';  
			  }else if($booking_infos->status == 2){
			     $order['order_status']='Approved';
		      }else{
				 $order['order_status']='Cancelled'; 
			  }
			  $order['order_date']=date('D, d M Y ', strtotime($booking_infos->created_at));
			   if($event_info->event_fee_type == 1){
				$order['event_fee_type']='Paid';
			  }else{
				$order['event_fee_type']='Free';
			  }
			  $imageData = DB::table('event_images')->where('event_id',$booking_infos->type_id)->first();	   
			  $order['image']=url('/').'/storage/app/public/event_image/'.$imageData->image;
					  
			  $res[]=!empty($order)?$order:"";
			 } 
		 }
		 
		 $goodies_info=BookingRequest::where('user_id',$user_id)->where('user_id',$user_id)->where('booking_type',2)->get();
		 //echo "<pre>";print_r($booking_info);die; 
		 $res1=array();  
		 if(!empty($goodies_info)){
			 foreach($goodies_info as $goodies_info){
			  $user_info1=User::where('id',$goodies_info->user_id)->first();
			  $goodies_data=Goodies::where('id',$goodies_info->type_id)->first();
			  //echo "<pre>";print_r($event_info);die; 
			  $god['name']=$user_info1->first_name.' '.$user_info1->last_name;
			  $god['goodies_name']=isset($goodies_data->title)?$goodies_data->title:'';
			  $god['goodies_address']=isset($goodies_data->goodies_address)?$goodies_data->goodies_address:'';
			  $god['order_id']=isset($goodies_info->id)?$goodies_info->id:'';
			  $god['no_ticket']=isset($goodies_info->number_of_ticket)?$goodies_info->number_of_ticket:'';
			  if($goodies_info->status == 1){
				$god['order_status']='Pending';  
			  }else if($goodies_info->status == 2){
			     $god['order_status']='Approved';
		      }else{
				 $god['order_status']='Cancal'; 
			  }
			  $god['order_date']=date('D, d M Y ', strtotime($goodies_info->created_at));
			   if(isset($goodies_data->goodies_fee_type) && $goodies_data->goodies_fee_type == 1){
				$god['goodies_fee_type']='Paid';
			  }else{
				$god['goodies_fee_type']='Free';
			  }
			  if(isset($goodies_data->image)){
			  	$god['image']=url('/').'/storage/app/public/goodies_image/'.$goodies_data->image;
			  }else{
			  	$god['image']='';
			  }
			   	  
			  $res1[]=!empty($god)?$god:"";
			 } 
		 }
		 
		//echo "<pre>";print_r($res);die; 
		 //echo "<pre>";print_r($res);die; 
		//  $data['type']=0 ;

		// $method = $request->method();

		// if ($request->isMethod('post')) {
		// 	   $data['type']=1 ;
		// 	}
		 // if (Request::isMethod('post'))
			// {
			//   
			// }

		 return view('website.pages.myevent.myevent1')->with('order',$res)->with('god_order',$res1)->with('type',$data);  
		}else{
			return redirect('/');   
		}  
    }
	
	public function Signup(Request $request){
 
    $first_name=isset($request->first_name)?$request->first_name:'' ;
	$last_name=isset($request->last_name)?$request->last_name:'' ;
    $email = isset($request->email)?$request->email:'' ;
    $dob = isset($request->dob)?$request->dob:'' ;
    $mobile_number = isset($request->mobile_number)?$request->mobile_number:'';
	$nationality	 = isset($request->nationality)?$request->nationality:'';
	$password1 = isset($request->password)?$request->password:'';
    $password = isset($request->password)?$request->password:'';
    $date = date("Y-m-d H:i:s");  
    $password =  Hash::make($password);

    
    try{   

 		

        $insertData=array(       
        'first_name'=>$first_name ,
		'last_name'=>$last_name ,
        'email'=>$email,
        'dob'=>$dob ,
        'phone'=>$mobile_number ,		
        'nationality'=>$nationality , 
        'password'=>$password ,
        'created_at'=>$date           
	    ); 
		 
        $data1=array(
		'name'=>$first_name.' '.$last_name,
		'email'=>$email,
		'pass'=>$password1   
		);		 

         if($email==''){
        	return checkResponse([],'Invalid Request');  
        }

        $data=DB::table('users')->where('email',$email)->first();
        

		if(!empty($data)){
		   return checkResponse([],'Email id already exists');  
		}else{   
         $user_info=User::create($insertData);

         $encryptionId=md5('Intgoldengirls'.$user_info->id).time() ;
    		DB::table('users')->where('id',$user_info->id)->update(['encryption'=>$encryptionId]);

    		$user = User::find($user_info->id);
				Auth::login($user);
				
		   $isSendMail = config('constants.isSendMail');
		   if($isSendMail==1){
		   	$da=sendRegistrationToEmail($data1);
		   }
		//

		 //
		 $insertProfile=array(
        'user_id'=>$user_info['id'],
        'created_at'=>$date		
	    ); 
		$profile_info=UserProfile::create($insertProfile);
		$userId = $user_info['id'] ;
       	$userType = $user_info['user_type'];
		$date = date("Y-m-d H:i:s");
		$updateData=array(
        'login_date' => $date,
		'login_status'=>2, 
		'isOnline'=>1	      
        );  
		DB::table('users')->where('id',$userId)->update($updateData);
		if(!empty($user->image)){
		    $image=url('/').'/storage/app/public/user_image/'.$user->image;	
		}else{
			$image=url('/').'/storage/app/public/user_image/'.'user_holder.svg';
		}
         $session_data = array('userId' => $userId,
                                'userType' => $userType,
                                'userFirstName' =>$user_info['first_name'],
								'userLastName' =>$user_info['last_name'],
                                'userEmail' =>$user_info['email'],
                                'image' =>$image,								
                                );
         Session::put('user_session', $session_data);           
         
        return successResponse([],'Save successfully');

	  }  
    }
     catch(\Exception $e)
    { 
      //echo $e ; exit ;
	//echo "<pre>";print_r($user_info);die;  
      return  errorResponse('error occurred'.$e); 
    }  
     
  }
  
    public function notification_list($id=null){
		
		$noti_info = DB::table('notification')->where('reciver_id',$id)->where('is_read',1)->orderBy('id', 'desc')->limit(3)->get();
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
		 
		$friend_info = DB::table('friend_list')->where('request_id',$id)->where('status',1)->orderBy('id', 'desc')->limit(3)->get();
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
		return view('website.notification')->with('notification',$res)->with('friend_request',$res2)->with('count',$count);      
		
		   
	}
	public function notification($id=null){  
		

		$data=session()->get('user_session');
		if(empty($data)){  
			return redirect('/');   
		}
		$user_id=$data['userId'];
		 
			$array=aboutInfo($user_id);

			DB::table('notification')->where('reciver_id',$user_id)->update(['is_read'=>2]);
		$noti_info = DB::table('notification')->where('reciver_id',$id)->orderBy('id', 'desc')->get();
		
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
				$not['message']=$noti_infos->message;
				$not['id']=$noti_infos->id;
				$not['senderId']=$noti_infos->sender_id;
				$not['type']=$noti_infos->type;
				$not['time']=!empty($elapsed)?$elapsed:"";
				$res[]=!empty($not)?$not:"";
			
			}
		}
		 
		
		 $count= count($res) ; 
		 $current_date=date("Y-m-d H:i:s");  
             $my_story_info = DB::table('stories')->where('user_id',$user_id)->where('created_at','<=',$current_date)->where('till_valid','>=',$current_date)->count();
        
		return view('website.notification1',$array)->with('notification',$res)->with('count',$count)->with('story_count',$my_story_info);      	   
	

	}
   
	
	public function accept_request($id=null){

		$data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
		
		$friend_info=DB::table('friend_list')->where('id',$id)->where('status',1)->first();
		 $date=date("Y-m-d H:i:s");
		 $updatedData=array(
				'status'=>2,
				'updated_at'=>$date           
				); 	
		  $updatestatus=DB::table('friend_list')->where('id',$id)->update($updatedData);
        if($updatestatus){
            $this->send_notification($friend_info->request_id,$friend_info->user_id,4); 
			$total_count=notification_count($data['userId']);
              $res['count']=!empty($total_count)?$total_count:"";
			  $res['status']=1;	 		
             return $res;    
		}else{
             echo 2;
        }
		
		
	}
	
	public function read_notification($id=null){
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
        $date=date("Y-m-d H:i:s");
		 $updatedData=array(
				'is_read'=>2,
				'updated_at'=>$date           
				); 	
		  $updatestatus=DB::table('notification')->where('id',$id)->update($updatedData);
        if($updatestatus){
              $total_count=notification_count($data['userId']);
              $res['count']=!empty($total_count)?$total_count:"";
			  $res['status']=1;	
			  return $res;     
		}else{
             echo 2;
        }  			
		
	   
	}
  //
	public function upcoming_event(Request $request){
         
        $typeQry = "select * from events where status=1" ; 
         $eventData = DB::select($typeQry);
		 if(!empty($eventData)){
			foreach($eventData as $eventDatas){
				
                  $image_info = DB::table('event_images')->where('event_id', $eventDatas->id)->first(); 
				  $event['id']=$eventDatas->id;
				  $event['event_name']=$eventDatas->event_name;
				  $event['event_type']=$eventDatas->event_type;
				  $event['event_start_date']=date("F m,Y", strtotime($eventDatas->event_date));
                  $event['month']=date("F", strtotime($eventDatas->event_date));
                  $event['day']=date("m", strtotime($eventDatas->event_date));
                  $event['day_name']=date("l", strtotime($eventDatas->event_date));
				  $event['event_end_date']=$eventDatas->event_date;
				  $event['event_descrption']=$eventDatas->event_descrption;
                  $event['address']=$eventDatas->address;
				  $event['image']=url('/').'/storage/app/public/event_image/'.$image_info->image;
				  $res[]=!empty($event)?$event:"";

			}				
			 
		 }
    	return view('/upcoming_event')->with('event_info',$res);  
    }

    public function home(Request $request){
    	
     	$data=session()->get('user_session');
		// if(empty($data)){  
		// 	return redirect('/');   
		// }

		$user_id=$data['userId'];      

	    $array=aboutInfo($user_id);
			 			
		$get_neartest_follow=peopleYouMayKnow(2);
		$usrImgPath=url('/').'/storage/app/public/user_image/' ;
		$defaultPath=url('/').'/storage/app/public/user_image/'.'no-img.png' ;	

		

		$query=DB::table("user_follows")->select('users.id',DB::raw("concat(first_name,' ',last_name) as name"),DB::raw("case when image is null then concat('".$defaultPath."') else concat('".$usrImgPath."',image) end as image"))->join('users','users.id','=','user_follows.follower_user_id')->where('user_follows.followed_user_id',$user_id)->where('isAccept',1)->where('login_status',2)->get()->toArray();
	    $query1=DB::table("user_follows")->select('users.id',DB::raw("concat(first_name,' ',last_name) as name"),DB::raw("case when image is null then concat('".$defaultPath."') else concat('".$usrImgPath."',image) end as image"))->join('users','users.id','=','user_follows.followed_user_id')->where('user_follows.follower_user_id',$user_id)->where('isAccept',1)->where('login_status',2)->get()->toArray();
	
//
	     $res=array_merge($query,$query1);

		/* story info */
		 $current_date=date("Y-m-d H:i:s");
		
		$sImgPath = URL('/').'/storage/app/public/stories_image/' ;
		$friend=getFriendListUserId($user_id);  

		$story_infos_ = DB::table('stories')->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when stories.image is null then '' else concat('".$sImgPath."',stories.image) end as image"),DB::raw(" count(*) as totalStory"),'file_type')
		->leftjoin('users','users.id','=','stories.user_id')		
		->where('user_id','!=',$user_id)->where('stories.created_at','<=',$current_date)->where('stories.till_valid','>=',$current_date)
		->whereIn('stories.user_id',$friend)
		->groupBy('users.id')->get()->toArray();
	
          
		
		 $my_story_info_ = DB::table('stories')->where('user_id',$user_id)->where('created_at','<=',$current_date)->where('till_valid','>=',$current_date);
		 $my_story_info=$my_story_info_->count();
		 $myStoryImg = $my_story_info_->get()->first() ;
		 $myStoryImage = isset($myStoryImg->image)?$myStoryImg->image:'' ;
		  $storiesType = isset($myStoryImg->file_type)?$myStoryImg->file_type:1 ;

		 if($myStoryImage!='' && $my_story_info > 0){
		 	$mSImg = URL('/').'/storage/app/public/stories_image/'.$myStoryImage ;
		 }else{
		 	$mSImg = $array['users']['image'] ;
		 }					 
			
		 

			
		   echo view('index',$array)->with('online_contact',$res)->with('get_neartest_follow',$get_neartest_follow)->with('story_count',$my_story_info)->with('selfStoryImg',$mSImg)->with('storiesType',$storiesType)->with('stories_info',$story_infos_);  


    }

	public function home_page(Request $request){ 

		$data=session()->get('user_session');

		if(empty($data)){  
			return redirect('/');   
		}

		$user_id=$data['userId'];
	 $requestUserId = isset($request->userId)?$request->userId:0 ;
	 if($requestUserId > 0){
	 	$user_id=$requestUserId ;
	 }


	 $type = isset($request->type)?$request->type:0 ;
	 $cond="";
	 if($type==1){
	 	$cond=" && p.user_id=".$user_id ;
	 }

	 
  		
  	  $page = $request->has('page') ? $request->get('page') : 1;
      $limit = $request->has('per_page') ? $request->get('per_page') : 10;
      $offset = ($page - 1) * $limit ;

         $loginUserId=$data['userId'] ;
		
         $friendList=array(111);


		$array=array();  

		  $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';

		 $postLike=" case when (select count(*) from post_like where post_id=p.id and status=1) is null then 0 else (select count(*) from post_like where post_id=p.id and status=1) end as post_like_count " ;	 
		 $youLikeOrNot = " case when (select count(*)  from post_like where post_id=p.id and status=1 and user_id=$user_id limit 1) is null then 'No' when (select count(*) from post_like where post_id=p.id and status=1 and user_id=$user_id limit 1) > 0 then 'Yes' else 'No' end as user_post_is_like  "  ;
		 $postCommentCount= " (select count(*) from comments where post_id=p.id) as commentCount " ;
		 $replyCommentCount = " (select count(*) from reply_comments where post_id=p.id) as replyCount ";
		 $friendQuery="(select count(*) from user_follows where ((followed_user_id=$loginUserId and follower_user_id=p.user_id) or 
		 (followed_user_id=p.user_id and follower_user_id=$loginUserId)) and isAccept=1)" ;
		 $cond1=" and (case when (post_text='' and (select count(*) from post_images where post_id=p.id)=0) then 0 else 1 end)=1" ;

		 $typeQry = "select p.id as postId,p.user_id,concat(u.first_name,' ',u.last_name) as name ,case when u.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',u.image) end as user_image ,post_text,post_type,$postLike , $postCommentCount ,$replyCommentCount,  $youLikeOrNot,p.created_at,case when (p.user_id!=$loginUserId && post_type=3) then 0 else 1 end as onlymePrivacy from posts as p left join users as u on u.id=p.user_id where (case when (p.user_id!=$loginUserId && post_type=3) then 0 else 1 end)=1 $cond && (case when (post_type=2 && p.user_id!=$loginUserId)  then $friendQuery else 1 end)=1 $cond1 order by p.id desc LIMIT $limit OFFSET $offset" ; 
		 
         $postData = DB::select($typeQry);
        
         $response=array() ;

        
         if(!empty($postData)){
         	foreach($postData as $key => $value) {
         		   $post=array();			 
				 
				  $total_count=$value->commentCount+$value->replyCount; 
				  $date = Carbon::parse($value->created_at);
				  $elapsed = $date->diffForHumans(Carbon::now());
				  $elapsed=createdAt($elapsed);

				  if($value->post_type==1){
				  	$text='public.png';
				  }else if($value->post_type==2){
				  	$text='friends.png';
				  }else{
				  	$text='only_me.png';
				  }

				  $post['id']=$value->postId;
				  $post['post_user_id']=$value->user_id;
				  $post['session_user_id']=$user_id;
				   $post['privacy']=$value->post_type;
				  $post['name']=$value->name;
				  $post['post_text']=$value->post_text;
				  $post['post_type']=$text;
				  $post['post_like_count']=$value->post_like_count;
				  $post['post_comment_count']=$total_count;                  
                  $post['post_share_url']=url('/').'/postDetail/'.$value->postId ;	
				  $post['time']=$elapsed;
				  $post['user_image']=$value->user_image;
				  $post['session_image']=$value->user_image;
				  $post['user_post_is_like']=$value->user_post_is_like ;
				
                 $postImagePath=url('/').'/storage/app/public/post_image/'.$value->postId.'/' ;					
				  $imgQry = "select id,image_type as file_type,concat('".$postImagePath."',image) as image,concat('".$postImagePath."',thumbnail) as thumbnail from post_images where post_id=".$value->postId; 
				  
                  $imageData = DB::select($imgQry);
                  $post['post_image']=!empty($imageData)?$imageData:array();            
				  $post['post_like_listing']=($value->post_like_count > 0)?array("total_like"=>$value->post_like_count):array();
				  if($value->post_text=='' && empty($post['post_image'])){
				  	continue ;
				  }
				  $response[]=$post ;
         	}
         }

        $loginUserId=isset($data['userId'])?$data['userId']:0 ;       

        if($type==1){
        	 $totalRecord=Post::select('id')        	
        	  ->leftjoin('users','users.id','=','posts.user_id')
        	   ->where(DB::raw("(case when (post_text='' and (select count(*) from post_images where post_id=posts.id)=0) then 0 else 1 end)"),1)
        	  ->where('posts.user_id',$user_id)->count();   
        }else{
        	 $totalRecord=Post::select('id')
        	 ->leftjoin('users','users.id','=','posts.user_id')
        	  ->where(DB::raw("(case when (post_text='' and (select count(*) from post_images where post_id=posts.id)=0) then 0 else 1 end)"),1)    
        	 ->count();   
        }

       
		
		if(($offset+$limit) < $totalRecord){
		  $data['isShowMore']=true ;  
		}else{
		  $data['isShowMore']=false ;  
		}

         $data['page']=$page ; 
         $data['type']=$type ;
         $data['loginUserId']=$data['userId'] ;
         $data['requestId']=$requestUserId ;
         
         if($page==1){
         	 return view('ajax_index')->with('loingUserId',$loginUserId)->with('post_info',$response)->with('data',$data);  
         	}else{
         return view('home_page_loadmore')->with('loingUserId',$loginUserId)->with('post_info',$response)->with('data',$data);  
         	}
		  
           			   
		  
    }

    


    public function mutual_friend1($id=null){
     
		 $query="SELECT u.id, u.first_name,COUNT(f3.request_id) mutual_friends FROM friend_list f1
					INNER JOIN friend_list f2 ON f2.user_id = f1.request_id
					INNER JOIN users u ON u.id= f2.user_id
					LEFT JOIN friend_list f3 ON f3.user_id = f1.user_id AND f3.request_id = f2.request_id
					WHERE f1.user_id = $id
					GROUP BY u.id, u.first_name";
	$mutual_friend = DB::select($query);
	 return $mutual_friend;

    }

   public function  mutual_friend($id=null,$ids=null){
     
		 $query="SELECT  COUNT(DISTINCT(request_id)) AS mutual_friend_count FROM friend_list  WHERE request_id in (SELECT request_id FROM friend_list WHERE user_id = $id and status=2)  AND request_id in (SELECT request_id FROM friend_list WHERE user_id = $ids and status=2)";
		 //echo $query;die; 
	$mutual_friend = DB::select($query);
	//echo "<pre>";print_r($mutual_friend[0]->mutual_friend_count);die; 
	 return $mutual_friend;

    }	
	public function post_like($id=null){
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}  
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $post_id=$id;
		 $post_like_info = DB::table('post_like')->where('user_id',$user_id)->where('post_id',$post_id)->first();
		 if(!empty($post_like_info)){ 
			 if($post_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'post_id'=>$post_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('post_like')->where('user_id',$user_id)->where('post_id',$post_id)->update($updatedData);
		 

		  if($updatestatus){
			  $post_like_count= DB::table('post_like')->where('post_id', $post_id)->where('status',1)->count();
			  $res['count']=!empty($post_like_count)?$post_like_count:"";
			  $res['status']=$status;
			  return $res;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'post_id'=>$post_id ,
				'status'=>1 ,
				'created_at'=>$date           
				); 
        $insertmember = PostLike::create($insertData);
        if($insertmember){
           $post_like_count= DB::table('post_like')->where('post_id', $post_id)->where('status',1)->count();
           $post_user_id= DB::table('posts')->where('id', $post_id)->first();
           if($post_user_id->user_id!=$user_id){
           		$this->send_notification($user_id,$post_user_id->user_id,2,$post_id);
           }
           

		      $res['count']=!empty($post_like_count)?$post_like_count:"";
			  $res['status']=1;
			  return $res;
		}else{
           echo 2;  
        }			
		
	   }
	}
	
	public function post_delete($id=null){
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
         $post_id=$id;		
         $directory='/app/public/post_image/'.$post_id ;
		 try{
		
		
		 $post_delete= DB::table('posts')->where('id',$post_id)->delete();
		 $post_profile_delete= DB::table('post_images')->where('post_id',$post_id)->delete();

		  File::deleteDirectory(storage_path($directory));
		 if($post_delete){
			 echo 1;
		 }else{
			 echo 2; 
		 }

		}catch(\Exception $e)
		    { 
		  	 echo $e;
		    }  
		      
	}
	
	public function post_comment_delete($id=null){  
		 $data=session()->get('user_session');
         if(empty($data)){  
			return redirect('/');   
		 }	  	 
         $post_comment_id=$id;		 
		 $post_commnet_delete= DB::table('comments')->where('id',$post_comment_id)->delete();
		 $post_profile_delete= DB::table('reply_comments')->where('comment_id',$post_comment_id)->delete();
		 if($post_comment_id){  
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}
	  
	public function reply_comment_delete($id=null){  
		 $data=session()->get('user_session');
         if(empty($data)){  
			return redirect('/');   
		}  		 
         $reply_comment_id=$id;		 
		 $reply_commnet_delete= DB::table('reply_comments')->where('id',$reply_comment_id)->delete();
		 if($reply_commnet_delete){  
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}
	
	public function Post_listing(Request $request){ 
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
		 //print_r($data['userId']);die; 
		 $user_id=$data['userId'];
		 $typeQry = "select * from posts order by id desc" ; 
         $postData = DB::select($typeQry);
		 $res=array();
		 $reply_comment_count=0;  
		 if(!empty($postData)){
			foreach($postData as $postDatas){ 
				  $user_info = DB::table('users')->where('id', $postDatas->user_id)->first();
				  $session_user_info = DB::table('users')->where('id', $user_id)->first();
				  $post_like_count= DB::table('post_like')->where('post_id', $postDatas->id)->where('status',1)->count();				  
				  $post_comment_count= DB::table('comments')->where('post_id', $postDatas->id)->count();
				  $reply_comment_count= DB::table('reply_comments')->where('post_id',$postDatas->id)->count(); 
				 
				  $total_count=$post_comment_count+$reply_comment_count;  
				  //echo "<pre>";print_r($post_like_count);die; 
				  $date = Carbon::parse($postDatas->created_at);
				  $elapsed = $date->diffForHumans(Carbon::now());
				  $elapsed=createdAt($elapsed);
				  $post['id']=$postDatas->id;
				  $post['post_user_id']=$postDatas->user_id;
				  $post['session_user_id']=$user_id;
				  $post['name']=$user_info->first_name .' '. $user_info->last_name;
				  $post['post_text']=$postDatas->post_text;
				  $post['post_type']=$postDatas->post_type;
				  $post['post_like_count']=!empty($post_like_count)?$post_like_count:"";
				  $post['post_comment_count']=!empty($total_count)?$total_count:"";  
				  $post['time']=$elapsed;
				  unset($total_count);
				  if($user_info->image){
							$post['user_image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
							}else{
							 $post['user_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
							}
                  if($session_user_info->image){  
						$post['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $post['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						} 							
				  $imgQry = "select * from post_images where post_id=".$postDatas->id; 
                  $imageData = DB::select($imgQry);
				  foreach($imageData as $imageDatas){  
				  $image[]=url('/').'/storage/app/public/post_image/'.$imageDatas->image;
				  //$image['post_id']=$postDatas->id;
				  //$post_image[]=$image;
				  }
				  $post['image']=!empty($image)?$image:"";
				  //unset($post_image);
				  $res[]=!empty($post)?$post:"";

			}				
			 
		 } 
		 //echo "<pre>";print_r($res);die; 
		 return  response()->json(['post_info'=>$res]);
		  //echo view('index')->with('post_info',$res);  
    }
	
	
	public function postDetails(Request $request,$id){
		
		$data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}

		 $imageId=isset($request->imageId)?$request->imageId:0 ;	

		 $reply_comment_count=0; 
		 $user_id=$data['userId'];
		 $post_info = DB::table('posts')->select(DB::raw(" concat(users.first_name,' ',users.last_name) as name"),'posts.id','posts.user_id','posts.post_text','posts.created_at')->leftjoin('users','users.id','=','posts.user_id')->where('posts.id', $id)->first();	

		  $date = Carbon::parse($post_info->created_at);
		  $elapsed = $date->diffForHumans(Carbon::now());
		  $elapsed=createdAt($elapsed);

		 $post['name']=isset($post_info->name)?$post_info->name:'' ;
		 $post['post_id']=isset($post_info->id)?$post_info->id:'' ;
		 $post['user_id']=isset($post_info->user_id)?$post_info->user_id:'';
		 $post['post_text']=isset($post_info->post_text)?$post_info->post_text:"";

		 $post['time']=$elapsed;

		
		 $imgPath = url('/').'/storage/app/public/post_image/'.$post_info->id.'/' ;
		 $imgQry = DB::table('post_images')->select('id',DB::raw("case when id=$imageId then 1 else 0 end as selectImg"),'post_id',DB::raw("concat('".$imgPath."',image) as image"),DB::raw("case when thumbnail='' || thumbnail is null then '' else concat('".$imgPath."',thumbnail) end as thumbnail"),DB::raw('image_type as file_type'))->where('post_id',$post_info->id) ->orderBy('selectImg', 'desc')->get()->toArray();
       
		 $post['post_image']=!empty($imgQry)?$imgQry:"";

			return view('postDetails')->with('post_details',$post);

		 }
         		 
	public function Goodies_listing(Request $request){   
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
		 //print_r($data['userId']);die; 
		 $user_id=$data['userId'];
		 $defaultCountry=getDefaultCountryInfo('value');
		 $defCountry=" ";
		 if($defaultCountry > 0){
		 	 $defCountry=" where country=".$defaultCountry ;
		 }
		 $typeQry = "select * from goodies  $defCountry order by id desc" ; 
         $goodiesData = DB::select($typeQry); 
		 $res=array(); 
		 $reply_comment_count=0;  
		 if(!empty($goodiesData)){
			foreach($goodiesData as $goodiesDatas){ 
				  
				 $god['id']=$goodiesDatas->id;
				 $god['title']=$goodiesDatas->title;
				 $god['goodies_address']=$goodiesDatas->goodies_address ;
				 $god['goodies_seats']=$goodiesDatas->goodies_seats ;
				 $god['goodies_fee_type']=$goodiesDatas->goodies_fee_type ;
				 $god['goodies_date']=$goodiesDatas->goodies_date ;
				 $god['goodies_descrption']=$goodiesDatas->goodies_descrption ;
				 $god['start_date']=$goodiesDatas->start_date;
				 $god['end_date']=$goodiesDatas->end_date;
				 if(!empty($goodiesDatas->image)){
				   $god['image']=url('/').'/storage/app/public/goodies_image/'.$goodiesDatas->image; 
				 }else{
					 $god['image']='';
				 }
				 $res[]=!empty($god)?$god:"";  
				 
			}					 
		 } 
		 //echo "<pre>";print_r($res);die; 
		 return  response()->json(['goodies_info'=>$res]);  
		  //echo view('index')->with('post_info',$res);
    }
	
	public function event_listing(Request $request){
		$data=session()->get('user_session');
		//echo "<pre>";print_r($request);die;
		if(empty($data)){  
			return redirect('/');   
		}  
		   $date=date("Y-m-d H:i:s");
		   
		    $sqlquery = [];
            $querydata = "";
            if(@$request['s_event_name'])
            {
             $sqlquery[] = "event_name LIKE '".trim($request['s_event_name'])."%'";
            }

            // echo "<pre>";
            // print_r($request->all());
            
            // exit ;
			if(@$request['sEvent_country'])
            {
             $sqlquery[] = "country=".$request['sEvent_country'];
            }
			if(@$request['s_event_city'])
            {
            	if(!empty($request['s_event_city'])){
            		$city_ = [] ;
            	foreach ($request['s_event_city'] as $key => $value) {
            		$city_[]=$value ;
            	}

             	$city1_ = implode(',',$city_);
             	$sqlquery[] = "city in (".$city1_.")";
            	}
             
            }
			
            if(@$request['s_event_date'])
            {
              $pp = date('Y-m-d',strtotime(trim($request['s_event_date'])));
              $sqlquery[] = "DATE(event_date) = '".$pp."'";   
            }
			if(@$request->status == 'all'){
				  //$sqlquery[]="event_fee_type=1 or event_fee_type=3";
			}else if($request->status == 'paid'){
				  $sqlquery[]="event_fee_type=1 ";
			}else{
				 $sqlquery[]="event_fee_type=3";       
			}
            if(!empty($sqlquery)) 
            {
             $querydata = " and ".implode(' and ',$sqlquery);
            }
					 $defaultCountry=getDefaultCountryInfo('value');
			$defCountry=" ";
			if($defaultCountry > 0){
			   $defCountry=" and country=".$defaultCountry ;
			}
		$typeQry = "select *,case when (select name from countries where id=country and status=1) is null then '' else (select name from countries where id=country and status=1) end as country,case when (select name from cities where id=city and status=1) is null then '' else (select name from cities where id=city and status=1) end as city from events where status=1 $defCountry and event_date >= '$date' $querydata order by id desc" ;

	 
       //echo $typeQry;die; 		
	    $eventData = DB::select($typeQry);
	    $res=array();
		$total=0;
		    if(!empty($eventData)){
				foreach($eventData as $eventDatas){ 
					  $user_info = DB::table('users')->where('id',1)->first();
					  $session_user_info = DB::table('users')->where('id', $data['userId'])->first();
					  $event_like_count= DB::table('event_like')->where('event_id', $eventDatas->id)->where('status',1)->count();
					  $user_event_like_yes_not= DB::table('event_like')->where('event_id', $eventDatas->id)->where('user_id', $data['userId'])->where('status',1)->first();
					   if(!empty($user_event_like_yes_not)){
						 $event['user_is_like']="Yes";  
					   }else{
						   $event['user_is_like']="No"; 
					   }
					  $event_comment_count= DB::table('event_comments')->where('event_id', $eventDatas->id)->count();
				      $event_reply_comment_count= DB::table('event_reply')->where('event_id',$eventDatas->id)->count();
					  $event_view_count = DB::table('event_view')->where('event_id', $eventDatas->id)->count();	
                      $total=$event_comment_count+$event_reply_comment_count;					  
					  $date = Carbon::parse($eventDatas->event_date);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					  $event['id']=$eventDatas->id;
					  if(isset($user_info->first_name)){
					  	$firstName=$user_info->first_name ;
					  }else{
					  	$firstName='' ;
					  }

					  if(isset($user_info->last_name)){
					  	$lastName=$user_info->last_name ;
					  }else{
					  	$lastName='' ;
					  }

					  $event['name']=$firstName .' '. $lastName;
					  $event['event_name']=$eventDatas->event_name;
					  $event['event_descrption']=$eventDatas->event_descrption;
					  $event['event_price']=$eventDatas->event_price;
					  $event['event_date']=date('D, d M Y ', strtotime($eventDatas->event_date));
					  $event['country']=$eventDatas->country;
				     $event['city']=$eventDatas->city;  
					  $event['event_time']=date('g:i A', strtotime($eventDatas->event_date));
					  $event['start_date']=date('D, d M Y ', strtotime($eventDatas->event_start_date));
                      $event['end_date']=date('D, d M Y ', strtotime($eventDatas->event_end_date));
					  $event['status']=$eventDatas->status;    
					  $event['tab_status']=$request->status;  
					  $event['event_fee_type']=$eventDatas->event_fee_type;  
					  $event['address']=$eventDatas->address;
					  $event['event_comment_count']=!empty($total)?$total:"";   
					  $event['event_like_count']=!empty($event_like_count)?$event_like_count:"";
					  $event['time']=$elapsed;
					  $event['event_view_count']=!empty($event_view_count)?$event_view_count:"";
					  $event['share_url']=url('/').'/eventDetails/'.$eventDatas->id;
					  $imageData = DB::table('event_images')->where('event_id',$eventDatas->id)->first();
					  
					  $event_info = DB::table('event_like')->where('event_id',$eventDatas->id)->where('status',1)->orderBy('id', 'desc')->get(); 
					$res7=array();
					foreach($event_info as $event_infos){
						 $event_user_info = DB::table('users')->where('id',$event_infos->user_id)->first();
						  $like['name']=$event_user_info->first_name; 
						//   .' '.$post_user_info->last_name
						  $res7[]=$like;   
					}
					$event['event_like_listing']=!empty($res7)?$res7:"";
                    unset($res7);

                      					  
                      if($session_user_info->image){  
						$event['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $event['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						} 					  
					  if(!empty($imageData )){  
					  $event['image']=url('/').'/storage/app/public/event_image/'.$imageData->image;
					  }else{
						  
					  }
					  $res[]=!empty($event)?$event:"";
				}				 
		    } //echo "<pre>";print_r($res);die; 
		 return  response()->json(['event_info'=>$res]);  
    }
	
	public function event_save_comment(Request $request){ 
            $data=session()->get('user_session');
		if(empty($data)){  
			return redirect('/');   
		}
			//echo "<pre>";print_r($request->all());die;
		    $comment=isset($request->comment)?$request->comment:'' ;
			$event_id=isset($request->event_id)?$request->event_id:'' ;
			$type=isset($request->type)?$request->type:0 ;
			$date = date("Y-m-d H:i:s");
			if($type==0){
			$insertData=array(
				'comment'=>$comment ,
				'user_id'=>$data['userId'],
				'event_id'=>$event_id,
				'created_at'=>$date	
			);
			$insertmember = EventComment::create($insertData);
			}
				$commentQry = "select * from event_comments where event_id='$event_id' order by id desc" ;
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
				
				        $reply_comment = DB::table('event_reply')->where('comment_id',$commentDatas->id)->orderBy('id', 'desc')->get();
						$reply=array();
						$res1=array();
					    if(!empty($reply_comment)){  
						 foreach($reply_comment as $reply_comments){
							 
							 $reply_like_count= DB::table('event_reply_comment_like')->where('reply_id',$reply_comments->id)->where('status',1)->count();
							 
							 $date1 = Carbon::parse($reply_comments->created_at);
							  $elapsed1 = $date1->diffForHumans(Carbon::now());
							  $elapsed1=createdAt($elapsed1);
                             $user_info1 = DB::table('users')->where('id',$reply_comments->user_id)->first();
                            $reply['comment_id']=$reply_comments->comment_id;
							$reply['id']=$reply_comments->id;
							$reply['user_id']=$reply_comments->user_id;
							$reply['session_user_id']=$data['userId'];    
							$reply['reply_comment']=$reply_comments->comment;
							$reply['name']=$user_info1->first_name .' '. $user_info1->last_name;
							$reply['time']=$elapsed1;
							$reply['event_id']=$event_id;
							$reply['reply_like_count']=$reply_like_count; 
							if($user_info1->image){
							$reply['image']=url('/').'/storage/app/public/user_image/'.$user_info1->image;
							}else{
							 $reply['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
							}
							$res1[]=!empty($reply)?$reply:"";
                         }							 
								
						}
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  $session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  $comment_count = DB::table('event_comments')->where('event_id',$event_id)->count();
					  $reply_count = DB::table('event_reply')->where('event_id',$event_id)->count();
					  $reply_yes = DB::table('event_reply')->where('comment_id',$commentDatas->id)->count();
					  $comment_likes = DB::table('event_comment_likes')->where('comment_id',$commentDatas->id)->where('status',1)->count();
					  $reply_comment_count= DB::table('event_reply')->where('comment_id',$commentDatas->id)->count();
					  //print_r($reply_yes);
					  if($reply_yes > 0){
						 $comment['is_comment']='Yes'; 
					  }else{
						  $comment['is_comment']='No';
					  }
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['event_id']=$commentDatas->event_id;
					$comment['user_id']=$commentDatas->user_id;
					$comment['session_user_id']=$session_user_info->id;  
					$comment['comment']=$commentDatas->comment;
					$comment['comment_count']=$comment_count+$reply_count;
					$comment['time']=$elapsed;
					$comment['comment_likes']=!empty($comment_likes)?$comment_likes:"0"; 
                    $comment['reply_comment_count']=!empty($reply_comment_count)?$reply_comment_count:"0";		  			
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if($session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						} 
						$comment['reply_info']=$res1;
                        						
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 
				return  response()->json(['comment_info'=>$res]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	
	public function save_event_reply_comment(Request $request){ 
            $data=session()->get('user_session');
			if(empty($data)){  
			return redirect('/');   
		    }
			//echo "<pre>";print_r($request->all());die;
		    $reply_comment=isset($request->reply_comment)?$request->reply_comment:'' ;
			$comment_id=isset($request->comment_id)?$request->comment_id:'' ;
			$event_id=isset($request->event_id)?$request->event_id:'' ;
			$date = date("Y-m-d H:i:s");
			
			$insertData=array(
				'comment'=>$reply_comment ,
				'user_id'=>$data['userId'],
				'comment_id'=>$comment_id,
				'event_id'=>$event_id,
				'created_at'=>$date	
			);
			$insertmember = EventReply::create($insertData);   
				
				$commentQry = "select * from reply_comments where comment_id=$comment_id order by id desc" ;
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  $session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  $comment_count = DB::table('reply_comments')->where('comment_id',$comment_id)->count();
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['comment_id']=$commentDatas->comment_id;
					$comment['reply_comment']=$commentDatas->comment;
					$comment['comment_count']=!empty($comment_count)?$comment_count:"";
					$comment['time']=$elapsed;
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if($session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}  
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 
				return  response()->json(['comment_info'=>$res]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	
	public function event_like($id=null){  
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }  
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $event_id=$id;
		 $event_like_info = DB::table('event_like')->where('user_id',$user_id)->where('event_id',$event_id)->first();
		 if(!empty($event_like_info)){ 
			 if($event_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'event_id'=>$event_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('event_like')->where('user_id',$user_id)->where('event_id',$event_id)->update($updatedData);
		  if($updatestatus){  
			  echo $status;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'event_id'=>$event_id ,
				'status'=>1 ,
				'created_at'=>$date           
				); 
        $insertmember = EventLike::create($insertData);
        if($insertmember){
           echo 1;
		}else{
           echo 2;
        }			
		
	   }
	}
	
	public function event_comment_like($id=null){  
		 $data=session()->get('user_session');
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $comment_id=$id;
		 $event_commment_like_info = DB::table('event_comment_likes')->where('user_id',$user_id)->where('comment_id',$comment_id)->first();
		 if(!empty($event_commment_like_info)){ 
			 if($event_commment_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'comment_id'=>$comment_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('event_comment_likes')->where('user_id',$user_id)->where('comment_id',$comment_id)->update($updatedData);
		  if($updatestatus){
			 $comment_count = DB::table('event_comment_likes')->where('comment_id',$comment_id)->where('status',1)->count();
			 echo $comment_count;die; 
           return $comment_count;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'comment_id'=>$comment_id ,
				'status'=>1 ,
				'created_at'=>$date             
				); 
        $insertmember = EventCommentLike::create($insertData); 
        if($insertmember){
			$comment_count = DB::table('event_comment_likes')->where('comment_id',$comment_id)->where('status',1)->count();
           return $comment_count;
		}else{
           echo 2;
        }			
		
	   }
	}
	
	public function event_reply_comment_like($id=null){  
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }  
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $reply_comment_id=$id; 
		 $comment_like_info = DB::table('event_reply_comment_like')->where('user_id',$user_id)->where('reply_id',$reply_comment_id)->first();      
		 if(!empty($comment_like_info)){ 
			 if($comment_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'reply_id'=>$reply_comment_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('event_reply_comment_like')->where('user_id',$user_id)->where('reply_id',$reply_comment_id)->update($updatedData);
		  if($updatestatus){
			  echo 1;
			
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'reply_id'=>$reply_comment_id, 
				'status'=>1,
				'created_at'=>$date           
				); 
        $insertmember = EventReplyCommentLike::create($insertData);
        if($insertmember){
			echo 1;
		}else{
           echo 2;
        }			
		
	   }
	}
	
	public function event_comment_delete($id=null){    
		 $data=session()->get('user_session');
         if(empty($data)){  
			return redirect('/');   
		 }		 
         $post_comment_id=$id;		 
		 $post_commnet_delete= DB::table('event_comments')->where('id',$post_comment_id)->delete();
		 $post_profile_delete= DB::table('event_reply')->where('comment_id',$post_comment_id)->delete();
		 if($post_comment_id){  
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}
	
	public function event_reply_comment_delete($id=null){  
		 $data=session()->get('user_session'); 
         if(empty($data)){  
			return redirect('/');   
		 }  		 
         $reply_comment_id=$id;		 
		 $reply_commnet_delete= DB::table('event_reply')->where('id',$reply_comment_id)->delete();
		 $reply_like_delete= DB::table('event_reply_comment_like')->where('reply_id',$reply_comment_id)->delete();  
		 if($reply_commnet_delete){  
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}
	
	public function comment_like($id=null){  
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $comment_id=$id;
		 $event_like_info = DB::table('comment_likes')->where('user_id',$user_id)->where('comment_id',$comment_id)->first();
		 if(!empty($event_like_info)){ 
			 if($event_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'comment_id'=>$comment_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('comment_likes')->where('user_id',$user_id)->where('comment_id',$comment_id)->update($updatedData);
		  if($updatestatus){
			 $comment_count = DB::table('comment_likes')->where('comment_id',$comment_id)->where('status',1)->count();
			 echo $comment_count;die; 
           return $comment_count;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'comment_id'=>$comment_id ,
				'status'=>1 ,
				'created_at'=>$date           
				); 
        $insertmember = CommentLike::create($insertData);
        if($insertmember){
			$comment_count = DB::table('comment_likes')->where('comment_id',$comment_id)->where('status',1)->count();
           return $comment_count;
		}else{
           echo 2;
        }			
		
	   }
	}
	
	public function reply_comment_like($id=null){  
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }  
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $reply_comment_id=$id; 
		 $comment_like_info = DB::table('reply_likes')->where('user_id',$user_id)->where('reply_id',$reply_comment_id)->first();      
		 if(!empty($comment_like_info)){ 
			 if($comment_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'reply_id'=>$reply_comment_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('reply_likes')->where('user_id',$user_id)->where('reply_id',$reply_comment_id)->update($updatedData);
		  if($updatestatus){
			 $comment_count = DB::table('reply_likes')->where('reply_id',$reply_comment_id)->where('status',1)->count();
			// echo $comment_count;die; 
           return $comment_count;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'reply_id'=>$reply_comment_id, 
				'status'=>1,
				'created_at'=>$date           
				); 
        $insertmember = ReplyLike::create($insertData);
        if($insertmember){
			$comment_count = DB::table('reply_likes')->where('reply_id',$reply_comment_id)->where('status',1)->count();
           return $comment_count;
		}else{
           echo 2;
        }			
		
	   }
	}

    public function event_delete($id=null){
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }
         $event_id=$id;		 
		 $event_delete= DB::table('events')->where('id',$event_id)->delete();
		 $event_image_delete= DB::table('event_images')->where('event_id',$event_id)->delete();
		 if($event_delete){
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}

    public function profile_image_upload(Request $request){
		//echo "<pre>";print_r($request->all());die;
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}

		$user_id = $data['userId'] ;//isset($request->user_id)?$request->user_id:'' ;
	   try{
    
	   // if($request->hasFile('myfile')){
    //             $imgPath='/public/user_image';       
    //             $filenamewithextension = $request->file('myfile')->getClientOriginalName();
    //              $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    //              //get file extension
    //              $extension = $request->file('myfile')->getClientOriginalExtension();
    //              $filename=str_replace(' ', '_', $filename);
    //              $filenametostore = $filename.'_'.time().'.'.$extension;          
    //              //Upload File
    //              $request->file('myfile')->storeAs($imgPath,$filenametostore);
    //             $updateData['image']=$filenametostore; 
    //       }
      
		 
		 	$filenametostore = 'profileImg'.$user_id.'_'.time().'.png';
        //$smallthumbnailpath = public_path('storage/user_image/'.$filenametostore);
        $smallthumbnailpath = storage_path('app/public/user_image/'.$filenametostore);
    	Image::make(file_get_contents($request->image))->save($smallthumbnailpath);

      	
      	$updateData['image']=$filenametostore; 


		

          $request->session()->forget('user_session.image');    
           User::where('id',$user_id)->update($updateData); 
           	$image=url('/').'/storage/app/public/user_image/'.$updateData['image'];
            $request->session()->put('user_session.image', $image);	 
            /* Profile Image*/ 
	          $profileImg=array(
	     			'userId'=>$user_id ,
	     			'image'=>$updateData['image'] ,
	     			'image_type'=>1 
	     		);
	       $this->saveProfileImage($profileImg);
           echo $image;                                                            
	     }
           catch(\Exception $e){
          echo 2; 
         
        }  		  

     }

     public function saveProfileImage($data){     	
     	
     	if(!empty($data) && isset($data['userId']) && isset($data['image_type']) && isset($data['image'])){
     		DB::table('user_profile_image')->where(['userId'=>$data['userId'] ,'image_type'=>$data['image_type']])->update(['status'=>0]);
     		$insertData=array(
     			'userId'=>$data['userId'] ,
     			'image'=>$data['image'] ,
     			'image_type'=>$data['image_type'] ,
     			'status'=>1
     		);
     		DB::table('user_profile_image')->insert($insertData);
     	}
     		

     }
	 
	public function save_comment(Request $request){ 
            $data=session()->get('user_session');
			// if(empty($data)){  
			// 	return redirect('/');   
			// }

			///echo "<pre>";print_r($request->all());die;

		    $comment=isset($request->comment)?$request->comment:'' ;
			$post_id=isset($request->post_id)?$request->post_id:'' ;
			$type=isset($request->type)?$request->type:0 ;
			$date = date("Y-m-d H:i:s");
			if(!empty($data) && $type==0){
			$insertData=array(
				'comment'=>$comment ,
				'user_id'=>$data['userId'],
				'post_id'=>$post_id,
				'created_at'=>$date	
			);
			$insertmember = Comment::create($insertData);
            $post_user_id= DB::table('posts')->where('id', $post_id)->first();
            if($post_user_id->user_id!=$data['userId']){
            	 $this->send_notification($data['userId'],$post_user_id->user_id,3,$post_id);
            }
           
			}		
				$limitCond="";
				if($type==2){
					$page = $request->has('page') ? $request->get('page') : 1;
				    $limit = $request->has('per_page') ? $request->get('per_page') : 2;
				    $offset = ($page - 1) * $limit ;
				    $limitCond="LIMIT $limit OFFSET $offset" ;
				}
				
				

				$commentQry = "select * from comments where post_id=$post_id order by id desc $limitCond " ;
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
				
				        $reply_comment = DB::table('reply_comments')->where('comment_id',$commentDatas->id)->orderBy('id', 'desc')->get();
						$reply=array();
						$res1=array();
					    if(!empty($reply_comment)){
						 foreach($reply_comment as $reply_comments){
							 
							 $reply_like_count= DB::table('reply_likes')->where('reply_id',$reply_comments->id)->where('status',1)->count();
							 
							 $date1 = Carbon::parse($reply_comments->created_at);
							  $elapsed1 = $date1->diffForHumans(Carbon::now());
							  $elapsed1=createdAt($elapsed1);
                             $user_info1 = DB::table('users')->where('id',$reply_comments->user_id)->first();
                            $reply['comment_id']=$reply_comments->comment_id;
							$reply['id']=$reply_comments->id;
							$reply['user_id']=$reply_comments->user_id;
							$reply['session_user_id']=isset($data['userId'])?$data['userId']:0;    
							$reply['reply_comment']=$reply_comments->reply_comment;
							$reply['name']=$user_info1->first_name .' '. $user_info1->last_name;
							$reply['time']=$elapsed1;
							$reply['post_id']=$post_id;
							$reply['reply_like_count']=$reply_like_count; 
							if($user_info1->image){
							$reply['image']=url('/').'/storage/app/public/user_image/'.$user_info1->image;
							}else{
							 $reply['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
							}
							$res1[]=!empty($reply)?$reply:"";
                         }							 
								
						}
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  if(isset($data['userId'])){
					  	$session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  }else{
					  	$session_user_info = array();
					  }
					  
					  $comment_count = DB::table('comments')->where('post_id',$post_id)->count();
					  $reply_count = DB::table('reply_comments')->where('post_id',$post_id)->count();
					  $reply_yes = DB::table('reply_comments')->where('comment_id',$commentDatas->id)->count();
					  $comment_likes = DB::table('comment_likes')->where('comment_id',$commentDatas->id)->where('status',1)->count();
					  $reply_comment_count= DB::table('reply_comments')->where('comment_id',$commentDatas->id)->count();
					  //print_r($reply_yes);
					  if($reply_yes > 0){
						 $comment['is_comment']='Yes'; 
					  }else{
						  $comment['is_comment']='No';
					  }
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['post_id']=$commentDatas->post_id;
					$comment['user_id']=$commentDatas->user_id;
					$comment['session_user_id']=isset($session_user_info->id)?$session_user_info->id:0;  
					$comment['comment']=$commentDatas->comment;
					$comment['comment_count']=$comment_count+$reply_count;
					$comment['time']=$elapsed;
					$comment['comment_likes']=!empty($comment_likes)?$comment_likes:"0"; 
                    $comment['reply_comment_count']=!empty($reply_comment_count)?$reply_comment_count:"0";		  			
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if(isset($session_user_info->image) && $session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						} 
						$comment['reply_info']=$res1;
                        						
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 

				if($type==2){

				$totalRecord=Comment::select('id')->where('post_id',$post_id)->count();   


				if(($offset+$limit) < $totalRecord){
				  $data['isShowMore']=true ;  
				}else{
				  $data['isShowMore']=false ;  
				}

				$data['page']=$page+1 ; 
				$data['type']=$type ;
				$data['loginUserId']=isset($data['userId'])?$data['userId']:0 ;

			}else{
				$data=array();
			}

				return  response()->json(['comment_info'=>$res,'data'=>$data]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	

	public function ajax_comment(Request $request){ 
            $data=session()->get('user_session');
			// if(empty($data)){  
			// 	return redirect('/');   
			// }

			///echo "<pre>";print_r($request->all());die;



			$post_id=isset($request->post_id)?$request->post_id:'' ;
			$type=isset($request->type)?$request->type:0 ;
			$date = date("Y-m-d H:i:s");

			$page = $request->has('page') ? $request->get('page') : 1;
			$limit = $request->has('per_page') ? $request->get('per_page') : 2;
			$offset = ($page - 1) * $limit ;


		
			$commentQry = "select * from comments where post_id=$post_id order by id desc  LIMIT $limit OFFSET $offset" ;
			
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
				
				        $reply_comment = DB::table('reply_comments')->where('comment_id',$commentDatas->id)->orderBy('id', 'desc')->get();
						$reply=array();
						$res1=array();
					    if(!empty($reply_comment)){
						 foreach($reply_comment as $reply_comments){
							 
							 $reply_like_count= DB::table('reply_likes')->where('reply_id',$reply_comments->id)->where('status',1)->count();
							 
							 $date1 = Carbon::parse($reply_comments->created_at);
							  $elapsed1 = $date1->diffForHumans(Carbon::now());
							  $elapsed1=createdAt($elapsed1);
                             $user_info1 = DB::table('users')->where('id',$reply_comments->user_id)->first();
                            $reply['comment_id']=$reply_comments->comment_id;
							$reply['id']=$reply_comments->id;
							$reply['user_id']=$reply_comments->user_id;
							$reply['session_user_id']=isset($data['userId'])?$data['userId']:0;    
							$reply['reply_comment']=$reply_comments->reply_comment;
							$reply['name']=$user_info1->first_name .' '. $user_info1->last_name;
							$reply['time']=$elapsed1;
							$reply['post_id']=$post_id;
							$reply['reply_like_count']=$reply_like_count; 
							if($user_info1->image){
							$reply['image']=url('/').'/storage/app/public/user_image/'.$user_info1->image;
							}else{
							 $reply['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
							}
							$res1[]=!empty($reply)?$reply:"";
                         }							 
								
						}
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  if(isset($data['userId'])){
					  	$session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  }else{
					  	$session_user_info = array();
					  }
					  
					  $comment_count = DB::table('comments')->where('post_id',$post_id)->count();
					  $reply_count = DB::table('reply_comments')->where('post_id',$post_id)->count();
					  $reply_yes = DB::table('reply_comments')->where('comment_id',$commentDatas->id)->count();
					  $comment_likes = DB::table('comment_likes')->where('comment_id',$commentDatas->id)->where('status',1)->count();
					  $reply_comment_count= DB::table('reply_comments')->where('comment_id',$commentDatas->id)->count();
					  //print_r($reply_yes);
					  if($reply_yes > 0){
						 $comment['is_comment']='Yes'; 
					  }else{
						  $comment['is_comment']='No';
					  }
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['post_id']=$commentDatas->post_id;
					$comment['user_id']=$commentDatas->user_id;
					$comment['session_user_id']=isset($session_user_info->id)?$session_user_info->id:0;  
					$comment['comment']=$commentDatas->comment;
					$comment['comment_count']=$comment_count+$reply_count;
					$comment['time']=$elapsed;
					$comment['comment_likes']=!empty($comment_likes)?$comment_likes:"0"; 
                    $comment['reply_comment_count']=!empty($reply_comment_count)?$reply_comment_count:"0";		  			
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if(isset($session_user_info->image) && $session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						} 
						$comment['reply_info']=$res1;
                        						
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 



				$totalRecord=Comment::select('id')->where('post_id',$post_id)->count();   


				if(($offset+$limit) < $totalRecord){
				  $data['isShowMore']=true ;  
				}else{
				  $data['isShowMore']=false ;  
				}

				$data['page']=$page+1 ; 
				$data['type']=$type ;
				$data['loginUserId']=isset($data['userId'])?$data['userId']:0 ;

				return  response()->json(['comment_info'=>$res,'data'=>$data]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	public function save_reply_comment(Request $request){ 
            $data=session()->get('user_session');
					
			if(empty($data)){  
				return redirect('/');   
			}
			//echo "<pre>";print_r($request->all());die;
		    $reply_comment=isset($request->reply_comment)?$request->reply_comment:'' ;
			$comment_id=isset($request->comment_id)?$request->comment_id:'' ;
			$post_id=isset($request->post_id)?$request->post_id:'' ;
			$date = date("Y-m-d H:i:s");
			
			$insertData=array(
				'reply_comment'=>$reply_comment ,
				'user_id'=>$data['userId'],
				'comment_id'=>$comment_id,
				'post_id'=>$post_id,
				'created_at'=>$date	
			);
			$insertmember = ReplyComment::create($insertData);
				
				$commentQry = "select * from reply_comments where comment_id=$comment_id order by id desc" ;
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  $session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  $comment_count = DB::table('reply_comments')->where('comment_id',$comment_id)->count();
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['comment_id']=$commentDatas->comment_id;
					$comment['reply_comment']=$commentDatas->reply_comment;
					$comment['comment_count']=!empty($comment_count)?$comment_count:"";
					$comment['time']=$elapsed;
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if($session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}  
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 
				return  response()->json(['comment_info'=>$res]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}


public function postTest() {
    $data = Input::all();
    $png_url = "product-".time().".png";
    $path = public_path().'img/designs/' . $png_url;

    Image::make(file_get_contents($data->base64_image))->save($path);     
    $response = array(
        'status' => 'success',
    );
    return Response::json( $response  );
 }

    public function banner_upload(Request $request){
		
        $data=session()->get('user_session');		
		if(empty($data)){  
			return redirect('/');   
		}
		$user_id =$data['userId'] ;//isset($request->user_id)?$request->user_id:'' ;
	  
	try{

	   // if($request->hasFile('BannerUpload')){
    //             $imgPath='/public/banner_image';    
    //             $filenamewithextension = $request->file('BannerUpload')->getClientOriginalName();
    //              $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    //              //get file extension
    //              $extension = $request->file('BannerUpload')->getClientOriginalExtension();
    //              $filename=str_replace(' ', '_', $filename);
    //              $filenametostore = $filename.'_'.time().'.'.$extension;          
    //              //Upload File
    //              $request->file('BannerUpload')->storeAs($imgPath,$filenametostore);
    //             $updateData['banner_image']=$filenametostore; 
    //       }
      	

      	$filenametostore = 'bannerImg'.$user_id.'_'.time().'.png';
        //$smallthumbnailpath = public_path('storage/banner_image/'.$filenametostore);
        $smallthumbnailpath = storage_path('app/public/banner_image/'.$filenametostore);

    	Image::make(file_get_contents($request->image))->save($smallthumbnailpath);

      	
      	$updateData['banner_image']=$filenametostore;
      	 $updateData=array(
      		"user_id"=>$user_id,
      		"banner_image"=>$filenametostore
      	);
	      //echo "<pre>";print_r($updateData);die;

      	 $check=DB::table("user_profile")->where('user_id',$user_id)->count();
		    if($check==0){
		    	UserProfile::create($updateData);
		    }else{
		    	UserProfile::where('user_id',$user_id)->update($updateData);
		    }
           
   		   // $user_info=UserProfile::where('user_id',$user_id)->first();
   		   // print_r($user_info);
   		   // exit ;
		   if(1){

				$image=url('/').'/storage/app/public/banner_image/'.$filenametostore;
				
				$profileImg=array(
     			'userId'=>$user_id ,
     			'image'=>$filenametostore ,
     			'image_type'=>2 
     			);

       			$this->saveProfileImage($profileImg);

				}else{  
				 $image=url('/').'/storage/app/public/user_image/'.'banner_defualt.jpg';
				}
           echo $image;                                                   
	     }
           catch(\Exception $e){
          echo $e; 
         
        }  		  

     }

    

     public function stories_upload(Request $request){
		//echo "<pre>";print_r($request->all());die;
        $data=session()->get('user_session');
        $user_id=$data['userId'];
		$current_date=date("Y-m-d H:i:s");
        $valid_for_time = date("Y-m-d H:i:s", strtotime('+24 hours'));	
		if(empty($data)){  
			return redirect('/');   
		}
		$res=[];  
        	            	
	     
      try{ 
            if($request->hasFile('story_upload')) {
				$files = $request->file('story_upload');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0]; 
					$imgPath='/public/stories_image';  
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name . '.' . $ext;
					$file->storeAs($imgPath,$image_full_name);
                    $image=$image_full_name; 
					$input=array(
							'image'=>$image,
							'user_id'=>$user_id,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s"),
							'till_valid'=>$valid_for_time
						);
                    $insertstories=$insertmember = Stories::create($input);					
				  }
			   }
				 
                  echo 1;				  
	                                                     
	     }
           catch(\Exception $e){
          echo 2; 
         
        }  		  

     }
	 public function viewStoryModel($id=null){
		$data=session()->get('user_session');
        $user_id=$data['userId'];
		if(empty($data)){  
			return redirect('/');   
		}
		$res=[];
		$current_date=date("Y-m-d H:i:s");  
		$loginUserId=$data['userId'] ;
		
		if($loginUserId==$id){
			$addSelect="0 as is_like" ;
			$addSelect_="case when (select count(*) from stories_like where stories_like.story_id=stories.id and stories_like.user_id!=$loginUserId) is null then 0 else (select count(*) from stories_like where stories_like.story_id=stories.id and stories_like.user_id!=$loginUserId) end as viewSotry" ;
		}else{
			$addSelect="case when (select is_like from stories_like where stories_like.story_id=stories.id and stories_like.user_id=$loginUserId limit 1) is null then 0 else (select is_like from stories_like where stories_like.story_id=stories.id and stories_like.user_id=$loginUserId limit 1) end as is_like" ;
			$addSelect_="0 as viewSotry" ;
		}

		$story_infos = DB::table('stories')->select('stories.id','stories.user_id','stories.file_type','stories.image')
		->addSelect(DB::raw($addSelect))
		->addSelect(DB::raw($addSelect_))
		->where('user_id',$id)->where('created_at','<=',$current_date)->where('till_valid','>=',$current_date)->get();
			
			

			 if(!empty($story_infos)){
				foreach($story_infos as $key=>$story_info){

					if($key==0){
						 $content = new Request();
						 $content->type = 0;
						 $content->storyId = $story_info->id;
						 $content->storyView = 1;
						 $this->privacyController->story_like($content);
					}

					$user_info = DB::table('users')->where('id',$story_info->user_id)->first();
					$story['id']=$story_info->id;
					$story['file_type']=$story_info->file_type;
					$story['name']=$user_info->first_name.' '.$user_info->last_name;
					$story['file']=url('/').'/storage/app/public/stories_image/'.$story_info->image;
					$story['story_user_id']=$story_info->user_id;
					$story['session_id']=$user_id;
					$story['is_like']=$story_info->is_like;
					$story['viewSotry']=$story_info->viewSotry;
					$res[]=!empty($story)?$story:""; 
				}
			 }


         
		return view('view_story_model')->with('story',$res);
		
		 
	 }
	 
	 public function deleteStoryImage($id=null){
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }
		 $stroy_image_delete= DB::table('stories')->where('id',$id)->delete();
		 if($stroy_image_delete){
			 echo 1;
		 }else{
			 echo 2; 
		 }
		 
	 }
	 
	
	public function life_style(Request $request){

		$defaultCountry=getDefaultCountryInfo('value');

		$data=session()->get('user_session');
		if(!empty($data)){
      
        $user_id=$data['userId'];  
		$array=aboutInfo($user_id);  
        $countryList = DB::table("countries")->select('countries.id','countries.name')  
        ->where('countries.id',$defaultCountry)        
        ->get() ;
        
		return view('website/life_style',$array)->with('country_list',$countryList);
	 
	 }else{
		return redirect('/');  
	 }	

	}
	/**/
	public function eventDetails(Request $request){
		
		$data=session()->get('user_session');
		if(!empty($data)){
        $user_id=$data['userId'];
		$event_view_info = DB::table('event_view')->where('event_id', $request->id)->where('user_id', $user_id)->first();
		if(empty($event_view_info)){  
		$insertData=array(
				'event_id'=>$request->id,
				'user_id'=>$user_id,
				'created_at'=>date("Y-m-d H:i:s"),	
			);
		$insertmember = EventView::create($insertData);
        }
		
		$array=aboutInfo($user_id);

        $event_info = DB::table('events')->where('id', $request->id)->first();
		//echo "<pre>";print_r($event_info);die; 
		    if(!empty($event_info)){
                      $event_view_count = DB::table('event_view')->where('event_id', $request->id)->count();				
					  $date = Carbon::parse($event_info->event_date);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					  $event['id']=$event_info->id;
					  $event['event_name']=$event_info->event_name;
					  $event['event_descrption']=$event_info->event_descrption;
					  $event['event_price']=$event_info->event_price;
					  $event['event_date']=date('D, d M Y ', strtotime($event_info->event_date));
					  $event['event_day']=date('d' , strtotime($event_info->event_date));
					  $event['event_month']=date('M' , strtotime($event_info->event_date));
					  $event['event_time']=date('g:i A', strtotime($event_info->event_date));
					  $event['status']=$event_info->status;
					  $event['event_fee_type']=$event_info->event_fee_type;  
					  $event['address']=$event_info->address;
					  $event['time']=$elapsed;
					  $event['event_view_count']=!empty($event_view_count)?$event_view_count:"";  
					  $imageData = DB::table('event_images')->where('event_id',$event_info->id)->first();	
					  
					  if(!empty($imageData )){  
					  $event['image']=url('/').'/storage/app/public/event_image/'.$imageData->image;
					  }else{  
					  	$event['image']='' ;
					  }
			}
			
			    $data['ogurl']=URL('/').'/eventDetails/'.$event_info->id;
				$data['ogImage']=$event['image'] ;
				$data['ogdescription']=$event_info->event_descrption;
				$data['canonical']=URL('/') ;
             
        // eventDetails
				//eventDetail_share
		return view('website/eventDetails',$array)->with('event_info',$event)->with('data',$data);
	 }else{
		return redirect('/');  
	 }		 
	}
	
	public function goodiesDetails(Request $request){
		$data=session()->get('user_session');
		if(!empty($data)){
		$goodies_view_info = DB::table('goodies_view')->where('goodies_id', $request->id)->where('user_id',$data['userId'])->first();
		if(empty($goodies_view_info)){  
		$insertData=array(
				'goodies_id'=>$request->id,
				'user_id'=>$data['userId'],
				'created_at'=>date("Y-m-d H:i:s"),	
			);
		$insertmember = GoodiesView::create($insertData);
        }  
        $user_id=$data['userId'];
		$array=aboutInfo($user_id);
        $goodies_info = DB::table('goodies')->where('id', $request->id)->first();
		//echo "<pre>";print_r($event_info);die; 
		    if(!empty($goodies_info)){
                      $goodies_view_count = DB::table('goodies_view')->where('goodies_id', $request->id)->count();				
									
					  $date = Carbon::parse($goodies_info->goodies_date);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					  $goodies['id']=$goodies_info->id;
					  $goodies['goodies_name']=$goodies_info->title;
					  $goodies['goodies_descrption']=$goodies_info->goodies_descrption;
					  //$goodies['event_price']=$goodies_info->event_price;
					  $goodies['goodies_seats']=$goodies_info->goodies_seats;
					  $goodies['goodies_date']=date('D, d M Y ', strtotime($goodies_info->goodies_date));
					  $goodies['goodies_time']=date('g:i A', strtotime($goodies_info->goodies_date));
					  $goodies['status']=$goodies_info->status;
					  $goodies['goodies_fee_type']=$goodies_info->goodies_fee_type;  
					  $goodies['goodies_address']=$goodies_info->goodies_address;
					  $goodies['time']=$elapsed;
                      $goodies['goodies_view_count']=!empty($goodies_view_count)?$goodies_view_count:"";					  
					  if(!empty($goodies_info->image)){    
					  $goodies['image']=url('/').'/storage/app/public/goodies_image/'.$goodies_info->image;
					  }else{ 
					  $goodies['image']=''; 
					  }
			}


			  /* share data*/
				$data['ogurl']=URL('/').'/goodiesDetails/'.$goodies_info->id ;
				$data['ogImage']=$goodies['image'] ;
				$data['ogdescription']=$goodies_info->goodies_descrption ;
				$data['canonical']=URL('/') ;

				 /* end */

		return view('website/goodiesDetails',$array)->with('goodies_info',$goodies)->with('data',$data);  

	 }else{
		return redirect('/');  
	 }		 
	}

	public function Stories(){
		$data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
		return view('story_model');
		
		
	}

    public function addPhotoModal(){
		$data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
		return view('add_photo_modal');
		
		
	}

	public function addVideoModal(){
		$data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}

		return view('add_video_modal');
		
		
	}
	
	
	public function save_booking(Request $request){ 
	        //echo "<pre>";print_r($request->all());die; 
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
		    $no_ticket=isset($request->no_ticket)?$request->no_ticket:'' ;
			$type_id=isset($request->type_id)?$request->type_id:'' ;
			$booking_type=isset($request->booking_type)?$request->booking_type:'' ;
			$date = date("Y-m-d H:i:s");
			try{  
						$insertData=array(
						'number_of_ticket'=>$no_ticket ,
						'booking_type'=>$booking_type,
						'type_id'=>$type_id,  
						'user_id'=>$data['userId'],
						'created_at'=>$date	 
					    );
			
				$insertmember = BookingRequest::create($insertData);
				//print_r($insertmember);die; 
				if($insertmember){
					echo 1 ;
				//$booking_id=$insertmember->id;
				}else{
				echo 2;  	
				}
				
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	
	public function save_post(Request $request){ 
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}

		    $post_text=isset($request->post_text)?$request->post_text:'' ;
			$date = date("Y-m-d H:i:s");
			$postPrivacy=isset($request->post_Privacy)?$request->post_Privacy:3;
			$insertData=array(
				'post_text'=>$post_text ,
				'user_id'=>$data['userId'],
				'post_type'=>$postPrivacy,
				'created_at'=>$date	
			);
			// $insertmember = Post::create($insertData); 
			// echo "<pre>";print_r($insertmember);die;	
			 $d=array();
			try{
				$insertmember = Post::create($insertData);
				$post_id=$insertmember->id;
				if($request->hasFile('image')) {
				$files = $request->file('image');
				foreach ($files as $file) {	  
				    //$file_info = finfo_open(FILEINFO_MIME_TYPE);
                   // $mime_type = finfo_file($file_info, $file);
					$filenamewithextension = $file->getClientOriginalName(); 
                    $mime_type=$file->getMimeType() ;
					//$fileType = explode('/', $mime_type)[0]; 
					$fileType = $this->checkFileType($filenamewithextension);
					$imgPath='/public/post_image';  
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					/* new */
					$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
					$filename=str_replace(' ', '_', $filename);
					$image_full_name = $filename.'_'.time().'.'.$ext;     

					/* end */

					//$image_full_name =  $image_name . '.' . $ext;


					//$file->storeAs($imgPath,$image_full_name);
					$file->storeAs($imgPath.'/'.$post_id.'/',$image_full_name);

					
                    $image=$image_full_name; 

                     $isSendMail = config('constants.isSendMail');
		  
                   /* thumbnail */
                   //&&  $isSendMail==1
                     if($fileType=='image'){
               			$smallthumbnail = $filename.'_1200_1200_'.time().'.jpg';    
		               $file->storeAs('public/post_image/'.$post_id.'/', $smallthumbnail);
		              $smallthumbnailpath = storage_path('app/public').'/post_image/'.$post_id.'/'.$smallthumbnail ;
		               
		               // echo $smallthumbnailpath = public_path('storage/post_image/'.$post_id.'/'.$smallthumbnail);
		               
		              $this->createThumbnail($smallthumbnailpath, 1200, 1200);
             
              		}else if($fileType=='video' &&  $isSendMail==1){              	   
// 
                      $smallthumbnail = $filename.'_100_100_'.time().'.jpg';    
                      
               

              	 VideoThumbnail::createThumbnail(
                storage_path('app/public').'/post_image/'.$post_id.'/'.$image_full_name, 
                storage_path('app/public').'/post_image/'.$post_id, 
                $smallthumbnail, 
                10, 
                1200, 
                1200
                );
              

              }else{
                $smallthumbnail ='';    
              }

                     /* end thumbnail */
					$input=array(
							'post_id'=>$post_id,
							'image'=>$image,
							'thumbnail'=>$smallthumbnail,
							'user_id'=>$data['userId'],  
							'image_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
                    //$d[]=$input ;
					DB::table('post_images')->insert($input);  			 
				}
			}
			
			// echo "<pre>";
			// print_r($d);
			// exit ;
			// $friend_list = DB::table('friend_list')->where('user_id',$data['userId'])->where('status',2)->get();
			// 		if(count($friend_list) > 0){
			// 			foreach($friend_list as $friend_lists){
			// 				$this->send_notification($friend_lists->user_id,$friend_lists->request_id,1);			 
			// 			 }
			//         }  			
			
			
				
				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{ echo $e ;
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
		}


		public function createThumbnail($path, $width, $height)
    {
      
      $img = Image::make($path)->resize($width, $height)->save($path);
    }


	public function checkFileType($fileName){
      
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','webp'];

        $videoExtensions = ['flv','mp4','m3u8','ts','3gp','mov','avi','wmv','FLV','MP4','M3U8','TS','3GP','MOV','AVI','WMV'];

        $audioExtensions = ['mp3','MP3'] ;

        $explodeImage = explode('.', $fileName);
        $extension = end($explodeImage);

        if(in_array($extension,$imageExtensions))
        {
        // Is image
          return 'image' ;
        }else if(in_array($extension, $videoExtensions))
        {
        // Is video
          return 'video' ;
        }else if(in_array($extension, $audioExtensions)){
          // is audio 
          return 'audio' ;
        }else{
          return $extension ;
        }
    }
	public function updatePost(Request $request){ 
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
			$post_id=$request->edit_post_id;
		    //echo "<pre>";print_r($request->all());die;  
		    $edit_post_des=isset($request->edit_post_des)?$request->edit_post_des:'' ;
			$date = date("Y-m-d H:i:s");
			
			$updateData=array(
				'post_text'=>$edit_post_des ,
				'user_id'=>$data['userId'],
				'updated_at'=>$date	
			);
			// $insertmember = Post::create($insertData); 
			// echo "<pre>";print_r($insertmember);die;	
			 
			try{
				$updatestatus=DB::table('posts')->where('id',$post_id)->update($updateData);
				if($request->hasFile('image')) {
				$files = $request->file('image');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					//$fileType = explode('/', $mime_type)[0]; 
					
					$imgPath='/public/post_image/'.$post_id.'/';  
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$filenamewithextension = $file->getClientOriginalName(); 
					$fileType = $this->checkFileType($filenamewithextension);
					$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
					$filename=str_replace(' ', '_', $filename);
					$image_full_name = $filename.'_'.time().'.'.$ext; 
					$image=$image_full_name; 
					$file->storeAs($imgPath,$image_full_name);
                    
                    /* thumb   */
					 $isSendMail = config('constants.isSendMail');
				    if($fileType=='image'){
               			$smallthumbnail = $filename.'_1200_1200_'.time().'.jpg';    
		               $file->storeAs('public/post_image/'.$post_id.'/', $smallthumbnail);
		               $smallthumbnailpath =storage_path('app/public/post_image/'.$post_id.'/'.$smallthumbnail);
		              $this->createThumbnail($smallthumbnailpath, 1200, 1200);
             
              		}else if($fileType=='video' &&  $isSendMail==1){              	   
// 
                      $smallthumbnail = $filename.'_1200_1200_'.time().'.jpg';    
              
              	 VideoThumbnail::createThumbnail(
                storage_path('app/public').'/post_image/'.$post_id.'/'.$image_full_name, 
                storage_path('app/public').'/post_image/'.$post_id, 
                $smallthumbnail, 
                10, 
                1200, 
                1200
                );
              

              }else{
                $smallthumbnail ='';    
              }

                     /* end thumbnail */
				
               
                    /* end */
					$input=array(
							'post_id'=>$post_id,
							'image'=>$image,
							'thumbnail'=>$smallthumbnail,
							'user_id'=>$data['userId'],  
							'image_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
					DB::table('post_images')->insert($input);  			 
				}
			}
			
			
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
				echo $e ;
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
     
    public function updateAddress(Request $request){
            //echo "<pre>";print_r($request);die;  
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
             $user_id=$data['userId'];
		    $address_line_1=isset($request->address_line_1)?$request->address_line_1:'' ;
            $address_line_2=isset($request->address_line_2)?$request->address_line_2:'' ;
            $edit_country=isset($request->edit_country)?$request->edit_country:'' ;
            $edit_city=isset($request->edit_city)?$request->edit_city:'' ;
            $postal_code=isset($request->postal_code)?$request->postal_code:'' ;
			$date = date("Y-m-d H:i:s");
			
			$updateData=array(
				'address_line_1'=>!empty($address_line_1)?$address_line_1:"" ,
				'address_line_2'=>!empty($address_line_2)?$address_line_2:"" ,
				'zip_code'=>!empty($postal_code)?$postal_code:"",
                'country'=>!empty($edit_country)?$edit_country:"",
                'city'=>!empty($edit_city)?$edit_city:"",
				'updated_at'=>$date	
			);
			try{
				  $updatestatus=DB::table('user_profile')->where('user_id',$user_id)->update($updateData);
				  if($updatestatus){
                     echo 1;
                   }else{
                     echo 2;
                    } 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
	}

    public function updateAccountInfo(Request $request){
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
             $user_id=$data['userId'];
		    $first_name=isset($request->first_name)?$request->first_name:'' ;
            $last_name=isset($request->last_name)?$request->last_name:'' ;
            $brand_name=isset($request->brand_name)?$request->brand_name:'' ;
            $brand_website=isset($request->brand_website)?$request->brand_website:'' ;
            $accountType=isset($request->accountType)?$request->accountType:0 ;
            
			$date = date("Y-m-d H:i:s");
			
			$updateData=array(
				'first_name'=>!empty($first_name)?$first_name:"" ,
				'last_name'=>!empty($last_name)?$last_name:"" ,
				'updated_at'=>$date,
				'isPrivate' =>$accountType	
			);
            $updateData1=array(
				'brand_name'=>!empty($brand_name)?$brand_name:"" ,
				'brand_website'=>!empty($brand_website)?$brand_website:"" ,
				'updated_at'=>$date	
			);

			try{
				  $updatestatus=DB::table('user_profile')->where('user_id',$user_id)->update($updateData1);
                  $updatestatus=DB::table('users')->where('id',$user_id)->update($updateData);  
                  
                  Session::put('user_session.userFirstName', $first_name); 
                  Session::put('user_session.userLastName',$last_name); 
				  if($updatestatus){
                     echo 1;
                   }else{
                     echo 2;
                    } 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
	}
	
	public function addCategory(Request $request){
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
            $user_id=$data['userId'];
            $category=implode(",",$request->category);
			$date = date("Y-m-d H:i:s");
			
			$updateData=array(
				'category'=>!empty($category)?$category:"" ,
				'updated_at'=>$date	
			);
			try{
				  $updatestatus=DB::table('user_profile')->where('user_id',$user_id)->update($updateData); 
				  if($updatestatus){
                     echo 1;
                   }else{
                     echo 2;
                    } 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
	}
	
	public function saveMediaUrl(Request $request){
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
            $user_id=$data['userId'];
             $instagram_url=!empty($request->instagram_url)?$request->instagram_url:"";
			 $snapchat_url=!empty($request->snapchat_url)?$request->snapchat_url:"";
			 $youtube_url=!empty($request->you_tube_url)?$request->you_tube_url:"";
			$date = date("Y-m-d H:i:s");
			
			$updateData=array(
				'instagram'=>!empty($instagram_url)?$instagram_url:"" ,
				'snapchat'=>!empty($snapchat_url)?$snapchat_url:"" ,
				'youtube'=>!empty($youtube_url)?$youtube_url:"" ,
				'updated_at'=>$date	
			);
			try{
				  $updatestatus=DB::table('user_profile')->where('user_id',$user_id)->update($updateData); 
				  if($updatestatus){
                     echo 1;
                   }else{
                     echo 2;
                    } 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
	}

   public function updateBasicProfile(Request $request){  
            $data=session()->get('user_session');
			if(empty($data)){  
				return redirect('/');   
			}
            $user_id=$data['userId'];
		    $know=isset($request->know)?$request->know:'' ;
            $gender=isset($request->basic_gender)?$request->basic_gender:'' ;
			$date = date("Y-m-d H:i:s");
			
			$updateData=array(
				'know'=>!empty($know)?$know:"" ,
				'gender'=>!empty($gender)?$gender:"" ,
				'updated_at'=>$date
			);
           
			try{
				   $updatestatus=DB::table('user_profile')->where('user_id',$user_id)->update($updateData);   
				  if($updatestatus){
                     echo 1;
                   }else{
                     echo 2;
                    } 
			}  
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
	}

  
	public function send_notification($sender_id,$reciver_id,$type,$post_id=0){
		// type 1 used for post save
		$data=session()->get('user_session');
		$user_info = DB::table('users')->where('id',$sender_id)->first();
		$date = date("Y-m-d H:i:s");
		if($type==1){  
			$message=$user_info->first_name.' '.$user_info->last_name.'  added new post';
		}else if($type==2){
			$message=$user_info->first_name.' '.$user_info->last_name.' likes your post';
		}else if($type==3){
			$message=$user_info->first_name.' '.$user_info->last_name.' also commented on your post';  
		}else if($type==4){  
		    $message=$user_info->first_name.' '.$user_info->last_name.' accepted your friend request';
		}else{
			$message='added new post';
		}
		$saveData=array(
			  'message'=>$message,
			  'sender_id'=>$sender_id,
			  'reciver_id'=>$reciver_id,
			  'type'=>$type,
              'post_id'=>$post_id,
			  'created_at'=>$date
		);
	    $insertmember = Notification::create($saveData); 
        //echo "<pre>";print_r($insertmember);die; 		
	}	
	
	
	public function group(Request $request){
         $data=session()->get('user_session');		
		if(empty($data)){  
			return redirect('/');   
		}
		return view('website/group'); 
	}
	
	public function goodies(Request $request){
		 $defaultCountry=getDefaultCountryInfo('value');
		 //echo "<pre>";print_r($request->all());die;
		$data=session()->get('user_session');
		if(!empty($data)){
		$user_id=$data['userId'];
		$array=aboutInfo($user_id);

		
		 $date1=date("Y-m-d H:i:s");
		 $defCountry=" ";
		 if($defaultCountry > 0){
		 	 $defCountry=" and country=".$defaultCountry ;
		 }
		
        $typeQry = "select *,country as countryId, city as cityId ,case when (select name from countries where id=country and status=1) is null then '' else (select name from countries where id=country and status=1) end as country,case when (select name from cities where id=city and status=1) is null then '' else (select name from cities where id=city and status=1) end as city from goodies where status=1  ".$defCountry." and is_delete=1 and goodies_date >= '$date1' order by id desc" ; 
      
		 //echo $typeQry;die;   
         $goodiesData = DB::select($typeQry); 
		 //echo "<pre>";print_r($goodiesData);die; 
		 $res4=array(); 
		 $reply_comment_count=0;  
		 if(!empty($goodiesData)){
			foreach($goodiesData as $goodiesDatas){ 
				  $goodies_like_count = DB::table('goodies_like')->where('goodies_id',$goodiesDatas->id)->where('status',1)->count();
				  
				  $goodies_user_like_yes_No = DB::table('goodies_like')->where('goodies_id',$goodiesDatas->id)->where('user_id',$user_id)->where('status',1)->first();
				  if(!empty($goodies_user_like_yes_No)){
					  $god['user_like_goodies_yes_no']='Yes';
				  }else{
					  $god['user_like_goodies_yes_no']='No';
				  }
				  $goodies_message_count = DB::table('goodies_comments')->where('goodies_id',$goodiesDatas->id)->count();
				  $goodies_reply_count = DB::table('goodies_reply')->where('goodies_id',$goodiesDatas->id)->count();
				  $goodies_view_count = DB::table('goodies_view')->where('goodies_id', $goodiesDatas->id)->count();				
					
				  $total=$goodies_message_count+$goodies_reply_count;
				 $god['id']=$goodiesDatas->id;
				 $god['title']=$goodiesDatas->title;
				 $god['goodies_address']=$goodiesDatas->goodies_address ;
				 $god['goodies_seats']=$goodiesDatas->goodies_seats ;
				 $god['countryId']=$goodiesDatas->country ;
				 $god['cityId']=$goodiesDatas->city ;
				  $god['country']=$goodiesDatas->country ;
				 $god['city']=$goodiesDatas->city ;


				 if($goodiesDatas->goodies_fee_type == 1){
				 $god['goodies_fee_type']='Paid';
				 }else{
				  $god['goodies_fee_type']='Free'; 
				 }
				// $god['goodies_fee_type']=$goodiesDatas->goodies_fee_type ;
				 $god['goodies_descrption']=$goodiesDatas->goodies_descrption ;				 
                 $god['goodies_date']=date("F j , h:i A" ,strtotime($goodiesDatas->goodies_date));	
				 $god['goodies_time']=date("h:i A" ,strtotime($goodiesDatas->goodies_date));		 
				 $god['start_date']=date('D, d M Y ', strtotime($goodiesDatas->start_date));
				 $god['end_date']=date('D, d M Y ', strtotime($goodiesDatas->end_date));
				 $god['like_count']=!empty($goodies_like_count)? $goodies_like_count:"";
                 $god['message_count']=!empty($total)? $total:"";
				 $god['share_url']=url('/').'/goodiesDetails/'.$goodiesDatas->id ;
				 $god['goodies_url']=url('/').'/goodiesDetails';
				 $god['goodies_view_count']=!empty($goodies_view_count)?$goodies_view_count:"";
                 $goodies_info = DB::table('goodies_like')->where('goodies_id',$goodiesDatas->id)->where('status',1)->orderBy('id', 'desc')->get(); 
					$res7=array();
					foreach($goodies_info as $goodies_infos){
						 $goodies_user_info = DB::table('users')->where('id',$goodies_infos->user_id)->first();
						  $like['name']=$goodies_user_info->first_name; 
						//   .' '.$post_user_info->last_name
						  $res7[]=$like;   
					}
					$god['goodies_like_listing']=!empty($res7)?$res7:"";
                    unset($res7);
                    unset($total);				 
				
				 if(!empty($goodiesDatas->image)){
				   $god['image']=url('/').'/storage/app/public/goodies_image/'.$goodiesDatas->image; 
				 }else{
					 $god['image']='';
				 }


				 $res4[]=!empty($god)?$god:"";  
				 
			}					 
		 }
		       

		     

			
        $countryList = DB::table("countries")->select('countries.id','countries.name')->where('countries.id',$defaultCountry)->get() ; 
		 		
		return view('website/goodies',$array)->with('goodies_listing',$res4)->with('country_list',$countryList); 

	  }else{
		 return redirect('/');  
	  }
	}
	
	public function goodies_like_listing($id=null){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}
		$goodies_info = DB::table('goodies_like')->where('goodies_id',$id)->where('status',1)->orderBy('id', 'desc')->get()->count();
		
		
        return  response()->json(['like'=>$goodies_info]);  

    }
	
	public function event_like_listing($id=null){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}
		$event_info = DB::table('event_like')->where('event_id',$id)->where('status',1)->orderBy('id', 'desc')->get()->count();
	
        return  response()->json(['like'=>$event_info]);     

    }
	
	public function filterGoodies(Request $request){
		 //echo "<pre>";print_r($request->all());die;
		$data=session()->get('user_session');
		if(!empty($data)){
		$user_id=$data['userId'];
		$users = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','users.email','users.dob','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','bust','hair_style','hair_color','waist','banner_image')
            ->leftjoin('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$data['userId'])
            ->first();
		$following_count = DB::table('follows')->where('user_id',$user_id)->where('status',1)->count();
		$followers_count = DB::table('follows')->where('follow_id',$user_id)->where('status',1)->count();
        $array['users'] = json_decode(json_encode($users), true);
        
        
		if($array['users']['image']){
		$array['users']['image']=url('/').'/storage/app/public/user_image/'.$array['users']['image'];
		}else{
		 $array['users']['image']=url('/').'/storage/app/public/user_image/'.'user.png';
		}
		if(!empty($array['users']['banner_image'])){
		
		$array['users']['banner_image']=url('/').'/storage/app/public/banner_image/'.$array['users']['banner_image'];
		}else{
		 $array['users']['banner_image']=url('/').'/storage/app/public/user_image/'.'banner_defualt.jpg';
		}
		$array['users']['following_count']=!empty($following_count)?$following_count:"0"; 
		$array['users']['followers_count']=!empty($followers_count)?$followers_count:"0";
		  $typeQry = "select * from post_images where user_id = '$user_id' order by id desc " ;
		  
            $postImage = DB::select($typeQry);
		  $post_image=array();
		  $res5=[];
		  	if(!empty($postImage)){
				foreach($postImage as $postImages){
					// echo "<pre>";print_r($postImages->image);die; 
					 $post_image['image']=url('/').'/storage/app/public/post_image/'.$postImages->image;
					 $post_image['file_type']=$postImages->image_type;
					 $res5[]=!empty($post_image)?$post_image:"";
					 unset($post_image);
				}  
				//echo "<pre>";print_r($post_image);die;
				
			}  
			$neartest_friends = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log')
            ->join('user_profile','user_profile.user_id','=','users.id')->where('users.id','!=',$data['userId'])->get(); 
			$res3=[]; 
             foreach($neartest_friends as $neartest_friend){
				 
				$follow_info = DB::table('follows')->where('user_id',$user_id)->where('follow_id',$neartest_friend->id)->where('status',1)->first();  
				if(!empty($follow_info)){
					$neartest['is_follow']=1;
				}else{
					$neartest['is_follow']=2;
				}
                $neartest['name']=$neartest_friend->first_name.' '.$neartest_friend->last_name;
				$neartest['id']=$neartest_friend->id;
				$neartest['country']=$neartest_friend->country;
				$neartest['city']=$neartest_friend->city;    
				if(!empty($neartest_friend->image)){
				$neartest['image']=url('/').'/storage/app/public/user_image/'.$neartest_friend->image;
				}else{
					$neartest['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
				$neartest['id']=$neartest_friend->id;
				$res3[]=$neartest;
				 
			 }
             $maches_friends = DB::table('friend_list')
            ->select('users.first_name','users.last_name','users.image','users.login_date','friend_list.id')
            ->join('users','users.id','=','friend_list.request_id')->where('friend_list.user_id','=',$data['userId'])->where('friend_list.status','=',2)->get();
            $res1=[];			
			foreach($maches_friends as $maches_friend){
			     $date = Carbon::parse($maches_friend->login_date);
				  $elapsed = $date->diffForHumans(Carbon::now());
				  $elapsed=createdAt($elapsed);
                $maches['name']=$maches_friend->first_name.' '.$maches_friend->last_name;
				if(!empty($maches_friend->image)){
				$maches['image']=url('/').'/storage/app/public/user_image/'.$maches_friend->image;
				}else{
					$maches['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
				}
				$maches['active']=$elapsed;
				$maches['id']=$maches_friend->id;
				$res1[]=$maches;
			}
            $user_requests = DB::table('friend_list')
            ->select('users.first_name','users.last_name','users.image','users.login_date','friend_list.id','friend_list.request_id','user_profile.country','user_profile.city')
            ->join('users','users.id','=','friend_list.request_id')->join('user_profile','user_profile.user_id','=','friend_list.request_id')->where('friend_list.user_id','=',$data['userId'])->where('friend_list.status','=',1)->get();
            $res2=[];			
			foreach($user_requests as $user_request){
                $user['name']=$user_request->first_name.' '.$user_request->last_name;
				$user['country']=!empty($user_request->country)?$user_request->country:"";
				$user['city']=!empty($user_request->city)?$user_request->city:"";
				if(!empty($user_request->image)){
				$user['image']=url('/').'/storage/app/public/user_image/'.$user_request->image;
				}else{
					$user['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
				$user['request_id']=$user_request->request_id ;  
				$res2[]=$user;    
			}

            $online_friends_list = DB::table('friend_list')->select('users.first_name','users.last_name','users.image','users.login_date','users.id')->join('users','users.id','=','friend_list.request_id')->where('friend_list.user_id','=',$data['userId'])->where('friend_list.status','=',2)->where('users.login_status','=',2)->get(); 
			$res=array();
			//echo "<pre>";print_r($online_friends_list);die; 
			 if(!empty($online_friends_list)){
                foreach($online_friends_list as $online_friends_lists){
					$online['name']=$online_friends_lists->first_name.' '.$online_friends_lists->last_name;
                    if(!empty($online_friends_lists->image)){
						$online['image']=url('/').'/storage/app/public/user_image/'.$online_friends_lists->image;
						}else{
							$online['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
						$res[]=!empty($online)?$online:"";	
                }						
			  }

            $sqlquery = [];
            $querydata = "";
            if(@$request['S_goodies_name'])
            {
             $sqlquery[] = "title LIKE '".trim($request['S_goodies_name'])."%'";
            }
			if($request['S_goodies_country']!='')
            {	
             	$sqlquery[] = "country=".$request['S_goodies_country'];
            }

			if(@$request['S_goodies_city'])
            {
             if(!empty($request['S_goodies_city'])){
            		$city_ = [] ;
            	foreach ($request['S_goodies_city'] as $key => $value) {
            		$city_[]=$value ;
            	}

             	$city1_ = implode(',',$city_);
             	$sqlquery[] = "city in (".$city1_.")";
            	}
            
            } 
			//echo $request['S_goodies_date'];die; 
            if(@$request['S_goodies_date'])  
            {
              $pp = date('Y-m-d',strtotime(trim($request['S_goodies_date'])));
              $sqlquery[] = "DATE(goodies_date) = '".$pp."'";   
            }
			$date=date("Y-m-d H:i:s");
			if(@$request->status == 'all'){
				  //$sqlquery[]="goodies_fee_type=3 or goodies_fee_type=1";
			}else if($request->status == 'paid'){
				  $sqlquery[]="goodies_fee_type=1 ";
			}else if($request->status == 'unpaid'){
				 $sqlquery[]="goodies_fee_type=3";       
			} 
			  
            if(!empty($sqlquery))
            {
             $querydata = " and ".implode(' and ',$sqlquery);
            }
           	  		


           	  		

     $typeQry = "select *,case when (select name from countries where id=country and status=1) is null then '' else (select name from countries where id=country and status=1) end as country,case when (select name from cities where id=city and status=1) is null then '' else (select name from cities where id=city and status=1) end as city from goodies where status=1 and is_delete=1 and goodies_date >= '$date' $querydata order by id desc" ; 

      
		 //echo $typeQry;die;   
         $goodiesData = DB::select($typeQry); 
		 $res4=array(); 
		 $reply_comment_count=0;  
		 if(!empty($goodiesData)){
			foreach($goodiesData as $goodiesDatas){ 
				  $goodies_like_count = DB::table('goodies_like')->where('goodies_id',$goodiesDatas->id)->where('status',1)->count();
				  $goodies_message_count = DB::table('goodies_comments')->where('goodies_id',$goodiesDatas->id)->count();
				  $goodies_reply_count = DB::table('goodies_reply')->where('goodies_id',$goodiesDatas->id)->count();
				  
				  $goodies_user_like_yes_No = DB::table('goodies_like')->where('goodies_id',$goodiesDatas->id)->where('user_id',$user_id)->where('status',1)->first();
				  if(!empty($goodies_user_like_yes_No)){
					  $god['user_like_goodies_yes_no']='Yes';
				  }else{
					  $god['user_like_goodies_yes_no']='No';
				  }
				  
				  $total=$goodies_message_count+$goodies_reply_count;
				 $god['id']=$goodiesDatas->id;
				 $god['title']=$goodiesDatas->title;
				 $god['goodies_address']=$goodiesDatas->goodies_address ;
				 $god['goodies_seats']=$goodiesDatas->goodies_seats ;
				 $god['country']=$goodiesDatas->country;
				$god['city']=$goodiesDatas->city;    

				  if($goodiesDatas->goodies_fee_type == 1){
				 $god['goodies_fee_type']='Paid';
				 }else{
				  $god['goodies_fee_type']='Free'; 
				 }
				 //$god['goodies_fee_type']=$goodiesDatas->goodies_fee_type ;
				 $god['goodies_descrption']=$goodiesDatas->goodies_descrption ;				 
                 $god['goodies_date']=date("F j , h:i A" ,strtotime($goodiesDatas->goodies_date));	
				 $god['goodies_time']=date("h:i A" ,strtotime($goodiesDatas->goodies_date));		 
				 $god['start_date']=date('D, d M Y ', strtotime($goodiesDatas->start_date));
				 $god['end_date']=date('D, d M Y ', strtotime($goodiesDatas->end_date));
				 $god['like_count']=!empty($goodies_like_count)? $goodies_like_count:"";
                 $god['message_count']=!empty($total)? $total:"";
				 $god['share_url']=url('/').'/goodies';
				 $god['goodies_url']=url('/').'/goodiesDetails'; 
				 
                 unset($total);				 
				
				 if(!empty($goodiesDatas->image)){
				   $god['image']=url('/').'/storage/app/public/goodies_image/'.$goodiesDatas->image; 
				 }else{
					 $god['image']='';
				 }
				 $res4[]=!empty($god)?$god:"";  
				 
			}					 
		 } 
				
		return view('website/filterGoodies',$array)->with('post_image',$res5)->with('neartest_friends',$res3)->with('maches_friend',$res1)->with('user_request',$res2)->with('goodies_listing',$res4)->with('online_contact',$res)->with('status',$request['status']);   
	  }else{
		 return redirect('/');    
	  }
	}

	public function goodies_save_comment(Request $request){ 
            $data=session()->get('user_session');
			if(empty($data)){  
			return redirect('/');   
			}
			//echo "<pre>";print_r($request->all());die;
		    $comment=isset($request->comment)?$request->comment:'' ;
			$goodies_id=isset($request->goodies_id)?$request->goodies_id:'' ;
			$type=isset($request->type)?$request->type:0 ;
			$date = date("Y-m-d H:i:s");
			if($type==0){
			$insertData=array(
				'comment'=>$comment ,
				'user_id'=>$data['userId'],
				'goodies_id'=>$goodies_id,
				'created_at'=>$date	
			);
			$insertmember = GoodiesComment::create($insertData);
			}  
				$commentQry = "select * from goodies_comments where goodies_id=$goodies_id order by id desc" ;
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
				
				        $reply_comment = DB::table('goodies_reply')->where('comment_id',$commentDatas->id)->orderBy('id', 'desc')->get();
						$reply=array();
						$res1=array();
					    if(!empty($reply_comment)){
						 foreach($reply_comment as $reply_comments){
							 
							 $reply_like_count= DB::table('goodies_reply_like')->where('reply_id',$reply_comments->id)->where('status',1)->count();
							 
							 $date1 = Carbon::parse($reply_comments->created_at);
							  $elapsed1 = $date1->diffForHumans(Carbon::now());
							  $elapsed1=createdAt($elapsed1);
                             $user_info1 = DB::table('users')->where('id',$reply_comments->user_id)->first();
                            $reply['comment_id']=$reply_comments->comment_id;
							$reply['id']=$reply_comments->id;
							$reply['user_id']=$reply_comments->user_id;
							$reply['session_user_id']=$data['userId'];    
							$reply['reply_comment']=$reply_comments->comment;
							$reply['name']=$user_info1->first_name .' '. $user_info1->last_name;
							$reply['time']=$elapsed1;
							$reply['goodies_id']=$goodies_id;
							$reply['reply_like_count']=$reply_like_count; 
							if($user_info1->image){
							$reply['image']=url('/').'/storage/app/public/user_image/'.$user_info1->image;
							}else{
							 $reply['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
							}
							$res1[]=!empty($reply)?$reply:"";
                         }							 
								
						}  
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  $session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  $comment_count = DB::table('goodies_comments')->where('goodies_id',$goodies_id)->count();
					  $reply_count = DB::table('goodies_reply')->where('goodies_id',$goodies_id)->count();
					  $reply_yes = DB::table('goodies_reply')->where('comment_id',$commentDatas->id)->count();
					  $comment_likes = DB::table('goodies_comment_likes')->where('comment_id',$commentDatas->id)->where('status',1)->count();
					  $reply_comment_count= DB::table('goodies_reply')->where('comment_id',$commentDatas->id)->count();
					  //print_r($reply_yes);
					  if($reply_yes > 0){
						 $comment['is_comment']='Yes'; 
					  }else{
						  $comment['is_comment']='No';
					  }
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['goodies_id']=$commentDatas->goodies_id;
					$comment['user_id']=$commentDatas->user_id;
					$comment['session_user_id']=$session_user_info->id;  
					$comment['comment']=$commentDatas->comment;
					$comment['comment_count']=$comment_count+$reply_count;
					$comment['time']=$elapsed;
					$comment['comment_likes']=!empty($comment_likes)?$comment_likes:"0"; 
                    $comment['reply_comment_count']=!empty($reply_comment_count)?$reply_comment_count:"0";		  			
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if($session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						} 
						$comment['reply_info']=$res1;
                        						
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 
				return  response()->json(['comment_info'=>$res]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	
	public function goodies_reply_comment_delete($id=null){  
		 $data=session()->get('user_session');
         if(empty($data)){  
			return redirect('/');   
		 }		 
         $reply_comment_id=$id;		 
		 $reply_commnet_delete= DB::table('goodies_reply')->where('id',$reply_comment_id)->delete();
		 if($reply_commnet_delete){  
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}
	
	public function goodies_comment_delete($id=null){  
		 $data=session()->get('user_session');
         if(empty($data)){  
			return redirect('/');   
		 }		 
         $post_comment_id=$id;		 
		 $post_commnet_delete= DB::table('goodies_comments')->where('id',$post_comment_id)->delete();
		 $post_profile_delete= DB::table('goodies_reply')->where('comment_id',$post_comment_id)->delete();
		 if($post_comment_id){  
			 echo 1;
		 }else{
			 echo 2; 
		 }
		      
	}
	  
	public function goodies_reply_comment_like($id=null){  
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $reply_comment_id=$id; 
		 $comment_like_info = DB::table('goodies_reply_like')->where('user_id',$user_id)->where('reply_id',$reply_comment_id)->first();      
		 if(!empty($comment_like_info)){ 
			 if($comment_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'reply_id'=>$reply_comment_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('goodies_reply_like')->where('user_id',$user_id)->where('reply_id',$reply_comment_id)->update($updatedData);
		  if($updatestatus){
			 $comment_count = DB::table('goodies_reply_like')->where('reply_id',$reply_comment_id)->where('status',1)->count();
			// echo $comment_count;die; 
           return $comment_count;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'reply_id'=>$reply_comment_id, 
				'status'=>1,
				'created_at'=>$date           
				); 
        $insertmember = GoodiesReplyLike::create($insertData);
        if($insertmember){
			$comment_count = DB::table('goodies_reply_like')->where('reply_id',$reply_comment_id)->where('status',1)->count();
           return $comment_count;
		}else{
           echo 2;
        }			
		
	   }
	}
	
	public function save_goodies_reply_comment(Request $request){ 
            $data=session()->get('user_session');
			if(empty($data)){  
			return redirect('/');   
			}
			//echo "<pre>";print_r($request->all());die;
		    $reply_comment=isset($request->reply_comment)?$request->reply_comment:'' ;
			$comment_id=isset($request->comment_id)?$request->comment_id:'' ;
			$goodies_id=isset($request->goodies_id)?$request->goodies_id:'' ;
			$date = date("Y-m-d H:i:s");
			
			$insertData=array(
				'comment'=>$reply_comment ,
				'user_id'=>$data['userId'],
				'comment_id'=>$comment_id,
				'goodies_id'=>$goodies_id,
				'created_at'=>$date	
			);
			$insertmember = GoodiesReply::create($insertData);
				
				$commentQry = "select * from goodies_reply where comment_id=$comment_id order by id desc" ;
			   // echo $typeQry;die; 		
				$commentData = DB::select($commentQry);
				//echo "<pre>";print_r($commentData);die;
				$res=array();
				$comment=array();
				foreach($commentData as $commentDatas){ //print_r($commentDatas->id);die; 
					  $user_info = DB::table('users')->where('id',$commentDatas->user_id)->first();
					  $session_user_info = DB::table('users')->where('id',$data['userId'])->first();
					  $comment_count = DB::table('goodies_reply')->where('comment_id',$comment_id)->count();
					  $date = Carbon::parse($commentDatas->created_at);
					  $elapsed = $date->diffForHumans(Carbon::now());
					  $elapsed=createdAt($elapsed);
					$comment['id']=$commentDatas->id;
					$comment['comment_id']=$commentDatas->comment_id;
					$comment['reply_comment']=$commentDatas->comment;
					$comment['comment_count']=!empty($comment_count)?$comment_count:"";
					$comment['time']=$elapsed;
					$comment['name']=$user_info->first_name .' '. $user_info->last_name;
					if($user_info->image){
						$comment['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
						}else{
						 $comment['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}
					if($session_user_info->image){
						$comment['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
						}else{
						 $comment['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
						}  
						$res[]=!empty($comment)?$comment:"";
				} //echo "<pre>";print_r($res);die; 
				return  response()->json(['comment_info'=>$res]);
				
			try{
				
                				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}	
		
		//return view('index'); 
	}
	
	
    public function goodies_like($id=null){   
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $goodies_id=$id;
		 $goodies_like_info = DB::table('goodies_like')->where('user_id',$user_id)->where('goodies_id',$goodies_id)->first();
		 if(!empty($goodies_like_info)){ 
			 if($goodies_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'goodies_id'=>$goodies_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('goodies_like')->where('user_id',$user_id)->where('goodies_id',$goodies_id)->update($updatedData);
		  if($updatestatus){
			  $like_count = DB::table('goodies_like')->where('goodies_id',$goodies_id)->where('status',1)->count();
			  return !empty($like_count)?$like_count:"";
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'goodies_id'=>$goodies_id,
				'status'=>1 ,  
				'created_at'=>$date           
				); 
        $insertmember = GoodiesLike::create($insertData);
        if($insertmember){ 
          $like_count = DB::table('goodies_like')->where('goodies_id',$goodies_id)->where('status',1)->count();
		  
		 return !empty($like_count)?$like_count:"";  
		}else{
           echo 2;
        }			
		
	   }
	}

    public function goodies_comment_like($id=null){  
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		 }
		 $user_id=$data['userId'];
		 $date=date("Y-m-d H:i:s");
         $comment_id=$id;
		 $event_like_info = DB::table('goodies_comment_likes')->where('user_id',$user_id)->where('comment_id',$comment_id)->first();    
		 if(!empty($event_like_info)){ 
			 if($event_like_info->status == 2){
				 $status=1;
			 }else{
				 $status=2;
			 }
			 $updatedData=array(
				'user_id'=>$user_id,
				'comment_id'=>$comment_id ,
				'status'=>$status,
				'updated_at'=>$date           
				); 
				
		  $updatestatus=DB::table('goodies_comment_likes')->where('user_id',$user_id)->where('comment_id',$comment_id)->update($updatedData);
		  if($updatestatus){
			 $comment_count = DB::table('goodies_comment_likes')->where('comment_id',$comment_id)->where('status',1)->count();
			 //echo $comment_count;die; 
           return $comment_count;
		  }else{
			  echo 2;  
		  }
		 }else{
          $insertData=array(
				'user_id'=>$user_id,
				'comment_id'=>$comment_id ,
				'status'=>1 ,
				'created_at'=>$date           
				); 
        $insertmember = GoodiesCommentLike::create($insertData);
        if($insertmember){
			$comment_count = DB::table('goodies_comment_likes')->where('comment_id',$comment_id)->where('status',1)->count();
           return $comment_count;
		}else{
           echo 2;
        }			
		
	   }
	}	

	public function backfollow(Request $request){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}
		$date = date("Y-m-d H:i:s");
		$loginUserId=$data['userId'] ;
		$update=0 ;
		$requestId=$request->id ;
		try{ 
		 if($request->status=='backfollow'){
		 	$updateData=array(
		 		"followBack"=>1,
		 		"updatedOn"=>$date
		 	);		 	
		 	DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->where('isAccept',1)->update($updateData);
		 	$this->follow->notification($loginUserId,$requestId);	
		 	$update=1 ;
		 }else if($request->status=='pending'){
		 	$updateData=array(
		 		"followBack"=>0,
		 		"updatedOn"=>$date
		 	);
		 	DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->where('isAccept',1)->update($updateData);
		 	$update=1 ;
		 }else if($request->status=='following'){
		 	$updateData=array(
		 		"followBack"=>0,
		 		"updatedOn"=>$date
		 	);
		 	$check=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->where('isAccept',1)->update($updateData);
		 	if(!$check){
		 		DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->where('isAccept',1)->update($updateData);
		 	}
		 	
		 	$update=1 ;
		 }else if($request->status=='remove'){
		 	$update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->where('isAccept',1)->delete();
		 	$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->where('isAccept',1)->delete();
		 	// $updateData=array(		 		
		 	// 	"isAccept"=>2,
		 	// 	"updatedOn"=>$date
		 	// );

		 	// $update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->where('isAccept',1)->update($updateData);

		 }else if($request->status=='following_'){
		 	DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->delete();
		 	$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->delete();
		 }else if($request->status=='follow__'){
		 $check=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->count();

		 	$check1=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->count();
		 	
		 	  $insertData=array(
		 	  		'followed_user_id'=>$loginUserId ,
		 	  		'follower_user_id'=>$requestId ,
		 	  		'isAccept'=>0
		 	  );
		 	
		  if($check==0 && $check1==0){
		 			$update =DB::table("user_follows")->insert($insertData);	
		 			 $this->follow->notification($data['userId'],$requestId);		
		 	 }			
		 	  
		 }else if($request->status=='pending__'){
		 	 $update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->delete();

		 }else if($request->status=='unfollow__'){
		 	$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->delete();
		 	$update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->delete();
		 }

		 if($update){
		 	echo 'succ' ;
		 }else{
		 	echo 'fail' ;
		 }
		} catch(\Exception $e)
			{
				echo $e ;
			  //echo  errorResponse('error occurred'); 
			} 
	}

	public function follow(Request $request){
		
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}

		$loginUserId = $data['userId'] ;
		$requestId = $request->id ;


		
        $upate="" ;
		
        if($request->status=='follow' || $request->status=='Follow'){	
       
		 $check=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->count();

		 	$check1=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->count();
		 	
		 	  $insertData=array(
		 	  		'followed_user_id'=>$loginUserId ,
		 	  		'follower_user_id'=>$requestId ,
		 	  		'isAccept'=>0
		 	  );
		 	
		  if($check==0 && $check1==0){

 			$update =DB::table("user_follows")->insert($insertData);	
 			 $this->follow->notification($data['userId'],$request->id);	

		 }if($check1==1){
		 	$update1=array(
					"followBack"=>1
				);
				$update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->update($update1);
		 }	
	 

		}else if($request->status=='pending' || $request->status=='Pending' || $request->status=='pending1' || $request->status=='cancel_request'){
			
			$getInfo=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->first();
			$getInfo1=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->first();
		$isAccept = isset($getInfo->isAccept)?$getInfo->isAccept:"NA" ;
		 $followBack = isset($getInfo->followBack)?$getInfo->followBack:"NA" ;

		 $isAccept1 = isset($getInfo1->isAccept)?$getInfo1->isAccept:"NA" ;
		 $followBack1 = isset($getInfo1->followBack)?$getInfo1->followBack:"NA";

			
			if($followBack1=="NA" && $followBack===0 && $isAccept===0){
			// echo "heel" ;
			
				$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->delete();

			}else if($isAccept1===1 && $followBack1===1){
		
				$update1=array(
					"followBack"=>0
				);
				$update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->update($update1);

			}else if($request->status=='cancel_request'){
		
				$update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->delete();
			}
							
		}else if($request->status == 'cancel'){
			//follow back concept
			$getInfo=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->first();
			$getInfo1=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->first();
		$isAccept = isset($getInfo->isAccept)?$getInfo->isAccept:"NA" ;
		$followBack = isset($getInfo->followBack)?$getInfo->followBack:"NA" ;

		$isAccept1 = isset($getInfo1->isAccept)?$getInfo1->isAccept:"NA" ;
		$followBack1 = isset($getInfo1->followBack)?$getInfo1->followBack:"NA";


			if($followBack1==0 && $isAccept1==0){
				$update=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->delete();
			}else if($isAccept==1 && $followBack==1){
				$update1=array(
					"followBack"=>0
				);
				$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->update($update1);

			}

				
		}else if($request->status == 'accept'){
			//follow back concept

			$getInfo=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->first();
			$getInfo1=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->first();
		$isAccept = isset($getInfo->isAccept)?$getInfo->isAccept:"NA" ;
		$followBack = isset($getInfo->followBack)?$getInfo->followBack:"NA" ;

		$isAccept1 = isset($getInfo1->isAccept)?$getInfo1->isAccept:"NA" ;
		$followBack1 = isset($getInfo1->followBack)?$getInfo1->followBack:"NA";


			if($followBack1==0 && $isAccept1==0){
				$update1=array(
					"isAccept"=>1
				);
				$update=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->update($update1);
			}else if($isAccept==1 && $followBack==1){
				$update1=array(
					"followBack"=>2
				);
				$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->update($update1);

			}	
				
		}else if($request->status == 'followback'){
			$getInfo=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->first();
			$getInfo1=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->first();
		$isAccept = isset($getInfo->isAccept)?$getInfo->isAccept:"NA" ;
		$followBack = isset($getInfo->followBack)?$getInfo->followBack:"NA" ;

		$isAccept1 = isset($getInfo1->isAccept)?$getInfo1->isAccept:"NA" ;
		$followBack1 = isset($getInfo1->followBack)?$getInfo1->followBack:"NA";

			if($followBack1==0 && $isAccept1==1){
				$update1=array(
					"followBack"=>1
				);
				$update=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->update($update1);
			}		
				
		}else if($request->status == 'unfollow'){
			$update=DB::table("user_follows")->where('followed_user_id',$requestId)->where('follower_user_id',$loginUserId)->delete();
			$update=DB::table("user_follows")->where('followed_user_id',$loginUserId)->where('follower_user_id',$requestId)->delete();
			
		}else{

				echo 1;
			// $data_delete= DB::table('user_follows')->where('followed_user_id',$data['userId'])->where('follower_user_id',$request->id)->delete();
		   
			// if($data_delete){
			// 	echo 1;
			// }else{
			//     echo 3;
			// }
			
		}

		if($update){
			echo 1 ;
		}else{
			echo 2 ;
		}
		
		
    }
	public function follow_old(Request $request){
		
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}

        if($request->status == 'Follow'){			
		//echo print_r($data);die; 
		$date = date("Y-m-d H:i:s");
        $insertData1=array(
		        'user_id'=>$data['userId'],
		        'request_id'=>$request->id,
				'status'=>1,
				'created_at'=>$date	  
			);        
		$insertmember1 = FriendList::create($insertData1);
		$insertData=array(
		        'user_id'=>$data['userId'],
		        'follow_id'=>$request->id,
				'status'=>1,
				'created_at'=>$date	
			);
        $this->follow->notification($data['userId'],$request->id);			
	     $insertmember = Follow::create($insertData);
		
		 if($insertmember){
			 echo 1;  
		 }else{
			 echo 3;
		 }
		}else{
			$data_delete= DB::table('friend_list')->where('request_id',$request->id)->where('user_id',$data['userId'])->delete();
		    $data_delete= DB::table('follows')->where('follow_id',$request->id)->where('user_id',$data['userId'])->delete();
			if($data_delete){
				echo 2;
			}else{
			    echo 3;
			}
			
		}
		
		
    }

    public function goodies_like_model($id=null){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}
		$like_info = DB::table('goodies_like')->where('goodies_id',$id)->where('status',1)->orderBy('id', 'desc')->get();
		$res=array();
		foreach($like_info as $like_infos){
             $user_info = DB::table('users')->where('id',$like_infos->user_id)->first();
			  $like['name']=$user_info->first_name;
			  if(!empty($user_info->image)){
					$like['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
					}else{
					 $like['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
					}
			  $res[]=$like;  
        }
         //echo "<pre>";print_r($res);die; 	  	
        return view('website.like_model')->with('post_infos',$res);

    }
	
	public function event_like_model($id=null){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}
		 
		$like_info = DB::table('event_like')->where('event_id',$id)->where('status',1)->orderBy('id', 'desc')->get();
		$res=array();
		foreach($like_info as $like_infos){
             $user_info = DB::table('users')->where('id',$like_infos->user_id)->first();
			  $like['name']=$user_info->first_name; 
			  if(!empty($user_info->image)){
					$like['image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
					}else{
					 $like['image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
					}
			  $res[]=$like;  
        }
         	  	
        return view('website.like_model')->with('post_infos',$res);

    }

    public function post_like_model($id=null){

		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}

		  $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';

		$like_info = DB::table('post_like')->select(DB::raw("concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when users.image is null then ('".$defaultImgPath."') else concat('". $usrImgPath."',image) end as image"))->where('post_id',$id)
		->join('users','users.id','=','post_like.user_id')
		->where('post_like.status',1)->orderBy('post_like.id', 'desc')->get()->toArray();
		$res=array() ;
		if(!empty($like_info)){
			$res=$like_info ;
		}

        return view('website.like_model')->with('post_infos',$res);

    }

      public function story_like_model($id=null){

		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}

		  $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';

		// $like_info = DB::table('post_like')->select(DB::raw("concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when users.image is null then ('".$defaultImgPath."') else concat('". $usrImgPath."',image) end as image"))->where('post_id',$id)
		// ->join('users','users.id','=','post_like.user_id')
		// ->where('post_like.status',1)->orderBy('post_like.id', 'desc')->get()->toArray();
		$like_info = DB::table('stories_like')->select('stories_like.is_like',DB::raw("concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when users.image is null then ('".$defaultImgPath."') else concat('". $usrImgPath."',image) end as image"))
		->join('users','users.id','=','stories_like.user_id')		
		->where('stories_like.story_id',$id)
		->orderBy('stories_like.id', 'desc')->get()->toArray();

		$res=array() ;
		if(!empty($like_info)){
			$res=$like_info ;
		}

        return view('website.story_modal')->with('post_infos',$res);

    }
    
    public function post_like_listing($id=null){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}
		$like_info = DB::table('post_like')->where('post_id',$id)->where('status',1)->orderBy('id', 'desc')->count();
		
		$res=array();
		
        return  response()->json(['like'=>$like_info]); 

    }	

    public function accept_friend_request(Request $request){

		$data=session()->get('user_session');  
		$date = date("Y-m-d H:i:s");  
		$followBack=DB::table('user_follows')->select('followBack')->where('follower_user_id',$request->id)->where('followed_user_id',$data['userId'])->where('isAccept',1)->first();
		$isFollowBack=isset($followBack->followBack)?$followBack->followBack:0 ;
		
		if($isFollowBack==1){
			$updateData=array(
				"followBack"=>2,
				'updatedOn'=>$date,
			);
			$updatemember=DB::table('user_follows')->where('follower_user_id',$request->id)->where('followed_user_id',$data['userId'])->where('isAccept',1)->update($updateData);
		}else if($isFollowBack==0){
			$updateData=array(
				"isAccept"=>1,
				'updatedOn'=>$date,
			);
			$updatemember=DB::table('user_follows')->where('follower_user_id',$data['userId'])->where('followed_user_id',$request->id)->where('followBack',0)->update($updateData);  
		}

			if($updatemember){
				 echo 2;
			}else{
				 echo 3;
			}
		
		
    }
	

	
	public function cancal_friend_request(Request $request){
		$data=session()->get('user_session'); 
	
		$followBack=DB::table('user_follows')->select('followBack')->where('follower_user_id',$request->id)->where('followed_user_id',$data['userId'])->where('isAccept',1)->first();
		 $isFollowBack=isset($followBack->followBack)?$followBack->followBack:0 ;


		if($isFollowBack==1){
			$updateData=array(
				"followBack"=>0
			);
			$updatemember=DB::table('user_follows')->where('follower_user_id',$request->id)->where('followed_user_id',$data['userId'])->where('isAccept',1)->update($updateData);
		}else if($isFollowBack==0){
			$updatemember=DB::table('user_follows')->where('follower_user_id',$data['userId'])->where('followed_user_id',$request->id)->where('isAccept',0)->where('followBack',0)->delete();  
		}
			
			if($updatemember){
				 echo 2;
			}else{
				 echo 3;
			}	
		
    }
	
	
	public function profileData($id=null){  
		$data['title']="golden girl" ;
		$data=session()->get('user_session'); 
		if(empty($data)){  
			return redirect('/');   
		}
		$userInfo = user::find($data['userId']) ;
		if($userInfo['image'] != ''){		
		  $userInfo['image']=url('/').'/storage/app/public/user_image/'.'user.png'; 
		 }else{
            $userInfo['image']="";
		 }  
		//echo "<pre>";print_r($userInfo);die;
        $data['userInfo']=$userInfo ;
		return view('user/profile',$data); 
	}
	
	public function add_event(Request $request){
		    
			$event_name=isset($request->event_name)?$request->event_name:'' ;
			$event_type = isset($request->event_type)?$request->event_type:'' ;
			$event_address = isset($request->event_address)?$request->event_address:'' ;  
			$event_start_date = isset($request->event_start_date)?$request->event_start_date:'' ;
			$event_end_date = isset($request->event_end_date)?$request->event_end_date:'' ;
			$event_price = isset($request->event_price)?$request->event_price:'' ;
			$event_descrption = isset($request->event_descrption)?$request->event_descrption:'' ;
			$event_image = isset($request->event_image)?$request->event_image:'' ;
			$date = date("Y-m-d H:i:s");
			
			$insertData=array(
				'event_name'=>$event_name ,
				'event_type'=>$event_type,
				'address'=>$event_address ,  
				'event_start_date'=>$event_start_date ,  
				'event_end_date'=>$event_end_date,
				'event_price'=>$event_price,
				'event_descrption'=>$event_descrption,
				'created_at'=>$date	
			);
				
			try{
				
			
				$insertmember = Event::create($insertData);
				//print_r($insertmember);die;
				$event_id=$insertmember->id;
				if($request->hasFile('event_image')) {
				$files = $request->file('event_image');
				foreach ($files as $file) {				
					$imgPath='/public/event_image';  
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name . '.' . $ext;
					$file->storeAs($imgPath,$image_full_name);
                    $image=$image_full_name; 
					$input=array(
							'event_id'=>$event_id,
							'image'=>$image,
							'image_type'=>$image,
							'created_at'=>date("Y-m-d H:i:s")
						);
					DB::table('event_images')->insert($input);    
                   			 
				}
			}
				
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}
		 
    }
	
	public function update_profile(Request $request){
	$data=session()->get('user_session'); 
	//echo "<pre>";print_r($request->all());
	if(empty($data)){  
			return redirect('/');   
	}
	$user_id=isset($data['userId'])? $data['userId']:'' ;
    $know = isset($request->know)?$request->know:'' ;
	$interests = isset($request->interests)?$request->interests:'' ;
	$height = isset($request->height)?$request->height:'' ;
	$weight = isset($request->weight)?$request->weight:'' ;
	$smoking = isset($request->smoking)?$request->smoking:'' ;
	$eye_color = isset($request->eye_color)?$request->eye_color:'' ;
	$hair_color = isset($request->hair_color)?$request->hair_color:'' ;
	$marital_status = isset($request->marital_status)?$request->marital_status:'' ;
	$waist = isset($request->waist)?$request->waist:'' ;
    $about_self = isset($request->about_self)?$request->about_self:'' ;
	$bust = isset($request->bust)?$request->bust:'' ;
	$hips = isset($request->hips)?$request->hips:'' ;
	$hair_style = isset($request->hair_style)?$request->hair_style:'' ;
    $date = date("Y-m-d H:i:s");   

   
		  
    $updateData=array(
        'know'=>$know , 
		'interests'=>$interests ,
		'height'=>$height ,
		'weight'=>$weight ,
		'smoking'=>$smoking ,
		'eye_color'=>$eye_color ,
		'marital_status'=>$marital_status ,
		'waist'=>$waist,
		'bust'=>$bust,
		'hip_size'=>$hips,
		'hair_style'=>$hair_style,
		'hair_color'=>$hair_color,
        'self_des'=>$about_self ,
        'updated_at'=>$date             
    );
	
		   UserProfile::where('user_id',$user_id)->update($updateData);
           
    try{  
	       UserProfile::where('user_id',$user_id)->update($updateData);
           User::where('id',$user_id)->update($updateData1);
		   $profile_info=UserProfile::where('user_id',$user_id)->orderBy('id', 'desc')->first();
	      
		  print_r(json_encode($profile_info));exit;  
	     }
          catch(\Exception $e)
        {
			//echo "ghgfh";die; 
          echo errorResponse('error occurred'); 
         
        } 

     }

     public function serach(Request $request){
     	$data=session()->get('user_session');
     	 $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';
          //DB::enableQueryLog();
          $loginUserId = $data['userId'] ;
           $search=!empty($request->search)?$request->search:"";
   //         if($search){
   //           $sqlquery[] =" CONCAT(first_name,' ',last_name) LIKE '".trim($search)."%'";
	  //      }

			// if(!empty($sqlquery))
   //          {
   //           $querydata = " and ".implode(' and ',$sqlquery);
   //          }


          $peopleYouMayKnow = DB::table('users')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend")            	
        )->addSelect(DB::raw("(select case when isAccept=0 then 1 when isAccept=1 then 2 else 3 end  from user_follows where (followed_user_id=".$loginUserId." and follower_user_id=users.id) or (followed_user_id=users.id and follower_user_id=".$loginUserId.")  limit 1) as is_follow"))
            ->addSelect(DB::raw("(select count(id) from user_follows where followed_user_id=users.id  and follower_user_id=".$loginUserId." and isAccept=0 limit 1) as isInvition"))
            ->leftjoin('user_profile','user_profile.user_id','=','users.id') 
          
            ->where('users.id','!=',$data['userId'])
            ->where(DB::raw(" concat(users.first_name,' ',users.last_name)"), 'LIKE', "%$search%")
            ->get()->toArray(); 

            // echo "<pre>";
            // print_r($peopleYouMayKnow);
         
             return  response()->json($peopleYouMayKnow); 
           
     }
	 
	 public function serach_old(Request $request){
		 $data=session()->get('user_session');
		 $user_id=$data['userId'];
		 $res=array();
		 $search=!empty($request->search)?$request->search:"";
		 $result=user_search($search,$user_id);

		 if(!empty($result)){
			 foreach($result as $results){
				 $friend_info = DB::table('friend_list')->where('user_id',$user_id)->where('request_id',$results->id)->first();
				 if(!empty($friend_info)){
					if($friend_info->status == 1){
						$search_info['isFriend']='Pending';
                    }
					if($friend_info->status == 2){
						$search_info['isFriend']='Accept';
                    }
                    					
				 }else{
					 $search_info['isFriend']='No'; 
				 }
		         //if(empty($friend_info)){
				 $search_info['name']=$results->first_name.' '.$results->last_name;
				 $search_info['country']=!empty($results->country)?$results->country:"";
				 $search_info['city']=!empty($results->city)?$results->city:"";
				 $search_info['id']=!empty($results->id)?$results->id:"";  
                 $mutual_info=$this->mutual_friend($results->id,$user_id);
				//echo "<pre>";print_r(($mutual_info[0]->mutual_friend_count));die; 
				$search_info['mutual_friend']=!empty($mutual_info[0]->mutual_friend_count)? ($mutual_info[0]->mutual_friend_count):"";
				 if($results->image){    
		            $search_info['image']=url('/').'/storage/app/public/user_image/'.$results->image;
					}else{
					$search_info['image']=url('/').'/storage/app/public/user_image/'.'user.png';
					}
					$res[]=!empty($search_info)?$search_info:"";
			 } 
			 //}
		 }	 
		  return  response()->json($res); 
		 
		 
	 }
	
	 public function change_password(Request $request){
		$data=session()->get('user_session');
        if(empty($data)){  
			return redirect('/');   
		}		
		$userInfo = user::find($data['userId']) ;
		//echo "<pre>";print_r($userInfo);die;
        $data['userInfo']=$userInfo ;
		$data['title']='Golden girls' ;
        return view('user/change_password',$data);  
    } 
	
	 public function edit_profile(Request $request){
		   
		$data=session()->get('user_session'); 
		if(empty($data)){  
			return redirect('/');   
			}
		$userInfo = user::find($data['userId']) ;
		//echo "<pre>";print_r($userInfo);die;
        $data['userInfo']=$userInfo ;
     return view('user/edit_profile',$data);    
    } 

    public function login(Request $request){
		//print_r ($request->all());die;
        $credentials = [
            'email' => $request->login_email,
			'user_type'=>1
        ];

        $user = User::where($credentials)->first();
       
		if(!empty($user)){

			if($user->status==2){
				echo 3 ; exit ;
			}

	
			/*  test */
			 $credentials1 = [
            'email' => $request->login_email,
            'password' => $request->login_password,
            'user_type'=>1,
            'status'=>1           
            ];



       //      echo "<pre>";
      	// print_r($credentials1);
      	// exit ;
       	//Hash::check($request->login_password, $user->password)
			/* end */
        if(auth()->attempt($credentials1)) { 
       	$userId = $user->id ;
       	$userType = $user->user_type ;
        $rememberMe = $request->rememberMe ;
		$date = date("Y-m-d H:i:s");
		$updateData=array(
        'login_date' => $date,
		'login_status'=>2,
		'isOnline'=>1	      
        );  
		DB::table('users')->where('id',$userId)->update($updateData);
		if(!empty($user->image)){
		    $image=url('/').'/storage/app/public/user_image/'.$user->image;	
		}else{
			$image=url('/').'/storage/app/public/user_image/'.'user_holder.svg';
		}
         $session_data = array('userId' => $userId,
                                'userType' => $userType,
                                'userFirstName' =>$user->first_name,
								'userLastName' =>$user->last_name,
                                'userEmail' =>$request->login_email,
                                'image' =>$image,								
                                );
         Session::put('user_session', $session_data); 

        if($rememberMe==1){
        Cookie::queue('userName', $request->login_email, 60);
        Cookie::queue('userPassword', $request->login_password, 60);      
        } 
		//env('PUSHER_APP_CLUSTER')
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
            );
		//print_r($options);die; 	 
       /*  $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'), 
                $options
            ); */
			
			 $pusher = new Pusher(
                'e9c75b86e285c511da57',
                '56c0c0dd6d90996be5b9',
                '1716502', 
                $options
            );
        // notification
        $data = ['loginUserId' =>$userId,"type"=>1]; 
        $notify = 'my-channel';
        //$pusher->trigger($notify, 'App\\Events\\MyEvent', $data);
        //echo successResponse([],'login successfully');
        echo 1;
   		}else{
			
			echo 2 ;
   		//echo checkResponse([],'Incorrect data');
        
   		}
	 }else{
       echo 2 ;  
	 }		 

    }


	 public function profile_info(Request $request,$id=0){  


		 $data=session()->get('user_session');
		 $tab=!empty($request->pro_tab)?$request->pro_tab:"No";
		 
		if(!empty($data)){
		$user_ids=$data['userId'];
		$user_id=$id;  
		
		$array=aboutInfo($user_id);
        $followFollowerCount=getFollowerAndFollowing($user_id);
        $array['users']['following_count']=isset($followFollowerCount['total_following'])?$followFollowerCount['total_following']:0; 

        $array['users']['followers_count']=isset($followFollowerCount['total_follower'])?$followFollowerCount['total_follower']:0; 
		
		$array['users']['tab_info']=$tab;
		
		if($data['userId']!=$id){
         	$isFriend=checkIsFriendOrNot($data['userId'],$id);  
         }else{
         	$isFriend=0 ;
         } 
        
         $array['users']['isFriend']=$isFriend;

			 //DB::enableQueryLog();
          

           	//  >> Follow >> Pending >> Accept >> Following >> Follower

         if($user_id!=$data['userId']){

        
       
         $loginUserId=$data['userId'];
         $firstCondition=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$loginUserId)->where('follower_user_id',$user_id)->first();

         $secondCondition=DB::table("user_follows")->select('isAccept','followBack')->where('followed_user_id',$user_id)->where('follower_user_id',$loginUserId)->first();
         $isAccept='' ;
         $followBack='';

         if(!empty($firstCondition)){
         	$isAccept=$firstCondition->isAccept ;
         	$followBack=$firstCondition->followBack ;

         	if($isAccept==0 && $followBack==0){
         	$user_follow_status='Pending';
         	}else if($isAccept==1 && $followBack==0){
         	$user_follow_status='Accept';
           }else if($isAccept==1 && $followBack==1){
         	$user_follow_status='Accept';
           }else if($isAccept==1 && $followBack==2){
         	$user_follow_status='Accept';
           }else{
           	$user_follow_status='not_follow';
           }



         }else if(!empty($secondCondition)){
         	$isAccept=$secondCondition->isAccept ;
         	$followBack=$secondCondition->followBack ;

         	if($isAccept==0 && $followBack==0){
         	$user_follow_status='Accept_Cancel';
         	}else if($isAccept==1 && $followBack==0){
         	$user_follow_status='FollowBack';
           }else if($isAccept==1 && $followBack==1){
         	$user_follow_status='Pending';
           }else if($isAccept==1 && $followBack==2){
         	$user_follow_status='Accept';
           }else{
           	$user_follow_status='not_follow';
           }


         }else{
         		$user_follow_status='not_follow';
         }

         
          
         // if($firstRequest!=="NA" && $firstRequest=="0"){
         		
         //  	$user_follow_status='Pending';
         //  }else if($secondRequest!=="NA" && $secondRequest==0){
         //  	$user_follow_status='Accept';
         //  }else if($firstRequest==1){
         //  	$user_follow_status='Accept';
         //  }else if($secondRequest==1){
         //  	$user_follow_status='Accept';
         //  }else{
         //  	$user_follow_status='not_follow';
         //  }


         }else{
         	$user_follow_status='';
         }
    	
 		/* story info */
		 $current_date=date("Y-m-d H:i:s");
		
		$sImgPath = URL('/').'/storage/app/public/stories_image/' ;
		$friend=getFriendListUserId($user_id);           
		$story_infos_ = DB::table('stories')->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when stories.image is null then '' else concat('".$sImgPath."',stories.image) end as image"),DB::raw(" count(*) as totalStory"),'file_type')
		->leftjoin('users','users.id','=','stories.user_id')
		->where('user_id','!=',$user_id)->where('stories.created_at','<=',$current_date)->where('stories.till_valid','>=',$current_date)
		->whereIn('stories.user_id',$friend)
		->groupBy('users.id')->get()->toArray();
		
		 $my_story_info_ = DB::table('stories')->where('user_id',$user_id)->where('created_at','<=',$current_date)->where('till_valid','>=',$current_date);
		 $my_story_info=$my_story_info_->count();
		 $myStoryImg = $my_story_info_->get()->first() ;
		 $myStoryImage = isset($myStoryImg->image)?$myStoryImg->image:'' ;
		  $storiesType = isset($myStoryImg->file_type)?$myStoryImg->file_type:1 ;

		 if($myStoryImage!='' && $my_story_info > 0){
		 	$mSImg = URL('/').'/storage/app/public/stories_image/'.$myStoryImage ;
		 }else{
		 	$mSImg = $array['users']['image'] ;
		 }					 
			
		$get_neartest_follow=peopleYouMayKnow(2);
          
		return view('website.pages.Profile.Profile',$array)->with('get_neartest_follow',$get_neartest_follow)->with('status',$user_follow_status)->with('story_count',$my_story_info)->with('selfStoryImg',$mSImg)->with('storiesType',$storiesType)->with('stories_info',$story_infos_);       	
	  }else{  
		 return redirect('/');    
	  }
		//return view('website.pages.Profile.Profile');   
	 }
	 
	 public function marches_info($id=null){  
		$data=session()->get('user_session');
		if(!empty($data)){ 
		$user_id=$id;

		 $loginUserId=$data['userId'];
			
		 $array=aboutInfo($user_id);  

        $followFollowerCount=getFollowerAndFollowing($user_id);
        $array['users']['following_count']=isset($followFollowerCount['total_following'])?$followFollowerCount['total_following']:0; 

        $array['users']['followers_count']=isset($followFollowerCount['total_follower'])?$followFollowerCount['total_follower']:0; 
		
		$followingList=getFollowing($user_id);
        $followerList=getFollowerList($user_id);
		
		$matches = array_merge($followingList,$followerList);
		return view('website.pages.Marches.marches',$array)->with('maches_friend',$matches); 
	  }else{
		 return redirect('/');  
	  } 
	 }
	 
	 /*Network*/
	 public function network_info(Request $request){
	 		$data=session()->get('user_session');

		    if(!empty($data)){

		    $loginUserId=$data['userId'];
			$user_id=$request->id;
			$array=aboutInfo($user_id);
			
          $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';
       
            $peopleYouMayKnow = peopleYouMayKnow();
  
      
         $user_requests_ = DB::table('users')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend")            	
        )            
            ->leftjoin('user_profile','user_profile.user_id','=','users.id')   
            ->join('user_follows','user_follows.followed_user_id','=','users.id') 
            ->where('user_follows.follower_user_id','=',$data['userId'])  
            ->where('user_follows.isAccept','=',0)        
            ->where('users.id','!=',$data['userId'])->get()->toArray();  
			
	  $user_requestsBackFollow = DB::table('users')
            ->select('users.id',DB::raw(" concat(users.first_name,' ',users.last_name) as name "),'users.first_name','users.last_name', DB::raw("case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.image) end as image"),'user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log',DB::raw("'' as mutual_friend")            	
        )            
            ->leftjoin('user_profile','user_profile.user_id','=','users.id')   
            ->join('user_follows','user_follows.follower_user_id','=','users.id') 
            ->where('user_follows.followed_user_id','=',$data['userId'])  
            ->where('user_follows.isAccept','=',1)   
            ->where('user_follows.followBack','=',1)      
            ->where('users.id','!=',$data['userId'])->get()->toArray();  
            /*dfdfdf*/
            $user_requests = array_merge($user_requests_,$user_requestsBackFollow);
	    return view('website.pages.network.network',$array)->with('user_request',$user_requests)->with('neartest_friends',$peopleYouMayKnow); 
       }else{
	 return redirect('/');  
       } 

	 }

	 
	 
	 public function editPost(Request $request,$id=null){

	 	
		 $post_info = DB::table('posts')->where('id',$id)->first();
		 $type=isset($request->type)?$request->type:0 ;

		

		 if(!empty($post_info)){
			 $post['id']=!empty($post_info->id)?$post_info->id:"";
			 $post['user_id']=!empty($post_info->user_id)?$post_info->user_id:"";
			 $post['post_text']=!empty($post_info->post_text)?$post_info->post_text:"";
			 $post['post_type']=!empty($post_info->post_type)?$post_info->post_type:"";
			 $imagePath=URL('/').'/storage/app/public/post_image/' ;
			 $post_image = DB::table('post_images')->select(DB::raw(" case when image is null then '' else concat('".$imagePath."',post_images.post_id,'/',image) end as image"),DB::raw("image_type as file_type"),DB::raw("id as image_id"))->where('post_id',$id)->get()->toArray();

    //          foreach($post_image as $post_images){
				//   $img['image']=url('/').'/storage/app/public/post_image/'.$post_images->image;
				//   $img['file_type']=$post_images->image_type;
				//   $img['image_id']=$post_images->id;
				//   $res[]=!empty($img)?$img:"";
			 // }

			 $post['image']=$post_image ; //!empty($res)?$res:"";
			 $post['type']= $type ;
			 // echo "<pre>";
			 // print_r($post['image']);
			 // exit ;
			 //echo "<pre>";print_r($post);die; 
			 return view('editPost')->with('post',$post);
         } 
	 }
	 
	 public function post_image_delete($id=null){
		 $data=session()->get('user_session');
		 if(empty($data)){  
			return redirect('/');   
		}
		 $post_profile_delete= DB::table('post_images')->where('id',$id)->delete();
		 if($post_profile_delete){
			 echo 1;
		 }else{
			 echo 2; 
		 }
		 
	 }
	 
	 public function myevent_info($id=null){
		 $data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$id;
			
			$users = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','users.email','users.dob','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','bust','hair_style','hair_color','waist','banner_image')
            ->leftJoin('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$user_id)  
            ->first();
		$following_count = DB::table('follows')->where('user_id',$user_id)->where('status',1)->count();
		$followers_count = DB::table('follows')->where('follow_id',$user_id)->where('status',1)->count();
        $array['users'] = json_decode(json_encode($users), true);
		if($array['users']['image']){
		$array['users']['image']=url('/').'/storage/app/public/user_image/'.$array['users']['image'];
		}else{
		 $array['users']['image']=url('/').'/storage/app/public/user_image/'.'user.png';
		}
		if(!empty($array['users']['banner_image'])){
		
		$array['users']['banner_image']=url('/').'/storage/app/public/banner_image/'.$array['users']['banner_image'];
		}else{
		 $array['users']['banner_image']=url('/').'/storage/app/public/user_image/'.'banner_defualt.jpg';
		}
		$array['users']['following_count']=!empty($following_count)?$following_count:"0"; 
		$array['users']['followers_count']=!empty($followers_count)?$followers_count:"0";
			
		 $booking_info=BookingRequest::where('user_id',$user_id)->where('user_id',$user_id)->where('booking_type',1)->get();
		 //echo "<pre>";print_r($booking_info);die; 
		 $res=array();
		 $res1=array();
		 if(!empty($booking_info)){
			 foreach($booking_info as $booking_infos){
			  $user_info=User::where('id',$booking_infos->user_id)->first();
			  $event_info=Event::where('id',$booking_infos->type_id)->first();
			  if(empty($event_info)){
			  	continue ;
			  }
			  //echo "<pre>";print_r($event_info);die; 
			  $order['name']=$user_info->first_name.' '.$user_info->last_name;
			  $order['event_name']=$event_info->event_name;
			  $order['event_address']=$event_info->address;
			  $order['order_id']=$booking_infos->id;
			  $order['no_ticket']=$booking_infos->number_of_ticket;
			  if($booking_infos->status == 1){
				$order['order_status']='Pending';  
			  }else if($booking_infos->status == 2){
			     $order['order_status']='Approved';
		      }else{
				 $order['order_status']='Cancal'; 
			  }
			  $order['order_date']=date('D, d M Y ', strtotime($booking_infos->created_at));
			   if($event_info->event_fee_type == 1){
				$order['event_fee_type']='Paid';
			  }else{
				$order['event_fee_type']='Free';
			  }
			  $imageData = DB::table('event_images')->where('event_id',$booking_infos->type_id)->first();	   
			  $order['image']=url('/').'/storage/app/public/event_image/'.$imageData->image;
					  
			  $res[]=!empty($order)?$order:"";
			 } 
		 }
		 
		 $goodies_info=BookingRequest::where('user_id',$user_id)->where('user_id',$user_id)->where('booking_type',2)->get();
		 //echo "<pre>";print_r($booking_info);die; 
		 $res1=array();  
		 if(!empty($goodies_info)){
			 foreach($goodies_info as $goodies_info){
			  $user_info1=User::where('id',$goodies_info->user_id)->first();
			  $goodies_data=Goodies::where('id',$goodies_info->type_id)->first();
			  //echo "<pre>";print_r($event_info);die; 
			  $god['name']=$user_info1->first_name.' '.$user_info1->last_name;
			  $god['goodies_name']=isset($goodies_data->title)?$goodies_data->title:'';
			  $god['goodies_address']=isset($goodies_data->goodies_address)?$goodies_data->goodies_address:'';
			  $god['order_id']=$goodies_info->id;
			  $god['no_ticket']=$goodies_info->number_of_ticket;
			  if($goodies_info->status == 1){
				$god['order_status']='Pending';  
			  }else if($goodies_info->status == 2){
			     $god['order_status']='Approved';
		      }else{
				 $god['order_status']='Cancal'; 
			  }
			  $god['order_date']=date('D, d M Y ', strtotime($goodies_info->created_at));
			   if(isset($goodies_data->goodies_fee_type) && $goodies_data->goodies_fee_type == 1){
				$god['goodies_fee_type']='Paid';
			  }else{
				$god['goodies_fee_type']='Free';
			  }

			  if(isset($goodies_data->image) && $goodies_data->image!=''){
			  	 $god['image']=url('/').'/storage/app/public/goodies_image/'.$goodies_data->image;
			  	}else{
			  	  $god['image']='' ;

			  	 }
			  $res1[]=!empty($god)?$god:"";
			  
			  	}
		 }
		 
		 //echo "<pre>";print_r($res);die; 
		 //echo "<pre>";print_r($res);die; 
		 
		 return view('website.pages.myevent.myevent',$array)->with('order',$res)->with('god_order',$res1);  
		}else{
			return redirect('/'); 
		}  
	 
	 }
	 
	 public function media_info(){  
		 
		$data=session()->get('user_session');
		if(!empty($data)){
			$user_id=$data['userId'];  
	      $typeQry = "select * from post_images where user_id = '$user_id' order by id desc ";
          $postImage = DB::select($typeQry);
		  $post_image=array();
		  $res5=[];
		  	if(!empty($postImage)){
				foreach($postImage as $postImages){
					// echo "<pre>";print_r($postImages->image);die; 
					 $post_image['image']=url('/').'/storage/app/public/post_image/'.$postImages->image;
					 $post_image['file_type']=$postImages->image_type;
					 $res5[]=!empty($post_image)?$post_image:"";
					 unset($post_image);
				}  
				//echo "<pre>";print_r($post_image);die;
				
			} 	
		return view('website.pages.media.media')->with('post_image',$res5); 
	  }else{
		 return redirect('/');  
	  } 
	 }
	 
	 public function myPosts($id=null){
         
		$data=session()->get('user_session');
	    $user_id=$id;
		$users = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','users.email','users.dob','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','bust','hair_style','hair_color','waist','banner_image')
            ->join('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$user_id)
            ->first();
			 //echo "<pre>";print_r($users);die; 
		$following_count = DB::table('follows')->where('user_id',$user_id)->where('status',1)->count();
		$followers_count = DB::table('follows')->where('follow_id',$user_id)->where('status',1)->count();
        $array['users'] = json_decode(json_encode($users), true);
		if($array['users']['image']){
		$array['users']['image']=url('/').'/storage/app/public/user_image/'.$array['users']['image'];
		}else{
		 $array['users']['image']=url('/').'/storage/app/public/user_image/'.'user.png';
		}
		if(!empty($array['users']['banner_image'])){
		
		$array['users']['banner_image']=url('/').'/storage/app/public/banner_image/'.$array['users']['banner_image'];
		}else{
		 $array['users']['banner_image']=url('/').'/storage/app/public/user_image/'.'banner_defualt.jpg';
		}
		$array['users']['following_count']=!empty($following_count)?$following_count:"0"; 
		$array['users']['followers_count']=!empty($followers_count)?$followers_count:"0";


		// if(!empty($data)){
		//  $typeQry = "select * from posts where user_id='$user_id' order by id desc" ; 
  //        $postData = DB::select($typeQry);
		//  $res1=array();
		//  $reply_comment_count=0;  
		//  if(!empty($postData)){
		// 	foreach($postData as $postDatas){ 
		// 		  $user_info = DB::table('users')->where('id', $postDatas->user_id)->first();
		// 		  $session_user_info = DB::table('users')->where('id', $user_id)->first();
		// 		  $post_like_count= DB::table('post_like')->where('post_id', $postDatas->id)->where('status',1)->count();
		// 		  $post_comment_count= DB::table('comments')->where('post_id', $postDatas->id)->count();
		// 		  $reply_comment_count= DB::table('reply_comments')->where('post_id',$postDatas->id)->count(); 
				  
		// 		  $user_post_like_Yes_or_no= DB::table('post_like')->where('post_id', $postDatas->id)->where('user_id', $user_id)->where('status',1)->first(); 
  //                  if(!empty($user_post_like_Yes_or_no)){
		// 				 $post['user_post_is_like']="Yes";    
		// 			   }else{
		// 				 $post['user_post_is_like']="No";   
		// 			   }
				 
		// 		  $total_count=$post_comment_count+$reply_comment_count;  
		// 		  //echo "<pre>";print_r($post_like_count);die; 
		// 		  $date = Carbon::parse($postDatas->created_at);
		// 		  $elapsed = $date->diffForHumans(Carbon::now());
		// 		  $elapsed=createdAt($elapsed);
		// 		  $post['id']=$postDatas->id;
		// 		  $post['post_user_id']=$postDatas->user_id;
		// 		  $post['session_user_id']=$user_id;
		// 		  $post['name']=$user_info->first_name .' '. $user_info->last_name;
		// 		  $post['post_text']=$postDatas->post_text;
		// 		  $post['post_type']=$postDatas->post_type;
		// 		  $post['post_like_count']=!empty($post_like_count)?$post_like_count:"";
		// 		  $post['post_comment_count']=!empty($total_count)?$total_count:"";  
		// 		  $post['time']=$elapsed;
		// 		  unset($total_count);
		// 		  if($user_info->image){
		// 					$post['user_image']=url('/').'/storage/app/public/user_image/'.$user_info->image;
		// 					}else{
		// 					 $post['user_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
		// 					}
  //                 if($session_user_info->image){  
		// 				$post['session_image']=url('/').'/storage/app/public/user_image/'.$session_user_info->image;
		// 				}else{
		// 				 $post['session_image']=url('/').'/storage/app/public/user_image/'.'no-img.png';
		// 				} 							
		// 		  $imgQry = "select * from post_images where post_id=".$postDatas->id; 
  //                 $imageData = DB::select($imgQry);
		// 		  foreach($imageData as $imageDatas){  
		// 		  $image['image']=url('/').'/storage/app/public/post_image/'.$imageDatas->image;
		// 		  $image['file_type']=$imageDatas->image_type;
		// 		  $post_image[]=$image;  
		// 		  }
		// 		  $post['post_image']=!empty($post_image)?$post_image:"";
		// 		  unset($post_image);    
		// 		  $res1[]=!empty($post)?$post:"";

		// 	}
  //            ///echo "<pre>";print_r($res1);die; ->with('post_info',$res1)
		// 	//->with('post_info',$res1)
  //           return view('website.pages.Profile.post',$array);			
			 
		//  }else{
  //          return view('website.pages.Profile.post',$array);
  //        }
			
		// }

 			return view('website.pages.Profile.post',$array);		

		 
	 }
	 
	 
	
	public function forgot_password(Request $request)
    {        
      
        $user = User::where('email', $request->forgot_email)->first();   
        if(!$user){
            echo 3;exit;
        } 
        $encryption=$user->encryption ;
        $resetUrl = URL('/').'/resetPassword/'.$encryption ;
        $name=$user->first_name.' '.$user->last_name;      
        $isSendMail = config('constants.isSendMail');
		   if($isSendMail==1){
		    $this->sendPwdEmail($request->forgot_email,$resetUrl,$name,3);  
		   }
        
        echo  2;exit;  

    }
	  
	 public function sendPwdEmail($email,$otp=123456,$name,$type=0){  

        if($type==1){
            $subject='Account Registration' ;
        }else if($type==2){
            $subject='Account Login' ;
        }else {
            $subject='Forgot Password' ;
        }
       $data=array(
        'email' => $email,
        'subject' => $subject,
        'message' => $otp,
        'name'=>$name
       );  
        
        $data=sendPasswordToEmail($data);
    }

    
    public function logout(Request $request){
      $data['title']='Golden girls' ;
	  $date = date("Y-m-d H:i:s");
	  $data=session()->get('user_session');
      if(!empty($data)){
	  //print_r($data);die; 
	  $updateData=array(
        'login_date' => $date,
		'login_status'=>1,
		'isOnline'=>0	      
        );  
		DB::table('users')->where('id',$data['userId'])->update($updateData);
       Auth::logout();    
       Session::flush();
      //return redirect('/');
	  return redirect("/")->withSuccess('Logout successfully.');
     }else{
     return redirect('/');
    }
    }
	
    public function UsernameGenerate($usrName,$id){
      $number = mt_rand(10000,99999);
      $username = "WOW".strtoupper($usrName).$id ;
      if($this->UsernameExist($username)){
        return $this->UsernameGenerate($usrName);
      }
      return $username ; 
    }

    public function UsernameExist($usrName){
      return User::where(['username'=>$usrName])->exists();
    }
	
	public function update_profile1312(Request $request){
	$user_id=isset($request->user_id)?$request->user_id:'' ;
    $edit_name=isset($request->edit_name)?$request->edit_name:'' ;
	$edit_phone = isset($request->edit_phone)?$request->edit_phone:'' ;
    $edit_dob = isset($request->edit_dob)?$request->edit_dob:'' ;
    $edit_gender = isset($request->edit_gender)?$request->edit_gender:'' ;
    $date = date("Y-m-d H:i:s");  
    $updateData=array(
        'name'=>$edit_name ,
		'phone'=>$edit_phone,
        'dob'=>$edit_dob , 
        'gender'=>$edit_gender , 		
        'updated_at'=>$date         
    );
	
    try{
            if($request->hasFile('profile_picture')){
                $imgPath='/public/user_image';  
                $filenamewithextension = $request->file('profile_picture')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('profile_picture')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('profile_picture')->storeAs($imgPath,$filenametostore);
                $updateData['image']=$filenametostore; 

          }
		 DB::table('users')->where('id',$user_id)->update($updateData);
           echo successResponse([],'Updated successfully');
		
	     }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

     }

	 public function update_password(Request $request){     
      $cha_password = isset($request->cha_password)?$request->cha_password:'';
      $con_password = isset($request->con_password)?$request->con_password:'';
	  $user_id = isset($request->user_id)?$request->user_id:'';
      $password =  Hash::make($cha_password);
      $updateData = array(
        "password"=>$password
      );
       try{
              user::where('id',$user_id )->update($updateData) ;           
              echo successResponse([],'changed password successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
    }

    public function editComment(Request $request){
    	$commentId = $request->commentId ;

    	$comment = DB::table('comments')->where('id',$commentId)->get()->first();
    	
    	return view('edit_comment')->with('commentInfo',$comment);
    }

    public function updateComment(Request $request){
    	$commentId = $request->edit_commentId ;
    	$comment = $request->usrComment ;
    	$updateData=array(
    		'comment'=>$comment
    	);

    	DB::table('comments')->where('id',$commentId)->update($updateData);
    	
    	return 'Success';
    }

     public function editReplyComment(Request $request){
    	$replyId = $request->replyId ;
    	
    	$reply = DB::table('reply_comments')->where('id',$replyId)->get()->first();
    	
    	return view('edit_reply_comment')->with('replyInfo',$reply);
    }
	 
	 public function updateReplyComment(Request $request){
    	$commentId = $request->edit_reply_commentId ;
    	$comment = $request->usrReplyComment ;
    	$updateData=array(
    		'reply_comment'=>$comment
    	);

    	DB::table('reply_comments')->where('id',$commentId)->update($updateData);
    	
    	return 'Success';
    }

    public function getCity(Request $request){
    	$country=$request->S_goodies_country ;

    	if(!empty($country)){
    			$getCity = DB::table("goodies")->select('cities.id','cities.name')
			    	->join('cities','cities.id','goodies.city')
			    	->where('goodies.status',1)
			    	->where('cities.status',1)
			    	->where('is_delete',1)
			    	->where('country_id',$country)
			    	->where('goodies.goodies_date','>=',date("Y-m-d H:i:s"))
			    	->get();

			return view('website/city')->with('goodies_city',$getCity);
    	}

    	echo 'fail' ;
    	//DB::enableQueryLog();
   
      // print_r(DB::getQueryLog());
    	
    }

      public function getEventCity(Request $request){
    	$country=$request->s_event_country ;

    	if(!empty($country)){
    			$getCity = DB::table("events")->select('cities.id','cities.name')
			    	->join('cities','cities.id','events.city')
			    	->where('events.status',1)  
        			->where('cities.status',1)    
			    	->where('country_id',$country)
			    	->where('events.event_date','>=',date("Y-m-d H:i:s"))
			    	->distinct()
			    	->get();

			return view('website/eventCities')->with('event_city',$getCity);
    	}

    	echo 'fail' ;
    	//DB::enableQueryLog();
   
      // print_r(DB::getQueryLog());
    	
    }

    public function updateCountrySession(Request $request){

    		$value=$request->value ;
    		$imgUrl = $request->imgUrl ;
    		$countryName = $request->countryName ;

    	session()->put('defaultCountry', array('image'=>$imgUrl,'value'=>$value,'name'=>$countryName));

    }


    public function editGoodiesComment(Request $request){
    	$commentId = $request->commentId ;

    	$comment = DB::table('goodies_comments')->where('id',$commentId)->get()->first();
    	
    	return view('editGoodiesComment')->with('commentInfo',$comment);
    }

    public function updateGoodiesComment(Request $request){
    	$commentId = $request->edit_commentId ;
    	$comment = $request->usrComment ;
    	$updateData=array(
    		'comment'=>$comment
    	);

    	DB::table('goodies_comments')->where('id',$commentId)->update($updateData);
    	
    	return 'Success';
    }

    public function editGoodiesReplyComment(Request $request){
    	$replyId = $request->replyId ;
    	
    	$reply = DB::table('goodies_reply')->where('id',$replyId)->get()->first();
    	
    	return view('editGoodiesReplyComment')->with('replyInfo',$reply);
    }
	 
	 public function updateGRComment(Request $request){
    	$commentId = $request->edit_reply_commentId ;
    	$comment = $request->usrReplyComment ;
    	$updateData=array(
    		'comment'=>$comment
    	);

    	DB::table('goodies_reply')->where('id',$commentId)->update($updateData);
    	
    	return 'Success';
    }

    public function editEventComment(Request $request){
    	$commentId = $request->commentId ;

    	$comment = DB::table('event_comments')->where('id',$commentId)->get()->first();
    	
    	return view('editEventComment')->with('commentInfo',$comment);
    }

    public function updateEventComment(Request $request){
    	$commentId = $request->edit_commentId ;
    	$comment = $request->usrComment ;
    	$updateData=array(
    		'comment'=>$comment
    	);

    	DB::table('event_comments')->where('id',$commentId)->update($updateData);
    	
    	return 'Success';
    }

     public function editERComment(Request $request){
    	$replyId = $request->replyId ;
    	 
    	$reply = DB::table('event_reply')->where('id',$replyId)->get()->first();
    	
    	return view('eventReplyComment')->with('replyInfo',$reply);
    }
	 
	 public function updateERComment(Request $request){
    	$commentId = $request->edit_reply_commentId ;
    	$comment = $request->usrReplyComment ;
    	$updateData=array(
    		'comment'=>$comment
    	);

    	DB::table('event_reply')->where('id',$commentId)->update($updateData);
    	
    	return 'Success';
    }

    public function addUserEncryption(){
    	$user = DB::table('users')->get();
    	foreach ($user as $key => $value) {
    		$userId=md5('Intgoldengirls'.$value->id) ;
    		DB::table('users')->where('id',$value->id)->update(['encryption'=>$userId]);
    	}
    }

    public function updateUserPassword(Request $request){

    	$encryption=$request->encryption ;
    	$password = $request->password ;
        $password_ =  Hash::make($password) ;

        try{
        	  $usrId=DB::table('users')->select('id')->where('encryption',$encryption)->first();

        	  if(isset($usrId->id) && $usrId->id > 0){
        	  	user::where('id',$usrId->id)->update(["password"=>$password_]) ;	
        	  }
              
             // return redirect('/');   
          } catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
	      
    }

}

<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\User; 
use App\Models\BookingRequest; 
use Hash;  
use Session ;
use DB ;
use Auth ;
use Image ;
use Cookie;
use Carbon\Carbon;
use App\Helper;
use File;
use VideoThumbnail ;
use App\Models\Event; 
use Illuminate\Support\Facades\Storage;

class PrivacyController extends Controller
{
	
   
	 public function __construct()
    {
        
    }
	
	public function userProfilePrivacy(Request $request){

		//print_r($request->all());
		$data=session()->get('user_session');
		if(empty($data)){  
			return redirect('/');   
		}
		$user_id=$data['userId'];
		$type=$request->type ;
		
						
		$user_profile=DB::table('user_profile')->select('isSocialPrivacy','isDOBPrivacy','isMNPrivacy','isEmailIdPrivacy','isAddressPrivacy')->where('user_id',$user_id)->get()->first();
		//print_r($user_profile);
		$userPrivacy=0 ;
		if($type==1){
			$userPrivacy=$user_profile->isAddressPrivacy ;
		}else if($type==2){
			$userPrivacy=$user_profile->isMNPrivacy ;
		}else if($type==3){
			$userPrivacy=$user_profile->isEmailIdPrivacy ;
		}else if($type==4){
			$userPrivacy=$user_profile->isSocialPrivacy ;
		}else if($type==5){
			$userPrivacy=$user_profile->isDOBPrivacy ;
		}
		$data=array();
		$data['userPrivacy']=$userPrivacy ;
		$data['type']=$type ;
        
		return view('website.pages.Profile.ajax_profile_privacy',$data);  

	}
	
	public function saveProfilePrivacy(Request $request){

	$data=session()->get('user_session');

	if(empty($data)){  
		return redirect('/');   
	}
	$user_id=$data['userId'];
		 			
	 $privacyinfo=isset($request->profileInfo)?$request->profileInfo:0 ;
	 $privacyType=isset($request->type)?$request->type:0 ;
	 $updateArray=array();
	if($privacyType==1){
		$updateArray=array("isAddressPrivacy"=>$privacyinfo) ;
	}else if($privacyType==2){
		$updateArray=array("isMNPrivacy"=>$privacyinfo) ;
	}else if($privacyType==3){
		$updateArray=array("isEmailIdPrivacy"=>$privacyinfo) ;
	}else if($privacyType==4){
		$updateArray=array("isSocialPrivacy"=>$privacyinfo) ;
	}else if($privacyType==5){
		$updateArray=array("isDOBPrivacy"=>$privacyinfo) ;
	}

	if(!empty($updateArray)){		
	 DB::table('user_profile')->where('user_id',$user_id)->update($updateArray);
	}

	$imagePath=URL('/').'/public/website/images/icon/' ;
    $title='' ;
	if($privacyinfo==1){
		$imagePath=$imagePath.'public.png' ;
		$title='Public' ;
	}else if($privacyinfo==2){	
		$imagePath=$imagePath.'friends.png' ;
		$title='Friends' ;
	}else if($privacyinfo==3){	
		$imagePath=$imagePath.'only_me.png' ;
		$title='Only me' ;
	}

  return successResponse(['privacyIcon'=>$imagePath,'title'=>$title ,'privacyType'=>$privacyType],'Save successfully');

}


  
 public function movePostImage(){

 	// $allPost=DB::table('post_images')->get()->toArray();
 	
 	// $postFilePath=URL('/').'/storage/app/public/post_image/' ;
 	// foreach ($allPost as $key => $value) {
 	// 	$imageName=$value->image ;
 	// 	//echo $value->post_id ;

 	// 	$fullImagePath=$postFilePath.$imageName ;
 	// 	if(file_exists(storage_path('/app/public/post_image/'.$imageName))){
 	// 		$path = storage_path('/app/public/post_image/'.$value->post_id);
		// 		File::makeDirectory($path, $mode = 0777, true, true);
		// 		if (\File::copy(storage_path('/app/public/post_image/'.$imageName) ,storage_path('/app/public/post_image/'.$value->post_id.'/'.$imageName))) {
  //   						//dd("success");
		// 		}
 	// 		echo 'Yes' ;
 	// 	}else{
 	// 		echo storage_path('/app/public/post_image/'.$imageName);
 	// 		echo 'No';
 	// 	}

 	// 		echo "hello";
 	
 	// }
 	

 }

public function moveLocalToS3(Request $request){
	  // $Imagepath = storage_path('app/public').'/post_image/'.$post_id.'/'.$smallthumbnail;

   //             $files = File::get($Imagepath);
   //            Storage::disk('s3')->put($postImgPathS3.$post_id.'/'.$smallthumbnail, $files,'public');
   //            		echo $postImgPathS3.$post_id.'/'.$smallthumbnail ;

}
 public function createImageAndVideoThumb1(Request $request){

 	
 	// 	$allPost=DB::table('post_images')->get()->toArray();
  //       $postFilePath=URL('/').'/storage/app/public/post_image/' ;
  //      foreach ($allPost as $key => $value) {
  //       $postId=$value->post_id ;

  //      	$fileType=$value->image_type ;
  //      	$imageName=$value->image ;
  //      	$filename = pathinfo($imageName, PATHINFO_FILENAME);
		// $filename=str_replace(' ', '_', $filename);
		// $fileExtension = \File::extension($imageName);
		// $image_full_name = $filename.'_1200_1200'.'.'.$fileExtension;     
  //      	$oldPath= $postFilePath.$postId.'/'.$value->image;

  //      	$newPathWithName=$_SERVER['DOCUMENT_ROOT'].'/storage/app/public/post_image/'.$postId.'/'.$image_full_name;
		// if (\File::copy($oldPath , $newPathWithName)) {
		
		// 	if($fileType=='image'){
		// 	//echo $smallthumbnailpath = public_path('storage/post_image/'.$postId.'/'.$image_full_name);
			
		// 	$this->createThumbnail($newPathWithName, 1200, 1200);
		// 	}else if($fileType=='video'){
		// 		$image_full_name = $filename.'_1200_1200'.'.jpg';  
		// 		VideoThumbnail::createThumbnail(
		//         storage_path('app/public').'/post_image/'.$postId.'/'.$value->image, 
		//         storage_path('app/public').'/post_image/'.$postId, 
		//        $image_full_name, 
		//         10, 
		//         1200, 
		//         1200
		//         );
		// 	}

		// 	$updateData=array(
		// 		"thumbnail"=>$image_full_name
		// 	);
		// 	$updateId=$value->id ;
		// 	DB::table("post_images")->where('id',$updateId)->update($updateData);

		// }
   
       

  //      }
       
          

         

		  

 }

 
 public function savePostPrivacy(Request $request){
 	
 	$postId=$request->upatePrivacyPost ;
 	$postPrivacyType = $request->postListPrivacy ; 	
 	DB::table('posts')->where('id',$postId)->update(["post_type"=>$postPrivacyType]);
 	echo "succ";

 }

		public function createThumbnail($path, $width, $height)
    {
      
       $img = Image::make($path)->orientate()->fit($width, (int)$height, function ($constraint) {
						//$constraint->aspectRatio();
						$constraint->upsize();
						})->save($path);
    }

 public function postDetail(Request $request){

 		$postId = $request->id ;


		$data=session()->get('user_session');

		// if(empty($data)){  
		// 	return redirect('/');   
		// }
		$getPostUsrId=DB::table('posts')->select('user_id')->where('id',$postId)->first();

		$user_id=isset($getPostUsrId->user_id)?$getPostUsrId->user_id:0;

	 $type = isset($request->type)?$request->type:0 ;
	 $cond="";

	 if($type==1){
	 	$cond=" && p.user_id=".$user_id ;
	 }

	 
  		
  	

         $loginUserId=isset($data['userId'])?$data['userId']:$user_id ;
		
         //$friendList=array(111);


		$array=array();  

		

		  $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';

		 $postLike=" case when (select count(*) from post_like where post_id=p.id and status=1) is null then 0 else (select count(*) from post_like where post_id=p.id and status=1) end as post_like_count " ;	 
		 $youLikeOrNot = " case when (select count(*)  from post_like where post_id=p.id and status=1 and user_id=$user_id limit 1) is null then 'No' when (select count(*) from post_like where post_id=p.id and status=1 and user_id=$user_id limit 1) > 0 then 'Yes' else 'No' end as user_post_is_like  "  ;
		 $postCommentCount= " (select count(*) from comments where post_id=p.id) as commentCount " ;
		 $replyCommentCount = " (select count(*) from reply_comments where post_id=p.id) as replyCount ";
		 $friendQuery="(select count(*) from user_follows where ((followed_user_id=$loginUserId and follower_user_id=p.user_id) or 
		 (followed_user_id=p.user_id and follower_user_id=$loginUserId)) and isAccept=1)" ;

		 $typeQry = "select p.id as postId,p.user_id,concat(u.first_name,' ',u.last_name) as name ,case when u.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',u.image) end as user_image ,post_text,post_type,$postLike , $postCommentCount ,$replyCommentCount,  $youLikeOrNot,p.created_at,case when (p.user_id!=$loginUserId && post_type=3) then 0 else 1 end as onlymePrivacy from posts as p left join users as u on u.id=p.user_id where (case when (p.user_id!=$loginUserId && post_type=3) then 0 else 1 end)=1 $cond && (case when (post_type=2 && p.user_id!=$loginUserId)  then $friendQuery else 1 end)=1 and p.id=$postId order by p.id desc " ; 
		 
         $postData = DB::select($typeQry);
        
         $response=array() ;
         $postText='' ;
         $postImage='' ;
        
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
				  $postText=$value->post_text;
				 


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
                  if(!empty($post['post_image'])){
                  	$postImage=$post['post_image'][0]->thumbnail ;
                  }
                 
				  $post['post_like_listing']=($value->post_like_count > 0)?array("total_like"=>$value->post_like_count):array();
				  $response[]=$post ;
         	}
         }

        $loginUserId=isset($data['userId'])?$data['userId']:0 ;
        $data['type']=$type ;
        $data['loginUserId']=$loginUserId ;
        
		$data['postId']=$postId ;
		$data['ogurl']=URL('/').'/postDetail/'.$postId ;
		$data['ogImage']=$postImage ;
		$data['ogdescription']=$postText ;
		$data['canonical']=URL('/') ;


           			   
		return view('home_page_detail')->with('loginUserId',$loginUserId)->with('post_info',$response)->with('data',$data);  
    
 		
 }
	
	public function story_comment(Request $request){

		$data=session()->get('user_session');
		$loginUserId=isset($data['userId'])?$data['userId']:0 ;
		$storyComment=$request->storyComment ;
		$storyId=$request->storyId ;		
		$storyInfo=DB::table("stories")->select('user_id','image','file_type')->where('id',$storyId)->first();

		if(!empty($storyInfo)){

			$image=isset($storyInfo->image)?$storyInfo->image:'' ;
			$userId=isset($storyInfo->user_id)?$storyInfo->user_id:0 ;
			$fileType=isset($storyInfo->file_type)?$storyInfo->file_type:'' ;

			$user_stories_s3 = config('constants.user_stories_s3');
			
			$storyImgPath=$user_stories_s3.$userId.'/'.$image ;
			$filepath="chat_image";
			if($fileType=='video'){
				$filepath="chat_video";
			}

			$message=array(
				"from"=>$loginUserId ,
				"to"=>$userId ,
				"message"=>$storyComment
			);		    

		    $insertId=DB::table('messages')->insertGetId($message);
		    
			$chatMessage=array(
				"chat_id"=>$insertId ,
				"file"=>$image,
				"file_type"=>$fileType 
			);

			DB::table('chat_images')->insertGetId($chatMessage);
			 $chat_image = config('constants.chat_image');
			 $copied_file=$chat_image.$insertId.'/'.$image ;

			if(!Storage::disk('s3')->exists($copied_file)){
				Storage::disk('s3')->copy($storyImgPath, $copied_file,'public');
			}
			
				 
			// if(file_exists(storage_path('/app/public/stories_image/'.$image))){
			// 	\File::copy(storage_path('/app/public/stories_image/'.$image) ,storage_path('/app/public/'.$filepath.'/'.$image));
	 	// 	}

		}

	}	

	public function story_like(Request $request){

		$data=session()->get('user_session');
		$loginUserId=isset($data['userId'])?$data['userId']:0 ;
		$type=isset($request->type)?$request->type:0 ;
		$storyId=isset($request->storyId)?$request->storyId:0 ;

		$checkLoginUserStory=DB::table("stories")->select('user_id')->where('id',$storyId)->where('user_id',$loginUserId)->count();
		if($checkLoginUserStory > 0){
			return true ;
		}
//
		$storyInfo=DB::table("stories")->select('user_id','image','file_type')->where('id',$storyId)->first();
		$userId=isset($storyInfo->user_id)?$storyInfo->user_id:0 ;	
	
		$checkIsLike=DB::table('stories_like')->select('id')->where('story_id',$storyId)->where('user_id',$loginUserId)->first();
		$existIsLikeId=isset($checkIsLike->id)?$checkIsLike->id:0 ;
		$storyView=isset($request->storyView)?$request->storyView:0 ;

		if(empty($checkIsLike)){
			$insertData=array(
			"story_id"=>$storyId ,
			"user_id"=>$loginUserId ,
			"is_like"=>$type
			);

			DB::table('stories_like')->insert($insertData);
		}else {
			$updateData=array(			
			"is_like"=>$type
			);

			DB::table('stories_like')->where('id',$existIsLikeId)->update($updateData);
		}
		//if($storyView==0)

	}

	public function aboutus(Request $request){
		
		return view('aboutus');  
	}

	public function privacyPolicy(Request $request){
		$privacyPolicy=DB::table('cms')->where('Content_type','privacyPolicy')->first();
		return view('privacyPolicy')->with('privacyPolicy',$privacyPolicy);  
	}

	public function termCondition(Request $request){
		$termCondition=DB::table('cms')->where('Content_type','termCondition')->first();
		return view('termCondition')->with('termCondition',$termCondition); 
	}

	public function eventPolicies(Request $request){
		
		return view('eventPolicies'); 
	}

	public function membershipsGuidlines(Request $request){
		
		return view('membershipGuidlines'); 
	}

	public function eventTermsServices(Request $request){
		
		return view('eventTermsServices'); 
	}

	public function contactUs(Request $request){
		$enquiryType=DB::table('enquiry')->get();
		return view('contactus')->with('enquiry',$enquiryType);
	}

	public function saveContactus(Request $request){

		$data=session()->get('user_session');
		
		$user_id=$data['userId'];
		$name=isset($request->name)?$request->name:'' ;
		$email=isset($request->email)?$request->email:'' ;
		$mobileNumber=isset($request->mobile_number)?$request->mobile_number:'' ;
		$enquiry=isset($request->enquiry)?$request->enquiry:'' ;
		$message=isset($request->message)?$request->message:'' ;
		
		$encType= DB::table('enquiry')->where('Id',$enquiry)->first();

		$enquiryType=isset($encType->Type)?$encType->Type:0 ;
		
		$insertData=array(
			'userId'=>$user_id ,
			'name'=>$name ,
			'email'=>$email,
			'mobile_number'=>$mobileNumber ,
			'enquiryType'=>$enquiry ,
			'message'=>$message 
		);

		DB::table('contactus')->insert($insertData);

		  $isSendMail = config('constants.isSendMail');
		   if($isSendMail==1){
				$data=array(
					'name' => $name,
			        'email' => $email,
			        'mobile_number'=> $mobileNumber,
			        'enquiryType'=>$enquiryType ,
			        'message_text'=>$message 
				);
				sendContactUsEmail($data);

	      }

		echo 'succ' ;
	}

	public function createImageAndVideoThumb(){


		/* data */
		$allPost=DB::table('post_images')->where('image_type','image')->get()->toArray();
        $postFilePath=URL('/').'/storage/app/public/post_image/' ;
       foreach ($allPost as $key => $value) {
        $postId=$value->post_id ;

       	$fileType=$value->image_type ;
       	$imageName=$value->image ;
       	$filename = pathinfo($imageName, PATHINFO_FILENAME);
		$filename=str_replace(' ', '_', $filename);
		$fileExtension = \File::extension($imageName);
		$image_full_name = $filename.'_1200_1200'.time().'.'.$fileExtension;     
       	$oldPath= $postFilePath.$postId.'/'.$value->image;

       	$newPathWithName=$_SERVER['DOCUMENT_ROOT'].'/storage/app/public/post_image/'.$postId.'/'.$image_full_name;
		if (\File::copy($oldPath , $newPathWithName)) {
		
			if($fileType=='image'){
			//echo $smallthumbnailpath = public_path('storage/post_image/'.$postId.'/'.$image_full_name);
			$postImagePath=url('/').'/storage/app/public/post_image/'.$postId.'/'.$image_full_name ;		          
		               $postImgResize=getImageHeight($postImagePath);
			$this->createThumbnail($newPathWithName, 1024, $postImgResize);

			$updateData=array(
				"thumbnail"=>$image_full_name
			);

			$updateId=$value->id ;
			DB::table("post_images")->where('id',$updateId)->update($updateData);

			}else if($fileType=='video'){
				// $image_full_name = $filename.'_1200_1200'.'.jpg';  
				// VideoThumbnail::createThumbnail(
		  //       storage_path('app/public').'/post_image/'.$postId.'/'.$value->image, 
		  //       storage_path('app/public').'/post_image/'.$postId, 
		  //      $image_full_name, 
		  //       10, 
		  //       1200, 
		  //       1200
		  //       );
			}

			

		}
   
       

       }


		/* end */
		
	}


    /* move image AWS server to  S3 bucket storage */

	public function moveImgServerToS3Storage(){

		$allPost=DB::table('post_images')->where('image_type','video')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$user_post_s3 = config('constants.user_post_s3');
			       
		  $postFilePath_=$s3BaseURL.$user_post_s3 ;

        $postFilePath=storage_path('app/public').'/post_image/' ;
       foreach ($allPost as $key => $value) {
        $postId=$value->post_id ;
       	$oldImgPath= $postFilePath.$postId.'/'.$value->image;
       	$oldThumbImg=$postFilePath.$postId.'/'.$value->thumbnail;   

        $files = file_get_contents($oldImgPath); //File::get($oldImgPath);
        Storage::disk('s3')->put($user_post_s3.$postId.'/'.$value->image, $files,'public');

        // $thumbFiles = File::get($oldThumbImg);
        // Storage::disk('s3')->put($user_post_s3.$postId.'/'.$value->thumbnail, $thumbFiles,'public');
		} 

       }

    public function moveStoryImgServerToS3Storage(){

		$allPost=DB::table('stories')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$user_stories_s3 = config('constants.user_stories_s3');
			       
		  $userStoriesS3=$s3BaseURL.$user_stories_s3 ;

        $postFilePath=storage_path('app/public').'/stories_image/' ;
       foreach ($allPost as $key => $value) {
        $storyId=$value->user_id ;
       	$oldImgPath= $postFilePath.$value->image;       
       	$fileType=$value->file_type ;

       	if($fileType=='image'){
       		 $files = File::get($oldImgPath);
       	}else if($fileType=='video'){
       		 $files = file_get_contents($oldImgPath);
       	}else{
       		 $files = File::get($oldImgPath);
       	}

        
        Storage::disk('s3')->put($user_stories_s3.$storyId.'/'.$value->image, $files,'public');

       

		} 

       }


        public function moveUserImageServerToS3Storage(){

		$allPost=DB::table('user_profile_image')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$user_profile_img_s3 = config('constants.user_profile_img_s3');
			       
		  $userImagePath=$s3BaseURL.$user_profile_img_s3 ;

        $userImgPath=storage_path('app/public').'/user_image/' ;
        $bannerImgPath=storage_path('app/public').'/banner_image/' ;

       foreach ($allPost as $key => $value) {
        $usrId=$value->userId ;
        $imageType = $value->image_type ;

        if($imageType==1){
        	$oldImgPath= $userImgPath.$value->image;  
        }else if($imageType==2){
        	$oldImgPath= $bannerImgPath.$value->image;  
        }else{
        	$oldImgPath='' ;
        }

       	 $files = File::get($oldImgPath);
        Storage::disk('s3')->put($user_profile_img_s3.$usrId.'/'.$value->image, $files,'public');

		} 

       }

        public function moveEventImageServerToS3Storage(){

		$allPost=DB::table('event_images')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$event_image = config('constants.event_image');
			       
		  $eventImg=$s3BaseURL.$event_image ;

        $eventImgPath=storage_path('app/public').'/event_image/' ;
        
       foreach ($allPost as $key => $value) {
        $evId=$value->event_id ;
        $imageType = $value->image_type ;

        $oldImgPath= $eventImgPath.$value->image;  
       	     
       	//$fileType=$value->file_type ;

       	 $files = File::get($oldImgPath);

        
        Storage::disk('s3')->put($event_image.$evId.'/'.$value->image, $files,'public');

       

		} 

       }

       public function moveGoodiesImageServerToS3Storage(){

		$allPost=DB::table('goodies')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$goodies_image = config('constants.goodies_image');
			       
		  $godiesImg=$s3BaseURL.$goodies_image ;

        $eventImgPath=storage_path('app/public').'/goodies_image/' ;
        
       foreach ($allPost as $key => $value) {
        $gId=$value->id ;
        
        $oldImgPath= $eventImgPath.$value->image;  
       	     
       

       	 $files = File::get($oldImgPath);

        
        Storage::disk('s3')->put($goodies_image.$gId.'/'.$value->image, $files,'public');

       

		} 

       }


        public function moveGroupImageServerToS3Storage(){

		$allPost=DB::table('groups')->where('image','!=','')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$group_icon = config('constants.group_icon');
			       
		  $groupImg=$s3BaseURL.$group_icon ;

        $groupImage=storage_path('app/public').'/group_image/' ;
        $groupThumb=storage_path('app/public').'/group_image/thumbnail/' ;
        
       foreach ($allPost as $key => $value) {
        $gId=$value->id ;
        
        $oldImgPath= $groupImage.$value->image;  
        $oldImgThumbPath= $groupThumb.$value->thumbnail;
       	     
       

       	 $files = File::get($oldImgPath);

        
        Storage::disk('s3')->put($group_icon.$gId.'/'.$value->image, $files,'public');

         $thumbFiles = File::get($oldImgThumbPath);
        Storage::disk('s3')->put($group_icon.$gId.'/'.$value->thumbnail, $thumbFiles,'public');

       

		} 

       }


        public function moveGroupChatImageServerToS3Storage(){

		$allPost=DB::table('group_images')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$group_image = config('constants.group_image');
			       
		  $groupImg=$s3BaseURL.$group_image ;

        $groupImage=storage_path('app/public').'/group_image/' ;
        $groupVideo=storage_path('app/public').'/group_video/' ;
        $groupDocument=storage_path('app/public').'/group_document/' ;
        
        
       foreach ($allPost as $key => $value) {
        $chat_id=$value->chat_id ;

        $fileType=$value->file_type ;

        if($fileType=='image'){
        	$oldImgPath= $groupImage.$value->file;  
        	 $files = File::get($oldImgPath);
        }else if($fileType=='video'){
        	$oldImgPath= $groupVideo.$value->file;  
        	 $files = file_get_contents($oldImgPath);
        }else if($fileType=='application'){
        	$oldImgPath= $groupDocument.$value->file;  
        	$files = file_get_contents($oldImgPath);
        }else{
        	echo "hello";
        	$oldImgPath='';  
        	$files = file_get_contents($oldImgPath);
        }
       	             
    

        Storage::disk('s3')->put($group_image.$chat_id.'/'.$value->file, $files,'public');

		} 

       }


      public function moveChatImageServerToS3Storage(){

		$allPost=DB::table('chat_images')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$chat_image = config('constants.chat_image');
			       
		  $chatImg=$s3BaseURL.$chat_image ;

        $chatImage=storage_path('app/public').'/chat_image/' ;
        $chatVideo=storage_path('app/public').'/chat_video/' ;
        $chatDocument=storage_path('app/public').'/chat_document/' ;
        
        
       foreach ($allPost as $key => $value) {
        $chat_id=$value->chat_id ;

        $fileType=$value->file_type ;

        if($fileType=='image'){
        	$oldImgPath= $chatImage.$value->file;  
        	 $files = File::get($oldImgPath);
        }else if($fileType=='video'){
        	$oldImgPath= $chatVideo.$value->file;  
        	 $files = file_get_contents($oldImgPath);
        }else if($fileType=='application'){
        	$oldImgPath= $chatDocument.$value->file;  
        	$files = file_get_contents($oldImgPath);
        }else{
        	$oldImgPath='';  
        	$files = file_get_contents($oldImgPath);
        }
       	             
        Storage::disk('s3')->put($chat_image.$chat_id.'/'.$value->file, $files,'public');

		} 

       }


        public function moveUserIssueImageServerToS3Storage(){

		$allPost=DB::table('users')->where('image','!=','')->get()->toArray();
		$s3BaseURL = config('constants.s3_baseURL');
		$user_profile_img_s3 = config('constants.user_profile_img_s3');
			       
		  $userImagePath=$s3BaseURL.$user_profile_img_s3 ;

        $userImgPath=storage_path('app/public').'/user_image/' ;
        $bannerImgPath=storage_path('app/public').'/banner_image/' ;

       foreach ($allPost as $key => $value) {
        $usrId=$value->id ;
        $imageType = 1 ; //$value->image_type ;

        if($imageType==1){
        	$oldImgPath= $userImgPath.$value->image;  
        }else if($imageType==2){
        	$oldImgPath= $bannerImgPath.$value->image;  
        }else{
        	$oldImgPath='' ;
        }

       	 $files = File::get($oldImgPath);
        Storage::disk('s3')->put($user_profile_img_s3.$usrId.'/'.$value->image, $files,'public');

		} 

       }

       public function cancelEvent(Request $request){

       	 $eventId=isset($request->bookingId)?$request->bookingId:0 ;
       	 $reason=isset($request->cancelReason)?$request->cancelReason:0 ;

       	 if($eventId > 0){

       	 	$updateData=array(
       	 		"cancel_reason"=>$reason,
       	 		"status" => 4
       	 	);

       	 	DB::table('booking_requests')->where('id',$eventId)->update($updateData);
       	 	 $isSendMail = config('constants.isSendMail');
           if($isSendMail==1){
       	 	$this->sendCancelBookingEmail($eventId);  
       	 	}

       	 	echo 1 ;
       	 }else{
       	 	echo 2 ;	
       	 }

       	 

       }

      public function getCountry($id){
          if($id!=''){
            $country = DB::table('countries')->select('name')->where('id',$id)->first(); 
            return isset($country->name)?$country->name:'' ;
          }else{
            return '' ;
          }
            
      }

        public function getCity($id){
         if($id!=''){
            $cities = DB::table('cities')->select('name')->where('id',$id)->first(); 
          return isset($cities->name)?$cities->name:'' ;
      }else{
        return '' ;
      }
            
    }

       public function sendCancelBookingEmail($id){  
		
       

		$booking_requests = BookingRequest::where('id',$id)->first();
		//echo "<pre>";print_r($booking_requests);die;  

		 $subject='Event Cancelled Confirmation' ; 
		 
		 $event_info = Event::where('id',$booking_requests->type_id)->first();
	     $countryName=$this->getCountry($event_info->country);
	     $cityName=$this->getCity($event_info->city);

		 $booking_name=!empty($event_info->event_name)?$event_info->event_name:"";
		 $address=!empty($event_info->address)?$event_info->address:"";
		 $date=date('D, d M Y ', strtotime($event_info->event_date));
		 $time=date('g:i A', strtotime($event_info->event_date));


		

		$user_info = DB::table('users')->where('id',$booking_requests->user_id)->first();
		$name=$user_info->first_name.' '.$user_info->last_name;
		$email=$user_info->email;
		$booking_id=!empty($booking_requests->id)?$booking_requests->id:"";
		$phoneNumber=isset($user_info->phone)?$user_info->phone:'' ;
		$cancelReason = isset($booking_requests->cancel_reason)?$booking_requests->cancel_reason:'' ;
		$status="Cancelled";

		
       $data=array(       	
	    'email'=>$email,
        'user_name' => $name,
		'booking_id'=>$booking_id,
		'booking_name'=>$booking_name,  
		'address'=>$address,
		'date'=>$date,
		'time'=>$time,
		'status'=>$status,
        'booking_type'=>$booking_requests->booking_type,
        'subject' => $subject,
        'no_ticket'=>$booking_requests->number_of_ticket,
        'countryName'=>$countryName ,
        'cityName'=>$cityName,
        'contact_number'=>$phoneNumber,
        'cancel_reason'=>$cancelReason
       );  
       /**/
        
        $data1=sendCancelledBookingEmail($data,1);
        $data1=sendCancelledBookingEmail($data,2);
        
         
    }


}

<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message; 
use App\Models\ChatImage;  
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Carbon\Carbon;

class MessageController extends Controller
{ 
    public function __construct()
    {
        //$this->middleware('auth');
        
    }

    /// show all groups that User is Follow
    public function index(Request $request)  
    {
      
       $data=session()->get('user_session');
          if(empty($data)){  
            return redirect('/');   
          }
      
      
    $user_id=$data['userId']; 
    $array=aboutInfo($user_id);
     $user_profile_img_s3 = config('constants.user_profile_img_s3');
     $s3BaseURL = config('constants.s3_baseURL');
       // $usrImg=url('/')."/storage/app/public/user_image/" ;
         $usrImg=$s3BaseURL.$user_profile_img_s3 ;
         $defaultImg=url('/')."/storage/app/public/user_image/" ;
        $userId = isset($request->userId)?$request->userId:$data['userId'] ;
        //echo $userId;die;
    // select all Users + count how many message are unread from the selected user
       // $users = DB::select("select users.id,users.isOnline,case when users.image is null then concat('".$usrImg."','user_holder.svg') else  concat('".$usrImg."',users.image) end as image, concat(users.first_name,' ',users.last_name) as name, users.email, count(is_read) as unread 
       //  from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
       //  where users.id != " . Auth::id() . " 
       //  group by users.id ");

        $friendList=getFriendListUserId($data['userId']);

       
        $unfriendUser=DB::table("messages")->where("from",$data['userId'])->groupby("to")->get()->pluck('to')->toArray();
        $unfriendUser_=DB::table("messages")->where("to",$data['userId'])->groupby("from")->get()->pluck('from')->toArray();
        $chatUser=array_unique(array_merge($unfriendUser,$unfriendUser_,$friendList));        

        $users = DB::table("users")->select('users.id','users.isOnline',DB::raw("case when users.image is null then concat('".$defaultImg."','user_holder.svg') else  concat('".$usrImg."',users.id,'/',users.image) end as image"),DB::raw("concat(users.first_name,' ',users.last_name) as name"),'users.email',DB::raw("count(is_read) as unread "))->leftjoin("messages",function($join){
            $join->on('users.id','=','messages.from')->where('is_read',0)->where('messages.to',Auth::id());
        })->where('users.id','!=',Auth::id())
        ->whereIn('users.id',$chatUser)
        ->groupBy('users.id')->get();       
         
        $pusherKey = config('constants.PUSHER_APP_KEY'); 
        echo view('website/chat/index')->with(['users'=>$array['users'],'users_' => $users,'userId'=>$userId,'loginUserId'=>$data['userId'],'APP_KEY'=>$pusherKey]);

    }
    //// get all Messages
    public function getMessage(Request $request,$user_id)
    {
                        
    $my_id = Auth::id();

     $user_profile_img_s3 = config('constants.user_profile_img_s3');
     $s3BaseURL = config('constants.s3_baseURL');
     $chatImage = config('constants.chat_image');
     // $chat_video = config('constants.chat_video');
     // $chat_document = config('constants.chat_document');

    //$usrImg=url('/')."/storage/app/public/user_image/" ;
     $usrImg=$s3BaseURL.$user_profile_img_s3 ;
     $defaultImg=url('/')."/storage/app/public/user_image/" ;



    $userInfo = User::select('users.id','users.isOnline',DB::raw("case when users.image is null then concat('".$defaultImg."','user_holder.svg') else  concat('".$usrImg."',users.id,'/',users.image) end as image"),DB::raw("concat(users.first_name,' ',users.last_name) as name"))->where('id',$user_id)->get()->first();

     $check=DB::table("block_friend")->select('id','isBlock')->where('to_',$my_id)->where('from_',$user_id)->first();
     $isBlock=isset($check->isBlock)?$check->isBlock:0 ;

    $checkFriendBlock=DB::table("block_friend")->select('id','isBlock')->where('to_',$user_id)->where('from_',$my_id)->first();

     $isFriendBlock=isset($checkFriendBlock->isBlock)?$checkFriendBlock->isBlock:0 ;


   
    
    
    /// Make read all unread message sent
    Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

    // Get all message from selected user
    $page = $request->has('page') ? $request->get('page') : 1;
    $limit = $request->has('per_page') ? $request->get('per_page') : 20;
    $offset = ($page - 1) * $limit ;

    $messages = Message::select('messages.id','messages.from','messages.to',DB::raw('users.id as userId'),'messages.message','messages.is_read','messages.created_at','messages.updated_at',DB::raw('users.image as usrImg'))->join('users','users.id','=','messages.from')->where(function($query) use ($user_id, $my_id) {
    $query->where('from', $user_id)->where('to', $my_id);
    })->oRwhere(function($query) use ($user_id, $my_id) {
     $query->where('from', $my_id)->where('to', $user_id);
    })->orderby('messages.id','DESC')->skip($offset)->take($limit)->get()->reverse();


     
    $response=array();
	
   
	
    if(!empty($messages)){
        foreach ($messages as $key => $value) {
        $chat_image=DB::table('chat_images')->where('chat_id',$value->id)->get();
		if(!empty($chat_image)){
		$res1=array();
		$res=array();
		foreach($chat_image as $chat_images){
             
     
     
			   if($chat_images->file_type=='image'){ 
			   //$res['image']=url('/')."/storage/app/public/chat_image/".$chat_images->file;
                $res['image']=$s3BaseURL.$chatImage.$chat_images->chat_id.'/'.$chat_images->file;
			   }else if($chat_images->file_type=='video'){ 
			   //$res['image']=url('/')."/storage/app/public/chat_video/".$chat_images->file;
                $res['image']=$s3BaseURL.$chatImage.$chat_images->chat_id.'/'.$chat_images->file;
			   }else if($chat_images->file_type=='application'){ 
			   //$res['image']=url('/')."/storage/app/public/chat_document/".$chat_images->file;
                $res['image']=$s3BaseURL.$chatImage.$chat_images->chat_id.'/'.$chat_images->file;
			   }
               
			   $res['file_type']=$chat_images->file_type;
			   $res['chat_id']=$chat_images->chat_id;
			   $res1[]=$res; 
               unset($res);			   
		}
        }		
       
        $date = Carbon::parse($value->created_at); // now date is a carbon instance
        if(today()->diffInHours($date) < 24 ){
                $value->createdOn =$date->format('H:i') ;
        }else{

        $elapsed = $date->diffForHumans(Carbon::now());
        $elapsed=createdAt($elapsed) ;        
        $value->createdOn =$elapsed ;
        } 
        $value->image=$res1;

       
         if(isset($value->usrImg) && $value->usrImg!=''){
              //$value->usrImg = URL('/').'/storage/app/public/user_image/'.$value->usrImg ;
              $value->usrImg = $s3BaseURL.$user_profile_img_s3.$value->userId.'/'.$value->usrImg ;
              
         }else{
             $value->usrImg = URL('/').'/storage/app/public/user_image/user_holder.svg' ;
         }

        unset($res1);
        $response[]=$value ;
        }



    }

      $totalRecord=Message::select('messages.id','messages.from','messages.to','messages.message','messages.is_read','messages.created_at','messages.updated_at',DB::raw('users.image as usrImg'))->join('users','users.id','=','messages.from')->where(function($query) use ($user_id, $my_id) {
    $query->where('from', $user_id)->where('to', $my_id);
    })->oRwhere(function($query) use ($user_id, $my_id) {
     $query->where('from', $my_id)->where('to', $user_id);
    })->get()->count();
                
          if(($offset+$limit) < $totalRecord){
          $data['isShowMore']=1 ;  
        }else{
          $data['isShowMore']=0 ;  
        }

         $data['page']=$page ; 

    return view('website/chat/message', ['messages' => $response,'userInfo'=>$userInfo,'isBlock'=>$isBlock,'isFriendBlock'=>$isFriendBlock,'data'=>$data]);

    }
   
   /// send new message
    public function sendMessage(Request $request)  
    {
		//echo "<pre>";print_r($request->all());die; 
        $from = Auth::id();
       
        $to = $request->id;
        $message = $request->message;
       //type =
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();
		$res=array();
		$res1=array();


        $usrI = Auth::user();
        $user_profile_img_s3 = config('constants.user_profile_img_s3');
        $s3BaseURL = config('constants.s3_baseURL');
        $chat_image = config('constants.chat_image');
        // $chat_video = config('constants.chat_video');
        // $chat_document = config('constants.chat_document');
                    
                    
        //
        if(isset($usrI->image) && $usrI->image!=''){
             //$fromImg = URL('/').'/storage/app/public/user_image/'.$usrI->id.'/'.$usrI->image ;
             $fromImg = $s3BaseURL.$user_profile_img_s3.$usrI->id.'/'.$usrI->image ;
         }else{
             $fromImg = URL('/').'/storage/app/public/user_image/user_holder.svg' ;
         }
      
       

		if($request->hasFile('chatimg')) {
				$files = $request->file('chatimg');
                
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0];
                    //echo $fileType;die;					
					$imgPath='/public/chat_image';
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name.time().'.'.$ext;
					//$file->storeAs($imgPath,$image_full_name);
                    $file->storeAs($chat_image.$data->id.'/',$image_full_name,'s3Public');
                    $image=$image_full_name;
                   					
					$input=array(
							'chat_id'=>$data->id,
							'file'=>$image,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);

						//$res['file']=url('/').'/storage/app/public/chat_image/'.$image;
                        $res['file']=$s3BaseURL.$chat_image.$data->id.'/'.$image;
						$res['file_type']=$fileType;
						$res1[]=$res;
					DB::table('chat_images')->insert($input);  			 
				}
			}
			if($request->hasFile('chatvideo')) {
				$files = $request->file('chatvideo');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0];
                    //echo $fileType;die;					
					$imgPath='/public/chat_video';
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name.time().'.'.$ext;
					//$file->storeAs($imgPath,$image_full_name);
                    $file->storeAs($chat_image.$data->id.'/',$image_full_name,'s3Public');
                    $image=$image_full_name;
                   					
					$input=array(
							'chat_id'=>$data->id,
							'file'=>$image,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
						//$res['file']=url('/').'/storage/app/public/chat_video/'.$image;
                        $res['file']=$s3BaseURL.$chat_image.$data->id.'/'.$image;
						$res['file_type']=$fileType;
						$res1[]=$res;
					DB::table('chat_images')->insert($input);  			 
				}
			}
			if($request->hasFile('chatFile')) {
				$files = $request->file('chatFile');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0];
                    //echo $fileType;die;					
					$imgPath='/public/chat_document'; 
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name . '.' . $ext;
					//$file->storeAs($imgPath,$image_full_name);
                    $file->storeAs($chat_image.$data->id.'/',$image_full_name,'s3Public');
                    $image=$image_full_name;
                   					
					$input=array(
							'chat_id'=>$data->id,
							'file'=>$image,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
						//$res['file']=url('/').'/storage/app/public/chat_document/'.$image;
                        $res['file']=$s3BaseURL.$chat_image.$data->id.'/'.$image;
						$res['file_type']=$fileType;
						$res1[]=$res;
					DB::table('chat_images')->insert($input);  			 
				}
			}
			
			$msg=!empty($message)?$message:"";
			$message1=array('message'=>$msg,'image'=>$res1,'fromImg'=>$fromImg);
		
        return $this->sendRequest($from, $message1, $to);
    }
    public function sendRequest($from, $message, $to){	

        $users = DB::select("SELECT * FROM messages WHERE messages.to = " . Auth::id() . " ");
        if(isset($users)){
            foreach ($users as $p) {
                $Data = $p->to;
            }}
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
            );  
        //print_r($options);die;
          $PUSHER_APP_ID = config('constants.PUSHER_APP_ID');       
            $PUSHER_APP_KEY = config('constants.PUSHER_APP_KEY');
            $PUSHER_APP_SECRET = config('constants.PUSHER_APP_SECRET');

        $pusher = new Pusher(
                 $PUSHER_APP_KEY,
                 $PUSHER_APP_SECRET,
                 $PUSHER_APP_ID, 
                $options
            );
        // notification
        $data = ['from' => $from,'message'=>$message,'type'=>1, 'to' => $to]; 
        $notify = 'my-channel';
        $pusher->trigger($notify, 'App\\Events\\MyEvent', $data);

    }

    public function blockFriend(Request $request){

        $friendId=isset($request->friendId)?$request->friendId:0 ;
        $loginUserId = Auth::id();
        $isBlock=isset($request->isBlock)?$request->isBlock:0 ;
       
        $check=DB::table("block_friend")->select('id','isBlock')->where('to_',$loginUserId)->where('from_',$friendId)->first();
         $check_block=isset($check->isBlock)?$check->isBlock:0 ;
         $updateId=isset($check->id)?$check->id:0 ;

        if(empty($check)){
            $insertData=array(
                "to_"=>$loginUserId ,
                "from_"=>$friendId ,
                "isBlock"=>1
            );
            DB::table("block_friend")->insert($insertData);
            
        }else{
            DB::select("update block_friend set isBlock=case when isBlock=1 then 0 else 1 end where to_=$loginUserId and from_=$friendId");
             // DB::table("block_friend")->where('id',$updateId)->update(['isBlock'=>$isBlock]);
           
        }

        echo json_encode(array("status"=>1,"message"=>"Successfully block user.","isBlock"=>($check_block==0)?1:0));
    }

    public function loadmore_message(Request $request){
        

        $my_id = Auth::id();
        $user_profile_img_s3 = config('constants.user_profile_img_s3');
        $s3BaseURL = config('constants.s3_baseURL');
        $chat_imagePath = config('constants.chat_image');
        // $chat_video = config('constants.chat_video');
        // $chat_document = config('constants.chat_document');



    $user_id=isset($request->userId)?$request->userId:0 ;


     //$usrImg=url('/')."/storage/app/public/user_image/" ;
     $usrImg=$s3BaseURL.$user_profile_img_s3 ;
   

    $page = $request->has('page') ? $request->get('page') : 1;
    $limit = $request->has('per_page') ? $request->get('per_page') :20;
    $offset = ($page - 1) * $limit ;

    // Get all message from selected user
    $messages = Message::select('messages.id','messages.from','messages.to',DB::raw('users.id as userId'),'messages.message','messages.is_read','messages.created_at','messages.updated_at',DB::raw('users.image as usrImg'))->join('users','users.id','=','messages.from')->where(function($query) use ($user_id, $my_id) {
    $query->where('from', $user_id)->where('to', $my_id);
    })->oRwhere(function($query) use ($user_id, $my_id) {
     $query->where('from', $my_id)->where('to', $user_id);
    })->orderBy('messages.id','desc')->skip($offset)->take($limit)->get()->reverse();
     
    $response=array();
    
   
    
    if(!empty($messages)){
        foreach ($messages as $key => $value) {
        $chat_image=DB::table('chat_images')->where('chat_id',$value->id)->get();
        if(!empty($chat_image)){
        $res1=array();
        $res=array();
        foreach($chat_image as $chat_images){



               if($chat_images->file_type=='image'){ 
               //$res['image']=url('/')."/storage/app/public/chat_image/".$chat_images->file;
               $res['image']=$s3BaseURL.$chat_imagePath.$chat_images->chat_id.'/'.$chat_images->file;
               }else if($chat_images->file_type=='video'){ 
               //$res['image']=url('/')."/storage/app/public/chat_video/".$chat_images->file;
               $res['image']=$s3BaseURL.$chat_imagePath.$chat_images->chat_id.'/'.$chat_images->file;
               }else if($chat_images->file_type=='application'){ 
               //$res['image']=url('/')."/storage/app/public/chat_document/".$chat_images->file;
               $res['image']=$s3BaseURL.$chat_imagePath.$chat_images->chat_id.'/'.$chat_images->file;
               }
               
               $res['file_type']=$chat_images->file_type;
               $res['chat_id']=$chat_images->chat_id;
               $res1[]=$res; 
               unset($res);            
        }
        }       
       
        $date = Carbon::parse($value->created_at); // now date is a carbon instance
        if(today()->diffInHours($date) < 24 ){
                $value->createdOn =$date->format('H:i') ;
        }else{

        $elapsed = $date->diffForHumans(Carbon::now());
        $elapsed=createdAt($elapsed) ;        
        $value->createdOn =$elapsed ;
        } 
        $value->image=$res1;

       
         if(isset($value->usrImg) && $value->usrImg!=''){
              //$value->usrImg = URL('/').'/storage/app/public/user_image/'.$value->usrImg ;
              $value->usrImg = $usrImg.$value->userId.'/'.$value->usrImg ;
         }else{
             $value->usrImg = URL('/').'/storage/app/public/user_image/user_holder.svg' ;
         }

        unset($res1);
        $response[]=$value ;
        }
    }

      $totalRecord=Message::select('messages.id','messages.from','messages.to','messages.message','messages.is_read','messages.created_at','messages.updated_at',DB::raw('users.image as usrImg'))->join('users','users.id','=','messages.from')->where(function($query) use ($user_id, $my_id) {
    $query->where('from', $user_id)->where('to', $my_id);
    })->oRwhere(function($query) use ($user_id, $my_id) {
     $query->where('from', $my_id)->where('to', $user_id);
    })->get()->count();
                
          if(($offset+$limit) < $totalRecord){
          $data['isShowMore']=1 ;  
        }else{
          $data['isShowMore']=0 ;  
        }

         $data['page']=$page ; 
    
    return view('website/chat/ajax_message', ['messages' => $response,'data'=>$data]);

    }

  }
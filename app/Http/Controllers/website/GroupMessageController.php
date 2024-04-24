<?php

namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\group_message;
use App\Models\Group;
use Carbon\Carbon;
use App\Events\MessageEvent;  
use Pusher\Pusher;
use App\Models\User;

class GroupMessageController extends Controller
{
    public function __construct()
    {
        //$this->middleware('member');
    }

    //show messages from a group   
    // public function show_messages($id)
    // {
    //     $group = Group::find($id);

    //     $messages = $group->messages()->with(['group', 'user'])->get();

    //     $user_loggedIn = auth()->user();
    //     return view('messages.index', compact(['group', 'messages']));
    //    // return ['messages' => $messages, 'user_loggedIn' => $user_loggedIn];
    // }
	
	
	
    public function isread($id)
    {
        $my_id = Auth::id();  
        $messages = message::where(['user_id' => $my_id])->get();
        foreach($messages as $value) {
            message::where(['user_id' => $my_id])->update(['is_read' => 1]);
            return redirect()->back();
        }
    }

    

   public function getMessag(Request $request,$id)
    {   
 
        $my_id = Auth::id();

        $group_icon = config('constants.group_icon');
        $userImage = config('constants.user_profile_img_s3');
        $s3BaseURL = config('constants.s3_baseURL');

        //$imgPath = url('/').'/storage/app/public/group_image/thumbnail/' ;
        $imgPath = $s3BaseURL.$group_icon ;
        $group = Group::select('id','group_name','code','admin_id',DB::raw('case when thumbnail="" then "" else concat("'.$imgPath.'",id,"/",thumbnail)  end as image '),'created_at')->where('id',$id)->first();
        // get all messages that User sent & got
        // $messages = Message::where(function ($query) use ($id, $my_id) {
        //     $query->where('group_id', $id)->where('user_id', $my_id);
        // })->oRwhere(function ($query) use ($id, $my_id) {
        //     $query->where('group_id', $my_id)->where('user_id', $id);
        // })->get();

        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('per_page') ? $request->get('per_page') : 20;
        $offset = ($page - 1) * $limit ;


        $messages = DB::table('group_messages')->select('group_messages.id',DB::raw('users.id as userId'),'group_messages.user_id','group_messages.group_id','group_messages.from','group_messages.name','group_messages.is_read','group_messages.message','group_messages.created_at','group_messages.updated_at',DB::raw('users.image as groupImg'),DB::raw("concat(users.first_name,' ',last_name) as name"),'group_messages.message_type')
        ->join('users','users.id','=','group_messages.from')
        ->where(['group_id' => $id])->where(['user_id' => $my_id])->orderby('group_messages.id','DESC')->skip($offset)->take($limit)->get()->reverse();
        
        foreach($messages as $value) {
            DB::table('group_messages')->where(['user_id' => $my_id])->update(['is_read' => 1]); // if User start to see messages is_read in Table update to 0
        }

        // $imgPath=url('/')."/storage/app/public/group_image/" ;
        // $videoPath=url('/')."/storage/app/public/group_video/" ;
        // $applicationPath=url('/')."/storage/app/public/group_document/" ;

        $group_image = config('constants.group_image');
        

        $imgPath=$s3BaseURL.$group_image ;
        // $videoPath=$s3BaseURL.$group_image ;
        // $applicationPath=$s3BaseURL.$group_image ;

        $response=array();
        if(!empty($messages)){
        foreach ($messages as $key => $value) {
			
         $chat_image=DB::table('group_images')->select('chat_id','file_type',DB::raw("case when (file_type='image' && file is not null) then concat('".$imgPath."',chat_id,'/',file) when (file_type='video' && file is not null) then concat('".$imgPath."',chat_id,'/',file) when (file_type='application' && file is not null) then concat('".$imgPath."',chat_id,'/',file) else '' end as image ") )
           ->where('chat_id',$value->id)->get()->toArray();
            $res1=array();
        
        if(!empty($chat_image)){
        $res1=$chat_image; 
        }

  
        $date = Carbon::parse($value->created_at); // now date is a carbon instance
        if(today()->diffInHours($date) < 24 ){
         $value->createdOn =$date->format('H:i') ;
         }else{

        $elapsed = $date->diffForHumans(Carbon::now());
        $elapsed=createdAt($elapsed) ;        
        $value->createdOn =$elapsed ;
        }  
        
         if(isset($value->groupImg) && $value->groupImg!=''){
             // $value->groupImg = URL('/').'/storage/app/public/user_image/'.$value->groupImg ;
              $value->groupImg = $s3BaseURL.$userImage.$value->userId.'/'.$value->groupImg ;
         }else{
             $value->groupImg = URL('/').'/storage/app/public/user_image/user_holder.svg' ;
         }

        $value->image=$res1 ; 
        $response[]=$value ;
        }
    }
       
        //$usrImg=url('/')."/storage/app/public/user_image/" ;
        $usrImg=$s3BaseURL.$userImage ;
      
  
         $users_list = DB::select("select users.id,users.isOnline,case when users.image is null then '' else  concat('".$usrImg."',users.id,'/',users.image) end as image, concat(users.first_name,' ',users.last_name) as name,LEFT (users.first_name, 1) as first_letter,users.email
        from users where status=1 and is_delete limit 5 ");

         $groupUser = DB::select("select user_id from group_participants where group_id=".$id);

         $totalGroupMember = DB::table("group_participants")->where('group_id',$id)->count();

           $totalRecord=DB::table('group_messages')
        ->join('users','users.id','=','group_messages.from')
        ->where(['group_id' => $id])->where(['user_id' => $my_id])->count();
                
          if(($offset+$limit) < $totalRecord){
          $data['isShowMore']=1 ;  
        }else{
          $data['isShowMore']=0 ;  
        }

         $data['page']=$page ; 


        return view('website/group/message', ['messages' => $response,'userList'=>$users_list ,'group'=>$group,'groupUser'=>$groupUser,'groupMember'=>$totalGroupMember,'data'=>$data]);
        
    }

   public function sendMessage(Request $request)
    {    
        $to = $request->id; // this part get Group id
        // this part get  user id who watnts to send message
        $group = Group::find($request->id);  // find group according id
        $from = Auth::id();
        $name = Auth::user()->first_name.' '.Auth::user()->last_name ;
        $group_members = $group->participants()->get();

		$res=array();
		$res1=array();

          $usrI = User::select('image')->where('id',$from)->get()->first();

        $user_profile_img_s3 = config('constants.user_profile_img_s3');
        $s3BaseURL = config('constants.s3_baseURL');
        $group_image = config('constants.group_image');
        $gImg=$s3BaseURL.$group_image ;

        if(isset($usrI->image) && $usrI->image!=''){
             //$fromImg = URL('/').'/storage/app/public/user_image/'.$usrI->image ;
             $fromImg = $s3BaseURL.$user_profile_img_s3.$from.'/'.$usrI->image ;
         }else{
             $fromImg = URL('/').'/storage/app/public/user_image/user_holder.svg' ;
         }
         
        
         // send for all Followers
         foreach($group_members as $value) {


            $message = group_message::create(
              $data = array(
               'group_id' => $request->id, 
               'user_id' => $value->id, 
               'message' => $request->message,
               'from' => $from,
               'name' => $name, 
               'is_read' =>(Auth::id()==$value->id)?1:0,
               'message_type'=>isset($request->message_type)?$request->message_type:1,
               ));
			   //echo "<pre>";print_r($message['id']);die;
            
			   if($request->hasFile('chatimg')) {
				$files = $request->file('chatimg');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0];
                    //echo $fileType;die;					
					$imgPath='/public/group_image';
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name.time().'.'.$ext;
					//$file->storeAs($imgPath,$image_full_name);
                    $file->storeAs($group_image.$message['id'].'/',$image_full_name,'s3Public');
                    $image=$image_full_name;
                   					
					$input=array(
							'chat_id'=>$message['id'],
							'file'=>$image,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
						//$res['file']=url('/').'/storage/app/public/group_image/'.$image;
                        $res['file']=$gImg.$message['id'].'/'.$image;
						$res['file_type']=$fileType;
						$res1[]=$res;  
					DB::table('group_images')->insert($input);  			 
				}
			}
			if($request->hasFile('chatvideo')) {
				$files = $request->file('chatvideo');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0];
                    //echo $fileType;die;					
					$imgPath='/public/group_video';
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name.time().'.'.$ext;
					//$file->storeAs($imgPath,$image_full_name);
                    $file->storeAs($group_image.$message['id'].'/',$image_full_name,'s3Public');
                    $image=$image_full_name;
                   					
					$input=array(
							'chat_id'=>$message['id'],
							'file'=>$image,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
						//$res['file']=url('/').'/storage/app/public/group_video/'.$image;
                        $res['file']=$gImg.$message['id'].'/'.$image;
						$res['file_type']=$fileType;
						$res1[]=$res;
					DB::table('group_images')->insert($input);  			 
				}
			}
			if($request->hasFile('chatFile')) {
				$files = $request->file('chatFile');
				foreach ($files as $file) {	  
				    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $file);
					$fileType = explode('/', $mime_type)[0];
                    //echo $fileType;die;					
					$imgPath='/public/group_document'; 
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
                    
					$image_full_name = $image_name.time().'.'.$ext;
					//$file->storeAs($imgPath,$image_full_name);
                    $file->storeAs($group_image.$message['id'].'/',$image_full_name,'s3Public');
                    $image=$image_full_name;
                   					
					$input=array(
							'chat_id'=>$message['id'],
							'file'=>$image,  
							'file_type'=>$fileType,  
							'created_at'=>date("Y-m-d H:i:s")
						);
						//$res['file']=url('/').'/storage/app/public/group_document/'.$image;
                        $res['file']=$gImg.$message['id'].'/'.$image;
						$res['file_type']=$fileType;
						$res1[]=$res;
					DB::table('group_images')->insert($input);  			 
				}
			}
			
			
               /// Pusher send New message at real time
               $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
                );

            $PUSHER_APP_ID = config('constants.PUSHER_APP_ID');       
            $PUSHER_APP_KEY = config('constants.PUSHER_APP_KEY');
            $PUSHER_APP_SECRET = config('constants.PUSHER_APP_SECRET');

            $pusher = new Pusher(
                   $PUSHER_APP_KEY,
                    $PUSHER_APP_SECRET,
                    $PUSHER_APP_ID, 
                    $options
                );  
            $msg=!empty($request->message)?$request->message:"";
			$message1=array('message'=>$msg,'image'=>$res1 ,'fromImg'=>$fromImg);
            $res1=array();          
            $data1 = ['from' => $to, 'to' => $from,'message'=>$message1,'type'=>1,'message_type'=>isset($request->message_type)?$request->message_type:1,'sender_name'=>$name];  
            $notify = '' . $value->id .'';
           
           // $pusher->trigger($notify, 'App\\Events\\Notify', $data);
             //$notify = 'my-channel';
             $pusher->trigger($notify, 'App\\Events\\Notify', $data1);
            //$pusher->trigger($notify, 'App\\Events\\MyEvent', $data);
             }
        return redirect()->back();
    }

    public function loadmore_group_message(Request $request){

         $id=isset($request->groupId)?$request->groupId:0 ;

             $my_id = Auth::id();



        
        //$imgPath = url('/').'/storage/app/public/group_image/thumbnail/' ;
        
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('per_page') ? $request->get('per_page') :20;
        $offset = ($page - 1) * $limit ;

        $messages = DB::table('group_messages')->select('group_messages.id','group_messages.user_id','group_messages.group_id','group_messages.from','group_messages.name','group_messages.is_read','group_messages.message','group_messages.created_at','group_messages.updated_at',DB::raw('users.id as userId'),DB::raw('users.image as groupImg'),'group_messages.message_type')
        ->join('users','users.id','=','group_messages.from')
        ->where(['group_id' => $id])->where(['user_id' => $my_id])->orderBy('group_messages.id','desc')->skip($offset)->take($limit)->get()->reverse();

      
        $response=array();
        $s3BaseURL = config('constants.s3_baseURL');       
        $group_image = config('constants.group_image');
        $user_profile_img_s3 = config('constants.user_profile_img_s3');

        // $imgPath=url('/')."/storage/app/public/group_image/" ;
        // $videoPath=url('/')."/storage/app/public/group_video/" ;
        // $applicationPath=url('/')."/storage/app/public/group_document/" ;

        $imgPath=$s3BaseURL.$group_image ;
       


        if(!empty($messages)){
        foreach ($messages as $key => $value) {
            
           $chat_image=DB::table('group_images')->select('chat_id','file_type',DB::raw("case when (file_type='image' && file is not null) then concat('".$imgPath."',chat_id,'/',file) when (file_type='video' && file is not null) then concat('".$imgPath."',chat_id,'/',file) when (file_type='application' && file is not null) then concat('".$imgPath."',chat_id,'/',file) else '' end as image ") )
           ->where('chat_id',$value->id)->get();
            $res1=array();
        
        if(!empty($chat_image)){
        $res1=$chat_image; 
        }

        $date = Carbon::parse($value->created_at); // now date is a carbon instance
        if(today()->diffInHours($date) < 24 ){
         $value->createdOn =$date->format('H:i') ;
         }else{

        $elapsed = $date->diffForHumans(Carbon::now());
        $elapsed=createdAt($elapsed) ;        
        $value->createdOn =$elapsed ;
        }  
        
         if(isset($value->groupImg) && $value->groupImg!=''){
              //$value->groupImg = URL('/').'/storage/app/public/user_image/'.$value->groupImg ;
            $value->groupImg = $s3BaseURL.$user_profile_img_s3.$value->userId.'/'.$value->groupImg ;
         }else{
             $value->groupImg = URL('/').'/storage/app/public/user_image/user_holder.svg' ;
         }

        $value->image=$res1 ; 
        $response[]=$value ;
        }
    }
       
     $totalRecord=DB::table('group_messages')
        ->join('users','users.id','=','group_messages.from')
        ->where(['group_id' => $id])->where(['user_id' => $my_id])->count();
                
          if(($offset+$limit) < $totalRecord){
          $data['isShowMore']=1 ;  
        }else{
          $data['isShowMore']=0 ;  
        }

         $data['page']=$page ; 

        return view('website/group/ajax_group_message', ['messages' => $response,'data'=>$data]);
    }
   


}

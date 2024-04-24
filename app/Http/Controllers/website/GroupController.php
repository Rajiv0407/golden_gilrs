<?php
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Message; 
use App\Models\ChatImage;  
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\group_message; 
use App\Http\Controllers\website\GroupMessageController;
use Image ;
use Thumbnail ;

class GroupController extends Controller
{ 
    
     protected $groupController;
 
    public function __construct(GroupMessageController $groupController)
    {
        
        $this->groupController = $groupController;

    }

  
	   public function index()
    {

      $data=session()->get('user_session');
      if(empty($data)){  
        return redirect('/');   
      }
    
        $my_id = Auth::id();
        // select channels that User Subscribe

        $group_icon = config('constants.group_icon');
        $userImage = config('constants.user_profile_img_s3');
        $s3BaseURL = config('constants.s3_baseURL');

        //$filePath = url('/').'/storage/app/public/group_image/thumbnail/' ;
        $filePath = $s3BaseURL.$group_icon ;
		$defaltImg=url('/')."/storage/app/public/group_image/";

         $user_id=$data['userId']; 
        $array=aboutInfo($user_id); 
       
        

  //      LEFT  JOIN  group_messages ON group_participants.user_id = group_messages.user_id and is_read = 0 and group_messages.group_id=group_participants.group_id  and group_messages.from = " . Auth::id() . "
  // and group_participants.user_id = " . Auth::id() . "

        // ,count(group_messages.is_read) as unread

        $groupList = DB::select("select groups.id, groups.group_name , case when groups.thumbnail='' then concat('".$defaltImg."','group_icon.png') else concat('".$filePath."',groups.id,'/',groups.thumbnail) end as groupImg,(select count(*) from group_messages where group_id=groups.id and user_id=group_participants.user_id
            and is_read = 0) as unread from `groups` inner JOIN  group_participants ON groups.id = group_participants.group_id 
        where group_participants.user_id = " . Auth::id() . "
        and group_participants.isBlock = 0
        group by groups.id, groups.group_name");        
		
          $usrImg=$s3BaseURL.$userImage ; //url('/')."/storage/app/public/user_image/" ;

        $friendList=getFriendListUserId($data['userId']);
        $users_list = DB::table("users")->select('users.id','users.isOnline',DB::raw("case when users.image is null then concat('".$usrImg."','user_holder.svg') else  concat('".$usrImg."',users.id,'/',users.image) end as image"),DB::raw("concat(users.first_name,' ',users.last_name) as name"),'users.email',DB::raw("count(is_read) as unread "))->leftjoin("messages",function($join){
            $join->on('users.id','=','messages.from')->where('is_read',0)->where('messages.to',Auth::id());
        })->where('users.id','!=',Auth::id())
        ->whereIn('users.id',$friendList)
        ->groupBy('users.id')->get();
  
        // $users_list = DB::select("select users.id,users.isOnline,case when users.image is null then '' else  concat('".$usrImg."',users.image) end as image, concat(users.first_name,' ',users.last_name) as name,LEFT (users.first_name, 1) as first_letter,users.email
        // from users where status=1 and is_delete =1 and id != '$my_id'"); 
		//echo "<pre>";print_r($groupList);die;   
        $pusherKey = config('constants.PUSHER_APP_KEY'); 
         return view('website/group/index',['users'=>$array['users'],'group_list' => $groupList,'user_list' => $users_list,'APP_KEY'=>$pusherKey]);

         /**/
    }
    //  get all Channels are in App   
    public function subscribe()
    {
        $groupALL = Group::all();
        
        return view('group.join', compact('groupALL'));
    }

    public function updateGroup(Request $request){
          $this->validate($request, [
            'update_name' => 'required'
        ]);

          $groupId = isset($request->groupId)?$request->groupId:0 ;

          DB::table('groups')->where('id',$groupId)->update(['group_name'=>$request->update_name]);
          return json_encode(array("status"=>1));
    }

    public function createGroup(Request $request){
        // echo "<pre>";
        // print_r($_FILES['add_groupimg']);
        // exit ;
        $this->validate($request, [
            'group_name' => 'required'
        ]);

        $discription=isset($request->group_description)?$request->group_description:'' ;
         //generate a code for the groupe        
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($characters), rand(0, 9), 7).time();
        //image upload 
        $smallthumbnail='';
        $filenametostore='' ;
        


        // insert New Group to Table
        $group = Group::create([
            'group_name' => $request->group_name,
            'code' => $code,           
            'admin_id' => auth()->user()->id,
            'discription'=>$discription
        ]);

        $groupId=isset($group->id)?$group->id:0 ;


        if($request->hasfile('add_groupimg')){
            $allowedfileExtension=['jpg', 'jpeg','PNG','JPEG','JPG', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','flv'];
         $file = $request->file('add_groupimg'); 
         $errors = [];
         $mimeType=$file->getMimeType() ;
         $filenamewithextension = $file->getClientOriginalName(); 
         $extension = $file->getClientOriginalExtension();  
        
          $check = in_array($extension,$allowedfileExtension);
          //$fileType = $this->checkFileType($filenamewithextension);

        
           if($check){

                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;         
                 //$file->storeAs('public/group_image/', $filenametostore);
                 //'image'=>$filenametostore,
                $smallthumbnail = $filename.'_100_100_'.time().'.jpg';    
                //$file->storeAs('public/group_image/thumbnail/', $smallthumbnail);
                //$smallthumbnailpath = public_path('storage/group_image/thumbnail/'.$smallthumbnail);
              // $this->createThumbnail($smallthumbnailpath, 100, 100);

                $group_icon = config('constants.group_icon');
                $s3BaseURL = config('constants.s3_baseURL');
                $file->storeAs($group_icon.$groupId.'/',$filenametostore,'s3Public');

                $img = Image::make($file->getRealPath())->orientate()->fit(1024, null, function ($constraint) {
                        $constraint->aspectRatio();
                        });

                        
                Storage::disk('s3')->put($group_icon.$groupId.'/'.$smallthumbnail, $img->stream()->__toString(),'public');

                $updateArray=array(
                'image' =>$filenametostore, 
                'thumbnail'=>$smallthumbnail,
                );

               DB::table('groups')->where('id',$groupId)->update($updateArray);
             }

         }
        $group->participants()->attach(auth()->user()->id);
       //  ///we attach the user with the group after he created it
        foreach ($request->groupUser as  $value) {
             $group->participants()->attach($value);
        }
       return json_encode(array("status"=>1));


    }

   
     public function createThumbnail($path, $width, $height)
    {
      $img = \Image::make($path)->resize($width, $height)->save($path);
    }



   // unFollow User a Channel 
    public function remove_user($id)
    {
        $group = Group::find($id);  // find Channel in Group Table
        $my_id = Auth::id();        // current User
        $group->participants()->detach($my_id);  // remove User in group_participants Table
        $messages = message::where(['from' => $my_id])->first(); // find User in Messages Table according his Id
        if (is_array($messages) || is_object($messages))
        {
        foreach($messages as $value) {
            message::where(['from' => $my_id])->delete();  // delete all messages of User in Messages Table
        }
    }
        return redirect()->back();
    }
    
    // get messages of user according find Group     
    public function getMessag($id)
    {
        $my_id = Auth::id();
        $group = Group::find($id);
        // get all messages that User sent & got
        // $messages = Message::where(function ($query) use ($id, $my_id) {
        //     $query->where('group_id', $id)->where('user_id', $my_id);
        // })->oRwhere(function ($query) use ($id, $my_id) {
        //     $query->where('group_id', $my_id)->where('user_id', $id);
        // })->get();
        $messages = message::where(['group_id' => $id])->where(['user_id' => $my_id])->get();
		//echo "<pre>";print_r($messages);die; 
        foreach($messages as $value) {
            message::where(['user_id' => $my_id])->update(['is_read' => 1]); // if User start to see messages is_read in Table update to 0
        }
        return view('messages.index', compact(['group', 'messages']));
    }
    // update is_read .... this function update messages is not read and update to read in Navbar
    // public function getMessage($id)
    // {
    //     $my_id = Auth::id();
    //     $group = Group::find($id);
    //     $messages = message::where(['user_id' => $my_id])->get();
    //     foreach($messages as $value) {
    //         message::where(['user_id' => $my_id])->update(['is_read' => 1]);
    //     }
    // }
   
   // send new message to all Followers
    public function sendMessage(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);
        $to = $request->id; // this part get Group id
        $from = Auth::id();  // this part get  user id who watnts to send message
        $group = Group::find($request->id);  // find group according id
        $from = Auth::id();
        $name = Auth::user()->name;
        $group_members = $group->participants()->get();
         // send for all Followers
         foreach($group_members as $value) {
            $message = Message::create(
              $data = array(
               'group_id' => $request->id, 
               'user_id' => $value->id, 
               'message' => $request->message,
               'from' => $from,
               'name' => $name, 
               'is_read' => 0,
               ));

                
             
               // Pusher send New message at real time
               $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
                );
            $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'), 
                    $options
                );
            $data = ['from' => $to, 'to' => $value->id]; 
            $notify = '' . $value->id .'';
            $pusher->trigger($notify, 'App\\Events\\Notify', $data);
            
            }

        
        return redirect()->back();
    }

    public function update_groupImage(Request $request){

       

        $groupId=isset($request->groupId)?$request->groupId:0 ;

        $smallthumbnail='';
        $filenametostore='' ;

        try{


        if($request->hasfile('edit_groupimg')){
            $allowedfileExtension=['jpg', 'jpeg','PNG','JPEG','JPG', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','flv'];
         $file = $request->file('edit_groupimg'); 
         $errors = [];
         $mimeType=$file->getMimeType() ;
         $filenamewithextension = $file->getClientOriginalName(); 
         $extension = $file->getClientOriginalExtension();  
        
          $check = in_array($extension,$allowedfileExtension);
          //$fileType = $this->checkFileType($filenamewithextension);

              if($check){

                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;         
                 //$file->storeAs('public/group_image/', $filenametostore);
                 //'image'=>$filenametostore,
                $smallthumbnail = $filename.'_100_100_'.time().'.jpg';   
                $group_icon = config('constants.group_icon');
                $s3BaseURL = config('constants.s3_baseURL');
                $file->storeAs($group_icon.$groupId.'/',$filenametostore,'s3Public');

                $img = Image::make($file->getRealPath())->orientate()->fit(1024, null, function ($constraint) {
                        $constraint->aspectRatio();
                        });

                        
                Storage::disk('s3')->put($group_icon.$groupId.'/'.$smallthumbnail, $img->stream()->__toString(),'public');


                //$file->storeAs('public/group_image/thumbnail/', $smallthumbnail);

                
                 $smallthumbnailpath = $s3BaseURL.$group_icon.$groupId.'/'.$smallthumbnail;
               // $smallthumbnailpath = storage_path('app/public/group_image/thumbnail/'.$smallthumbnail);
               //$this->createThumbnail($smallthumbnailpath, 100, 100);

                $group = Group::where('id',$groupId)->update([           
                'image' =>$filenametostore, 
                'thumbnail'=>$smallthumbnail           
                ]);

                $imgUrl=$smallthumbnailpath ; //URL('/').'/storage/app/public/group_image/thumbnail/'.$smallthumbnail ;
             }else{
              $imgUrl='' ;
             }

        }

         if($imgUrl!=''){
           return json_encode(array("status"=>1,'imgUrl'=>$imgUrl));
         }else{
           return json_encode(array("status"=>0,'imgUrl'=>$imgUrl));
         }
       }  catch(\Exception $e)
          { 
           // echo $e ; exit ;
        //echo "<pre>";print_r($user_info);die;  
           return json_encode(array("status"=>0,'imgUrl'=>''));
          }  
     


    }

    public function groupManageMember(Request $request){
        $data=session()->get('user_session');
        $groupId=isset($request->groupId)?$request->groupId:0 ;
        $searchKey=isset($request->searchKey)?$request->searchKey:'' ;

         $usrImgPath=url('/').'/storage/app/public/user_image/' ;
          $defaultImgPath=url('/').'/storage/app/public/user_image/user.png';
       
        $groupInfo=DB::table('groups')->select('id','group_name','admin_id')
        ->addSelect(DB::raw("(select count(*) from group_participants where group_id=$groupId) as totalGroupMember"))
        ->where('id',$groupId)->first();

        if($searchKey!=''){
           $groupParticipant=DB::table('group_participants')->select('users.id',DB::raw("concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.image) end as image"),'users.email','group_participants.group_id','group_participants.isBlock')->join('users','users.id','=','group_participants.user_id')->where('group_participants.group_id',$groupId)->where(DB::raw("concat(users.first_name,' ',users.last_name)"), 'LIKE', '%'.$searchKey.'%')->get()->toArray();
        }else{
           $groupParticipant=DB::table('group_participants')->select('users.id',DB::raw("concat(users.first_name,' ',users.last_name) as name"),DB::raw(" case when users.image is null then concat('".$defaultImgPath."') else concat('".$usrImgPath."',users.image) end as image"),'users.email','group_participants.group_id','group_participants.isBlock')->join('users','users.id','=','group_participants.user_id')->where('group_participants.group_id',$groupId)->get()->toArray();
        }
       
       
        return view('website.group.manage_group_member')->with('groupParticipant', $groupParticipant)->with('groupInfo',$groupInfo);    
    }


    public function addGroupMember(Request $request){

        $data=session()->get('user_session');
        $groupId=isset($request->groupId)?$request->groupId:0 ;
        $usrImg=url('/')."/storage/app/public/user_image/" ;
        $groupInfo=DB::table('groups')->select('id','group_name','admin_id')        
        ->where('id',$groupId)->first();

        $friendList=getFriendListUserId($data['userId']);
        $users_list = DB::table("users")->select('users.id','users.isOnline',DB::raw("case when users.image is null then concat('".$usrImg."','user_holder.svg') else  concat('".$usrImg."',users.image) end as image"),DB::raw("concat(users.first_name,' ',users.last_name) as name"),'users.email',DB::raw("count(is_read) as unread "))->leftjoin("messages",function($join){
            $join->on('users.id','=','messages.from')->where('is_read',0)->where('messages.to',Auth::id());
        })->where('users.id','!=',Auth::id())
        ->whereIn('users.id',$friendList)
        ->groupBy('users.id')->get();      
      

        return view('website.group.add_member')->with('user_list', $users_list)->with('groupInfo',$groupInfo);  

    }

    public function updateGroupMember(Request $request){
        $data=session()->get('user_session');
        $loginUserName=$data['userFirstName'].' '.$data['userLastName'] ;

        $groupId=isset($request->groupId)?$request->groupId:0 ;
        $group = Group::find($groupId);  
        $requestGroupMember=$request->addGroupUser ;
       $data = DB::table("group_participants")->select('user_id')->where('group_id',$groupId)->whereIn('user_id',$requestGroupMember)->pluck('user_id')->toArray();

       $notExistMember = array_diff($requestGroupMember,$data);
      

       if(!empty($notExistMember)){

            foreach ($notExistMember as  $value) {             
            $group->participants()->syncWithoutDetaching($value);                
           }

           
                $receivername=$this->getUserName($notExistMember);
                $content = new Request();
                $content->id = $groupId;
                $content->message = $loginUserName." added ".$receivername;
                $content->message_type = 2;
                $this->groupController->sendMessage($content);
            

       }

        $totalParticipant=DB::table('group_participants')->where('group_id',$groupId)->count();
        return json_encode(array("status"=>1,"total_participant"=>$totalParticipant));
    }

    public function getUserName($userId){
        $user=User::select(DB::raw("Group_concat(concat(first_name,' ',last_name)) as name"))->whereIn('id',$userId)->first();
        return isset($user->name)?$user->name:'' ;
    }
    
     public function removeGroupMember(Request $request){
        $groupId=isset($request->groupId)?$request->groupId:0;
        $userId=isset($request->userId)?$request->userId:0;
    
        if($groupId > 0 && $userId > 0){
            DB::table("group_participants")->where('group_id',$groupId)->where('user_id',$userId)->delete();
        }
        return json_encode(array("status"=>1));
    }

    public function blockGroupMember(Request $request){

        $groupId=isset($request->groupId)?$request->groupId:0;
        $userId=isset($request->userId)?$request->userId:0;
        $isBlock=isset($request->isBlock)?$request->isBlock:0;

        if($isBlock==0){
            $updateBlock=1 ;
        }else{
             $updateBlock=0 ;
        }
    
        if($groupId > 0 && $userId > 0){
            echo "fff";
            DB::table("group_participants")->where('group_id',$groupId)->where('user_id',$userId)->update(["isBlock"=>$updateBlock]);
        }
        return json_encode(array("status"=>1));

    }

    public function leaveGroup(Request $request){
         $groupId=isset($request->groupId)?$request->groupId:0;
         $isAdmin=isset($request->isAdmin)?$request->isAdmin:0;
         $data=session()->get('user_session');
         $loginId=$data['userId'] ;

          DB::table("group_participants")->where('group_id',$groupId)->where('user_id',$loginId)->delete();

         if($isAdmin==$loginId){
            $getAdminId=DB::table("group_participants")->select('user_id')->where('group_id',$groupId)->first() ;
            $getAdminId_=isset($getAdminId->user_id)?$getAdminId->user_id:'' ;
            DB::table("groups")->where('id',$groupId)->update(['admin_id'=>$getAdminId_]);
         }

        return json_encode(array("status"=>1));
    }

    public function groupManageMemberModal(Request $request){
        $groupId=isset($request->groupId)?$request->groupId:0 ;

         $imgPath = url('/').'/storage/app/public/group_image/thumbnail/' ;

        $group = Group::select('id','group_name','code','admin_id',DB::raw('case when thumbnail="" then "" else concat("'.$imgPath.'",thumbnail)  end as image '),'created_at')->where('id',$groupId)->first();

       $totalGroupMember = DB::table("group_participants")->where('group_id',$groupId)->count();


         return view('website/group/manageMember_modal', ['group'=>$group,'groupMember'=>$totalGroupMember]);

    }

  }
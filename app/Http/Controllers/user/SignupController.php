<?php
namespace App\Http\Controllers\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\EventImage;
use App\Models\Event;
use Hash;  
use Session ;
use DB ;
use Auth ;
use Image ;
use Cookie;
use App\Helper;


class SignupController extends Controller
{
	
    public function login(Request $request){ 
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
	  
    	return view('/login',$data);
    }
	
	public function index(Request $request){ 
		$data=session()->get('user_session');  
        if(!empty($data)){   		
		 //$userInfo = user::find($data['userId']); 
		  $user_id=$data['userId'];
          $usrQry = "select u.id,u.name,u.email,u.dob,u.status,u.image,up.user_id,up.gender,up.age,up.country,up.city,up.relationship,up.height,up.weight,up.education,up.know,up.interests,up.smoking,up.eye_color,up.marital_status,up.looking_man_for,up.work_as,up.self_des,up.banner_image,up.lat,up.log from users as u inner join user_profile as up on u.id=up.user_id where is_delete=1 and u.id=$user_id" ; 
          $userInfo = DB::select($usrQry); 
         $LATITUDE=!empty($userInfo[0]->lat)?$userInfo[0]->lat:"0.00";
		 $LONGITUDE=!empty($userInfo[0]->log)?$userInfo[0]->log:"0.00";
         $query="select u.id,(((acos(
                          sin(( $LATITUDE * pi() / 180))
                          *
                          sin(( up.lat * pi() / 180)) + cos(( $LATITUDE * pi() /180 ))
                          *
                          cos(( up.lat * pi() / 180)) * cos((( $LONGITUDE - up.log) * pi()/180)))
                  ) * 180/pi()) * 60 * 1.1515 * 1.609344)
      as distance,u.name,u.email,u.dob,u.status,u.image,up.user_id,up.gender,up.age,up.country,up.city,up.relationship,up.height,up.weight,up.education,up.know,up.interests,up.smoking,up.eye_color,up.marital_status,up.looking_man_for,up.work_as,up.self_des,up.banner_image,up.lat,up.log from users as u inner join user_profile as up on u.id=up.user_id where is_delete=1 and u.id !=$user_id";	  
          
          $userInfo1 = DB::select($query); 
		  		   
         if($userInfo[0]->image != ''){		
		  $userInfo['image']=url('/').'/storage/app/public/user_image/'.$userInfo[0]->image;   
		 }else{
            $userInfo['image']=url('/').'/storage/app/public/user_image/'.'user.png';  
		 }
		 if($userInfo[0]->banner_image != ''){		
		  $userInfo['banner_image']=url('/').'/storage/app/public/banner_image/'.$userInfo[0]->banner_image;   
		 }else{
            $userInfo['banner_image']="";
		 }
        // echo "<pre>";print_r($userInfo1);die;  
        $dateOfBirth =$userInfo[0]->dob ;
		$today = date("Y-m-d");
		//echo $dateOfBirth;die;   
		$diff = date_diff(date_create($dateOfBirth), date_create($today));
		$userInfo['age']=$diff->format('%y');    
        $userInfo['date'] =date('d F Y', strtotime($userInfo[0]->dob));   
        $data['userInfo']=$userInfo ;
        
		echo view('user/myaccount',$data)->with('frnd_data',$userInfo1);            
	  }else{
		return view('/login',$data); 
	 }
    }
	public function profileData(Request $request){  
		$data['title']="golden girl" ;
		$data=session()->get('user_session'); 
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
	
	public function event_listing(Request $request){
		
	  $typeQry = "select id,type_name from event_type where status=1" ; 
      $eventTypeData = DB::select($typeQry);
		
        $data['event_type']=$eventTypeData;	
		$data['title']='Golden girls' ;
        return view('user/event',$data);  
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
	
	
	
	 public function change_password(Request $request){
		$data=session()->get('user_session'); 
		$userInfo = user::find($data['userId']) ;
		//echo "<pre>";print_r($userInfo);die;
        $data['userInfo']=$userInfo ;
		$data['title']='Golden girls' ;
        return view('user/change_password',$data);  
    } 
	
	 public function edit_profile(Request $request){
		   
		$data=session()->get('user_session'); 
		$userInfo = user::find($data['userId']) ;
		//echo "<pre>";print_r($userInfo);die;
        $data['userInfo']=$userInfo ;
     return view('user/edit_profile',$data);    
    } 

    public function do_login(Request $request){	
	    //echo $request->login_email;die; 
        		
        $credentials = [
            'email' => $request->login_email,
            'password' => $request->password,
            'user_type' => 1,
            'status' => 1
        ]; 
		 
       if(auth()->attempt($credentials)) {
       	$userData = auth()->user() ;  
        //print_r($userData);die;	  
       	$userId = $userData->id ;
       	$userType = $userData->user_type ;
        $rememberMe = $request->rememberMe ;
         $session_data = array('userId' => $userId,
                                'userType' => $userType,
                                'userName' =>$userData->name,
                                'userEmail' =>$request->login_email,                         
                                );
         Session::put('user_session', $session_data); 

        if($rememberMe==1){
        Cookie::queue('userName', $request->login_email, 60);
        Cookie::queue('userPassword', $request->password, 60);      
        }
        
        echo 'succ';
      
   		}else{

   		echo 'fail'; 
   		}  

    }

    
    public function logout(Request $request){
      $data['title']='Golden girls' ;
       Auth::logout();    
       Session::flush();
      return redirect('/do_login');  
    }
	
	public function Signup(Request $request){
    
    $name=isset($request->name)?$request->name:'' ;
    $email = isset($request->email)?$request->email:'' ;
    $dob = isset($request->dob)?$request->dob:'' ;
    $user_type = isset($request->user_type)?$request->user_type:'';
    $password = isset($request->spassword)?$request->spassword:'';
    $date = date("Y-m-d H:i:s");  
    $password =  Hash::make($password) ;
	
    try{

        $insertData=array(
        'name'=>$name ,
        'email'=>$email,
        'dob'=>$dob , 
        'user_type'=>$user_type , 
        'password'=>$password ,
        'created_at'=>$date           
	    ); 

        $data=DB::table('users')->where('email',$email)->where('user_type',$user_type)->first();
		if(!empty($data)){
			echo checkResponse([],'Email id already Registered');die;
		 }   
         $user_info=User::create($insertData);
		 $insertProfile=array(
        'user_id'=>$user_info['id'],
        'created_at'=>$date		
	    ); 
		$profile_info=UserProfile::create($insertProfile);        
         
        echo successResponse([],'Save successfully');
    }
     catch(\Exception $e)
    { 
	//echo "<pre>";print_r($user_info);die;  
      echo  errorResponse('error occurred'); 
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
	
	public function update_profile(Request $request){
		
	$user_id=isset($request->user_id)?$request->user_id:'' ;
    $gender=isset($request->gender)?$request->gender:'' ;
	$education = isset($request->education)?$request->education:'' ;
    $know = isset($request->know)?$request->know:'' ;
    $country = isset($request->country)?$request->country:'' ;
	$city = isset($request->city)?$request->city:'' ;
	$dob = isset($request->dob)?$request->dob:'' ;
	$interests = isset($request->interests)?$request->interests:'' ;
	$relationship = isset($request->relationship)?$request->relationship:'' ;
	$height = isset($request->height)?$request->height:'' ;
	$weight = isset($request->weight)?$request->weight:'' ;
	$smoking = isset($request->smoking)?$request->smoking:'' ;
	$eye_color = isset($request->eye_color)?$request->eye_color:'' ;
	$marital_status = isset($request->marital_status)?$request->marital_status:'' ;
	$looking_man_or_a = isset($request->looking_man_or_a)?$request->looking_man_or_a:'' ;
	$work_as = isset($request->work_as)?$request->work_as:'' ;
    $date = date("Y-m-d H:i:s");  
    $updateData=array(
        'gender'=>$gender ,
		'education'=>$education,
        'know'=>$know , 
        'country'=>$country ,
        'city'=>$city ,
        'dob'=>$dob ,
		'interests'=>$interests ,
		'relationship'=>$relationship ,
		'height'=>$height ,
		'weight'=>$weight ,
		'smoking'=>$smoking ,
		'eye_color'=>$eye_color ,
		'marital_status'=>$marital_status ,
		'looking_man_for'=>$looking_man_or_a ,
		'work_as'=>$work_as ,
        'updated_at'=>$date           
    );
	//echo $user_id;die; 
	//echo "<pre>";print_r($updateData);die; 
    try{  
	//echo "gfdgf";die;
            /* if($request->hasFile('profile_picture')){
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
          } */
           UserProfile::where('user_id',$user_id)->update($updateData);   		   
           echo successResponse([],'Updated successfully');                                                 
	     }
          catch(\Exception $e)
        {
			//echo "ghgfh";die; 
          echo errorResponse('error occurred'); 
         
        } 

     }
	 
	 public function update_descrption(Request $request){
		
	$user_id=isset($request->user_id)?$request->user_id:'' ;
    $self_des=isset($request->self_des)?$request->self_des:'' ;
	 
    $date = date("Y-m-d H:i:s");  
    $updateData=array(
        'self_des'=>$self_des ,
        'updated_at'=>$date           
    ); 
    try{  
           UserProfile::where('user_id',$user_id)->update($updateData);     		   
           echo successResponse([],'Updated successfully');                                                 
}
         catch(\Exception $e){
         echo errorResponse('error occurred'); 
         
        }  

     }
	 
	 public function banner_upload(Request $request){
		//echo "<pre>";print_r($request->all());
		$user_id = isset($request->user_id)?$request->user_id:'' ;
	   if($request->hasFile('BannerUpload')){
                $imgPath='/public/banner_image';    
                $filenamewithextension = $request->file('BannerUpload')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('BannerUpload')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('BannerUpload')->storeAs($imgPath,$filenametostore);
                $updateData['banner_image']=$filenametostore; 
          }
      try{  
	      //echo "<pre>";print_r($updateData);die;
           UserProfile::where('user_id',$user_id)->update($updateData);   		   
           echo successResponse([],'Updated successfully');                                                 
	     }
           catch(\Exception $e){
          echo errorResponse('error occurred'); 
         
        }  		  

     }

public function profile_image_upload(Request $request){
		//echo "<pre>";print_r($request->all());
		$user_id = isset($request->user_id)?$request->user_id:'' ;
	   if($request->hasFile('myfile')){
                $imgPath='/public/user_image';       
                $filenamewithextension = $request->file('myfile')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('myfile')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('myfile')->storeAs($imgPath,$filenametostore);
                $updateData['image']=$filenametostore; 
          }
      try{  
	      //echo "<pre>";print_r($updateData);die; 
           User::where('id',$user_id)->update($updateData);   		   
           echo successResponse([],'Updated successfully');                                                 
	     }
           catch(\Exception $e){
          echo errorResponse('error occurred'); 
         
        }  		  

     }
	 
	 public function update_password(Request $request){     
      $cha_password = isset($request->cha_password)?$request->cha_password:'' ;
      $con_password = isset($request->con_password)?$request->con_password:'' ;
	  $user_id = isset($request->user_id)?$request->user_id:'' ;
      $password =  Hash::make($cha_password) ;
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

   public function get_lat_long(){

   $address="A 119 sector 63 noida 201203";

     //$address =$going; // Google HQ
    $prepAddr = str_replace(' ','+',$address);
    $apiKey = 'AIzaSyCvPoC5jaPsTV3jDq--1jwPKe379f_Zr7A'; // Google maps now requires an API key.  
    $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
    print_r($geocode);

    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;

   
}
	 

}

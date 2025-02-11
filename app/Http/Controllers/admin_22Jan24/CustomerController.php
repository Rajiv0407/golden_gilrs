<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\User;
use DB;
use Hash ;
use Carbon\Carbon;
use Session ;

class CustomerController extends Controller
{ 
    public function index(Request $request){

    	$data['title']=siteTitle();

    	echo view('admin/customerManagement/index',$data);

    }
    /**/

    public function customerData(Request $request){

    	$data['title']=siteTitle();

    	echo view('admin/customerManagement/index',$data);

    }

    public function detail(Request $request){

    	$data['title']=siteTitle();
        $userId = isset($request->userId)?$request->userId:'' ;
        $userInfo = user::find($userId) ;
        $data['userInfo']=$userInfo ;
       // echo "<pre>";print_r($data);die; 
    	echo view('admin/customerManagement/customerDetail',$data);

    }
	
	public function userDetailData(Request $request){

      $userId = isset($request->userId)?$request->userId:'' ; 
      $type = isset($request->type)?$request->type:'' ;
      $data['type']= $type ;
      $data['userId'] = $userId ;
	  
	  $typeQry = "select * from post_images where user_id = '$userId' and image_type='image' order by id desc ";
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
         if($type==2){
          echo view('admin/customerManagement/followers',$data);
        } else if($type==3){
          echo view('admin/customerManagement/follows',$data);
        }else{
           echo view('admin/customerManagement/user_image',$data)->with('image',$res5);
		}			
              
   }
   
   public function userFollower_datatable(Request $request){  

	  $data['title']=siteTitle();
	  $userId=$request->userId ;
	  $type=$request->type ;
	  $userImgPath = config('constants.user_image');     
	  $carQry="select f.id ,concat(u.first_name,' ',u.last_name) as name,case when f.status is null then '' when f.status=1 then 'Pending' when f.status=2 then 'Approved' else '' end as status,f.created_at,f.status as status_ from friend_list as f inner join users as u on u.id=f.request_id where request_id=".$userId;
	  $carData = DB::select($carQry); 
	  $tableData = Datatables::of($carData)->make(true);  
	  return $tableData; 

	}
	
	public function userFollows_datatable(Request $request){  

	  $data['title']=siteTitle();
	  $userId=$request->userId ;
	  $type=$request->type ;
	  $userImgPath = config('constants.user_image');     
	  $carQry="select f.id ,CONCAT(u.first_name,' ',u.last_name) as name,case when f.status is null then '' when f.status=1 then 'Pending' when f.status=2 then 'Approved' else '' end as status,f.created_at,f.status as status_ from friend_list as f inner join users as u on u.id=f.request_id where f.user_id=".$userId;
	  $carData = DB::select($carQry); 	  
	  $tableData = Datatables::of($carData)->make(true);  
	  return $tableData; 

	}
	
	public function customer_detail(Request $request){

    	$data['title']=siteTitle();
        $userId = isset($request->id)?$request->id:'' ;
        $userInfo = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','users.email','users.dob','users.phone','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','bust','hair_style','hair_color','instagram','youtube','snapchat','waist','banner_image','address_line_1','address_line_2','zip_code')
            ->join('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$userId)    
            ->first();
		//echo "<pre>";print_r($userInfo);die; 	
        $data['userInfo']=$userInfo ; 
    	echo view('admin/customerManagement/customerDetail',$data);

    }

    public function customerlist(Request $request){
    	$data['title']=siteTitle();
		$usrImg = config('constants.user_image');
		$usrDefaultImg = config('constants.user_default');
		
    	$usrQry = "select id,concat(first_name,' ',last_name) as name,case when (image is null || image='') then '$usrDefaultImg' else concat('".$usrImg."',image) end as image,email,phone,DATE_FORMAT(dob,'%e %M %Y') as dob,case when status=1 then 'Active' else 'Inactive' end as status_,status from users where is_delete=1 and user_type=1";    
	   //echo "<pre>";print_r($usrQry);die;
        $usrData = DB::select($usrQry); 
        $tableData = Datatables::of($usrData)->make(true);  
        return $tableData; 
    	
    }

    public function changeStatus(Request $request)
    {
    	$id=$request->id ;
    	$qry="update users set status=(case when status=1 then 2 else 1 end) where id=".$id;
    	try{  
           DB::select($qry);	
             echo successResponse([],'changed status successfully'); 
         
    	}
    	 catch(\Exception $e)
        {
           echo errorResponse('error occurred'); 
         
        }

    }
    public function delete_customer(Request $request){
          $id=isset($request->id)?$request->id:'' ;
        try{
               user::where('id',$id)->update(array('is_delete'=>2));
                
              echo successResponse([],'This user has deactivated successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
    }

    public function changePassword(Request $request){
   
      $password = isset($request->newPassword)?$request->newPassword:'' ;
      $cpassword = isset($request->confirmPassword)?$request->confirmPassword:'' ;
      $email_change = isset($request->email_change)?$request->email_change:'' ;
      $userId = isset($request->changeUserPwd)?$request->changeUserPwd:'' ;
      $password_ =  Hash::make($password) ;


      $updateData = array(
        "password"=>$password_
      );
     
       try{
              user::where('id',$userId)->update($updateData) ;             
              echo successResponse([],'changed password successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
      
    }
	
	 public function forgot_password(Request $request)
    {        
            $otp = "123456" ; 
            $password ="123456" ;
          $user = User::where('email', $request->forgot_email)->first();
          if(!$user){
               echo  errorResponse('User does not exist', 401);
          }
            DB::table('password_resets')->insert([
                'email' => $request->forgot_email,
                'token' => $otp,
                'created_at' => Carbon::now()
            ]); 

            $this->sendPwdEmail($request->forgot_email,$password,3);
         
            $message='Your otp has been sent to your email.' ;
            echo  successResponse($request->forgot_email,$message,200);  

    }  
	
	 public function sendPwdEmail($email,$otp=123456,$type=0){

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
        'message' => $otp
       );
        
        $data=sendPasswordToEmail($data);
    }
	
	public function verifyOTP(Request $request){
		
       if($request->otp){
         $checkOTP = DB::table('password_resets')->where(array('token'=>$request->otp,'email'=>$request->email_))->first();
		// print_r($checkOTP);die; 
         if(empty($checkOTP)){
           echo  errorResponse('Invalid OTP', 401);
         }else{
            echo successResponse($request->email_,'OTP matched successfully.',200);

         }

        }

    } 

     public function changeAdminPassword(Request $request){
   
      $newPassword = ($request->newAdminPassword)??'' ;
      $sessionData =Session::get('admin_session');
      $userId = ($sessionData['userId'])??0 ;
      $password =  Hash::make($newPassword) ;

      $updateData = array(
        "password"=>$password
      );
       

       try{
              user::where('id',$userId)->update($updateData) ;           
              echo successResponse([],'changed password successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
      
    }
}

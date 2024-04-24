<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\UserProfile; 
use App\Models\AdminUser;   
use DB;
use Hash ;
use Carbon\Carbon;
use Session ;

class AdminusersController extends Controller
{ 
    public function index(Request $request){

    	$data['title']=siteTitle();
		$carQry="select id,type,name from categories where type=1" ;   
        $category_data = DB::select($carQry); 
        $data['category_data']=$category_data; 
		$res2=array();
         $role_type_info=DB::table('role_type')->where('status',1)->where('id','!=',3)->orderBy('id', 'DESC')->get();
		 if(!empty($role_type_info)){
			 foreach($role_type_info as $role_type_infos){
				 $type['title']=$role_type_infos->title;
				 $type['id']=$role_type_infos->id;
				 $res2[]=!empty($type)?$type:"";
			 }	 			 
		 }
    	echo view('admin/adminUsersManagement/index',$data)->with('role_type',$res2);     

    }

    public function customerData(Request $request){

    	$data['title']=siteTitle();

    	echo view('admin/customerManagement/index',$data);

    }

    public function changeAdminPassword(Request $request){     
      $newPassword = !empty($request->newPassword)?$request->newPassword:"";
      $id = !empty($request->admin_user_ids)?$request->admin_user_ids:"";
      $password =  Hash::make($newPassword) ;

      $updateData = array(
        "password"=>$password
      );
       

       try{
              AdminUser::where('id',$id)->update($updateData) ;           
              echo successResponse([],'changed password successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
      
    }
	
	public function saveUser(Request $request){

    $session_data=session()->get('admin_session');
    //echo "<pre>";print_r($session_data['userId']);die; 
 	
    $first_name=isset($request->first_name)?$request->first_name:'' ;
	$last_name=isset($request->last_name)?$request->last_name:'' ;
	$user_role=isset($request->user_role)?$request->user_role:'' ;
	$category=isset($request->category)?$request->category:'' ;
    $email = isset($request->email1)?$request->email1:'' ;
    $user_status = isset($request->user_status)?$request->user_status:'' ;
    $mobile_number = isset($request->mobile_number)?$request->mobile_number:'';
	  $password1 = isset($request->password)?$request->password:'';
    $password = isset($request->password)?$request->password:'';
    $date = date("Y-m-d H:i:s");  
    $password =  Hash::make($password);

    $insertData=array(
        'first_name'=>$first_name ,
    'last_name'=>$last_name ,
    'user_type'=>$user_role,
    'category'=>$category,  
        'email'=>$email,
        'status'=>$user_status,  
        'phone'=>$mobile_number,    
        'password'=>$password ,
        'created_at'=>$date           
      ); 
     
        $data1=array(
    'name'=>$first_name.' '.$last_name,
    'email'=>$email,
    'pass'=>$password1   
    );     //->where('user_type',$user_role)
        $data=DB::table('admin_users')->where('email',$email)->first();
    
    if(!empty($data)){
       return checkResponse([],'Email id already Registered');
    }else{    
         $user_info=AdminUser::create($insertData);

           $isSendMail = config('constants.isSendMail');
       if($isSendMail==1){
         $da=sendRegistrationToEmail($data1);
        }
        
    $master_data=DB::table('master_role_permission')->where('roleTypeId',$user_role)->get();
     if(!empty($master_data) && sizeof($master_data) > 0 ){
      foreach($master_data as $master_datas){
        $roleTypeId=$user_role;
        $roleId=$master_datas->roleId;
        $role_add=$master_datas->add_;
        $role_edit=$master_datas->edit_;
        $role_delete=$master_datas->delete_;
        $role_view=$master_datas->view_;  
        $role_status=$master_datas->status_;
        
        
        $insertRoleData[]=array(
            "roleTypeId"=>$roleTypeId ,
          "userId"=>$user_info->id,  
            "roleId"=>$roleId ,
            "add_"=>$role_add ,
            "edit_"=>$role_edit ,
            "delete_"=>$role_delete ,
            "view_"=>$role_view,
          "status_"=>$role_status

           );
         
      }
      //echo "<pre>";print_r($insertRoleData);die; 
      DB::table('roles_permission')->insert($insertRoleData); 
    } 
      echo successResponse([],'Save successfully');     
    }		
    try{         
    }  
     catch(\Exception $e)
    { 
	//echo "<pre>";print_r($user_info);die;  
      echo  errorResponse('error occurred'); 
    }    
  }

   public function editAdminUser(Request $request){

        $data['title']=siteTitle();
        $userId = isset($request->id)?$request->id:'' ;
        $userInfo = AdminUser::find($userId) ;
        $data['userInfo']=$userInfo ;
        $carQry="select id,type,name from categories where type=1" ;   
        $category_data = DB::select($carQry); 
        $data['category_data']=$category_data; 
          $res2=array();
               $role_type_info=DB::table('role_type')->where('status',1)->where('id','!=',3)->orderBy('id', 'DESC')->get();
           if(!empty($role_type_info)){
             foreach($role_type_info as $role_type_infos){
               $type['title']=$role_type_infos->title;
               $type['id']=$role_type_infos->id;
               $res2[]=!empty($type)?$type:"";
             }         
           }
        echo view('admin/adminUsersManagement/editAdminDetail',$data)->with('role_type',$res2); 
   }

    public function detail(Request $request){
    	  $data['title']=siteTitle();
        $userId = isset($request->userId)?$request->userId:'' ;
        $userInfo = user::find($userId) ;
        $data['userInfo']=$userInfo ;
        
    	echo view('admin/customerManagement/customerDetail',$data);

    }

    public function editChangePwd(Request $request){
      
        $id=$request->id;
       echo view('admin/adminUsersManagement/changePassword')->with('user_id',$id);
    }
	
	public function user_detail(Request $request){
		  $id=$request->id;
		  //echo $id;die; 
		  $userInfo = AdminUser::find($id) ;
		 // print_r($userInfo->user_type);die; 
          $res=array();
		 $res1=array();  
         $role_info=DB::table('roles')->where('parentId',0)->get();
		 if(!empty($role_info)){
			foreach($role_info as $role_infos){
				$role_sub_info=DB::table('roles')->where('parentId',$role_infos->id)->get();
				$master_info=DB::table('roles_permission')->where('roleTypeId',$userInfo->user_type)->where('userId',$id)->where('roleId',$role_infos->id)->first();
				if(!empty($role_sub_info)){
					foreach($role_sub_info as $role_sub_infos){
$master_info1=DB::table('roles_permission')->where('userId',$id)->where('roleTypeId',$userInfo->user_type)->where('roleId',$role_sub_infos->id)->first();
						  $role1['add']=!empty($master_info1->add_)?$master_info1->add_:"";
							$role1['edit']=!empty($master_info1->edit_)?$master_info1->edit_:"";
							$role1['delete']=!empty($master_info1->delete_)?$master_info1->delete_:"";
							$role1['view']=!empty($master_info1->view_)?$master_info1->view_:"";
							$role1['status']=!empty($master_info1->status_)?$master_info1->status_:"";
						  $role1['id']=$role_sub_infos->id;
						  $role1['title']=$role_sub_infos->title;
						  $res1[]=!empty($role1)?$role1:"";
						  
					}
				}
				$role['id']=$role_infos->id;
				$role['title']=$role_infos->title;
				$role['add']=!empty($master_info->add_)?$master_info->add_:"";
				$role['edit']=!empty($master_info->edit_)?$master_info->edit_:"";
				$role['delete']=!empty($master_info->delete_)?$master_info->delete_:"";
				$role['view']=!empty($master_info->view_)?$master_info->view_:"";
				$role['status']=!empty($master_info->status_)?$master_info->status_:"";
				$role['sub_title']=!empty($res1)? $res1:"";  
                $res[]=!empty($role)?$role:"";
				unset($res1);
            }				 
		 }
         //echo "<pre>";print_r($res);die;		 
		echo view('admin/adminUsersManagement/userDetail')->with('userInfo',$userInfo)->with('role_info',$res);          
	}

    public function customerlist(Request $request){
    	$data['title']=siteTitle();
    	$usrQry = "select id,concat(first_name,' ',last_name) as name,email,phone,(select title from role_type where id=admin_users.user_type) AS user_type,category,status,case when status=1 then 'Active' else 'Inactive' end as status_ from admin_users where is_delete=1 and user_type !=3 ";  
  
      $usrData = DB::select($usrQry);
        $tableData = Datatables::of($usrData)->make(true);    
        return $tableData; 
    	
    }

    public function changeadminUsrStatus(Request $request)
    {
    	$id=$request->id ;
      //echo $id;die;    
    	try{  
        $qry="update admin_users set status=(case when status=1 then 2 else 1 end) where id=".$id;
        //echo successResponse([],'changed status successfully');  
        DB::select($qry); 
        echo json_encode(array("status"=>1));
    	}
    	 catch(\Exception $e)
        { 
           echo errorResponse('error occurred'); 
         
        }

    }
    public function delete_admin_user(Request $request){
          $id=isset($request->id)?$request->id:'' ;
		  AdminUser::where('id',$id)->update(array('is_delete'=>2));   
              echo successResponse([],'This user has deactivated successfully');
        /* try{
                
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         } */
    }

    public function changePassword(Request $request){
   
      $password = isset($request->password)?$request->password:'' ;
      $cpassword = isset($request->cpassword)?$request->cpassword:'' ;
      $email_change = isset($request->email_change)?$request->email_change:'' ;
      $password =  Hash::make($password) ;

      $updateData = array(
        "password"=>$password
      );
       try{
              user::where('email',$email_change)->update($updateData) ;           
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

public function edit_admin_user(Request $request){

  $adminUserId=isset($request->id)?$request->id:0 ;

  $adminData=DB::table("admin_users")->where('id',$adminUserId)->first();

    $carQry="select id,type,name from categories where type=1" ;   
        $category_data = DB::select($carQry); 
       
    $res2=array();
         $role_type_info=DB::table('role_type')->where('status',1)->where('id','!=',3)->orderBy('id', 'DESC')->get();
     if(!empty($role_type_info)){
       foreach($role_type_info as $role_type_infos){
         $type['title']=$role_type_infos->title;
         $type['id']=$role_type_infos->id;
         $res2[]=!empty($type)?$type:"";
       }         
     }
    
    return view('admin/adminUsersManagement/edit_admin_user')->with(['adminData'=>$adminData,'role_type'=>$res2,'category_data'=>$category_data]);
    
  //print_r($adminData);
}

public function update_admin_user(Request $request){
   $updateId=isset($request->updateUserId)?$request->updateUserId:0 ;
   $firstName=isset($request->edit_name)?$request->edit_name:0 ;
   $lastName=isset($request->edit_last_name)?$request->edit_last_name:0 ;
   $role=isset($request->edit_user_role)?$request->edit_user_role:0 ;
   $category=isset($request->edit_category)?$request->edit_category:0 ;
   $status=isset($request->edit_status)?$request->edit_status:0 ;
   $mobileNumber=isset($request->edit_mobile_number)?$request->edit_mobile_number:0 ;


   $updataData=array(
        'first_name'=>$firstName ,
        'last_name'=>$lastName ,
        'user_type'=>$role,
        'category'=>$category,         
        'status'=>$status,  
        'phone'=>$mobileNumber
   );

    DB::table('admin_users')->where('id',$updateId)->update($updataData);

    echo json_encode(array('status'=>1));

}

     
}

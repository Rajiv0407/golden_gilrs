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

class RoleController extends Controller
{    
    public function index(Request $request){
    	$data['title']=siteTitle();
         $res=array();
		 $res1=array();  
         $role_info=DB::table('roles')->where('parentId',0)->where('status',1)->get();
		 if(!empty($role_info)){
			foreach($role_info as $role_infos){
				$role_sub_info=DB::table('roles')->where('parentId',$role_infos->id)->get();
				if(!empty($role_sub_info)){
					foreach($role_sub_info as $role_sub_infos){
						  $role1['id']=$role_sub_infos->id;
						  $role1['title']=$role_sub_infos->title;
						  $res1[]=!empty($role1)?$role1:"";
						  
					}
				}
				$role['id']=$role_infos->id;
				$role['title']=$role_infos->title;
				$role['sub_title']=!empty($res1)? $res1:"";  
                $res[]=!empty($role)?$role:"";
				unset($res1);
            }				 
		 }
		 $res2=array();
         $role_type_info=DB::table('role_type')->where('status',1)->where('id','!=',3)->orderBy('id', 'DESC')->get();
		 if(!empty($role_type_info)){
			 foreach($role_type_info as $role_type_infos){
				 $type['title']=$role_type_infos->title;
				 $type['id']=$role_type_infos->id;
				 $res2[]=!empty($type)?$type:"";
			 }				 
		 }
          		 
		 
    	echo view('admin/RoleManagment/index')->with('role_info',$res)->with('role_type',$res2);    

    }
	
	public function brand_permission($id=null){
		 
		$data['title']=siteTitle();
         $res=array();
		 $res1=array();  
         $role_info=DB::table('roles')->where('parentId',0)->where('status',1)->get();
		 if(!empty($role_info)){
			foreach($role_info as $role_infos){
				$master_info=DB::table('master_role_permission')->where('roleTypeId',$id)->where('roleId',$role_infos->id)->first();
				 
				$role_sub_info=DB::table('roles')->where('parentId',$role_infos->id)->get();
				if(!empty($role_sub_info)){
					foreach($role_sub_info as $role_sub_infos){
						  $master_info1=DB::table('master_role_permission')->where('roleTypeId',$id)->where('roleId',$role_sub_infos->id)->first();
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
		 $res2=array();
         $role_type_info=DB::table('role_type')->where('status',1)->where('id','!=',3)->orderBy('id', 'DESC')->get();
		 if(!empty($role_type_info)){
			 foreach($role_type_info as $role_type_infos){
				 $type['title']=$role_type_infos->title;
				 $type['id']=$role_type_infos->id;
				 $res2[]=!empty($type)?$type:"";
			 }				 
		 }
		echo view('admin/RoleManagment/brand')->with('role_info',$res)->with('role_type',$res2)->with('role_id',$id);  
	}
   public function save_master_role_permissions(Request $request){
	    //echo "<pre>";print_r($request->all());die;
   		$role=DB::table('roles')->select('id','title')->where('status',1)->get();
   		//                      Add  Edit Delete View 
   		//Dashboard >> 1   
   		$insertData=array();
   		if(!empty($role)){
              $master_data=DB::table('master_role_permission')->where('roleTypeId',$request->roleTypeId)->get();
			  if(!empty($master_data)){
				$pre_delete= DB::table('master_role_permission')->where('roleTypeId',$request->roleTypeId)->delete();  
			  } 
   			$roleTypeId =$request->roleTypeId ;
   			foreach ($role as $key => $value) {
                 $roleId = !empty($request->{'roleId_'.$value->id})?$request->{'roleId_'.$value->id}:0 ;
   				 $role_add = !empty($request->{'add_'.$value->id})?1:0 ;
   				 $role_edit = !empty($request->{'edit_'.$value->id})?1:0 ;
   				 $role_delete = !empty($request->{'delete_'.$value->id})?1:0 ;
   				 $role_view = !empty($request->{'view_'.$value->id})?1:0 ;
				 $role_status = !empty($request->{'status_'.$value->id})?1:0 ;
   				 $insertData[]=array(
   				 	"roleTypeId"=>$roleTypeId ,
   				 	"roleId"=>$roleId ,
   				 	"add_"=>$role_add ,
   				 	"edit_"=>$role_edit ,
   				 	"delete_"=>$role_delete ,
   				 	"view_"=>$role_view,
					"status_"=>$role_status

   				 );
   			}
			//echo "<pre>";print_r($insertData);die; 
   			 if(DB::table('master_role_permission')->insert($insertData)){
				echo 1;
			}else{
				echo 2;
			} 

   		}
   }
   
   public function save_user_role_permissions(Request $request){
	    //echo "<pre>";print_r($request->all());die;  
   		$role=DB::table('roles')->select('id','title')->where('status',1)->get();
   		//                      Add  Edit Delete View 
   		//Dashboard >> 1   
   		$insertData=array();
   		if(!empty($role)){
              $master_data=DB::table('roles_permission')->where('roleTypeId',$request->roleTypeId)->where('userId',$request->userId)->get();
			  if(!empty($master_data)){
				$pre_delete= DB::table('roles_permission')->where('roleTypeId',$request->roleTypeId)->where('userId',$request->userId)->delete();  
			  } 
   			$roleTypeId =$request->roleTypeId ;
   			foreach ($role as $key => $value) {
                 $roleId = !empty($request->{'roleId_'.$value->id})?$request->{'roleId_'.$value->id}:0 ;
   				 $role_add = !empty($request->{'add_'.$value->id})?1:0 ;
   				 $role_edit = !empty($request->{'edit_'.$value->id})?1:0 ;
   				 $role_delete = !empty($request->{'delete_'.$value->id})?1:0 ;
   				 $role_view = !empty($request->{'view_'.$value->id})?1:0 ;
				 $role_status = !empty($request->{'status_'.$value->id})?1:0 ;
   				 $insertData[]=array(
   				 	"roleTypeId"=>$roleTypeId ,
					"userId"=>$request->userId,  
   				 	"roleId"=>$roleId ,
   				 	"add_"=>$role_add ,
   				 	"edit_"=>$role_edit ,
   				 	"delete_"=>$role_delete ,
   				 	"view_"=>$role_view,
					"status_"=>$role_status  

   				 );
   			}
   			 if(DB::table('roles_permission')->insert($insertData)){
				echo 1;
			}else{
				echo 2;
			} 

   		}
   }
   
   public function save_user_all_role_permissions(Request $request){
	    //echo "<pre>";print_r($request->all());die;  
   		$role=DB::table('roles')->select('id','title')->where('status',1)->get();
   		//                      Add  Edit Delete View 
   		//Dashboard >> 1   
   		$insertData=array();
   		if(!empty($role)){
              $master_data=DB::table('roles_permission')->where('roleTypeId',$request->roleTypeId)->where('userId',$request->userId)->get();
			  if(!empty($master_data)){
				$pre_delete= DB::table('roles_permission')->where('roleTypeId',$request->roleTypeId)->where('userId',$request->userId)->delete();  
			  } 
   			$roleTypeId =$request->roleTypeId ;
   			foreach ($role as $key => $value) {
                 $roleId = !empty($request->{'roleId_'.$value->id})?$request->{'roleId_'.$value->id}:0 ;
   				 $role_add = 1 ;
   				 $role_edit = 1 ;
   				 $role_delete = 1 ;
   				 $role_view = 1;
				 $role_status=1;
   				 $insertData[]=array(
   				 	"roleTypeId"=>$roleTypeId ,
					"userId"=>$request->userId,  
   				 	"roleId"=>$roleId ,
   				 	"add_"=>$role_add ,
   				 	"edit_"=>$role_edit ,
   				 	"delete_"=>$role_delete ,
   				 	"view_"=>$role_view,
					"status_"=>$role_status

   				 );
   			}
   			 if(DB::table('roles_permission')->insert($insertData)){
				echo 1;
			}else{
				echo 2;
			} 

   		}
   }
   
   public function delete_user_all_role_permissions(Request $request){
	    //echo "<pre>";print_r($request->all());die;  
              $master_data=DB::table('roles_permission')->where('roleTypeId',$request->roleTypeId)->where('userId',$request->userId)->get();
			  if(!empty($master_data)){
				$pre_delete= DB::table('roles_permission')->where('roleTypeId',$request->roleTypeId)->where('userId',$request->userId)->delete();
               echo 1;  				
			  } 
   }
   
   public function edit_role($id=null){
      
      $role_info=DB::table('role_type')->where('id',$id)->where('status',1)->first();
     
	  echo view('admin/RoleManagment/editRole')->with('name',$role_info);
    }
	
	public function update_role(Request $request){
      
      $edit_role = isset($request->edit_role_type)?$request->edit_role_type:'' ;
	  $role_id = isset($request->role_id)?$request->role_id:'' ;
	  
	  $role_info=DB::table('role_type')->where('title',$edit_role)->where('id','!=',$role_id)->first() ;	
      if(!empty($role_info)){
        echo 2;exit;  
      }	   
      $updateData = array(
        "title"=>$edit_role,
      ); 
       try{
		   $updateRole=DB::table('role_type')->where('id',$role_id)->update($updateData) ; 
              echo successResponse([],'Role updated successfully');
               
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
      
    }
	public function add_role(Request $request){
      
      $add_role = isset($request->add_role_title)?$request->add_role_title:'' ; 
      $role_info=DB::table('role_type')->where('title',$add_role)->first() ;	
      if(!empty($role_info)){
        echo 2;exit;  
      }		  
      $addData = array(
        "title"=>$add_role,
      );  
       try{
		   DB::table('role_type')->insert($addData) ; 
              echo successResponse([],'Role updated successfully');       
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }
      
    }
    

}

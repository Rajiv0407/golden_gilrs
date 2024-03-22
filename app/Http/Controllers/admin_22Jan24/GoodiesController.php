<?php
//
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use DB ; 
use App\models\countries ;
use App\models\event_types ;
use App\Models\EventImage;
use App\Models\Event;
use App\Models\Coupon;
use App\Models\Goodies;   
use Image ;
use Illuminate\Support\Facades\Validator;
ini_set('memory_limit', '2048M');

	 
class goodiesController extends Controller
{

	public function goodies_list(Request $request){
        $data['title']=siteTitle();
		$carQry="select id,fee_type from fee_type where status=1 " ;   
        $fee_data = DB::select($carQry); 
          
        $data['fee_data']=$fee_data;
        echo view('admin/goodies/index',$data); 

    }
	
	 public function saveGoodies(Request $request){  
		    //echo "<pre>";print_r($request->all());die;
            $session_data=session()->get('admin_session');			
			$goodies_title=isset($request->goodies_title)?$request->goodies_title:'' ; 
			$goodies_fee_type=isset($request->goodies_fee_type)?$request->goodies_fee_type:'' ;
			$goodies_address=isset($request->goodies_address)?$request->goodies_address:'' ;
            $goodies_seats=isset($request->goodies_seats)?$request->goodies_seats:'' ;			
			$start_date = isset($request->start_date)?$request->start_date:'' ;
			$goodies_date=isset($request->goodies_date)?$request->goodies_date:'';
			$end_date = isset($request->end_date)?$request->end_date:'' ;
			$goodies_status = isset($request->goodies_status)?$request->goodies_status:'' ;
			$goodies_descrption = isset($request->goodies_descrption)?$request->goodies_descrption:'' ;
			$user_id=isset($session_data['userId'])?$session_data['userId']:'' ;
			$date = date("Y-m-d H:i:s");
			
			if($request->hasFile('goodies_image')){
                $imgPath='/public/goodies_image';       
                $filenamewithextension = $request->file('goodies_image')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('goodies_image')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('goodies_image')->storeAs($imgPath,$filenametostore);
                 
            }   
		  
				$insertData=array(
				'title'=>$goodies_title ,
				'goodies_fee_type'=>$goodies_fee_type ,
				'goodies_address'=>$goodies_address ,
				'goodies_seats'=>$goodies_seats ,
				'goodies_date'=>$goodies_date ,
				'goodies_descrption'=>$goodies_descrption ,
                'start_date'=>$start_date,				
				'end_date'=>$end_date ,
				'user_id'=>$user_id ,
				'image'=>$filenametostore,  
                'status'=>$goodies_status ,	   			
				'created_at'=>$date	  
			);      
				$insertmember = Goodies::create($insertData);
				//echo "<pre>";print_r($insertmember);die;
				
			try{
				
			
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}
		 
    }
	public function goodies_datatable(Request $request){
         
        $data['title']=siteTitle();  
        $session_data=session()->get('admin_session');
        $user_id=$session_data['userId'];
		$goosiesImg = config('constants.goodies_image');
        if($session_data['userType']== 3){
        $goodiesQry="select id,title,goodies_address,case when goodies_fee_type=1 then 'Paid' else 'Free' end as   goodies_fee_type,goodies_descrption,goodies_seats,goodies_date,DATE_FORMAT(start_date,'%Y-%m-%d') as start_date,DATE_FORMAT(end_date,'%Y-%m-%d') as end_date,case when status=1 then 'Active' else 'Inactive' end as status_,status,DATE_FORMAT(goodies.goodies_date,'%d %M %Y') as goodies_date,case when (image is null || image='') then '' else concat('".$goosiesImg."',image) end as image from goodies where is_delete=1";            
        $goodiesData = DB::select($goodiesQry); 
        $tableData = Datatables::of($goodiesData)->make(true);
        //echo "<pre>";print_r($tableData);die;
		}else{
          $goodiesQry="select id,title,goodies_address,case when goodies_fee_type=1 then 'Paid' else 'Free' end as as goodies_fee_type,goodies_descrption,goodies_seats,goodies_date,DATE_FORMAT(start_date,'%Y-%m-%d') as start_date,DATE_FORMAT(end_date,'%Y-%m-%d') as end_date,case when status=1 then 'Active' else 'Inactive' end as status_,status,DATE_FORMAT(goodies.goodies_date,'%d %M %Y') as goodies_date,case when (image is null || image='') then '' else concat('".$goosiesImg."',image) end as image from goodies where is_delete=1 and user_id='$user_id'";              
        $goodiesData = DB::select($goodiesQry); 
        $tableData = Datatables::of($goodiesData)->make(true);
        //echo "<pre>";print_r($tableData);die;
		}			
        return $tableData;       
    }
	
	public function goodiesStatus(Request $request)    
    {
        $id=$request->id ;  
        $qry="update goodies set status=(case when status=1 then '2' else 1 end) where id=".$id; 
        try{  
           DB::select($qry);      
            echo successResponse([],'changed status successfully'); 
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }
	
	public function editCoupon(Request $request){
            //echo "<pre>";print_r($request);die; 
            $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
            $couponInfo = Coupon::where('id',$updatedId)->first() ;
			$couponTypeQry="select id,type from coupon_type where status=1 " ;   
			$coupon_type_data = DB::select($couponTypeQry); 
			//echo "<pre>";print_r($coupon_type_data);die; 
			$eventQry="select id,event_name from events where status=1 order by id desc" ;   
			$event_data = DB::select($eventQry); 
		   //$fee_data = Datatables::of($carData)->make(true);
			
			$data['coupon_type_data']=$coupon_type_data;  
			$data['event_data']=$event_data; 
           //echo "<pre>";print_r($data);die;     
           $data['couponInfo'] = $couponInfo ;  
           $data['updatedId']=$updatedId ;
  
  
  
          echo view('admin/coupon/editCoupon',$data);
    }
	
	 public function deleteGoodies(Request $request){

        $deleteId=isset($request->id)?$request->id:'' ;
        try{
			    $date = date("Y-m-d H:i:s");
			    $updateData=array(
				'is_delete'=>2,		  		  
				'updated_at'=>$date	
			);  
                goodies::where('id', $deleteId)->update($updateData);

              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }

    }
	public function editGoodies(Request $request){
            //echo "<pre>";print_r($request);die; 
           $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $goodiesInfo = Goodies::where('id',$updatedId)->first();  
           $data['eventInfo'] = $goodiesInfo ;  
           $data['updatedId']=$updatedId ;
          echo view('admin/goodies/editGoodies',$data);     
    }
	
	public function updateGoodies(Request $request){ 
	        //echo "<pre>";print_r($request->all());die; 
            $updateId = isset($request->updatedId)?$request->updatedId:'' ;
            $edit_goodies_title=isset($request->edit_goodies_title)?$request->edit_goodies_title:'' ;
			$edit_goodies_fee_type=isset($request->edit_goodies_fee_type)?$request->edit_goodies_fee_type:'' ;
			$edit_goodies_seats=isset($request->edit_goodies_seats)?$request->edit_goodies_seats:'' ;
			$edit_goodies_address=isset($request->edit_goodies_address)?$request->edit_goodies_address:'' ;
			$edit_goodies_start_date = isset($request->edit_goodies_start_date)?$request->edit_goodies_start_date:'' ;
			$edit_goodies_end_date = isset($request->edit_goodies_end_date)?$request->edit_goodies_end_date:'' ; 
            $edit_goodies_date = isset($request->edit_goodies_date)?$request->edit_goodies_date:'' ;			
			$edit_goodies_status= isset($request->edit_goodies_status)?$request->edit_goodies_status:'' ;
			$edit_goodies_descrption= isset($request->edit_goodies_descrption)?$request->edit_goodies_descrption:'' ;
			$date = date("Y-m-d H:i:s");
         
        try{
            $updateData=array(
                'title'=>$edit_goodies_title ,
                'goodies_fee_type'=>$edit_goodies_fee_type,
                'goodies_seats'=>$edit_goodies_seats,
                'goodies_address'=>$edit_goodies_address,
                'start_date'=>$edit_goodies_start_date,
                'end_date'=>$edit_goodies_end_date,
                'goodies_date'=>$edit_goodies_date,
                'status'=>$edit_goodies_status,
                'goodies_descrption'=>$edit_goodies_descrption,             
                'updated_at'=>$date   
            );   

            if($request->hasFile('edit_goodies_image')){
                $imgPath='/public/goodies_image';       
                $filenamewithextension = $request->file('edit_goodies_image')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('edit_goodies_image')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('edit_goodies_image')->storeAs($imgPath,$filenametostore);
                 $updateData['image']=$filenametostore ;
            }			
		  
			
			Goodies::where('id',$updateId)->update($updateData);  
			    
              echo successResponse([],'successfully updated Event'); 
        } 
		  
         catch(\Exception $e){
			 
             echo errorResponse('error occurred'); 
         }         
    }

}

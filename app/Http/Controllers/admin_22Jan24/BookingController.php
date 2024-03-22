<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\User;
use App\Models\BookingRequest;
use App\Models\Event; 
use App\Models\Goodies; 
use App\Models\Notification;      
use Image ;
use DB ;   
use Illuminate\Support\Facades\Validator;
ini_set('memory_limit', '2048M');
	 
class BookingController extends Controller
{
//

    public function event_booking_list(Request $request){
           
        $data['title']=siteTitle();
		
        echo view('admin/EventBooking/index',$data);

    }
	
	public function goodies_booking_list(Request $request){
           
        $data['title']=siteTitle();
		
        echo view('admin/GoodiesBooking/index',$data);

    }
	
	public function event_booking_detail(Request $request){
           
        $data['title']=siteTitle();
		$booking_id = isset($request->id)?$request->id:'' ;
		$carQry="select b.id,b.user_id as user_id,concat(u.first_name,' ',u.last_name) as name,u.email,e.event_name, DATE_FORMAT(b.created_at,'%d %M %Y') as booking_request_date,case when b.status=1 then 'Pending' when b.status=2 then 'Accepted' else 'Cancel' end as status_,b.status from booking_requests as b left join users as u on b.user_id= u.id left join events as e on e.id=b.type_id where b.booking_type=1 and b.id='$booking_id'" ;     
        $bookData = DB::select($carQry); 
		//echo "<pre>";print_r($bookData);die; 
		$book['book_id']=!empty($bookData[0]->id)?$bookData[0]->id:"";
		$book['user_name']=!empty($bookData[0]->name)?$bookData[0]->name:"";
		$book['event_name']=!empty($bookData[0]->event_name)?$bookData[0]->event_name:"";
		$book['booking_request_date']=!empty($bookData[0]->booking_request_date)?$bookData[0]->booking_request_date:"";
		$book['status_']=!empty($bookData[0]->status_)?$bookData[0]->status_:"";
		$book['status']=!empty($bookData[0]->status)?$bookData[0]->status:"";
		$user_id=!empty($bookData[0]->user_id)?$bookData[0]->user_id:"";
		
		$userInfo = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','users.email','users.dob','users.phone','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','bust','hair_style','hair_color','instagram','youtube','snapchat','waist','banner_image','address_line_1','address_line_2','zip_code')
            ->join('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$user_id)    
            ->first();
		//echo "<pre>";print_r($userInfo);die; 	
        $data['userInfo']=$userInfo ; 
        echo view('admin/EventBooking/bookingDetail',$data)->with('book_info',$book);

    }
	
	
    public function event_booking_datatable(Request $request){
         
        $data['title']=siteTitle(); 
        $session_data=session()->get('admin_session');
        $user_id=$session_data['userId'];
        $eventImg = config('constants.event_image'); 
        if($session_data['userType']== 3){ 
        $carQry="select b.id,concat(u.first_name,' ',u.last_name) as name,u.email,u.phone,e.event_name, DATE_FORMAT(b.created_at,'%d %M %Y') as booking_request_date,case when b.status=1 then 'Pending' when b.status=2 then 'Accepted' else 'Cancel' end as status_,b.status,DATE_FORMAT(b.created_at,'%Y-%m-%d') as booking_date,case when (eimg.image is null || eimg.image='') then '' else concat('".$eventImg."',eimg.image) end as image from booking_requests as b left join users as u on b.user_id= u.id left join events as e on e.id=b.type_id left join event_images as eimg on e.id=eimg.event_id where b.booking_type=1" ;     
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
        //echo "<pre>";print_r($tableData);die; 
        }else{
          $carQry="select b.id,concat(u.first_name,' ',u.last_name) as name,u.email,u.phone,e.event_name, DATE_FORMAT(b.created_at,'%d %M %Y') as booking_request_date,case when b.status=1 then 'Pending' when b.status=2 then 'Accepted' else 'Cancel' end as status_,b.status,DATE_FORMAT(b.created_at,'%Y-%m-%d') as booking_date,case when (eimg.image is null || eimg.image='') then '' else concat('".$eventImg."',eimg.image) end as image from booking_requests as b left join users as u on b.user_id= u.id left join events as e on e.id=b.type_id left join event_images as eimg on e.id=eimg.event_id where b.booking_type=1 and b.user_id='$user_id'" ;     
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);


        }		
        return $tableData;   
    }
	
	public function goodies_booking_detail(Request $request){  
           
        $data['title']=siteTitle();
		$booking_id = isset($request->id)?$request->id:'' ;
		$carQry="select b.id,b.user_id as user_id,concat(u.first_name,' ',u.last_name) as name,u.email,g.title as title, DATE_FORMAT(b.created_at,'%d %M %Y') as booking_request_date,case when b.status=1 then 'Pending' when b.status=2 then 'Accepted' else 'Cancel' end as status_,b.status from booking_requests as b left join users as u on b.user_id= u.id left join goodies as g on g.id=b.type_id where b.booking_type=2 and b.id='$booking_id'" ;     
        $bookData = DB::select($carQry); 
		//echo "<pre>";print_r($bookData);die; 
		$book['book_id']=!empty($bookData[0]->id)?$bookData[0]->id:"";
		$book['user_name']=!empty($bookData[0]->name)?$bookData[0]->name:"";
		$book['event_name']=!empty($bookData[0]->title)?$bookData[0]->title:"";  
		$book['booking_request_date']=!empty($bookData[0]->booking_request_date)?$bookData[0]->booking_request_date:"";
		$book['status_']=!empty($bookData[0]->status_)?$bookData[0]->status_:"";
		$book['status']=!empty($bookData[0]->status)?$bookData[0]->status:"";
		$user_id=!empty($bookData[0]->user_id)?$bookData[0]->user_id:"";
		//echo $user_id;die; 
		$userInfo = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','users.email','users.dob','users.phone','users.status','user_profile.gender','user_profile.age','user_profile.country','user_profile.city','user_profile.relationship','user_profile.height','user_profile.smoking','user_profile.marital_status','user_profile.know','user_profile.interests','user_profile.eye_color','user_profile.looking_man_for','user_profile.self_des','user_profile.lat','user_profile.log','hip_size','bust','hair_style','hair_color','instagram','youtube','snapchat','waist','banner_image','address_line_1','address_line_2','zip_code')
            ->leftJoin('user_profile','user_profile.user_id','=','users.id')
            ->where('users.id','=',$user_id)    
            ->first();
		//echo "<pre>";print_r($userInfo);die; 	
        $data['userInfo']=$userInfo ; 

        echo view('admin/GoodiesBooking/goodiesBookingDetail',$data)->with('book_info',$book);

    }
	
	public function goodies_booking_datatable(Request $request){
        $data['title']=siteTitle();
        $session_data=session()->get('admin_session');
        $user_id=$session_data['userId']; 
        $goosiesImg = config('constants.goodies_image');
        if($session_data['userType']== 3){  
        $carQry="select b.id,concat(u.first_name,' ',u.last_name) as name,u.email,u.phone,g.title as title, DATE_FORMAT(b.created_at,'%d %M %Y') as booking_request_date,case when b.status=1 then 'Pending' when b.status=2 then 'Accepted' else 'Cancel' end as status_,b.status,DATE_FORMAT(b.created_at,'%Y-%m-%d') as booking_date,case when (g.image is null || g.image='') then '' else concat('".$goosiesImg."',g.image) end as image from booking_requests as b left join users as u on b.user_id= u.id left join goodies as g on g.id=b.type_id where b.booking_type=2" ;       
        $carData = DB::select($carQry);   
        $tableData = Datatables::of($carData)->make(true);
        //echo "<pre>";print_r($tableData);die; 
        }else{
          $carQry="select b.id,concat(u.first_name,' ',u.last_name) as name,u.email,u.phone,g.title as title, DATE_FORMAT(b.created_at,'%d %M %Y') as booking_request_date,case when b.status=1 then 'Pending' when b.status=2 then 'Accepted' else 'Cancel' end as status_,b.status,DATE_FORMAT(b.created_at,'%Y-%m-%d') as booking_date,case when (g.image is null || g.image='') then '' else concat('".$goosiesImg."',g.image) end as image from booking_requests as b left join users as u on b.user_id= u.id left join goodies as g on g.id=b.type_id where b.booking_type=2 and b.user_id='$user_id'" ;         
        $carData = DB::select($carQry);     
        $tableData = Datatables::of($carData)->make(true);

        }		
        return $tableData;   
    }
	
	public function bookingStatus(Request $request)    
    {
        $id=$request->id ; 	
        //echo $id;die; 	
         
        	
        try{ 
			$qry="update booking_requests set status=2 where id=".$id;
        //$a=$this->sendBookingEmail($id);
               DB::select($qry);
               $qry1="update booking_requests set email_status=2 where id=".$id;
               DB::select($qry1);                          
              echo successResponse([],'changed status successfully');     
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }
	
	public function sendBookingEmail($id){  
		
		$booking_requests = BookingRequest::where('id',$id)->first();
		//echo "<pre>";print_r($booking_requests);die;   
		if($booking_requests->booking_type==1){
            $subject='Event Booking Confirmation' ;
        }else if($booking_requests->booking_type==2){
            $subject='Goodies Booking Confirmation' ;
        }else {
            $subject='Forgot Password' ;
        }
		if($booking_requests->booking_type==1){
			$event_info = Event::where('id',$booking_requests->type_id)->first();
			   $booking_name=!empty($event_info->event_name)?$event_info->event_name:"";
			   $address=!empty($event_info->address)?$event_info->address:"";
			   $date=date('D, d M Y ', strtotime($event_info->event_date));
			   $time=date('g:i A', strtotime($event_info->event_date));
		}else{
			$goodies_info = Goodies::where('id',$booking_requests->type_id)->first();
			$booking_name=!empty($goodies_info->title)?$goodies_info->title:"";
			$address=!empty($goodies_info->goodies_address)?$goodies_info->goodies_address:"";
			$date=date('D, d M Y ', strtotime($goodies_info->goodies_date));
			$time=date('g:i A', strtotime($goodies_info->goodies_date));   
		}
		$user_info = DB::table('users')->where('id',$booking_requests->user_id)->first();
		$name=$user_info->first_name.' '.$user_info->last_name;
		$email=$user_info->email;
		$booking_id=!empty($booking_requests->id)?$booking_requests->id:"";
		if($booking_requests->status==2){
			$status="Approved";
		}else if($booking_requests->status==3){  
              $status="Cancel";
        }else{
			$status="Pending";
		}   
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
        'no_ticket'=>$booking_requests->number_of_ticket
       );  
        //echo "<pre>";print_r($data);die;  
        $data=sendBookingToEmail($data);
        if($booking_requests->booking_type == 2){
        $this->send_notification($booking_requests->type_id,$booking_requests->user_id,5,0,$booking_requests->status);
        }
        if($booking_requests->booking_type == 1){
        $this->send_notification($booking_requests->type_id,$booking_requests->user_id,6,0,$booking_requests->status);
        }
         
    }
	
	public function send_notification($sender_id,$reciver_id,$type,$post_id=0){  
		// type 1 used for post save
		$data=session()->get('user_session');
		$user_info = DB::table('users')->where('id',$sender_id)->first();
		$event_info = DB::table('events')->where('id',$sender_id)->first();
		$date = date("Y-m-d H:i:s");
		if($type==5){ 
		    if($status == 2) {
		    $message= 'Congratulations!! your goodies booking has been Approved';
		    }else{
		    	$message= 'Sorry!! your goodies booking has been Cancel';
		    }
		}
		if($type==6){ 
		    if($status == 2) { 
		    $message= 'Congratulations!! your event booking has been Approved';
		    }else{
		    	$message= 'Sorry!! your event booking has been Cancel ' ;
		    }
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
	
	
	public function cancalBooking(Request $request)
	{
        $id=$request->id ;  
         
        try{ 
            $qry="update booking_requests set status=3 where id=".$id;
            DB::select($qry); 
            $a=$this->sendBookingEmail($id);  
               $qry1="update booking_requests set email_status=2 where id=".$id;
               DB::select($qry1);
                    
            echo successResponse([],'changed status successfully'); 
         
        }  
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }
	
	

}

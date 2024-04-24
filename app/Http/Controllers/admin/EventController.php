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
use Image ;
use Illuminate\Support\Facades\Validator;
ini_set('memory_limit', '2048M');	 
class EventController extends Controller
{
public function createThumbnail($path, $width, $height)
    {
        
      $img = Image::make($path)->resize($width, $height)->save($path);
    }
    
    public function event_list(Request $request){
           
        $data['title']=siteTitle();
		$eventTypeQry="select id,type_name from event_type where status=1 " ;   
        $event_type_data = DB::select($eventTypeQry); 

		$carQry="select id,fee_type from fee_type where status=1 " ;   
        $fee_data = DB::select($carQry); 
        //$fee_data = Datatables::of($carData)->make(true);
		
		$countryQry="select id,name,status from countries where status=1 " ;   
        $country_data = DB::select($countryQry);
		
		$cityQry="select id,country_id,name,status from cities where status=1 " ;   
        $city_data = DB::select($cityQry);
          
		$data['country_data']=$country_data;
		$data['city_data']=$city_data; 
		
		$data['event_type_data']=$event_type_data;  
        $data['fee_data']=$fee_data;
        echo view('admin/event/event/index',$data);

    }
	public function getEventCity(Request $request){
		 
		$cityQry="select id,country_id,name,status from cities where status=1 and country_id= '$request->id' " ;   
        $city_data = DB::select($cityQry);
		return view('admin/event/city')->with('event_city',$city_data);
		//return $city_data;
	}
	public function getEditEventCity(Request $request){
		 
		$cityQry="select id,country_id,name,status from cities where status=1 and country_id= '$request->id' " ;   
        $city_data = DB::select($cityQry);
		return view('admin/event/edit_city')->with('event_city',$city_data);
		//return $city_data;  
	}
	
	public function coupon_list(Request $request){
           
        $data['title']=siteTitle();
		$couponTypeQry="select id,type from coupon_type where status=1 " ;   
        $coupon_type_data = DB::select($couponTypeQry); 
        //echo "<pre>";print_r($coupon_type_data);die; 
		$eventQry="select id,event_name from events where status=1 order by id desc" ;   
        $event_data = DB::select($eventQry); 
       //$fee_data = Datatables::of($carData)->make(true);
		
		$data['coupon_type_data']=$coupon_type_data;  
        $data['event_data']=$event_data;  
        echo view('admin/coupon/index',$data);

    }
	
	 public function saveCoupon(Request $request){
		    //echo "<pre>";print_r($request->all());die; 
			$coupon_title=isset($request->coupon_title)?$request->coupon_title:'' ;
			$event_name = isset($request->event_name)?$request->event_name:'' ;
			$value_type = isset($request->value_type)?$request->value_type:'' ;
			$coupon_value = isset($request->coupon_value)?$request->coupon_value:'' ;  
			$start_date = isset($request->start_date)?$request->start_date:'' ;
			$end_date = isset($request->end_date)?$request->end_date:'' ;
			$coupon_status = isset($request->coupon_status)?$request->coupon_status:'' ;
			$date = date("Y-m-d H:i:s");
			try{
				$insertData=array(
				'coupon_title'=>$coupon_title ,
				'event_id'=>$event_name,
				'coupon_type'=>$value_type,
				'coupon_value'=>$coupon_value ,
                'start_date'=>$start_date,				
				'end_date'=>$end_date ,
                'status'=>$coupon_status ,	   			
				'created_at'=>$date	  
			);    
				$insertmember = Coupon::create($insertData);
				echo successResponse([],'Save successfully'); 
			}
			 catch(\Exception $e)
			{
			  echo  errorResponse('error occurred'); 
			}
		 
    }
	public function coupon_datatable(Request $request){
         
        $data['title']=siteTitle();  
        $couponQry="select c.id,e.event_name,c.coupon_title,c.status,c.coupon_value,DATE_FORMAT(c.start_date,'%Y-%m-%d') as start_date,DATE_FORMAT(c.end_date,'%Y-%m-%d') as end_date,case when c.coupon_type=1 then 'Flat' else 'Percent' end as coupon_type,case when c.status=1 then 'Active' else 'Inactive' end as status_,c.status from coupon as c left join events as e on e.id= c.event_id " ;   
        $couponData = DB::select($couponQry); 
        $tableData = Datatables::of($couponData)->make(true);
        //echo "<pre>";print_r($tableData);die; 		
        return $tableData;     
    }
	
	public function couponStatus(Request $request)    
    {
        $id=$request->id ;  
        $qry="update coupon set status=(case when status=1 then '2' else 1 end) where id=".$id; 
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
	
	public function updateCoupon(Request $request){ 
	        //echo "<pre>";print_r($request->all());die; 
            $updateId = isset($request->updatedId)?$request->updatedId:'' ;
            $edit_coupon_title=isset($request->edit_coupon_title)?$request->edit_coupon_title:'' ;
			$edit_coupon_event_name = isset($request->edit_coupon_event_name)?$request->edit_coupon_event_name:'' ;
			$edit_coupon_value_type = isset($request->edit_coupon_value_type)?$request->edit_coupon_value_type:'' ;
			$edit_coupon_value = isset($request->edit_coupon_value)?$request->edit_coupon_value:'' ;  
			$edit_coupon_start_date = isset($request->edit_coupon_start_date)?$request->edit_coupon_start_date:'' ;
			$edit_coupon_end_date = isset($request->edit_coupon_end_date)?$request->edit_coupon_end_date:'' ;
			$date = date("Y-m-d H:i:s");
         
        try{ 
		  
			$updateData=array(
				'coupon_title'=>$edit_coupon_title ,
				'event_id'=>$edit_coupon_event_name,
				'coupon_type'=>$edit_coupon_value_type,
				'coupon_value'=>$edit_coupon_value ,
                'start_date'=>$edit_coupon_start_date,				
				'end_date'=>$edit_coupon_end_date ,  
				'updated_at'=>$date	
			);  //echo "<pre>";print_r($updateData);die;   
			Coupon::where('id',$updateId)->update($updateData);  
			    
              echo successResponse([],'successfully updated Event'); 
        } 
		  
         catch(\Exception $e){
			 
             echo errorResponse('error occurred'); 
         }         
    }

    public function event_datatable(Request $request){
         //where e.user_id='$user_id' 
        $data['title']=siteTitle();  
        $session_data=session()->get('admin_session');
        //$eventImg = config('constants.event_image');
        $goodiesImg = config('constants.event_image');
	    $s3BaseURL = config('constants.s3_baseURL');
	    $eventImg = $s3BaseURL.$goodiesImg;

		if($session_data['userType']== 3){
		$user_id=$session_data['userId'];
        $carQry="select e.id,e.event_name,ety.type_name as event_type,e.address,DATE_FORMAT(e.event_date,'%d %M %Y') as event_end_date,e.event_price,DATE_FORMAT(e.event_start_date,'%Y-%m-%d') as start_date,DATE_FORMAT(e.event_end_date,'%Y-%m-%d') as end_date,case when e.status=1 then 'Active' else 'Inactive' end as status_,e.status,case when (eimg.image is null || eimg.image='') then '' else concat('".$eventImg."',e.id,'/',eimg.image) end as image from events as e left join event_type as ety on e.event_type= ety.id left join event_images as eimg on e.id=eimg.event_id" ;       
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
		}else{
		$user_id=$session_data['userId'];
        $carQry="select e.id,e.event_name,ety.type_name as event_type,e.address,DATE_FORMAT(e.event_date,'%d %M %Y') as event_end_date,e.event_price,DATE_FORMAT(e.event_start_date,'%Y-%m-%d') as start_date,DATE_FORMAT(e.event_end_date,'%Y-%m-%d') as end_date,case when e.status=1 then 'Active' else 'Inactive' end as status_,e.status,case when (eimg.image is null || eimg.image='') then '' else concat('".$eventImg."',e.id,'/',eimg.image) end as image from events as e left join event_type as ety on e.event_type= ety.id left join event_images as eimg on e.id=eimg.event_id where e.user_id='$user_id' " ;       
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
		}
        //echo "<pre>";print_r($tableData);die; 		
        return $tableData; 
    }

     public function saveEvent(Request $request){
		 
		    $session_data=session()->get('admin_session');
		    //echo "<pre>";print_r($request->all());die; 
			$event_name=isset($request->event_name)?$request->event_name:'' ;
			$event_type = isset($request->event_type)?$request->event_type:'' ;
			$event_fee_type = isset($request->event_fee_type)?$request->event_fee_type:'' ;
			$event_country = isset($request->event_country)?$request->event_country:'' ;
			$event_city = isset($request->event_city)?$request->event_city:'' ;
			$event_address = isset($request->event_address)?$request->event_address:'' ;  
			$event_price = isset($request->event_price)?$request->event_price:'' ;
			$event_start_date = isset($request->event_start_date)?$request->event_start_date:'' ;
			$event_end_date = isset($request->event_end_date)?$request->event_end_date:'' ;
			$event_seats = isset($request->event_seats)?$request->event_seats:'' ;
			$event_date = isset($request->event_date)?$request->event_date:'' ;
			$event_descrption = isset($request->event_descrption)?$request->event_descrption:'' ;
			$event_image = isset($request->event_image)?$request->event_image:'' ;
			$user_id=isset($session_data['userId'])?$session_data['userId']:'' ;
			$date = date("Y-m-d H:i:s");
			
			
				
			try{
				$insertData=array(
				'event_name'=>$event_name ,
				'event_type'=>$event_type,
				'event_fee_type'=>$event_fee_type,
				'country'=>$event_country,
				'city'=>$event_city,
				'address'=>$event_address ,
                'event_price'=>$event_price,				
				'event_start_date'=>$event_start_date , 
                'event_end_date'=>$event_end_date ,
                'event_date'=>$event_date ,	
                'total_seats'=>$event_seats,				
				'event_descrption'=>$event_descrption,
				'user_id'=>$user_id,  
				'created_at'=>$date  	  
			);  
				$insertmember = Event::create($insertData);
				//print_r($insertmember);die;
				$event_id=$insertmember->id;
				if($request->hasFile('event_image')) {
				$files = $request->file('event_image');
				foreach ($files as $file) {				
					$imgPath='/public/event_image';  
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name .time().'.' . $ext;
					//$file->storeAs($imgPath,$image_full_name);

					//Store image on S3 bucket  
					$goodiesImg = config('constants.event_image');
			        $s3BaseURL = config('constants.s3_baseURL');
					
				   
				    $file->storeAs($goodiesImg.$event_id.'/',$image_full_name,'s3Public');
				    //echo $goodiesImg.$event_id.'/'.$image_full_name ;

                    $image=$image_full_name; 
					$input=array(
							'event_id'=>$event_id,
							'image'=>$image,
							'image_type'=>$image,
							'created_at'=>date("Y-m-d H:i:s")
						);
					//echo "<pre>";print_r($input);die; 
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
	
	public function eventStatus(Request $request)
    {
        $id=$request->id ;
        $qry="update events set status=(case when status=1 then '0' else 1 end) where id=".$id; 
        try{
           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }

     public function deleteEventType(Request $request){

        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                event_types::where('id', $deleteId)->delete();

              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }

    }

     public function editEvent(Request $request){
            //echo "<pre>";print_r($request);die; 
           $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $eventInfo = Event::where('id',$updatedId)->first() ;
		   $city = DB::table('cities')->where('id',$eventInfo->city)->first() ;
		   //echo "<pre>";print_r($eventInfo);die;   
           $eventInfo->city=$city->name;
           $eventInfo->city_id=$city->id;
           	  	   
		   $eventTypeQry="select id,type_name from event_type where status=1 " ;   
           $event_type_data = DB::select($eventTypeQry); 

			$carQry="select id,fee_type from fee_type where status=1 " ;   
			$fee_data = DB::select($carQry); 
			//$fee_data = Datatables::of($carData)->make(true);
			
			 $countryQry="select id,name,status from countries where status=1 " ;   
             $country_data = DB::select($countryQry);
		
			$cityQry="select id,country_id,name,status from cities where status=1 " ;   
			$city_data = DB::select($cityQry);
          
			$data['country_data']=$country_data;
			$data['city_data']=$city_data;
			
			
			$data['event_type_data']=$event_type_data;  
			$data['fee_data']=$fee_data;
           //echo "<pre>";print_r($data);die;     
           $data['eventInfo'] = $eventInfo ;  
           $data['updatedId']=$updatedId ;

          echo view('admin/event/event/editEvent',$data);
    }


     public function updateEvent(Request $request){ 
	        //echo "<pre>";print_r($request->all());die; 
            $updateId = isset($request->updatedId)?$request->updatedId:'' ;
            $edit_event_name=isset($request->edit_event_name)?$request->edit_event_name:'' ;
			$edit_event_type = isset($request->edit_event_type)?$request->edit_event_type:'' ;
			$edit_event_fee_type = isset($request->edit_event_fee_type)?$request->edit_event_fee_type:'' ;
			$edit_event_country = isset($request->edit_event_country)?$request->edit_event_country:'' ;
			$edit_event_city = isset($request->edit_event_city)?$request->edit_event_city:'' ;
			$edit_event_address = isset($request->edit_event_address)?$request->edit_event_address:'' ;  
			$edit_event_price = isset($request->edit_event_price)?$request->edit_event_price:'' ;
			$edit_event_seats = isset($request->edit_event_seats)?$request->edit_event_seats:'' ;
			$edit_event_date = isset($request->edit_event_date)?$request->edit_event_date:'' ;
			$edit_start_date = isset($request->edit_start_date)?$request->edit_start_date:'' ;
			$edit_end_date = isset($request->edit_end_date)?$request->edit_end_date:'' ;
			$edit_event_descrption = isset($request->edit_event_descrption)?$request->edit_event_descrption:'' ;
			$edit_event_image = isset($request->edit_event_image)?$request->edit_event_image:'' ;
			$date = date("Y-m-d H:i:s");
            
         

        try{ 
		  
			$updateData=array(
				'event_name'=>$edit_event_name ,
				'event_type'=>$edit_event_type,
				'event_fee_type'=>$edit_event_fee_type,
				'country'=>$edit_event_country,
				'city'=>$edit_event_city,  
				'address'=>$edit_event_address ,
                'event_price'=>$edit_event_price,
                'total_seats'=>$edit_event_seats,				
				'event_date'=>$edit_event_date ,  
				'event_start_date'=>$edit_start_date ,  
				'event_end_date'=>$edit_end_date ,         
				'event_descrption'=>$edit_event_descrption,
				'updated_at'=>$date	  
			);  //echo "<pre>";print_r($updateData);die;   
			Event::where('id',$updateId)->update($updateData);
			    
				if($request->hasFile('edit_event_image')) {
				$files = $request->file('edit_event_image'); 
				$image = EventImage::where('event_id',$updateId)->get();
                				
				if(!empty($image)){
					foreach($image as $images){ //echo "<pre>";print_r($images->id);die;
					$imgPath='app/public/event_image/';
					EventImage::where('id', $images->id)->delete();
					$unlinkPath = storage_path($imgPath.$images->image);
					do_upload_unlink(array($unlinkPath));
					}
				}
			
				//EventImage::where('event_id', $updateId)->delete();
				foreach ($files as $file) {				
					$imgPath='/public/event_image';  
					$image_name = md5(rand(1000, 10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name .time().'.' . $ext;
					$file->storeAs($imgPath,$image_full_name);
                    $image=$image_full_name; 

                    //Store image on S3 bucket  
					$goodiesImg = config('constants.event_image');
			        $s3BaseURL = config('constants.s3_baseURL');
					
				   
				    $file->storeAs($goodiesImg.$updateId.'/',$image_full_name,'s3Public');
				    //echo $goodiesImg.$updateId.'/'.$image_full_name ;
					$input=array(
							'event_id'=>$updateId,
							'image'=>$image,
							'image_type'=>$image,
							'created_at'=>date("Y-m-d H:i:s")
						);
                   	DB::table('event_images')->insert($input);   	  	 
				}
			}
              
              echo successResponse([],'successfully updated Event'); 
        } 
		  
         catch(\Exception $e){
			 echo $e;
             echo errorResponse('error occurred'); 
         }         
    }
    
  public function updateSponser(Request $request){
        $data['title']=siteTitle();
        $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
        $name=isset($request->editSTitle)?$request->editSTitle:'' ;
        $email = isset($request->editEmail)?$request->editEmail:'' ;
        $description = isset($request->editDescription)?$request->editDescription:'' ;
        $filenametostore='';

        $updateData=array(
            'name'=>$name ,
            'email'=>$email,
            'description'=>$description           
        );
    
        try{
            
            if($request->hasFile('editSImage')) {
        
       
                $imgPath='app/public/sponser_img/' ;
                
              
                 $filenamewithextension = $request->file('editSImage')->getClientOriginalName();
           
                 //get filename without extension
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
           
                 //get file extension
                 $extension = $request->file('editSImage')->getClientOriginalExtension();
           
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;       
                 $smallthumbnail = $filename.'_100_100_'.time().'.'.$extension;    
                
                 //Upload File
                 $request->file('editSImage')->storeAs('public/sponser_img', $filenametostore);
                // $request->file('sImage')->storeAs('public/star_type_img/thumb', $smallthumbnail);
                
                  
                 //create small thumbnail
                // $smallthumbnailpath = public_path('storage/star_type_img/thumb/'.$smallthumbnail);
                // $this->createThumbnail($smallthumbnailpath, 100, 100);                 
                $checkPV = DB::table('sponser')->select(DB::raw('case when image is null then "" else image end as image'))->where('id',$updatedId)->first();
                if(isset($checkPV->image) && $checkPV->image!=''){
                    $unlinkPath = storage_path($imgPath.$checkPV->image) ;
                    do_upload_unlink(array($unlinkPath));
                }

                $updateData['image']=$filenametostore;
                }

               
                			
            DB::table('sponser')->where('id',$updatedId)->update($updateData);
           echo successResponse([],'Updated successfully'); 

        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }
  }
}

<?php
//
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use DB ; 
use App\models\countries ;
use App\models\event_types ;
use App\models\fee_type ;
use App\models\Country ; 
use App\models\City ; 
use Image ;
use Illuminate\Support\Facades\Validator;
ini_set('memory_limit', '1024M'); 
class masterController extends Controller
{



public function createThumbnail($path, $width, $height)
    {
        
      $img = Image::make($path)->resize($width, $height)->save($path);
    }
    
    public function event_type_list(Request $request){
           
        $data['title']=siteTitle();
		$qry="select id,type_name from event_type where status=1";
        $qryExe=DB::select($qry);
         $data['']=$qryExe;
        echo view('admin/master/event_type/index',$data);

    }
	
	public function country_list(Request $request){
        $data['title']=siteTitle();
        echo view('admin/master/country/index',$data);  
    }
	
	public function country_datatable(Request $request){

        $data['title']=siteTitle();
        
        $carQry="select id,name,case when status=1 then 'Active' else 'Inactive' end as status_,status as flag from countries order by id asc" ;   
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
       // echo "<pre>";print_r($tableData);die; 		
        return $tableData; 
    }

    public function countryStatus(Request $request)
    {
        $id=$request->id ;
        $qry="update countries set status=(case when flag=1 then '0' else 1 end) where id=".$id; 
        try{
           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }
    }
     
    public function saveCountry(Request $request){ 
	        //echo "<pre>";print_r($request->all());
            $country = isset($request->country)?$request->country:'' ;
        try{	
        $insertData = array(
             "name"=>$request->country,
             "status"=>$request->country_status,
			 "created_at"=>date('Y-m-d')    
        );  
		//print_r($insertData);die;
		$check= DB::table('countries')->where('name', '=', $country)->get()->toArray();
        if(empty($check)){ 
			DB::table('countries')->insert($insertData) ; 
            echo successResponse([],'Country save successfully.'); 
        }     
        }catch(\Exception $e)
        {     
             echo errorResponse('Error occurred.');  
        }   
    }	
     public function deleteCountry(Request $request){
        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                Country::where('id', $deleteId)->delete();
              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){  
             echo errorResponse('error occurred'); 
         }
    }
     public function editCountry(Request $request){
           //echo "<pre>";print_r($request->all());die;
          $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $countryInfo = Country::where('id',$updatedId)->first() ;
           //echo "<pre>";print_r($eventTypeInfo);die; 
           $data['countryInfo'] = $countryInfo ;
           $data['updatedId']=$updatedId ;

          echo view('admin/master/country/editCountry',$data);  
    }
    public function updateCountry(Request $request){
      
          $updateId = isset($request->updatedId)?$request->updatedId:'' ;
          $edit_country = isset($request->edit_country)?$request->edit_country:'' ;
		  $edit_country_status = isset($request->edit_country_status)?$request->edit_country_status:'' ;
          
        try{ 
		   $updateData = array(
                "name"=>$edit_country, 
				"status"=>!empty($edit_country_status)?$edit_country_status:"",
            ) ;
              Country::where('id',$updateId)->update($updateData) ;
              echo successResponse([],'Country updated successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }         
    } 

    public function city_list(Request $request){
        $data['title']=siteTitle();
        echo view('admin/master/city/index',$data);    
    }
	
	public function city_datatable(Request $request){

        $data['title']=siteTitle();
        
        $carQry="select id,name,case when status=1 then 'Active' else 'Inactive' end as status_,status as flag from cities order by id asc" ;   
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
       // echo "<pre>";print_r($tableData);die; 		
        return $tableData; 
    }

    public function cityStatus(Request $request)
    {
        $id=$request->id ;
        $qry="update cities set status=(case when flag=1 then '0' else 1 end) where id=".$id; 
        try{
           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }
    }
     
    public function saveCity(Request $request){ 
	        //echo "<pre>";print_r($request->all());
            $city = isset($request->city)?$request->city:'' ;
        try{  	
        $insertData = array(
             "name"=>$request->city,
             "status"=>$request->city_status,
			 "created_at"=>date('Y-m-d')    
        );  
		//print_r($insertData);die;
		$check= DB::table('cities')->where('name', '=', $city)->get()->toArray();
        if(empty($check)){ 
			DB::table('cities')->insert($insertData) ; 
            echo successResponse([],'Country save successfully.'); 
        }     
        }catch(\Exception $e)
        {     
             echo errorResponse('Error occurred.');  
        }   
    }	
     public function deleteCity(Request $request){
        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                City::where('id', $deleteId)->delete();
              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){  
             echo errorResponse('error occurred'); 
         }
    }
     public function editCity(Request $request){
           //echo "<pre>";print_r($request->all());die;
          $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $cityInfo = City::where('id',$updatedId)->first() ;
           //echo "<pre>";print_r($eventTypeInfo);die; 
           $data['cityInfo'] = $cityInfo ;
           $data['updatedId']=$updatedId ;

          echo view('admin/master/city/editCity',$data);  
    }
    public function updateCity(Request $request){
           //echo "<pre>";print_r($request->all());die; 
          $updateId = isset($request->updatedId)?$request->updatedId:'' ;
          $edit_city = isset($request->edit_city)?$request->edit_city:'' ;
		  $edit_city_status = isset($request->edit_city_status)?$request->edit_city_status:'' ;
          
        try{ 
		   $updateData = array(
                "name"=>$edit_city,
				"status"=>!empty($edit_city_status)?$edit_city_status:"",
            ) ;
              City::where('id',$updateId)->update($updateData) ;
              echo successResponse([],'City updated successfully'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }         
    } 	

    public function event_type_datatable(Request $request){

        $data['title']=siteTitle();
        
        $carQry="select id,type_name,case when status=1 then 'Active' else 'Inactive' end as status_,status from event_type" ;   
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
        //echo "<pre>";print_r($tableData);die; 		
        return $tableData; 
    }
	
	public function event_fee_type_list(Request $request){
        $data['title']=siteTitle();
        echo view('admin/master/fee_type/index',$data);
    }  
	
	public function event_fee_type_datatable(Request $request){

        $data['title']=siteTitle();
        
        $carQry="select id,fee_type,case when status=1 then 'Active' else 'Inactive' end as status_,status from fee_type" ;   
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);
        //echo "<pre>";print_r($tableData);die; 		
        return $tableData; 
    }
	
	public function saveEventFeeType(Request $request){ 

            $event_type_fee = isset($request->event_type_fee)?$request->event_type_fee:'' ;
        try{
			
        $insertData = array(
             "fee_type"=>$request->event_type_fee,
             "status"=>$request->fee_status,
			 "created_at"=>date('Y-m-d')    
        );
		//print_r($insertData);die;
		$check= DB::table('fee_type')->where('fee_type', '=', $event_type_fee)->get()->toArray() ;
		
        if(empty($check)){ 
            
			DB::table('fee_type')->insert($insertData) ; 
            echo successResponse([],'Event Fee type save successfully.'); 
        }     

      }catch(\Exception $e)
        {     
             echo errorResponse('Error occurred.');     
          
        }
        
       
    }
	
	 public function editEventFeeType(Request $request){

          $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $feeTypeInfo = fee_type::where('id',$updatedId)->first() ;
           //echo "<pre>";print_r($eventTypeInfo);die; 
           $data['eventTypeInfo'] = $feeTypeInfo ;
           $data['updatedId']=$updatedId ;

          echo view('admin/master/fee_type/editEventFeeType',$data);
    }
	
	public function updateEventFeeType(Request $request){
      
          $updateId = isset($request->updatedId)?$request->updatedId:'' ;
          $edit_event_fee_type = isset($request->edit_event_fee_type)?$request->edit_event_fee_type:'' ;
		  $edit_fee_status = isset($request->edit_fee_status)?$request->edit_fee_status:'' ;
        try{
			
		   $updateData = array(
                "fee_type"=>$edit_event_fee_type,
				"status"=>$edit_fee_status
            ) ;
              fee_type::where('id',$updateId)->update($updateData) ;
              echo successResponse([],'successfully updated Event fee type'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }         
    }
	
	public function deleteEventFeeType(Request $request){

        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                fee_type::where('id', $deleteId)->delete();

              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }

    }
	
	public function eventFeeTypeStatus(Request $request)
    {
        $id=$request->id ;
        $qry="update fee_type set status=(case when status=1 then '0' else 1 end) where id=".$id; 
        try{
           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }


     public function saveEventType(Request $request){  
            $event_type = isset($request->event_type)?$request->event_type:'' ;
        try{
			
			if($request->hasFile('event_type_image')){
				
                $imgPath='/public/event_type_image';  
                $filenamewithextension = $request->file('event_type_image')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('event_type_image')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('event_type_image')->storeAs($imgPath,$filenametostore);

          } 
        $insertData = array(
             "type_name"=>$request->event_type,
             "status"=>1,
			 "image"=>!empty($filenametostore)?$filenametostore:"",
			 "created_at"=>date('Y-m-d')  
        );
		$check= DB::table('event_type')->where('type_name', '=', $event_type)->get()->toArray() ;
		
        if(empty($check)){ 
            
			DB::table('event_type')->insert($insertData) ; 
            echo successResponse([],'Event type save successfully.'); 
        }     

      }catch(\Exception $e)
        {     
             echo errorResponse('Error occurred.');     
          
        }
        
       
    }
	
	 public function saveTermCondition(Request $request){  
            $termCondition = isset($request->termCondition)?$request->termCondition:'' ;
			$content_id = isset($request->content_id)?$request->content_id:'' ;
        try{
			 
        $updateData = array(
             "Description"=>$request->term,
			 "CratedOn"=>date('Y-m-d H:i:s')  
        );
		// echo "<pre>";print_r($updateData);die;       
			DB::table('cms')->where('id',$content_id)->update($updateData) ;  
            echo successResponse([],'Term condition save successfully.');      

      }catch(\Exception $e)
        {     
             echo errorResponse('Error occurred.');     
          
        }
        
       
    }
	
	public function savePrivacyPolicy(Request $request){  
            $privacy_policy = isset($request->privacy_policy)?$request->privacy_policy:'' ;
			$privacy_id = isset($request->privacy_id)?$request->privacy_id:'' ;
        try{
			 
        $updateData = array(
             "Description"=>$privacy_policy,
			 "CratedOn"=>date('Y-m-d H:i:s')  
        );
		// echo "<pre>";print_r($updateData);die;       
			DB::table('cms')->where('id',$privacy_id)->update($updateData) ;  
            echo successResponse([],'Term condition save successfully.');      

      }catch(\Exception $e)
        {     
             echo errorResponse('Error occurred.');     
          
        }
        
       
    }

     public function deleteEventType(Request $request){

        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                DB::table("event_type")->where('id', $deleteId)->delete();

              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }

    }

     public function editEventType(Request $request){

          $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $eventTypeInfo = event_types::where('id',$updatedId)->first() ;
           //echo "<pre>";print_r($eventTypeInfo);die; 
           $data['eventTypeInfo'] = $eventTypeInfo ;
           $data['updatedId']=$updatedId ;

          echo view('admin/master/event_type/editEventType',$data);
    }


     public function updateEventType(Request $request){
      
          $updateId = isset($request->updatedId)?$request->updatedId:'' ;
          $edit_event_type = isset($request->edit_event_type)?$request->edit_event_type:'' ;
          
        try{
			
			if($request->hasFile('edit_event_type_image')){
				
                $imgPath='/public/event_type_image';  
                $filenamewithextension = $request->file('edit_event_type_image')->getClientOriginalName();
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                 //get file extension
                 $extension = $request->file('edit_event_type_image')->getClientOriginalExtension();
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;          
                 //Upload File
                 $request->file('edit_event_type_image')->storeAs($imgPath,$filenametostore);

          } 
		   $updateData = array(
                "type_name"=>$edit_event_type,
				"image"=>!empty($filenametostore)?$filenametostore:"",
            ) ;
              event_types::where('id',$updateId)->update($updateData) ;
              echo successResponse([],'successfully updated Event type name '); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }         
    }
    
     public function eventTypeStatus(Request $request)
    {
        $id=$request->id ;
        $qry="update event_type set status=(case when status=1 then '0' else 1 end) where id=".$id; 
        try{
           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }

    public function privacyPolicy(){

        $qry="select Id,Content_title,Description from cms where Content_type='privacyPolicy'";
        $qryExe=DB::select($qry);

        $title=isset($qryExe[0]->Content_title)?$qryExe[0]->Content_title:'' ;
        $privacyPolicy=isset($qryExe[0]->Description)?$qryExe[0]->Description:'' ;
        $pp=strip_tags($privacyPolicy) ;
        $pp_=str_replace("&nbsp;", "",  $pp);        
        
         $data['privacyPolicy'] = $pp_ ;
         $data['title'] = $title ;
		 $data['id'] = $qryExe[0]->Id;
        echo view('admin/cms/privacyPolicy',$data); 

    }


    public function termCondition(){
        
         $qry="select Id,Content_title,Description from cms where Content_type='termCondition'";
        $qryExe=DB::select($qry);

        $title=isset($qryExe[0]->Content_title)?$qryExe[0]->Content_title:'' ;
        $privacyPolicy=isset($qryExe[0]->Description)?$qryExe[0]->Description:'' ;
         $pp=strip_tags($privacyPolicy) ;
        $pp_=str_replace("&nbsp;", "",  $pp);      
        
        $data['termCondition'] = $pp_ ;
		$data['id'] = $qryExe[0]->Id;
        $data['title'] = $title ;
        echo view('admin/cms/termCondition',$data);           
    }
    
    public function notificationFor_datatable(){

        $data['title']=siteTitle();
        $carQry="select id,title,case when status=1 then 'Active' else 'Inactive' end as status_,status from notification_type" ;
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);  
        return $tableData; 
    }

    public function rankType_datatable(){
        $data['title']=siteTitle();
    
        $rankImgPath=config('constants.star_image');
        $carQry="select id,rank_title as title,range_from,range_to,case when (star_img='' || star_img is null) then '' else concat('".$rankImgPath."',star_img) end as star_img,case when status=1 then 'Active' else 'Inactive' end as status_,
        status from rank_types" ;    
       
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);  
        return $tableData; 
    }

    public function interestList(){
       $data['title']=siteTitle();

        echo view('admin/master/interest/index',$data);
    }


     public function interest_datatable(Request $request){

        $data['title']=siteTitle();
        
        $carQry="select id,title,case when status=1 then 'Active' else 'Inactive' end as status_,status as status from user_interests" ;   
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);  
        return $tableData; 
    }

    public function interestStatus(Request $request)
    {

        $id=$request->id ;

        $qry="update user_interests set status=(case when status=1 then 0 else 1 end) where id=".$id;

        try{

           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }

      public function deleteInterest(Request $request){

        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                DB::table('user_interests')->where('id', $deleteId)->delete();

              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }

    }

      public function editInterest(Request $request){

          $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
           $countryInfo = DB::table('user_interests')->where('id',$updatedId)->first() ;
           
           $data['interestInfo'] = $countryInfo ;
           $data['updatedId']=$updatedId ;

          echo view('admin/master/interest/editNFor',$data);
    }


     public function updateInterest(Request $request){
      
          $updateId = isset($request->updatedId)?$request->updatedId:'' ;
          $editCTitle = isset($request->editSTitle)?$request->editSTitle:'' ;
         
          $updateData = array(
                "title"=>$editCTitle                
            ) ;

        try{
              DB::table('user_interests')->where('id',$updateId)->update($updateData) ;
              echo successResponse([],'successfully updated interest '); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }         
    }

     public function saveInterest(Request $request){
           
            $cTitle = isset($request->sTitle)?$request->sTitle:'' ;
            

        try{

        $insertData = array(
             "title"=>$request->sTitle,            
             "status"=>1
        );

        $check= DB::table('user_interests')->where('title', '=', $cTitle)->get()->toArray() ;

       
        if(empty($check)){
            DB::table('user_interests')->insert($insertData) ;
            echo successResponse([],'Feature save successfully.'); 
        }else{
          echo errorResponse([],'Already exist this country.');        
        }
     
        
            

      }catch(\Exception $e)
        {
             echo errorResponse('Error occurred.');     
          
        }
        
       
    }

    public function sponserList(){
       $data['title']=siteTitle();

        echo view('admin/master/sponser/index',$data);
    }


     public function sponser_datatable(Request $request){

        $data['title']=siteTitle();
        $img=config('constants.sponser_image');
        $carQry="select id,name,email,case when image is null then '' else concat('".$img."',image) end as image,description,case when status=1 then 'Active' else 'Inactive' end as status_,status as status from sponser" ;  
        $carData = DB::select($carQry); 
        $tableData = Datatables::of($carData)->make(true);  
        return $tableData; 
    }

    public function sponserStatus(Request $request)
    {

        $id=$request->id ;

        $qry="update sponser set status=(case when status=1 then 0 else 1 end) where id=".$id;

        try{

           DB::select($qry);    
            echo successResponse([],'changed status successfully'); 
         
        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }

    }

    public function save_sponser(Request $request){
        $data['title']=siteTitle();
        $name=isset($request->sTitle)?$request->sTitle:'' ;
        $email = isset($request->email)?$request->email:'' ;
        $description = isset($request->description)?$request->description:'' ;
        $filenametostore='';
        try{
            
            if($request->hasFile('sImage')) {
        
       
                $imgPath='app/public/sponser_img/' ;
                
              
                 $filenamewithextension = $request->file('sImage')->getClientOriginalName();
           
                 //get filename without extension
                 $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
           
                 //get file extension
                 $extension = $request->file('sImage')->getClientOriginalExtension();
           
                 $filename=str_replace(' ', '_', $filename);
                 $filenametostore = $filename.'_'.time().'.'.$extension;       
                 $smallthumbnail = $filename.'_100_100_'.time().'.'.$extension;    
                
                 //Upload File
                 $request->file('sImage')->storeAs('public/sponser_img', $filenametostore);
                // $request->file('sImage')->storeAs('public/star_type_img/thumb', $smallthumbnail);
                
                  
                 //create small thumbnail
                // $smallthumbnailpath = public_path('storage/star_type_img/thumb/'.$smallthumbnail);
                // $this->createThumbnail($smallthumbnailpath, 100, 100);                 
                   
          
                }

                $insertData=array(
                    'name'=>$name ,
                    'email'=>$email,
                    'description'=>$description,  
                    'image'=>$filenametostore,
                    'status'=>1
                );
                			
            DB::table('sponser')->insert($insertData);
           echo successResponse([],'saved successfully'); 

        }
         catch(\Exception $e)
        {
          echo errorResponse('error occurred'); 
         
        }
    }

    public function sponserDelete(Request $request){

        $deleteId=isset($request->id)?$request->id:'' ;
        try{
                DB::table('sponser')->where('id', $deleteId)->delete();

              echo successResponse([],'successfully deleted'); 
        }
         catch(\Exception $e){
             echo errorResponse('error occurred'); 
         }

    }

    public function editSponser(Request $request){

        $updatedId = isset($request->updatedId)?$request->updatedId:0 ;
         $countryInfo = DB::table('sponser')->where('id',$updatedId)->first() ;
         
         $data['sponserInfo'] = $countryInfo ;
         $data['updatedId']=$updatedId ;

        echo view('admin/master/sponser/editNFor',$data);
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

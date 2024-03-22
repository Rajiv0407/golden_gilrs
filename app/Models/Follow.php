<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class Follow extends Model
{
    use HasFactory;
    public $timestamps = false;

     protected $fillable = [
        'id','user_id','follow_id','status','created_at',''
    ];
	
    protected $casts = [        
    ];
	
    public function following_list($id){
		     $data=session()->get('user_session');
			 $user_id=$data['userId'];
              
			 $query="select u.id,u.first_name,u.last_name,u.email,u.image,up.age,up.country,up.city,up.lat,up.log from users as u left join follows as f on f.follow_id=u.id left join user_profile as up on up.user_id = f.follow_id where f.user_id='".$id."' and u.id !='".$id."'";
			 $following_list =DB::select($query);    
			
			$res3=[]; 
             foreach($following_list as $following_lists){
				 $mutual_info=$this->mutual_friend($following_lists->id,$user_id);
				//echo "<pre>";print_r(($mutual_info[0]->mutual_friend_count));die; 
				$following['mutual_friend']=!empty($mutual_info[0]->mutual_friend_count)? ($mutual_info[0]->mutual_friend_count):"";
                $following['name']=$following_lists->first_name.' '.$following_lists->last_name;
				$following['id']=$following_lists->id;
				$following['country']=$following_lists->country;
				$following['city']=$following_lists->city;    
				if(!empty($following_lists->image)){
				$following['image']=url('/').'/storage/app/public/user_image/'.$following_lists->image;
				}else{
					$following['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
				$following['id']=$following_lists->id;
				$res3[]=$following; 
			 }
			 //echo "<pre>";print_r($res3);die; 
			 return $res3;  
		
	}

	 public function mutual_friend($id=null,$ids=null){
     
		 $query="SELECT  COUNT(DISTINCT(request_id)) AS mutual_friend_count FROM friend_list  WHERE request_id in (SELECT request_id FROM friend_list WHERE user_id = $id and status=2)  AND request_id in (SELECT request_id FROM friend_list WHERE user_id = $ids and status=2)";
		 //echo $query;die; 
	$mutual_friend = DB::select($query);
	//echo "<pre>";print_r($mutual_friend[0]->mutual_friend_count);die; 
	 return $mutual_friend;

    }
	
	public function followers_list($id){
		

		     $query="select u.id,u.first_name,u.last_name,u.email,u.email,u.image,up.age,up.country,up.city,up.lat,up.log from users as u left join follows as f on f.user_id=u.id left join user_profile as up on up.user_id = f.user_id where f.follow_id='".$id."' and u.id != '".$id."'";
		     //echo $query;die; 
			 $followers_list =DB::select($query);
             //echo "<pre>";print_r($followers_list);die; 
		     /*$followers_list = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log')
            ->join('user_profile','user_profile.user_id','=','users.id')->join('follows','follows.follow_id','=','users.id')->where('users.id','!=',$id)->get();*/ 
			$res3=[]; 
             foreach($followers_list as $followers_lists){
				$mutual_info=$this->mutual_friend($followers_lists->id,$id);
				//echo "<pre>";print_r(($mutual_info[0]->mutual_friend_count));die; 
				$followers['mutual_friend']=!empty($mutual_info[0]->mutual_friend_count)? ($mutual_info[0]->mutual_friend_count):"";  
                $followers['name']=$followers_lists->first_name.' '.$followers_lists->last_name;
				$followers['id']=$followers_lists->id;
				$followers['country']=$followers_lists->country;
				$followers['city']=$followers_lists->city;    
				if(!empty($followers_lists->image)){
				$followers['image']=url('/').'/storage/app/public/user_image/'.$followers_lists->image;
				}else{
					$followers['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
				$followers['id']=$followers_lists->id;
				$res3[]=$followers;   
			 }
			 return $res3;  
		
	}
	
	public function get_follow_list($id){ 
	         
		     $follow_list = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.image','user_profile.age','user_profile.country','user_profile.city','user_profile.lat','user_profile.log')
            ->join('user_profile','user_profile.user_id','=','users.id')->where('users.id','!=',$id)->get(); 			
			$res3=[];
            $i=0;			
             foreach($follow_list as $follow_lists){
				 $follow_info = DB::table('follows')->where('user_id',$id)->where('follow_id',$follow_lists->id)->first();
				if(empty($follow_info)){
				if($i < 3){
                $follow['name']=$follow_lists->first_name.' '.$follow_lists->last_name;
				$follow['id']=$follow_lists->id;
				$follow['country']=$follow_lists->country;
				$follow['city']=$follow_lists->city;    
				if(!empty($follow_lists->image)){
				$follow['image']=url('/').'/storage/app/public/user_image/'.$follow_lists->image;
				}else{
					$follow['image']=url('/').'/storage/app/public/user_image/'.'user.png';
				}
				$res3[]=$follow;
				}
				$i++;
			  }				
			 }
			 //echo "<pre>";print_r($res3);die; 
			 return $res3;  
	}
	
	public function notification($sender,$receiver){ 
		 $senderName=DB::table('users')->select(DB::raw("concat(first_name,' ',last_name) as name"))->where('id',$sender)->first();
		 $senderName_ = isset($senderName->name)?$senderName->name:'' ;
			$inserData=array(
				'sender_id'=>$sender ,
				'reciver_id'=>$receiver ,
				'message'=>$senderName_.' send you friend request.',
				'type'=>7 
			);

     		DB::table('notification')->insert($inserData);         
		     
	}

    
}

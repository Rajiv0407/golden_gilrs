<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
class UserProfile extends Model  
{   
    protected $table = 'user_profile';
	public $timestamps = false;

    protected $fillable = [
        'id','user_id','dob','gender','age','country','city','relationship','height','weight','education','know','interests','smoking','eye_color','marital_status','looking_man_for','work_as','self_des','banner_image','created_at','updated_at',];

}
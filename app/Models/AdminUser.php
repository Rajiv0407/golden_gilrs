<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class AdminUser extends Authenticatable    
{   
   use HasApiTokens,HasFactory, Notifiable;
   
   
    protected $table = 'admin_users';
	public $timestamps = false;
    protected $fillable =['id','first_name','last_name','email','phone','user_type','category','password','image','address_line_1','address_line_2','city','country','state','zip','created_at','updated_at',]; 

}
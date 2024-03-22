<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
class User_follows extends Model
{
    protected $table = 'user_follows';    
	public $timestamps = false;

    protected $fillable = [
        'id','followed_user_id','follower_user_id','isAccept','followBack'    
    ];

    
}
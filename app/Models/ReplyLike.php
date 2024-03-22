<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class ReplyLike extends Model
{
	protected $table = 'reply_likes';  
    protected $fillable = [
        'id','user_id','reply_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
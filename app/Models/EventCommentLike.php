<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EventCommentLike extends Model
{
	protected $table = 'event_comment_likes';  
    protected $fillable = [
        'id','user_id','comment_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EventReplyCommentLike extends Model
{
	protected $table = 'event_reply_comment_like';   
    protected $fillable = [
        'id','user_id','reply_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
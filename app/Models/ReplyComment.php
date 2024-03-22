<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
	protected $table = 'reply_comments';  
    protected $fillable = [
        'id','user_id','comment_id','post_id','reply_comment','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
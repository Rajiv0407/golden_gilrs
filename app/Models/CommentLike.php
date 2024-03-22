<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
	protected $table = 'comment_likes';  
    protected $fillable = [
        'id','user_id','comment_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class GoodiesCommentLike extends Model
{
	protected $table = 'goodies_comment_likes';  
    protected $fillable = [
        'id','user_id','comment_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
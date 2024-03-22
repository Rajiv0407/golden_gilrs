<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
	protected $table = 'post_like';  
    protected $fillable = [
        'id','user_id','post_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];
}
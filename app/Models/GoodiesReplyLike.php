<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class GoodiesReplyLike extends Model
{
	protected $table = 'goodies_reply_like';  
    protected $fillable = [
        'id','user_id','reply_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
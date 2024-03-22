<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class GoodiesReply extends Model
{
	protected $table = 'goodies_reply';    
    protected $fillable = [
        'id','user_id','comment_id','goodies_id','comment','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
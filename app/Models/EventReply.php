<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EventReply extends Model    
{
	protected $table = 'event_reply';  
    protected $fillable = [
        'id','user_id','comment_id','event_id','comment','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
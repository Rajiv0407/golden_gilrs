<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EventLike extends Model
{
	protected $table = 'event_like';  
    protected $fillable = [
        'id','user_id','event_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
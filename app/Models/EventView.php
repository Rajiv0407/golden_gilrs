<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EventView extends Model
{
	protected $table = 'event_view';  
    protected $fillable = [
        'id','user_id','event_id','created_at','updated_at'               
    ];
	protected $casts = [        
    ];	
}
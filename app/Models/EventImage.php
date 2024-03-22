<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
	
    protected $fillable = [
        'id','event_id','image','image_type','created_at'                
    ];
	protected $casts = [        
    ];
}
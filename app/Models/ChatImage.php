<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class ChatImage extends Model
{
	
    protected $fillable = [
        'id','chat_id','file','file_type','created_at','updated_at'                
    ];  
	protected $casts = [        
    ];
}
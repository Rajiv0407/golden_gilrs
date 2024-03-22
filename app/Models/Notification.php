<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class Notification extends Model
{
    use HasFactory;
	protected $table = 'notification';
    public $timestamps = false;

     protected $fillable = [
        'id','sender_id','reciver_id','post_id','type','message','created_at','updated_at'
    ];  
	  
    protected $casts = [        
    ];

    
}

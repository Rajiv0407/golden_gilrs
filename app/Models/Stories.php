<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class Stories extends Model
{
    use HasFactory;
    public $timestamps = false;

     protected $fillable = [
        'id','user_id','image','file_type','till_valid','created_at','updated_at'
    ];
	  
    protected $casts = [        
    ];

    
    

    
}

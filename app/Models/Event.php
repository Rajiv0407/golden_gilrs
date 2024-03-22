<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;

     protected $fillable = [
        'id','event_name','event_type','event_fee_type','address','event_start_date','event_end_date','event_date','event_price','total_seats','event_descrption','status','created_at','user_id','country','city','updated_at'  
    ];
	  
    protected $casts = [        
    ];

    
}

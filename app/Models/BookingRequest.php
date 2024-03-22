<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
	protected $table = 'booking_requests';  
    protected $fillable = [
        'id','user_id','type_id','status','email_status','booking_type','number_of_ticket','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
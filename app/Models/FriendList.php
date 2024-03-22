<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class FriendList extends Model
{
    use HasFactory;
	protected $table = 'friend_list';  
    public $timestamps = false;

     protected $fillable = [
        'id','user_id','request_id','status','created_at','updated_at'
    ];
	
    protected $casts = [        
    ];

    
}

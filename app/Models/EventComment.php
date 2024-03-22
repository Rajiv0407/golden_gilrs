<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class EventComment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'event_comments';
     protected $fillable = [
        'id','user_id','event_id','comment','created_at','updated_at',
    ];
	
    protected $casts = [        
    ];

    
}

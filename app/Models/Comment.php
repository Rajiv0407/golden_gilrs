<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;

     protected $fillable = [
        'id','user_id','post_id','comment','created_at','updated_at',
    ];
	
    protected $casts = [        
    ];

    
}

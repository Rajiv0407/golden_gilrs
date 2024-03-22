<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;

     protected $fillable = [
        'id','user_id','post_text','post_type','created_at','updated_at',
    ];
	
    protected $casts = [        
    ];

    
}

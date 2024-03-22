<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB ;

class GoodiesComment extends Model
{
    use HasFactory;
    public $timestamps = false;
      protected $table = 'goodies_comments';
     protected $fillable = [
        'id','user_id','goodies_id','comment','created_at','updated_at',
    ];
	
    protected $casts = [        
    ];

    
}

<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class GoodiesLike extends Model
{
	protected $table = 'goodies_like';  
    protected $fillable = [
        'id','user_id','goodies_id','status','created_at','updated_at'                
    ];
	protected $casts = [        
    ];	
}
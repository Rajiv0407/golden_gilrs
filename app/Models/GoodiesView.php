<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class GoodiesView extends Model
{
	protected $table = 'goodies_view';    
    protected $fillable = [
        'id','user_id','goodies_id','created_at','updated_at'               
    ];
	protected $casts = [        
    ];	
}
<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Goodies extends Model
{
    protected $table = 'goodies';  
	public $timestamps = false;   

    protected $fillable = [
        'id','title','goodies_address','goodies_fee_type','goodies_descrption','goodies_seats','image','goodies_date','start_date','end_date','status','user_id','city','country','created_at','updated_at'
    ];

}
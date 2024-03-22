<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';  
	public $timestamps = false;

    protected $fillable = [
        'id','event_id','coupon_title','coupon_type','coupon_value','limit_usage','start_date','end_date','status','created_at','updated_at'
    ];

}
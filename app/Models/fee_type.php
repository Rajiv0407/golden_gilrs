<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class fee_type extends Model
{
    protected $table = 'fee_type';
	public $timestamps = false;

    protected $fillable = [
        'id','fee_type','status','created_at','updated_at'
    ];

}
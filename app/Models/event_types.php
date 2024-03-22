<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class event_types extends Model
{
    protected $table = 'event_type';
	public $timestamps = false;

    protected $fillable = [
        'id','type_name','status'
    ];

}
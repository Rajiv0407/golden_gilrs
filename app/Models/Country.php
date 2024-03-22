<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';  
	public $timestamps = false;

    protected $fillable = [
        'id','name','status','createdOn',  
    ];

}
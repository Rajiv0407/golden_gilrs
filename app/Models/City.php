<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
class City extends Model
{
    protected $table = 'cities';    
	public $timestamps = false;

    protected $fillable = [
        'id','name','country_id','status','createdOn',    
    ];

}
<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
class PostImage extends Model  
{   
    protected $table = 'post_images';
	public $timestamps = false;

    protected $fillable = [
        'id','post_id','user_id','image','type','created_at',];

}
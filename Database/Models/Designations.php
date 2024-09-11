<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Designations extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "designation";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'designation'
    ];
   
}

?>
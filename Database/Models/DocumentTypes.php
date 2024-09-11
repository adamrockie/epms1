<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DocumentTypes extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */

    protected $table = "doctypes";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name','description'
    ];

 
    
   
}

?>
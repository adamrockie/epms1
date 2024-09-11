<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ranks extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */

    protected $table = "ranks";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'rank'
    ];


    public function owner()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis');
    }

    public function type()
    {
        return $this->belongsTo('Database\Models\DocumentTypes', 'type_id');
    }

 
    
   
}

?>
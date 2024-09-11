<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Documents extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */

    protected $table = "documents";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'ippis','type_id', 'doc', 'title', 'description'
    ];


    public function owner()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }

    public function type()
    {
        return $this->belongsTo('Database\Models\DocumentTypes', 'type_id');
    }

 
    
   
}

?>
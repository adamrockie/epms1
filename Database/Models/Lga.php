<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Lga extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "lga";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
           'lga_id', 'lga_name', 'state_id'
    ];


    public function state()
    {
        return $this->belongsTo('Database\Models\States', 'state_id', 'state_id');
    }
   
}

?>
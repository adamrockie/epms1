<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Training extends Model
{ 
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "training";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'ippis','training', 'start_date', 'end_date', 'certificate', 'url'
    ];

    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }
}

?>
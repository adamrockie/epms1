<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Units extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "units";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'unit_id','office_id','name', 'location'
    ];

    public function office()
    {
        return $this->belongsTo('Database\Models\Offices', 'office_id', 'office_id');
    }

    public function staff()
    {
        return $this->hasMany('Database\Models\Employees', 'office_id');
    }
   
}

?>
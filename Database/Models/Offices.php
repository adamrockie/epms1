<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Offices extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "offices";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'office_id','name', 'location', 'type', 'created_by_id'
    ];

    public function created_by()
    {
        return $this->belongsTo('Database\Models\Users', 'created_by_id');
    }

    public function staff()
    {
        return $this->hasMany('Database\Models\Employees', 'office_id');
    }
   
}

?>
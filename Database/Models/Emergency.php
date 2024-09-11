<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Emergency extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "emergency";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'ippis',
        'names', 
        'relationship', 
        'phone_1',
        'phone_2',
        'type'
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
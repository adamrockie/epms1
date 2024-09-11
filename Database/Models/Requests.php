<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Requests extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "requests";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'uniqid','staff_id', 'title', 'content', 'status', 'attachment', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'staff_id', 'staff_id');
    }
   
}

?>
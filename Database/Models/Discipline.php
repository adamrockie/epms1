<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Discipline extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "discipline";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'uniqid','staff_id', 'title', 'content', 'status', 'attachment1', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'staff_id', 'staff_id');
    }
   
}

?>
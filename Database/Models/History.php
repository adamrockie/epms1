<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class History extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "history";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'staff_id', 'type', 'description', 'author'
    ];


    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'staff_id', 'staff_id');
    }

    public function author()
    {
        return $this->belongsTo('Database\Models\Employees', 'author', 'staff_id');
    }
   
}

?>
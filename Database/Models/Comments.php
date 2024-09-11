<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comments extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "comments";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'source','source_id', 'author', 'status', 'comment', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function author()
    {
        return $this->belongsTo('Database\Models\Employees', 'author', 'staff_id');
    }

    public function source($source_type)
    {
        if($source_type == 'document')
        {
            return $this->belongsTo('Database\Models\Documents', 'source_id', 'id');
        }
        elseif($source_type == 'leave')
        {
            return $this->belongsTo('Database\Models\LeaveHistory', 'source_id', 'id');
        }
          
    }
   
}

?>
<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Posting extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "posting";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'posting_id', 'ippis', 'staff_id','office_id', 'unit_id', 'position', 'start_date', 'end_date', 'status'
    ];

    public function office()
    {
        return $this->belongsTo('Database\Models\Offices', 'office_id', 'office_id');
    }

    public function unit()
    {
        return $this->belongsTo('Database\Models\Units', 'unit_id', 'unit_id');
    }

    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }
/*
    public function staff()
    {
        return $this->hasMany('Database\Models\Employees', 'ippis', 'ippis');
    }
*/
    public function staff_rank()
    {
        return $this->hasOneThrough('Database\Models\Ranks', 'Database\Models\Employees', 'rank', 'id', 'id', 'ippis');
    }
   
}

?>
<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Heads extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "heads";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'ippis','office_id', 'status', 'doa', 'dot'
    ];

    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }

    public function office()
    {
        return $this->belongsTo('Database\Models\Offices', 'office_id', 'office_id');
    }
   
}

?>
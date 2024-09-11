<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LeaveHistory extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "leave_history";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'ippis', 'leave_type', 'start_date', 'end_date', 'days', 'remark', 'request_status', 'created_at', 'updated_at', 'deleted_at'
    ];


    public function leavetype()
    {
        return $this->belongsTo('Database\Models\LeaveTypes', 'leave_type', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }

 /*
    public function office()
    {
        return $this->hasOneThrough('Database\Models\Offices', 'Database\Models\Employees', 'ippis', 'office_id', 'ippis', 'office_id');
    }
*/

   
}

?>
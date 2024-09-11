<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employees extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */
    //use SoftDeletes; 
    protected $table = "staff";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'cadre','title', 'surname', 'middlename', 'lastname', 'rank', 'gl', 'step', 
        'ippis', 'file_no', 'sex', 'dob', 'date_of_1st_appt', 'date_of_confirmation', 
        'date_of_pres_appt', 'state_origin', 'lga', 'official_email', 'personal_email', 'phone', 
        'passport', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function office()
    {
        return $this->belongsTo('Database\Models\Offices', 'office_id', 'office_id');
    }

    public function designation()
    {
        return $this->belongsTo('Database\Models\Designations', 'designation_id', 'id');
    }

    public function rank()
    {
        return $this->belongsTo('Database\Models\Ranks', 'rank', 'id');
    }

    public function state()
    {
        return $this->belongsTo('Database\Models\States', 'state_origin', 'state_id');
    }

    public function current_office()
    {
        return $this->hasOneThrough('Database\Models\Offices', 'Database\Models\Posting', 'office_id', 'office_id', 'ippis', 'ippis');
    }

    public function current_unit()
    {
        return $this->hasManyThrough('Database\Models\Offices', 'Database\Models\Posting', 'office_id', 'office_id', 'ippis', 'ippis');
    }
    
   
}

?>
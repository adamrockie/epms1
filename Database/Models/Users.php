<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
class Users extends Model
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = "users";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'ippis', 'email', 'password', 'status', 'group_id', 'office_id'
    ];
   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
  

   /*
    * Get Group of User
    *
    */
    public function group()
    {
        return $this->belongsTo('Database\Models\Groups', 'group_id', 'id');
    }

    /**
     * Get the user's staff details
     */
    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }

    /**
     * Get the user's staff details
     */
    public function office()
    {
        return $this->belongsTo('Database\Models\Offices', 'office_id', 'office_id');
    }
}

?>
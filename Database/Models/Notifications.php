<?php

/**
 * One framework v2
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
class Notifications extends Model
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = "notification";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'title', 'content', 'status', 'source', 'user_destination', 'uniqid', 'created_at', 'updated_at'
    ];
}

?>
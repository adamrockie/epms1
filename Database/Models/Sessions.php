<?php
/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
class Sessions extends Model
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = "users_session";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'hash'
    ];

 }

?>
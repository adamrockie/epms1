<?php
/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
class Groups extends Model
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = "groups";
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'name', 'permissions'
   ];
 }

?>
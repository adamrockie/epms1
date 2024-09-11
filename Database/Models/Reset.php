<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
class Reset extends Model
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = "reset";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id','token'
    ];

   /*
    * Get Todo of User
    *
    */
    public function posts()
    {
        return $this->hasMany(Post::class, 'created_by');
    }
}

?>
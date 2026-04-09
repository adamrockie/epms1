<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ItemRequests extends Model
{
    
   /**
    * The database table used by the model.
    *
    * @var string
    */

    protected $table = "items_requests";
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'rid','ippis','item_id', 'item_name', 'item_description', 'qty', 'head', 'head_approval_status', 'dir_approval_date', 'agf', 'agf_approval_status', 'agf_approval_date', 'status', 'request_date','comment', 'created_at', 'updated_at', 'deleted_at',
    ];


    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }

    // public function item()
    // {
    //     return $this->belongsTo('Database\Models\Items', 'item_id');
    // }

  
}

?>
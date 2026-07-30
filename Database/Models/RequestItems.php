<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;

class RequestItems extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "request_items";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'subject', 'description', 'status', 'note',
        'created_at', 'updated_at'
    ];

    
}

?>
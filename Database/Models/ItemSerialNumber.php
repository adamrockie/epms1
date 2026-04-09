<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSerialNumber extends Model
{
    protected $table = "item_serial_numbers";

    protected $fillable = [
        'item_request_id',
        'inventory_id',   
        'ippis',
        'serial_number'
    ];

    //  Request relationship
    public function request()
    {
        return $this->belongsTo('Database\Models\ItemRequests', 'item_request_id');
    }

    //  Inventory relationship
    public function inventory()
    {
        return $this->belongsTo('Database\Models\Inventory', 'inventory_id');
    }

    // Staff relationship
    public function staff()
    {
        return $this->belongsTo('Database\Models\Employees', 'ippis', 'ippis');
    }
}
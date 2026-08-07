<?php

namespace Database\Models;
use Illuminate\Database\Eloquent\Model;

class ReceivableDocument extends Model
{
    protected $table = "receivable_documents";

    protected $fillable = [
        'id', 'receivable_id', 'document', 'status', 'created_at', 'updated_at'
    ];

    public function receivable()
    {
        return $this->belongsTo('Database\Models\Receiveable', 'receivable_id', 'id');
    }
    public function documents()
    {
        return $this->hasMany('Database\Models\ReceivableDocument', 'receivable_id', 'id');
    }
}
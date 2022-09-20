<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'history_details',
            'history_id',
            'item_id'
        )->withPivot('price', 'quantity', 'subtotal');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

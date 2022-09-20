<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'item_id';
    public $timestamps = false;

    public function history()
    {
        return $this->belongsToMany(
            'App\Models\History',
            'history_details',
            'item_id',
            'history_id'
        )->withPivot('buy_price', 'quantity', 'subtotal');
    }

    public function item()
    {
        return $this->belongsToMany(
            'App\Models\Invoice',
            'invoice_details',
            'item_id',
            'invoice_id'
        )->withPivot('price', 'quantity', 'subtotal');
    }
}

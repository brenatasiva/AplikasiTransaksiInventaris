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

    public function invoice()
    {
        return $this->belongsToMany(
            'App\Models\Invoice',
            'invoice_details',
            'invoice_id',
            'item_id'
        )->withPivot('price', 'quantity', 'subtotal');
    }
}

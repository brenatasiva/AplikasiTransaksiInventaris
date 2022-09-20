<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';
    protected $primaryKey = 'history_id';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'history_details',
            'history_id',
            'item_id'
        )->withPivot('buy_price', 'quantity', 'subtotal');
    }

    public function insertHistory($items)
    {
        $total = 0;
        $subtotal = 0;
        foreach ($items as $id => $detail) {
            $subtotal = $detail['price'] * $detail['quantity'];
            $total += $detail['price'] * $detail['quantity'];
            $this->item()->attach($id, ['quantity' => $detail['quantity'], 'subtotal' => $subtotal, 'buy_price' => $detail['price'], 'item_id' => $detail['item_id']]);
        }

        return $total;
    }
}

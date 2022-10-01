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

    public function insertHistoryDetail($items, $id)
    {
        // dd($items);
        $total = 0;
        $subtotal = 0;
        for ($i=0; $i < count($items->name); $i++) { 
            $item = Item::where('name', 'like', '%' . $items->name[$i] . '%')->first();
            $item->stock = $item->stock + $items->quantity[$i];
            $item->save();//add stock

            $subtotal = $items->buyPrice[$i] * $items->quantity[$i];
            $total += $subtotal;
            $this->item()->attach($id, ['quantity' => $items->quantity[$i], 'subtotal' => $subtotal, 'buy_price' => $items->buyPrice[$i], 'item_id' => $item->item_id]);
        }

        return $total;
    }
}

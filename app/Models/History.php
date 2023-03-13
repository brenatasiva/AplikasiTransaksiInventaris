<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoryDetails;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';
    protected $primaryKey = 'history_id';
    public $timestamps = false;

    // public function item()
    // {
    //     return $this->belongsToMany(
    //         'App\Models\Item',
    //         'history_details',
    //         'history_id'
    //     )->withPivot('buy_price', 'quantity', 'subtotal', 'item_name');
    // }

    public function insertHistoryDetail($items, $id)
    {
        // dd($items);
        $total = 0;
        $subtotal = 0;
        for ($i=0; $i < count($items->name); $i++) { 
            $item = Item::where('name', 'like', '%' . $items->name[$i] . '%')->first();
            $newBuyPrice = ($item->stock > 0 ? ($item->buy_price * $item->stock + $items->buyPrice[$i] * $items->quantity[$i]) / ($item->stock + $items->quantity[$i]) : $items->buyPrice[$i]);//hitung harga kulak baru
            $item->buy_price = round($newBuyPrice);//update harga kulak
            $item->stock = $item->stock + $items->quantity[$i];
            
            $item->save();//add stock

            
            $subtotal = $items->buyPrice[$i] * $items->quantity[$i];
            $total += $subtotal;

            $hd = new HistoryDetails();
            $hd->history_id = $id;
            $hd->item_name = $item->name;
            $hd->buy_price = $items->buyPrice[$i];
            $hd->quantity = $items->quantity[$i];
            $hd->subtotal = $subtotal;
            $hd->save();
        }

        return $total;
    }
}

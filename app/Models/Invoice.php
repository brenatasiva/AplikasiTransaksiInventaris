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
            'invoice_details',
            'invoice_id',
            'item_id'
        )->withPivot('price', 'quantity', 'subtotal');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function insertInvoiceDetail($items, $id)
    {
        // dd($items);
        $total = 0;
        $subtotal = 0;
        for ($i=0; $i < count($items->name); $i++) { 
            $item = Item::where('name', 'like', '%' . $items->name[$i] . '%')->first();
            $item->stock = $item->stock - $items->quantity[$i];
            $item->save();//reduce stock

            $subtotal = $items->price[$i] * $items->quantity[$i];
            $total += $subtotal;
            $this->item()->attach($id, ['quantity' => $items->quantity[$i], 'subtotal' => $subtotal, 'price' => $items->price[$i], 'item_id' => $item->item_id]);
        }

        return $total;
    }
}

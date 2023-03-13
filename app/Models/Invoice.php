<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceDetails;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    public $timestamps = false;

    // public function item()
    // {
    //     return $this->belongsToMany(
    //         'App\Models\Item',
    //         'invoice_details',
    //         'invoice_id',
    //         'item_id'
    //     )->withPivot('price', 'buy_price', 'quantity', 'subtotal');
    // }

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User', 'user_id');
    // }

    public function insertInvoiceDetail($items, $id)
    {
        // dd($items);
        $total = 0;
        $profit = 0;
        $array = [];
        $subtotal = 0;
        for ($i=0; $i < count($items->name); $i++) { 
            $item = Item::where('name', 'like', '%' . $items->name[$i] . '%')->first();
            
            $subtotal = $items->price[$i] * $items->quantity[$i];
            $total += $subtotal;

            $invdet = new InvoiceDetails();
            $invdet->invoice_id = $id;
            $invdet->item_name = $item->name;
            $invdet->price = $item->price;
            $invdet->buy_price = $item->buy_price;
            $invdet->quantity = $items->quantity[$i];
            $invdet->subtotal = $subtotal;
            $invdet->save();

            $item->stock = $item->stock - $items->quantity[$i];
            $item->save();//reduce stock

            $profit += ($items->price[$i] - $item->buy_price) * $items->quantity[$i];
        }

        $array['total'] = $total;
        $array['profit'] = $profit;
        
        return $array;
    }
}

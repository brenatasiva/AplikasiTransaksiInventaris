<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $table = 'histories';

    public function item()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'history_details',
            'history_id',
            'item_id'
        )->withPivot('buy_price', 'quantity', 'subtotal');
    }
}

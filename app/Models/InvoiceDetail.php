<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';

    public function item()
    {
        return $this->belongsTo('App\Model\Item', 'item_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Model\Invoice', 'invoice_id', 'id');
    }
}

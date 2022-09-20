<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetail extends Model
{
    use HasFactory;

    protected $table = 'history_details';

    public function item()
    {
        return $this->belongsTo('App\Model\Item', 'item_id', 'id');
    }

    public function history()
    {
        return $this->belongsTo('App\Model\History', 'history_id', 'id');
    }
}

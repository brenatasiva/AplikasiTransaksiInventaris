<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetails extends Model
{
    use HasFactory;

    protected $table = 'history_details';
    protected $primaryKey = 'history_details_id';
    public $timestamps = false;
}

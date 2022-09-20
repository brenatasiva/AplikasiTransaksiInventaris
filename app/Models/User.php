<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function invoice()
    {
        return $this->belongsTo('App\Model\Invoice', 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionsDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'transaction_id', 'products_id'
    ];

    protected $hidden = [];

    protected $table = 'transaction_details';

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'transaction_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}

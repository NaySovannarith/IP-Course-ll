<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Disable timestamps for this model
    public $timestamps = false;
    protected $table = ('payments');
    protected $fillable = ['payment_method', 'amount', 'payment_date', 'order_id', 'customer_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
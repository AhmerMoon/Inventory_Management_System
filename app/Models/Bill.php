<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['customer_id', 'total', 'date'];
    
    protected $dates = ['date']; // Add this line
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function items()
    {
        return $this->hasMany(BillItem::class);
    }
}
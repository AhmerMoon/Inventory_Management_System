<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $fillable = ['bill_id', 'product_id', 'quantity', 'price'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
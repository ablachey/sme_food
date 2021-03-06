<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'customer_id',
    'deliver_at',
    'discount',
    'delivery_status',
    'payment_status',
    'payment_method',
  ];

  protected $casts = [
    'deliver_at' => 'datetime',
  ];

  public function customer() {
    return $this->belongsTo(Customer::class);
  }

  public function products() {
    return $this->belongsToMany(Product::class)->withPivot('quantity', 'preferences');
  }
}

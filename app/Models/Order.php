<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $guarded = [];

    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot(['quantity', 'discount', 'color', 'id'])->withTimestamps();
    }

    public function governorate()
    {
    	return $this->belongsTo(Governorate::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

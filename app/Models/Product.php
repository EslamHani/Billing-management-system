<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $guarded = [];

    public function trademark()
    {
    	return $this->belongsTo(Trademark::class, 'trade_id', 'id');
    }

    public function department()
    {
    	return $this->belongsTo(Department::class, 'dep_id', 'id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class)->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }

    public function getPhotoAttribute($value)
    {
        return asset($value);
    }
}

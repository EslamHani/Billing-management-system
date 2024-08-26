<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    protected $table = "trademarks";

    protected $guarded = [];

    public function product()
    {
    	return $this->hasMany(Product::class);
    }
}

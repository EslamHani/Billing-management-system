<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $guarded = [];

	//$owner->abilities
    public function abilities()
    {
    	return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    public function allowTo($ability)
    {
        if(is_string($ability))
        {
            $ability = Ability::whereName($ability)->firstOrFail();
        }
        $this->abilities()->sync($ability);
    }
}

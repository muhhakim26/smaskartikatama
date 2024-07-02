<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UpperCaseTrait
{
    public function getNameAttribute()
    {
        return Str::of($this->attributes['name'])->upper();
    }
}

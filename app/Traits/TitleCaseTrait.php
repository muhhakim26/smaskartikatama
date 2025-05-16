<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait TitleCaseTrait
{
    public function getNameAttribute()
    {
        return Str::of($this->attributes['name'])->title();
    }
}

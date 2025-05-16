<?php

namespace App\Models\Area;

class CustomModel extends \Illuminate\Database\Eloquent\Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'indonesia_' . $this->table;
    }
}

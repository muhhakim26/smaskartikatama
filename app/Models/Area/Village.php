<?php

namespace App\Models\Area;

use App\Traits\UpperCaseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends CustomModel
{
    use HasFactory, UpperCaseTrait;
    protected $fillable = ['code', 'district_code', 'name'];
    protected $table = 'villages';
}

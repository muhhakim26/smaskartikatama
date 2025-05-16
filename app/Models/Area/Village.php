<?php

namespace App\Models\Area;

use App\Traits\TitleCaseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends CustomModel
{
    use HasFactory, TitleCaseTrait;

    protected $fillable = ['code', 'district_code', 'name'];
    protected $table = 'villages';
}

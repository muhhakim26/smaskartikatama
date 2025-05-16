<?php

namespace App\Models\Area;

use App\Traits\TitleCaseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends CustomModel
{
    use HasFactory, TitleCaseTrait;

    protected $fillable = ['code', 'name'];
    protected $table = 'provinces';

    public function regencies()
    {
        return $this->hasMany(Regency::class, 'province_code', 'code');
    }
}

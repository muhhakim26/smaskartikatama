<?php

namespace App\Models\Area;

use App\Traits\TitleCaseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regency extends CustomModel
{
    use HasFactory, TitleCaseTrait;

    protected $fillable = ['code', 'province_code', 'name'];
    protected $table = 'regencies';

    public function districts()
    {
        return $this->hasMany(District::class, 'regency_code', 'code');
    }
}

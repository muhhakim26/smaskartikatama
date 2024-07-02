<?php

namespace App\Models\Area;

use App\Traits\UpperCaseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends CustomModel
{
    use HasFactory, UpperCaseTrait;
    protected $fillable = ['code', 'regency_code', 'name'];
    protected $table = 'districts';
    public function villages()
    {
        return $this->hasMany(Village::class, 'district_code', 'code');
    }

}

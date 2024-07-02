<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, TimestampTrait;
    protected $table = 'admin';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'level',
    ];
    protected $hidden = [
        'password',
    ];
}

<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', [Home::class, 'index'])->name('home');

Route::get('/admin', [Admin::class, 'index'])->name('admin');

Route::get('/create-admin', [Admin::class, 'create'])->name('create-admin');

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Artisan::call('farm:life');

    return view('welcome');
});

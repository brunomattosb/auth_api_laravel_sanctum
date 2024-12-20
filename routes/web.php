<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    abort(403,  'Unauthorized access');
});



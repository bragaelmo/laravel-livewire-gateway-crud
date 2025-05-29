<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\GatewayCrud;

Route::get('/', function () {
    return view('welcome');
});

//route::get('/gateways', GatewayCrud::class);
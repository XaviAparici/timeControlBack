<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/index', [Controller::class, 'index']);
Route::post('/registroInicio', [Controller::class, 'horaInicio']);
Route::post('/registroFin', [Controller::class, 'horaFin']);
Route::get('/getData', [Controller::class, 'getData']);
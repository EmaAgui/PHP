<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\PortafolioController::class, 'index']); ///se agrega el controlador y el metodo index
Auth::routes(); //se agrega para que funcione el login

Route::resource('/proyectos', App\Http\Controllers\ProyectoController::class); //se agrega para que funcione el crud

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //se agrega para que funcione el login



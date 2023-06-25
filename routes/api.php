<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/login', 'App\Http\Controllers\UserController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{id}', 'App\Http\Controllers\UserController@getUser'); // Obter informações do usuário atual
    Route::get('/users/{id}', 'App\Http\Controllers\UserController@show'); // Obter informações de um usuário específico
    Route::put('/user/{id}', 'App\Http\Controllers\UserController@updateUser'); // Atualizar informações do usuário atual
    Route::delete('/user/{id}', 'App\Http\Controllers\UserController@deleteUser'); // Excluir usuário atual
    Route::get('/users', 'App\Http\Controllers\UserController@listUsers'); // Listar todos os usuários
    Route::middleware('auth:sanctum')->post('/logout', 'App\Http\Controllers\UserController@logout'); // Realiza o logout do usuário


    Route::resource('events', 'App\Http\Controllers\EventController');
});

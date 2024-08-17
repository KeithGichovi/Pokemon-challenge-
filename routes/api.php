<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokemonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authentication;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'Register']);

Route::post('/login', [AuthController::class, 'Login']);


Route::middleware('auth:sanctum')->group(function() {

    Route::get('/logout', [AuthController::class, 'Logout']);
    Route::post('/insertPokemoncsv', [PokemonController::class, 'insertPokemoncsv']);
    Route::get('/displayPokemon', [PokemonController::class, 'displayPokemon']);
});
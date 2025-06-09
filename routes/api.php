<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/usuario-logado', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


//CATEGORIAS
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias/store', [CategoriaController::class, 'store']);
Route::delete('/categorias/delete/{id}', [CategoriaController::class, 'destroy']);
Route::put('/categorias/update/{id}', [CategoriaController::class, 'update']);

//PRODUTOS
Route::get('/produtos', [ProdutoController::class, 'index'])->name("produtos.listar");
Route::post('/produtos/store', [ProdutoController::class, 'store']);
Route::delete('/produtos/delete/{id}', [ProdutoController::class, 'destroy']);
Route::put('/produtos/update/{id}', [ProdutoController::class, 'update']);  

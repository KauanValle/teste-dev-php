<?php

use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/salvarFornecedor", [FornecedorController::class, 'salvarFornecedor']);
Route::put("/atualizarFornecedor", [FornecedorController::class, 'atualizarFornecedor']);
Route::delete("/deletarFornecedor", [FornecedorController::class, 'deletarFornecedor']);
Route::get("/listarFornecedores", [FornecedorController::class, 'listarFornecedores']);

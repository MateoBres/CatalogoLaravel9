<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

#############################################################################
#############  CRUD de Marcas
Route::get('/adminMarcas', [MarcaController::class, 'index']);
Route::get('/agregarMarca', [MarcaController::class, 'create']);
Route::post('/agregarMarca', [MarcaController::class, 'store']);
Route::get('/modificarMarca/{id}', [MarcaController::class, 'edit']);
Route::put('/modificarMarca/{id}', [MarcaController::class, 'update']);
Route::get('/eliminarMarca/{id}', [MarcaController::class, 'confirmarBaja']);
Route::delete('/eliminarMarca', [MarcaController::class, 'destroy']);

#############################################################################
#############  CRUD de Categorias
Route::get('/adminCategorias', [CategoriaController::class, 'index']);
Route::get('/agregarCategoria', [CategoriaController::class, 'create']);
Route::post('/agregarCategoria', [CategoriaController::class, 'store']);
Route::get('/modificarCategoria/{id}', [CategoriaController::class, 'edit']);
Route::put('/modificarCategoria/{id}', [CategoriaController::class, 'update']);
Route::get('/eliminarCategoria/{id}', [CategoriaController::class, 'confirmarBaja']);
Route::delete('/eliminarCategoria', [CategoriaController::class, 'destroy']);

#############################################################################
#############  CRUD de Productos
Route::get('/adminProductos', [ProductoController::class, 'index']);
Route::get('/agregarProducto', [ProductoController::class, 'create']);
Route::post('/agregarProducto', [ProductoController::class, 'store']);
Route::get('/modificarProducto/{id}', [ProductoController::class, 'edit']);
Route::put('/modificarProducto/{id}', [ProductoController::class, 'update']);
Route::get('/eliminarProducto/{id}', [ProductoController::class, 'confirmarBaja']);
Route::delete('/eliminarProducto', [ProductoController::class, 'destroy']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaFiscalController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

// USUARIOS
Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('home');
Route::get('/editar_usuario', [App\Http\Controllers\UsuariosController::class, 'editar_usuario'])->name('editar_usuario');
Route::post('/editar_usuario_alterar', [App\Http\Controllers\UsuariosController::class, 'editar_usuario_alterar'])->name('editar_usuario_alterar');
Route::get('/deletar_usuario', [App\Http\Controllers\UsuariosController::class, 'deletar_usuario'])->name('deletar_usuario');
Route::get('/alterar_senha', [App\Http\Controllers\UsuariosController::class, 'alterar_senha'])->name('alterar_senha');
Route::post('/alterar_senha_alterar', [App\Http\Controllers\UsuariosController::class, 'alterar_senha_alterar'])->name('alterar_senha_alterar');
Route::get('/alterar_senha', [App\Http\Controllers\UsuariosController::class, 'alterar_senha'])->name('alterar_senha');

// NOTA FISCAL
Route::get('/home', [App\Http\Controllers\NotaFiscalController::class, 'index'])->name('home');
Route::get('/consultar-nf', [App\Http\Controllers\NotaFiscalController::class, 'index'])->name('consultar_nf');
Route::get('/fornecedores', [App\Http\Controllers\NotaFiscalController::class, 'fornecedores'])->name('fornecedores');
Route::get('/cadastrar-nf', [App\Http\Controllers\NotaFiscalController::class, 'create'])->name('create');
Route::post('/cadastrar-nf', [App\Http\Controllers\NotaFiscalController::class, 'store'])->name('store');
Route::get('/editar', [App\Http\Controllers\NotaFiscalController::class, 'edit'])->name('edit');
Route::post('/editar-nf', [App\Http\Controllers\NotaFiscalController::class, 'status'])->name('status');

Route::middleware(['auth', 'role:fornecedor'])->group(function () {
    Route::get('/notas_fiscais/create', [NotaFiscalController::class, 'create'])->name('notas_fiscais.create');
    Route::post('/notas_fiscais', [NotaFiscalController::class, 'store'])->name('notas_fiscais.store');
});

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/notas_fiscais', [NotaFiscalController::class, 'index'])->name('notas_fiscais.index');
    Route::post('/notas_fiscais/approve/{id}', [NotaFiscalController::class, 'approve'])->name('notas_fiscais.approve');
    Route::post('/notas_fiscais/reject/{id}', [NotaFiscalController::class, 'reject'])->name('notas_fiscais.reject');
});


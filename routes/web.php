<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NoticiaController::class, 'index'])->name('home');

Route::resource('noticias', NoticiaController::class);

Route::post('/noticias/{noticia}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::get('/comentarios/{comentario}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
Route::put('/comentarios/{comentario}', [ComentarioController::class, 'update'])->name('comentarios.update');
Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
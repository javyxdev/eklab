<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Admin\Categoria_ExamensController;

Route::get('', [HomeController::class,'index']);
Route::resource('pacientes', PacienteController::class)->names('admin.pacientes');
Route::resource('categoria_examens', Categoria_ExamensController::class)->names('admin.categoria_examens');

Route::post('ajaxDelete/{id}',[Categoria_ExamensController::class,'ajaxDelete']);





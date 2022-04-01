<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Admin\Categoria_ExamensController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\BarrioController;

Route::get('', [HomeController::class,'index']);

/** Rutas creadas dinamicamente para los mantenimientos con route-resource */
Route::resource('pacientes', PacienteController::class)->names('admin.pacientes');
Route::resource('categoria_examens', Categoria_ExamensController::class)->names('admin.categoria_examens');
Route::resource('municipios',MunicipioController::class)->names('admin.municipios');
Route::resource('barrios',BarrioController::class)->names('admin.barrios');

/** Rutas de Borrados asíncronos en las bandejas de mantenimiento con DataTable */
Route::post('categoriaExamensDelete/{id}',[Categoria_ExamensController::class,'ajaxDelete']);
Route::post('pacientesDelete/{id}',[PacienteController::class,'ajaxDelete']);
Route::post('municipiosDelete/{id}',[MunicipioController::class,'ajaxDelete']);
Route::post('barriosDelete/{id}',[BarrioController::class,'ajaxDelete']);

/** Rutas internas de dropdowns asíncronos dependientes */
Route::get('pacientes/getMunicipiosByDepartamento/{id}',[PacienteController::class,'getMunicipiosByDepartamento']);
Route::get('pacientes/getBarriosByMunicipio/{id}',[PacienteController::class,'getBarriosByMunicipio']);
Route::get('barrios/getMunicipiosByDepartamento/{id}',[BarrioController::class,'getMunicipiosByDepartamento']);






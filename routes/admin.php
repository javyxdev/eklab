<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Admin\Categoria_ExamensController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\BarrioController;
use App\Http\Controllers\Admin\OrdenController;
use App\Http\Controllers\Admin\ExamenController;
use App\Http\Controllers\Admin\ExmHecesController;
use App\Http\Controllers\Admin\ExmOrinaController;
use App\Http\Controllers\Admin\ExmHemogramaController;
use App\Http\Controllers\Admin\ExmQuimicaController;
use App\Http\Controllers\Admin\ExmGenericaController;

Route::get('', [HomeController::class,'index']);

/** Rutas creadas dinamicamente para los mantenimientos con route-resource */
Route::resource('pacientes', PacienteController::class)->names('admin.pacientes');
Route::resource('categoria_examens', Categoria_ExamensController::class)->names('admin.categoria_examens');
Route::resource('municipios',MunicipioController::class)->names('admin.municipios');
Route::resource('barrios',BarrioController::class)->names('admin.barrios');
Route::resource('ordens',OrdenController::class)->names('admin.ordens');
Route::resource('examens',ExamenController::class)->names('admin.examens');
Route::resource('exm_heces_plantillas',ExmHecesController::class)->names('admin.exm_heces_plantillas');
Route::resource('exm_hemograma_plantillas',ExmHemogramaController::class)->names('admin.exm_hemograma_plantillas');
Route::resource('exm_orina_plantillas',ExmOrinaController::class)->names('admin.exm_orina_plantillas');
Route::resource('exm_quimica_plantillas',ExmQuimicaController::class)->names('admin.exm_quimica_plantillas');
Route::resource('exm_generica_plantillas',ExmGenericaController::class)->names('admin.exm_generica_plantillas');

/** Rutas de Borrados asíncronos en las bandejas de mantenimiento con DataTable */
Route::post('categoriaExamensDelete/{id}',[Categoria_ExamensController::class,'ajaxDelete']);
Route::post('pacientesDelete/{id}',[PacienteController::class,'ajaxDelete']);
Route::post('municipiosDelete/{id}',[MunicipioController::class,'ajaxDelete']);
Route::post('barriosDelete/{id}',[BarrioController::class,'ajaxDelete']);
Route::post('examensDelete/{id}',[ExamenController::class,'ajaxDelete']);

/** Rutas internas de dropdowns asíncronos dependientes */
Route::get('pacientes/getMunicipiosByDepartamento/{id}',[PacienteController::class,'getMunicipiosByDepartamento']);
Route::get('pacientes/getBarriosByMunicipio/{id}',[PacienteController::class,'getBarriosByMunicipio']);
Route::get('barrios/getMunicipiosByDepartamento/{id}',[BarrioController::class,'getMunicipiosByDepartamento']);

/** Rutas transaccionales asincronas */
Route::get('ordens/getPacienteById/{id}',[OrdenController::class,'getPacienteById']);
Route::get('ordens/getExamenById/{id}',[OrdenController::class,'getExamenById']);
Route::post('ordens/totalizarOrden',[OrdenController::class,'totalizarOrden']);
Route::post('ordens/procesarOrden',[OrdenController::class,'procesarOrden']);
Route::post('anularOrden/{id}',[OrdenController::class,'anularOrden']);
Route::post('ordens/{id}/finalizarOrden',[OrdenController::class,'finalizarOrden']);







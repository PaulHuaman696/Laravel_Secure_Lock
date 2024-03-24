<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\PersonalLimpiezaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AsistenciaController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Administradores
Route::get('administradores',[AdministradorController::class, 'index']);
Route::get('administradores/{id}',[AdministradorController::class, 'show']);
Route::post('administradores',[AdministradorController::class, 'store']);
Route::patch('administradores/{id}',[AdministradorController::class, 'update']);
Route::delete('administradores/{id}',[AdministradorController::class, 'destroy']);

# Alumnos
Route::get('alumnos',[AlumnoController::class, 'index']);
Route::get('alumnos/{id}',[AlumnoController::class, 'show']);
Route::post('alumnos',[AlumnoController::class, 'store']);
Route::patch('alumnos/{id}',[AlumnoController::class, 'update']);
Route::delete('alumnos/{id}',[AlumnoController::class, 'destroy']);

# Areas
Route::get('areas',[AreaController::class, 'index']);
Route::get('areas/{id}',[AreaController::class, 'show']);
Route::post('areas',[AreaController::class, 'store']);
Route::patch('areas/{id}',[AreaController::class, 'update']);
Route::delete('areas/{id}',[AreaController::class, 'destroy']);

# Asistencias
Route::get('asistencias', [AsistenciaController::class, 'index']);
Route::get('asistencias/{id}', [AsistenciaController::class, 'show']);
Route::post('asistencias', [AsistenciaController::class, 'store']);
Route::patch('asistencias/{id}', [AsistenciaController::class, 'update']);
Route::delete('asistencias/{id}', [AsistenciaController::class, 'destroy']);

# Docentes
Route::get('docentes', [DocenteController::class, 'index']);
Route::get('docentes/{id}', [DocenteController::class, 'show']);
Route::post('docentes', [DocenteController::class, 'store']);
Route::patch('docentes/{id}', [DocenteController::class, 'update']);
Route::delete('docentes/{id}', [DocenteController::class, 'destroy']);

# Cursos
Route::get('cursos', [CursoController::class, 'index']);
Route::get('cursos/{id}', [CursoController::class, 'show']);
Route::post('cursos', [CursoController::class, 'store']);
Route::patch('cursos/{id}', [CursoController::class, 'update']);
Route::delete('cursos/{id}', [CursoController::class, 'destroy']);

# Horarios
Route::get('horarios', [HorarioController::class, 'index']);
Route::get('horarios/{id}', [HorarioController::class, 'show']);
Route::post('horarios', [HorarioController::class, 'store']);
Route::patch('horarios/{id}', [HorarioController::class, 'update']);
Route::delete('horarios/{id}', [HorarioController::class, 'destroy']);

# Matriculas
Route::get('matriculas', [MatriculaController::class, 'index']);
Route::get('matriculas/{id}', [MatriculaController::class, 'show']);
Route::post('matriculas', [MatriculaController::class, 'store']);
Route::patch('matriculas/{id}', [MatriculaController::class, 'update']);
Route::delete('matriculas/{id}', [MatriculaController::class, 'destroy']);

# Personal de Limpieza
Route::get('personal-limpieza', [PersonalLimpiezaController::class, 'index']);
Route::get('personal-limpieza/{id}', [PersonalLimpiezaController::class, 'show']);
Route::post('personal-limpieza', [PersonalLimpiezaController::class, 'store']);
Route::patch('personal-limpieza/{id}', [PersonalLimpiezaController::class, 'update']);
Route::delete('personal-limpieza/{id}', [PersonalLimpiezaController::class, 'destroy']);

# Usuarios
Route::get('usuarios', [UsuarioController::class, 'index']);
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('usuarios', [UsuarioController::class, 'store']);
Route::patch('usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;//crea la referencia al controlador empleado
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

Route::get('/', function () {
    return view('auth.login');
});
/*
Route::get('/empleado', function () {
    return view('empleado.index');
});
 */
/*nos enruta a las view empleado/create.  */
/*
Route::get('/empleado/create',[EmpleadoController::class,'create']);
*/

/*acceder a todas las url así trabajar con todos los método de EmpleadoControllers */
//se delimito con el middleware('auth') a que respete siempre logear
Route::resource('empleado',EmpleadoController::class)->middleware('auth');

//aca hace que el la ruta del login no deje hacer registro ni recordar contraseña
Auth::routes(['register'=>false,'reset'=>false]);

//cuando el user escriba /home lo lleva al crud de empleado
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');


//prefijo middleware
//ver el grupo que pertenece la autenticacion
//cuando se autentique lo redirige a empelado controller a index
Route::group(['middleware'=>'auth'],function ()
 {
    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
});


//Auth::routes();

//

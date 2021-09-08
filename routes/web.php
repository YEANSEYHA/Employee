<?php

use App\Models\Employee;
// New adding line
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/* $router->get('/', function () use ($router) {
    return $router->app->version();
});
 */
Route::get('/',function(){
    return 'API Employee';
});

Route::get('/employees','EmployeeController@index');
Route::post('/employees','EmployeeController@store');
Route::get('/employees/{id}','EmployeeController@show');
Route::put('/employees/{id}','EmployeeController@update');
Route::delete('/employees/{id}','EmployeeController@destroy');

Route::post('/employees/multiple','EmployeeController@multiplecreate');

Route::post('/employees/multiple2','EmployeeController@multiplecreate2');

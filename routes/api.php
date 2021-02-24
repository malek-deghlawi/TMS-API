<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->get('/token/revoke','AuthController@logout');
Route::group(['middleware' => ['cors']], function(){
    Route::post('/login','AuthController@login' );
    Route::post('/register','AuthController@register' );
    Route::post('/tasks/add','TaskController@store' )->middleware('auth:api');
    Route::post('/tasks/addSubTask','TaskController@storeSub' )->middleware('auth:api');
    Route::get('/tasks/list','TaskController@index' )->middleware('auth:api');
    Route::post('/tasks/show','TaskController@show' )->middleware('auth:api');
    Route::post('/tasks/updateflag','TaskController@updateflag' )->middleware('auth:api');
    Route::get('/categories/list','CategorieConroller@index' )->middleware('auth:api');
    Route::get('/user/list','UserConroller@index' )->middleware('auth:api');

});

<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/productos', 'ProductoController');

Route::group(['prefix'=>'productos'], function(){

	Route::apiResource('/{producto}/resenias', 'ReseniaController');

});
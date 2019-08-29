<?php

use Illuminate\Http\Request;

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
    
    Route::get('package',function(){
        $data = \App\Packge::with('PackageType.name')->get();
        return response()->json($data,200);
    });
    
    Route::get('packageAct',function(){
        $data['data'] =   \App\TourPackage::first();
        return response()->json($data,200);
    });
    

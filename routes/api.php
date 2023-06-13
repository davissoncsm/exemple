<?php

use App\Http\Controllers\GetPatientsController;
use App\Http\Controllers\GetPatientByIdController;
use App\Http\Controllers\CreatePatientController;
use App\Http\Controllers\UpdatePatientController;
use App\Http\Controllers\DeletePatientController;
use App\Http\Controllers\GetFilteredPatientController;
use App\Http\Controllers\GetCepController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'patients'], function (){
    Route::get('/filter', GetFilteredPatientController::class);
    Route::get('/', GetPatientsController::class);
    Route::get('/{id}', GetPatientByIdController::class);
    Route::post('/', CreatePatientController::class);
    Route::put('/{id}', UpdatePatientController::class);
    Route::delete('/{id}', DeletePatientController::class);
    Route::post('/search/cep', GetCepController::class);
    Route::post('/import', ImportController::class);

});


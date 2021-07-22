<?php

use App\Http\Controllers\Api\EvaluationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return response()->json(['message' => 'success']);
});

Route::get('/evaluations/{company}', [EvaluationController::class, 'index']);
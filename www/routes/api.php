<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnswerController;

Route::get('questions/{question}/answers', [AnswerController::class, 'index']);
Route::post('questions/{question}/answers', [AnswerController::class, 'store']);
Route::get('questions/{question}/answers/{answer}', [AnswerController::class, 'show']);
Route::put('questions/{question}/answers/{answer}', [AnswerController::class, 'update']);
Route::delete('questions/{question}/answers/{answer}', [AnswerController::class, 'destroy']);

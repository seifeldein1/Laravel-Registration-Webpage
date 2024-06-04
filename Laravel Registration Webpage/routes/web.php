<?php

use App\Http\Controllers\DbController;
use App\Http\Controllers\Api\EmailController;

use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\App;
use App\Models\Rej;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Mail\TestMail;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/{lang}', function ($lang) {
    App::setLocale($lang);
    return view('signup');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/signup', [DbController::class, 'signup']);
//Route::get('/actors/bio', [ActorController::class,'getActorsBornOnDate']);
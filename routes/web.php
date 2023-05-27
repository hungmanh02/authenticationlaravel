<?php

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Auth::routes();
// Route::get('/admin',[AdminController::class,'index']);
Route::prefix('admin')->middleware('auth','verified')->group(function (){
    Route::get('/',[AdminController::class,'index']);



});
Route::get('/email/verify',function(){
    return view('auth.verify');
    })->middleware('auth')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', function( EmailVerificationRequest $request){
    $request->fulfill();
    return redirect('/admin');
})->middleware('auth','signed')->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

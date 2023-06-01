<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Doctors\Auth\ForgotPasswordController;
use App\Http\Controllers\Doctors\Auth\LoginController;
use App\Http\Controllers\Doctors\Auth\ResetPasswordController;
use App\Http\Controllers\Doctors\IndexController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
Route::prefix('admin')->name('admin.')->middleware('auth','verified')->group(function (){
    Route::get('/',[AdminController::class,'index']);
    Route::get('product',function(){
        return "products";
    });
    Route::prefix('posts')->name('posts.')->group(function(){
        Route::get('/',[PostController::class,'index'])->name('index');
        Route::get('/add',[PostController::class,'add'])->name('add');
        Route::get('/show/{id}',[PostController::class,'show'])->name('show');
        Route::get('/edit/{id}',[PostController::class,'edit'])->name('edit');
        Route::get('/delete/{id}',[PostController::class,'index'])->name('delete');
    });



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

Route::prefix('doctors')->name('doctors.')->group(function(){
    Route::get('/',[IndexController::class,'index'])->middleware('auth:doctor');
    Route::get('login',[LoginController::class,'login'])->name('login')->middleware('guest:doctor');
    Route::post('login',[LoginController::class,'postlogin'])->name('login');
    Route::post('/logout',[LoginController::class,'logout'])->middleware('auth:doctor')->name('logout');
    Route::get('forgot-password',[ForgotPasswordController::class,'getForgotPassword'])->name('forgot-password')->middleware('guest:doctor');
    Route::post('forgot-password',[ForgotPasswordController::class,'sendResetLinkEmail'])->middleware('guest:doctor');
    Route::get('reset-password/{token}',[ResetPasswordController::class,'showResetForm'])->name('reset-password');
    Route::post('update-password',[ResetPasswordController::class,'reset'])->name('update-password');
    Route::get('reset-password/{token}',[ResetPassWordController::class,'showResetForm'])->name('reset-password');
    Route::post('update-password',[ResetPassWordController::class,'reset'])->name('update-password');
});

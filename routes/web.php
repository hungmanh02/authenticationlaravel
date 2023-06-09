<?php

use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Doctors\Auth\ForgotPasswordController;
use App\Http\Controllers\Doctors\Auth\LoginController;
use App\Http\Controllers\Doctors\Auth\ResetPasswordController;
use App\Http\Controllers\Doctors\IndexController;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Middleware;
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
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::get('/',[AdminController::class,'index']);
    // users
    Route::prefix('users')->name('users.')->middleware('can:users')->group(function(){
        Route::get('/',[UsersController::class,'index'])->name('index');
        Route::get('/add',[UsersController::class,'add'])->name('add')->can('create',User::class);
        Route::post('/add',[UsersController::class,'postAdd'])->name('add')->can('create',User::class);
        Route::get('/show/{user}',[UsersController::class,'show'])->name('show');
        Route::get('/edit/{user}',[UsersController::class,'edit'])->name('edit')->can('users.edit');
        Route::post('/edit/{user}',[UsersController::class,'postEdit'])->name('update')->can('users.edit');
        Route::get('/delete/{user}',[UsersController::class,'delete'])->name('delete')->can('users.delete');
    });
    //groups
    Route::prefix('groups')->name('groups.')->middleware('can:groups')->group(function(){
        Route::get('/',[GroupController::class,'index'])->name('index');
        Route::get('/add',[GroupController::class,'add'])->name('add');
        Route::post('/add',[GroupController::class,'postadd'])->name('add');
        Route::get('/show/{group}',[GroupController::class,'show'])->name('show');
        Route::get('/edit/{group}',[GroupController::class,'edit'])->name('edit');
        Route::post('/edit/{group}',[GroupController::class,'postEdit'])->name('update');
        Route::get('/delete/{group}',[GroupController::class,'delete'])->name('delete');
        Route::get('/permission/{group}',[GroupController::class,'permission'])->name('permission');
        Route::post('/permission/{group}',[GroupController::class,'postPermission'])->name('permission');
    });
    //posts
    Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(function(){
        Route::get('/',[PostController::class,'index'])->name('index');
        Route::get('/add',[PostController::class,'add'])->name('add')->can('create',Post::class);//->middleware('can:posts.add')
        Route::post('/add',[PostController::class,'postAdd'])->name('add')->can('create',Post::class);//->middleware('can:posts.add')
        Route::get('/show/{id}',[PostController::class,'show'])->name('show');
        Route::get('/edit/{post}',[PostController::class,'edit'])->name('edit')->can('posts.edit');//->middleware('can:posts.update,post')
        Route::post('/edit/{post}',[PostController::class,'postEdit'])->name('edit')->can('posts.edit');//->middleware('can:posts.update,post')
        Route::get('/delete/{post}',[PostController::class,'delete'])->name('delete')->can('posts.delete');
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

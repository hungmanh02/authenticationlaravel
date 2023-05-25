<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function validationErrorMessages()
    {
        return [
            'token.required' =>'Token không được để trống.',
            'email.required' =>'Email không được để trống.',
            'email.email'=>'Email phải đúng định dạng.',
            'password.required'=>'Mật khẩu không được để trống.',
            'password.confirmed'=>'Mật khẩu không khớp.',
            'password.min'=> 'Mật khẩu không được nhỏ hơn :min ký tự.',
        ];
    }
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }
}

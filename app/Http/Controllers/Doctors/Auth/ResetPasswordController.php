<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPassWordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::DOCTOR;

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
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('doctors.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        // dd($request);
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($doctor, $password) {
                $this->resetPassword($doctor, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    public function broker()
    {
        return Password::broker('doctors');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('doctor');
    }
}

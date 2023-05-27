<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        if(Auth::guard('doctor')->check()){
            $dataInfo=Auth::guard('doctor')->user();
            // dd($dataInfo);
        }
        return view('doctors.auth.login');
    }
    public function postLogin(Request $request){
        $dataLogin=$request->except('_token');
        // dd($dataLogin);
        if(isDoctorActive($dataLogin["email"])){
            $checkLogin=Auth::guard('doctor')->attempt($dataLogin);
            if($checkLogin){

                return redirect(RouteServiceProvider::DOCTOR);
            }
            return back()->with('msg','Email hoặc mật khẩu không đúng');
        }
        return back()->with('msg','Tài khoản chưa được kích hoạt');

    }
}

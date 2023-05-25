<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo= route('register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation'=>['required','same:password'],
        ],
        [
            'required'=>':attribute bắt buộc phải nhập',
            'string' =>':attribute phải là ký tự chữ',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'email' => ':attribute không đúng định dạng email',
            'unique' =>':attribute đã được sử dụng',
            'same' =>':attribute phải giống mật khẩu',
            'integer' =>':attribute không đúng định dạng số điện thoại',
        ],
        [
            'name'=>'Họ và Tên',
            'email'=>'Địa chỉ email',
            'phone'=>'Số điện thoại',
            'password'=>'Mật khẩu',
            'password_comfirmation'=>'Nhập lại mật khẩu',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath())->with('msg','Đăng ký tài khoản thành công.');
    }
}

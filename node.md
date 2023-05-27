# new project
- composer create-project laravel/laravel:^9.0 authenticationlaravel
#Modules 6 Authentication
* Cấu hình và cài đặt Authentication Laravel
- model, view, controller được tạo sẵn trong laravel khi cài đặt Auth
- mặc định 1 Eloquent Model app\User.php được tạo ra , được sử dụng mặc định trong file cấu hình config/auth.php
- laravel cũng tạo ra cái controller như sau:
-- RegisterController: Quản lý đăng ký thành viên mới
-- LoginController: Quản lý việc đăng nhập các thành viên
-- Forgot PasswordController: gửi mail với đường link  sử dụng để reset pasword.
-- ResetPasswordController: kiểm soát việc reset lại mật khẩu  với các logic do lập trình viên thêm vào.
- laravel sinh ra các view trong resources/views/auth
* Cài đặt Laravel Authentication
- composer require laravel/ui
- php artisan ui bootstrap tích hợp bootstrap cho auth
- chạy lệnh npm install và npm run dev phải cài nodejs mới chạy được npm
- cài auth php artisan ui:auth
- cài đặt migration 
* Thiết lập Path Controller Trong Authentication
* Thiết kế giao diện lại việt hóa các tên
- việt hóa các validation và các alert
- khi đăng nhập không thành công
1. sửa ở phần lang/en
    'failed' => 'Thông tin đăng nhập không hợp lệ.',
    'password' => 'Mật khẩu được cung cấp không chính xác.',
    'throttle' => 'Quá nhiều lần thử đăng nhập. Vui lòng thử lại sau :seconds giây.',
2. ghi đè lại fail đăng nhập
- sử dụng trong Auth loginController
- use Illuminate\Validation\ValidationException;
- protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không hợp lệ.'],
        ]);
    }
- đăng nhập bằng số điện thoại.
-- tự thêm tay cột sđt trong table users.
-- public function username(){
        return 'phone'; 
    }
-- sủa lại validation và views login lại thành đăng nhập bằng số điện thoại
* đăng nhập bằng nhiều cách, số điện thoại hoặc email
-- protected function credentials(Request $request)
    {
        if(filter_var($request->phone,FILTER_VALIDATE_EMAIL)){
            $fielDb='email';
        }else{

            $fielDb='phone';
        }
        $dataArr= [
            $fielDb =>$request->phone,
            'password' => $request->password
        ];
        return $dataArr;
        // return $request->only($username, 'password');
    }
* sửa form đăng ký, validation form 
- quên mật khẩu
-- cấu hình mail trong .env
-- để cấu hình thì sử dụng gmail lấy mật khẩu ứng dụng trong xác minh 2 bước trong bảo mật của gmail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=domanh462@gmail.com
MAIL_PASSWORD=jnnjilhhxniwwvdy
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=domanh462@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

* thiết lập xác nhận mật khẩu và gửi email thông báo (Confirmed pasword)
-- xử lý gửi mail khi confirm thành công
-- sử dụng mail raw laravel
 public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        // xử lý gửi mail khi confirm thành công

        // dd($request->email);
        $email=Auth::user()->email;
        $name=Auth::user()->name;
        $content='Chào '.$name.'<br/>';
        $content.='Bạn vừa xác nhận mật khẩu thành công.';

          Mail::raw('', function (Message $message) use ($email){
            $message->to($email)
            ->subject('Xác nhận mật khẩu thành công');
        });

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
* truy xuất thông tin Middleware các thao tác khác.
- middleware:
* xây dựng chức năng xác thực email khi đăng ký tài khoản
- trong Model User implements MustVerifyEmail
- use thêm Notifiable
- tạo route 
#Modules 7 Multiple Authentication trong Laravel
* tạo migrattions-Seed-Model-Custom Guards
- tạo migration create_doctors_table
- seed database
* viết chức năng đăng nhập
- 






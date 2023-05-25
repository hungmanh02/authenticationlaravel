# new project
- composer create-project laravel/laravel:^9.0 authenticationlaravel
#Modules 6
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




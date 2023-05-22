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


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
* làm việc với middleware trong Custom Guard
* viết chức năng đăng xuất trong Custom Guard
* viết chức năng quên mật khẩu trong Custom Guard P1
# Modules 8 Authozication
- user chỉ được sửa bài đăng của user đó đăng
* Gates giống như route kết nối vơi controller, Police kết nối các logic với model
* Định nghĩa gate và policy
* Tạo 1 controller PostController
- viết route cho post
- xử lý gate
- tạo policy php artisan make:policy PostPolicy
* kiểm tra phân quyền gate và policy
- kiểm tra quyền của 1 user nào đó
- kiểm tra quyền bằng middleware
- thay can cho middleware 
-- Route::get('/edit/{post}',[PostController::class,'edit'])->name('edit')->middleware('can:posts.update,post'); 
-- Route::post('/edit/{post}',[PostController::class,'edit'])->name('edit')->can('posts.update','post); 
* phân tích :
1. Danh sách modules:
- Quản lý người dùng
- Quản lý người dùng người dùng
- Quản lý bài viết
2. Phân quyền
- tạo 1 nhóm người dùng => phân quyền cho nhóm
- thêm user cho nhóm => user có phần trong nhóm đó
- Các quyền :
01: Module bài viết

 + Xem danh sách bài viết
 + Thêm bài viết
 + Sửa bài viết: Bài viết của ai thì sửa của người đó
 + Xóa bài viết: Bài viết của ai thì xóa người đó

02: Module nhóm người dùng
 + Xem danh sách nhóm
 + Thêm nhóm
 + Sửa nhóm
 + Xóa nhóm
 + Phân quyền

03: Module người dùng
 + Xem danh sách người dùng
 + Thêm người dùng
 + Sửa người dùng
 + Xóa người dùng
 + Phân quyền 

* thiết kế database :
- tạo dữ liệu giả cho các table
- thiết kế giao diện dashboard
- list users
- thêm users
- cập nhật, xóa users

* groups
- danh sách groups
- cột phân quyền và CRUD trong groups
- thiết lập phân quyền
- tạo 1 table permission rieng để click
- insert table modules để tạo danh sách permission bằng db:seed
- tạo model cho modules
- tại controller tạo 1 mảng role
- viết function checkbox ô phân quyền đã được chọn
- thiết lập phân quyền
* post
 1. Thiết lập Gate: cho phép truy cập vaog Controller
- 
 2. Thiết lập Policy:Ứng vơi mỗi model
- 





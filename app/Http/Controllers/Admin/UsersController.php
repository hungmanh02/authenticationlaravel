<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        $lists=User::all();
        return view('admin.users.list',compact('lists'));
    }
    public function show(User $user){
        return "Chi tiết bài viết".$user;
    }
    public function add(){
        $groups=Group::all(['id','name']);
        return view('admin.users.add', compact('groups'));
    }
    public function postAdd(Request $request){
        $request->validate(
            [
                    'name' =>'required|max:255',
                    'phone' =>'required|max:10',
                    'email' => 'required|email|unique:users,email',
                    'password'=>'required|min:6',
                    'group_id' =>['required','integer',function($attribute,$value,$fail){
                        if($value==0){
                        $fail('Vui lòng chọn nhóm');
                    }
                    }
                    ]
                 ]
            ,[
                'name.required' => 'Tên không được để trống',
                'email.required' =>'Email không được để trống',
                'email.unique' =>'Email đã tồn tại',
                'password.required' =>'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu không được nhỏ hơn :min ký tự',
                'group_id.integer' =>'Nhóm phải là số ',
                'name.max' =>'Tên không được quá :max ký tự',
                'phone.required'=>'Số điện thoại không được để trống',
                'phone.max'=>'Số điện thoại không quá :max ký tự',
            ]
        );

        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->group_id=$request->group_id;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.users.index')->with('msg','Thêm người dùng thành công');
    }
    public function edit(User $user){
        // $user=User::find(2);
        // if(Gate::forUser($user)->allows('users.update',$user)){
        //     return 'Cho phép thêm bài viết ';

        // }
        // if(Gate::forUser($user)->denies('users.update',$user)){
        //     return 'Không cho phép thêm bài viết ';

        // }
        // if(Gate::allows('users.update',$user)){
        //     return 'Cho phép sửa bài viết '.$user->id;
        // }
        // if(Gate::denies('users.update',$user)){
        //     return 'Không cho phép sửa bài viết '.$user->id;
        // }

        $groups=Group::all(['id','name']);
        return view('admin.users.edit',compact('user','groups'));
    }

    public function postEdit(User $user,Request $request){
        $request->validate(
            [
                    'name' =>'required|max:255',
                    'phone' =>'required|max:10',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                    'group_id' =>['required','integer',function($attribute,$value,$fail){
                        if($value==0){
                        $fail('Vui lòng chọn nhóm');
                    }
                    }
                    ]
                 ]
            ,[
                'name.required' => 'Tên không được để trống',
                'email.required' =>'Email không được để trống',
                'email.unique' =>'Email đã tồn tại',
                'group_id.integer' =>'Nhóm phải là số ',
                'name.max' =>'Tên không được quá :max ký tự',
                'phone.required'=>'Số điện thoại không được để trống',
                'phone.max'=>'Số điện thoại không quá :max ký tự',
            ]
        );
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->group_id=$request->group_id;
        if(!empty($request->password)){
            $user->password=Hash::make($request->password);
        }
        // $user->password=$user->password;
        $user->save();
        return back()->with('msg','Cập nhật người dùng thành công');

    }
    public function delete(User $user){
        if(Auth::user()->id!== $user->id){
            //xử lý xóa
            User::destroy($user->id);
            return redirect()->route('admin.users.index')->with('msg','Xóa thành công người dùng !');
        }
        return redirect()->route('admin.users.index')->with('msg','Bạn không thể xóa tài khoản này !');
    }
}

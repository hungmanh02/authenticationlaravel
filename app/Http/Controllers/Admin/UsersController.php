<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        // $users=$request->all();
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'group_id'=>$request->group_id,
            'password'=>Hash::make($request->password),
            'created_at'=>$time->format('Y-m-d H:i:s'),
            'updated_at'=>$time->format('Y-m-d H:i:s'),
        ]);
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
        // dd($user);
        $groups=Group::all(['id','name']);
        return view('admin.users.edit',compact('user','groups'));
    }

    public function postEdit(User $user){
        // return view('admin.users.add');
    }
    public function delete(User $user){
        return $user;
    }
}

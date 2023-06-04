<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        return view('admin.users.add');
    }
    public function postAdd(){
        // return view('admin.users.add');
    }
    public function edit(User $user){
        // $user=User::find(2);
        // if(Gate::forUser($user)->allows('users.update',$user)){
        //     return 'Cho phép thêm bài viết ';

        // }
        // if(Gate::forUser($user)->denies('users.update',$user)){
        //     return 'Không cho phép thêm bài viết ';

        // }
        if(Gate::allows('users.update',$user)){
            return 'Cho phép sửa bài viết '.$user->id;
        }
        if(Gate::denies('users.update',$user)){
            return 'Không cho phép sửa bài viết '.$user->id;
        }
    }

    public function postEdit(User $user){
        // return view('admin.users.add');
    }
    public function delete(User $user){
        return $user;
    }
}

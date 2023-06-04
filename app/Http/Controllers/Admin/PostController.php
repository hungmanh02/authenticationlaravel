<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(){
        return view('admin.posts.list');
    }
    public function show(Post $post){
        return "Chi tiết bài viết".$post;
    }
    public function add(){
        $user=User::find(2);
        if(Gate::forUser($user)->allows('posts.add')){
            return 'Có quyền thêm bài viết';
        }

        // xứ lý logic cho phân quyền
        // if(Gate::allows('posts.add')){
        //     return 'Có quyền thêm bài viết';
        // }
        // if(Gate::denies('posts.add')){
        //     return 'Không có quyền thêm bài viết';
        // }
        // return "Thêm bài viết";
    }
    public function postAdd(){

    }
    public function postEdit(Post $post){
        return $post;
    }
    public function edit(Post $post){
        // $user=User::find(2);
        // if(Gate::forUser($user)->allows('posts.update',$post)){
        //     return 'Cho phép thêm bài viết ';

        // }
        // if(Gate::forUser($user)->denies('posts.update',$post)){
        //     return 'Không cho phép thêm bài viết ';

        // }
        if(Gate::allows('posts.update',$post)){
            return 'Cho phép sửa bài viết '.$post->id;
        }
        if(Gate::denies('posts.update',$post)){
            return 'Không cho phép sửa bài viết '.$post->id;
        }
    }
    public function delete($id){
        return $id;
    }
}

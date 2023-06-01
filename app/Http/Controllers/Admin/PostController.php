<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(){
        return '<h2>post</h2>';
    }
    public function show($id){
        return "Chi tiết bài viết".$id;
    }
    public function add(){
        // xứ lý logic cho phân quyền
        if(Gate::allows('posts.add')){
            return 'Có quyền thêm bài viết';
        }
        if(Gate::denies('posts.add')){
            return 'Không có quyền thêm bài viết';
        }
        // return "Thêm bài viết";
    }
    public function edit($id){
        $post=Post::find($id);
        if(Gate::allows('posts.update',$post)){
            return 'Cho phép sửa bài viết '.$id;
        }
        if(Gate::denies('posts.update',$post)){
            return 'Không cho phép sửa bài viết '.$id;
        }
    }
    public function delete($id){
        return $id;
    }
}

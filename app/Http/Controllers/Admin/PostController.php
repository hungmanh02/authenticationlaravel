<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(){
        $lists=Post::all();
        return view('admin.posts.list',compact('lists'));
    }
    public function show(Post $post){
        return "Chi tiết bài viết".$post;
    }
    public function add(){
        return View('admin.posts.add');
    }
    public function postAdd(Post $post){
        return $post;
    }
    public function edit(Post $post){

            return View('admin.posts.edit',compact('post'));
    }
    public function postEdit(Post $post,Request $request){

    }

    public function delete($id){
        return $id;
    }
}

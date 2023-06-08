<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function postAdd(Request $request){
        $request->validate(
            [
                    'title' =>'required|max:100',
                    'description' =>'required|max:150',
                    'user_id' => 'integer',
                    'content'=>'required',
                 ]
            ,[
                'title.required' => 'Tiêu đề bài viết không được để trống',
                'title.max' =>'Tiêu đề bài viết không được quá :max ký tự',
                'description.required' =>'Diễn giải bài viết không được để trống',
                'description.max'=>'Diễn giải bài viết không quá :max ký tự',
                'content.required'=>'Nội dung bài viết không được để trống',
            ]
        );
        $post= new Post();
        $post->title=$request->title;
        $post->description=$request->description;
        $post->content=$request->content;
        $post->user_id=Auth::id();
        $post->save();
         return redirect()->route('admin.posts.index')->with('msg','Thêm bài viết thành công !');
    }
    public function edit(Post $post){
            $users=User::all(['name','id']);
            return View('admin.posts.edit',compact('post','users'));
    }
    public function postEdit(Post $post,Request $request){
        $request->validate(
            [
                    'title' =>'required|max:100',
                    'description' =>'required|max:150',
                    'content'=>'required',
                    'user_id' =>['required',function($attribute,$value,$fail){
                        if($value==0){
                        $fail('Vui lòng chọn người viết bài');
                    }
                    }
                    ]
                 ]
            ,[
                'title.required' => 'Tiêu đề bài viết không được để trống',
                'user_id.required' => 'Người đăng bài viết không được để trống',
                'title.max' =>'Tiêu đề bài viết không được quá :max ký tự',
                'description.required' =>'Diễn giải bài viết không được để trống',
                'description.max'=>'Diễn giải bài viết không quá :max ký tự',
                'content.required'=>'Nội dung bài viết không được để trống',
            ]
        );
        $post->title=$request->title;
        $post->description=$request->description;
        $post->content=$request->content;
        $post->user_id=$request->user_id;
        $post->save();
         return back()->with('msg','Cập nhật bài viết thành công !');
    }

    public function delete(Post $post){
        Post::destroy($post->id);
        return redirect()->route('admin.posts.index')->with('msg','Xóa thành công bài viết !');
    }
}

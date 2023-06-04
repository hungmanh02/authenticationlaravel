<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    public function index(){
        return "index";
    }
    public function add(){
        return "thêm nhóm người dùng";
    }
    public function show(Group $group){
        return "Chi tiết bài viết".$group;
    }
    public function postAdd(){

    }
    public function postEdit(Group $group){
        return $group;
    }
    public function edit(Group $group){
        // $user=User::find(2);
        // if(Gate::forUser($user)->allows('groups.update',$group)){
        //     return 'Cho phép thêm bài viết ';

        // }
        // if(Gate::forUser($user)->denies('groups.update',$group)){
        //     return 'Không cho phép thêm bài viết ';

        // }
        if(Gate::allows('groups.update',$group)){
            return 'Cho phép sửa bài viết '.$group->id;
        }
        if(Gate::denies('groups.update',$group)){
            return 'Không cho phép sửa bài viết '.$group->id;
        }
    }
    public function delete(Group $group){
        return $group;
    }
}

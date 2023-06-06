<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    public function index(){
        $lists=Group::all();
        return view('admin.groups.list',compact('lists'));
    }
    public function show(group $group){
        return "Chi tiết bài viết".$group;

    }
    public function add(){
        return view('admin.groups.add');
    }
    public function postAdd(Request $request){
        $request->validate(
            [
                'name' =>'required|max:255|unique:groups,name',
             ]
        ,[
            'name.required' => 'Tên không được để trống',
            'name.max'=>'Tên không được quá :max ký tự',
            'name.unique'=>'Tên đã tồn tại',
        ]
        );
        $group= new Group();
        $group->name=$request->name;
        $group->user_id=Auth::user()->id;
        $group->save();
        return redirect()->route('admin.groups.index')->with('msg','Thêm nhóm người dùng thành công');
    }
    public function edit(Group $group){
        // $group=group::find(2);
        // if(Gate::forgroup($group)->allows('groups.update',$group)){
        //     return 'Cho phép thêm bài viết ';

        // }
        // if(Gate::forgroup($group)->denies('groups.update',$group)){
        //     return 'Không cho phép thêm bài viết ';

        // }
        // if(Gate::allows('groups.update',$group)){
        //     return 'Cho phép sửa bài viết '.$group->id;
        // }
        // if(Gate::denies('groups.update',$group)){
        //     return 'Không cho phép sửa bài viết '.$group->id;
        // }

        // $groups=Group::all(['id','name']);
        return view('admin.groups.edit',compact('group'));
    }

    public function postEdit(Group $group,Request $request){
        $request->validate(
            [
                    'name' =>'required|max:255|unique:groups,name,'.$group->id,
                 ]
            ,[
                'name.required' => 'Tên không được để trống',
                'name.max'=>'Tên không được quá :max ký tự',
                'name.unique'=>'Tên đã tồn tại',
            ]
        );
        $group->name=$request->name;
        $group->save();
        return back()->with('msg','Cập nhật nhóm người dùng thành công');

    }
    public function delete(Group $group){
            $userCount=$group->users()->count();
            if($userCount==0){
                Group::destroy($group->id);
                return redirect()->route('admin.groups.index')->with('msg','Xóa thành công nhóm người dùng !');
            }

        return redirect()->route('admin.groups.index')->with('msg','Trong nhóm vẫn còn '.$userCount.' người dùng !');
    }
}

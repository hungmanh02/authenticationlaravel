@extends('admin.master')
@section('title','Phân quyền nhóm: '.$group->name)
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Phân quyền nhóm: {{$group->name}}</h1>
</div>
@if ($errors->any())
<div class="alert alert-danger text-center">
    Vui lòng kiểm tra dữ liệu nhập vào
</div>
@endif
@if(!empty(session('msg')))
        <div class="alert alert-success text-center">
           {{session('msg')}}
        </div>
    @endif
<form action="{{route('admin.groups.permission',$group)}}" method="POST">
    @csrf
    <table class="table table-borderd">
        <thead>
            <tr>
                <th width="20%">Module</th>
                <th>Quyền</th>
            </tr>
        </thead>
        <tbody>
            @if ($modules->count()>0)
                @foreach ($modules as $module)
                <tr>
                    <td>{{$module->title}}</td>
                    <td>
                        <div class="row">
                            @if (!empty($roleListArr))
                                @foreach ($roleListArr as $roleName =>$roleLabel)
                                <div class="col-2">
                                    <label for="role_{{$module->name}}_{{$roleName}}">
                                        <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_{{$roleName}}" value="{{$roleName}}"
                                            {{isRoleArrActiveBox($roleArr,$module->name,$roleName)? 'checked':false}}
                                        />
                                        {{$roleLabel}}
                                    </label>
                                </div>
                                @endforeach
                            @endif
                            @if ($module->name=='groups')
                            <div class="col-2">
                                <label for="role_{{$module->name}}_permission">
                                    <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_permission" value="permission"
                                    {{isRoleArrActiveBox($roleArr,$module->name,'permission')? 'checked':false}}
                                    />
                                    Phân quyền
                                </label>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Phân quyền</button>
        <a href="{{route('admin.groups.index')}}" class="btn btn-danger">Hủy</a>
    </div>
</form>
@endsection

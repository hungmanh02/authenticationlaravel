@extends('admin.master')
@section('title','Danh sách người dùng')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>
    </div>
    @if(!empty(session('msg')))
        <div class="alert alert-success text-center">
           {{session('msg')}}
        </div>
    @endif
    <div>
        @can('create','App\\Models\User')
        <p>
            <a href="{{route('admin.users.add')}}" class="btn btn-primary">Thêm mới</a>
        </p>
        @endcan
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th >Name</th>
            <th >Email</th>
            <th >Phone</th>
            <th >Nhóm</th>
            @can('users.edit')
            <th width="5%" >Sửa</th>
            @endcan
            @can('users.delete')
            <th width="5%" >Xóa</th>
            @endcan
          </tr>
        </thead>
        <tbody>
            @if ($lists->count()>0)
                @foreach ($lists as $key=>$list)
                <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$list->name}}</td>
                    <td>{{$list->email}}</td>
                    <td>{{$list->phone}}</td>
                    <td>{{$list->groups->name}}</td>
                    @can('users.edit')
                    <td><a href="{{route('admin.users.edit',$list->id)}}" class="btn btn-warning">Sửa</a></td>
                    @endcan
                    @can('users.delete')
                    @if(Auth::user()->id!==$list->id)
                    <td><a href="{{route('admin.users.delete',$list->id)}}" onclick="return confirm('Bạn có chắc chắn ?')" class="btn btn-danger">Xóa</a></td>
                    @endif
                    @endcan
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection

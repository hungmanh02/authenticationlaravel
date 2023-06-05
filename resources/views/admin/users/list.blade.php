@extends('admin.master')
@section('title','Danh sách người dùng')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>
    </div>
    @if(!empty(session('msg')))
    {{session('msg')}}
    @endif
    <div>
        <p>
            <a href="{{route('admin.users.add')}}" class="btn btn-primary">Thêm mới</a>
        </p>
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th >Name</th>
            <th >Email</th>
            <th >Phone</th>
            <th >Nhóm</th>
            <th width="5%" >Sửa</th>
            <th width="5%" >Xóa</th>
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
                    <td><a href="{{route('admin.users.edit',$list->id)}}" class="btn btn-warning">Sửa</a></td>
                    <td><a href="#" class="btn btn-danger">Xóa</a></td>
                  </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection

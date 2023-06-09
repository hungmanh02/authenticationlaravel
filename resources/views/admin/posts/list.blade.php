@extends('admin.master')
@section('title','Danh sách bài viết')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>
    </div>
    @if(!empty(session('msg')))
        <div class="alert alert-success text-center">
           {{session('msg')}}
        </div>
    @endif
    @if(!empty(session('fail')))
        <div class="alert alert-success text-center">
           {{session('fail')}}
        </div>
    @endif
    <div>
        @can('create','App\Models\Post')
            <p>
                <a href="{{route('admin.posts.add')}}" class="btn btn-primary">Thêm mới</a>
            </p>
        @endcan
    </div>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th >title</th>
            <th >description</th>
            <th >Người viết bài</th>
            @can('posts.edit')
            <th width="5%" >Sửa</th>
            @endcan
            @can('posts.delete')
            <th width="5%" >Xóa</th>
            @endcan
          </tr>
        </thead>
        <tbody>
            @if ($lists->count()>0)
                @foreach ($lists as $key=>$list)
                <tr>
                    <th scope="row">{{$key +1}}</th>
                    <td>{{$list->title}}</td>
                    <td>{!!$list->description!!}</td>
                    <td>{{$list->user->name}}</td>
                    @can('posts.edit')
                    <td><a href="{{route('admin.posts.edit',$list->id)}}" class="btn btn-warning">Sửa</a></td>
                    @endcan
                    @can('posts.delete')
                    <td><a href="{{route('admin.posts.delete',$list->id)}}" onclick="return confirm('Bạn có chắc chắn ?')" class="btn btn-danger">Xóa</a></td>
                    @endcan
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
@endsection

@extends('admin.master')
@section('title','Thêm bài viết')
@section('content')
@if ($errors->any())
<div class="alert alert-danger text-center">
    Vui lòng kiểm tra dữ liệu nhập vào
</div>
@endif
<form action="{{route('admin.posts.add')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="">Tiêu đề bài viết</label>
                <input type="text" name="title" value="{{ old('title')}}" class="form-control title @error('title') is-invalid @enderror" id="" placeholder="Tiêu đề bài viết...">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="">Diễn giải bài viết</label>
                <textarea name="description" class="form-control ckeditor @error('description') is-invalid @enderror"
                 placeholder="Diễn giải bài viết ...">
                 {{ old('description')}}
                </textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="">Nội dung bài viết</label>
                <textarea name="content" class="form-control  ckeditor @error('content') is-invalid @enderror"
                 placeholder="Nội dung bài viết ...">
                 {{ old('content')}}
                </textarea>
                @error('content')
                 <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.posts.index')}}" class="btn btn-danger">Hủy</a>
        </div>

    </div>

</form>
@endsection
@section('stylesheets')

    <style>
        img {
            max-width: 100%;
            height: auto !important;
        }
        #holder img{
            width: 100% !important;
        }
        .list-categories{
            max-height: 200px;
            overflow: auto;
        }
    </style>
@endsection

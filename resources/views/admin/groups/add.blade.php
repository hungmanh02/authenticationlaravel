@extends('admin.master')
@section('title','Thêm nhóm người dùng')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm nhóm người dùng</h1>
</div>
@if ($errors->any())
<div class="alert alert-danger text-center">
    Vui lòng kiểm tra dữ liệu nhập vào
</div>
@endif
<form action="{{route('admin.groups.add')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" value="{{ old('name')}}" class="form-control title @error('name') is-invalid @enderror" id="" placeholder="Tên...">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.groups.index')}}" class="btn btn-danger">Hủy</a>
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

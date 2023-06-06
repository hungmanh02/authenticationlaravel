@extends('admin.master')
@section('title','Cập nhật người dùng')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sửa người dùng</h1>
</div>
@if ($errors->any())
<div class="alert alert-danger text-center">
    Vui lòng kiểm tra dữ liệu nhập vào
</div>
@endif
@if(!empty(session('msg')))
        <div class="alert alert-success text-center">
            Cập nhật người dùng thành công
        </div>
    @endif
<form action="{{route('admin.users.update',$user->id)}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" value="{{ old('name') ?? $user->name}}" class="form-control title @error('name') is-invalid @enderror" id="" placeholder="Tên...">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ old('email') ?? $user->email}}" class="form-control email @error('email') is-invalid @enderror" id="" placeholder="Email...">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" value="{{old('phone') ?? $user->phone}}" class="form-control @error('phone') is-invalid @enderror" id="" placeholder="Số điện thoại...">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Mật khẩu (Không nhập nếu không đổi)</label>
                <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" id="" placeholder="Nhập mật khẩu...">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Chọn nhóm</label>
                <select name="group_id" id="" class="form-control @error('group_id') is-invalid @enderror">
                    <option value="0">Chọn nhóm</option>
                    @if (count($groups)>0)
                        @foreach ($groups as $group)
                            <option value="{{$group->id}}" {{ old('group_id')==$group->id || $user->group_id ==$group->id ? 'selected':false;}}>{{$group->name}}</option>
                        @endforeach
                    @endif
                </select>
                @error('group_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        {{-- <div class="col-12">
            <div class="mb-3">
                <div class="row  {{$errors->has('thumbnail')? 'align-items-center':'align-items-end'}}">
                    <div class="col-7">
                        <label for="">Ảnh đại diện</label>
                        <input type="text" id="thumbnail"  readonly name="thumbnail" value="{{old('thumbnail')}}" class="form-control {{$errors->has('thumbnail')? 'is-invalid':''}}" id=""
                        placeholder="Ảnh đại diện...">
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2 d-grid">
                        <button type="button"  class="btn btn-primary" id="lfm" data-input="thumbnail"
                        data-preview="holder">
                            <i class="fa fa-save"></i> Chọn ảnh
                        </button>
                    </div>
                    <div class="col-3">
                        <div id="holder">
                            @if (old('thumbnail'))
                            <img src="{{old('thumbnail')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
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

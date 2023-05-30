@extends('doctors.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Khu vực dành cho bác sĩ</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Đã có lỗi xảy ra. Vui lòng kiểm tra dữ liệu bên dưới
                        </div>
                    @endif
                    @if (session('msg'))
                        <p class="alert alert-danger text-center">
                            {{session('msg')}}
                        </p>
                    @endif
                    <form method="POST" action="{{ route('doctors.login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">Tên đăng nhập</label>

                            <div class="col-md-6">
                                <input id="text" placeholder="Email hoặc số điện thoại ..." type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" placeholder="Mật khẩu ..." type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Ghi nhớ mật khẩu
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Đăng nhập
                                </button>

                                @if (Route::has('doctors.forgot-password'))
                                    <a class="btn btn-link" href="{{ route('doctors.forgot-password') }}">
                                        Quên mật khẩu
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

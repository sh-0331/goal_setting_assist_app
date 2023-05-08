@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;<a href="{{ route('mypage.index') }}">My page</a></div>
    <div>&gt;パスワード編集</div>
</div>

@if(session('flash_message'))
    <div class="flash_message bg-danger text-center py-3 mb-1">
        {{ session('flash_message') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="mt-3 mb-3">パスワードの編集</h1>
            <hr>

            <form action="{{ route('mypage.update_password') }}" method="post">
                @csrf
                @method('PUT')
                <!-- 新しいパスワード -->
                <div class="form-group">
                    <label for="password" class="form-label">新しいパスワード</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" value="{{ old('password') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <!-- 確認用パスワード -->
                <div class="form-group">
                    <label for="password_confirm" class="form-label">確認用パスワード</label>
                    <input type="password" id="password_confirm" name="password_confirmation" class="form-control" required autocomplete="new-password">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mt-3" name="update">パスワード更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
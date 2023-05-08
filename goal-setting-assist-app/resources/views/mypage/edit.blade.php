@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;<a href="{{ route('mypage.index') }}">My page</a></div>
    <div>&gt;ユーザー情報編集</div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="mt-3 mb-3">会員情報の編集</h1>
            <hr>

            <form action="{{ route('mypage.update', compact('user')) }}" method="post">
                @csrf
                @method('PUT')
                <!-- 氏名 -->
                <div class="form-group">
                    <label for="user_name" class="form-label">氏名</label>
                    <input type="text" id="user_name" name="name" class="form-control" value="{{$user->name}}" required>
                </div>
                <!-- メールアドレス -->
                <div class="form-group">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" required>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mt-3 w-25" name="register">保存</button>
                </div>
            </form>
            <div class="d-flex justify-content-start">
                <a href="{{ route('mypage.edit_password') }}">パスワードの変更はこちら</a>
            </div>
        </div>
    </div>
</div>
@endsection
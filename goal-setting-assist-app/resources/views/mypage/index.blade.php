@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;My page</div>
</div>

<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h1>マイページ</h1>

        <hr>
        <!-- ユーザー情報 -->
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">会員情報の編集</label>
                            <p>アカウント情報の編集</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('mypage.edit') }}"><i class="fas fa-chevron-right fa-2x"></i></a>
                </div>
            </div>
        </div>

        <hr>
        <!-- アーカイブ情報 -->
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-box-archive fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <label for="user-name">アーカイブ</label>
                            <p>アーカイブを確認できます</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{route('mypage.show_archive')}}"><i class="fas fa-chevron-right fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/8b5d46c961.js" crossorigin="anonymous"></script>
@endsection
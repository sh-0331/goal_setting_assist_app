@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <p>&gt;Goal新規登録</p>
</div>

<div class="container">
    <div class="container bg-light mb-1">
        <div class="d-flex justify-content-end">
            <a href="{{ route('goals.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <div class="row">
        <div class="col"></div>

        <div class="col-9">
            <form action="{{ route('goals.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <!-- 目的の分類を選択 -->
                    <label for="classification" class="form-label">1. 実現したい目的の分類を選択してください。</label>
                    <select class="form-select" name="classification">
                        <option value=1>自分の成長</option>
                        <option value=2>業務・試験</option>
                        <option value=3>アイデア・改善</option>
                    </select>
                </div>
                <div>
                    <!-- 目的の詳細を記述 -->
                    <div class="mb-3">
                        <label for="goal_content" class="form-label">2. 目的(Goal)を記述してください。</label>
                        <textarea name="goal_content" id="" rows="3" class="form-control"></textarea>
                    </div>
                    <!-- 目的のメリット -->
                    <div class="mb-3">
                        <label for="merit" class="form-label">3. 目的を達成すると自分にどんなメリットがありますか？</label>
                        <textarea name="merit" id="" rows="3" class="form-control"></textarea>
                        <!-- メリット評価 -->
                        <label for="eval" class="form-label">メリットを5段階で評価してみましょう。</label>
                        <select class="form-select" name="eval">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <!-- 現状(Start)把握 -->
                    <div class="mb-3">
                        <label for="start_content" class="form-label">4. 目的に対して現在の状態(Start)を記述してください。</label>
                        <p>例）できていないこと、足りていないところ、問題点　など</p>
                        <textarea name="start_content" id="" rows="3" class="form-control"></textarea>
                    </div>
                    <!-- 登録ボタン -->
                    <div class="d-flex flex-row-reverse mt-1">
                        <button type="submit" class="btn btn-primary" name="create" value="create">登録</button>
                    </div>
            </form>
        </div>
    </div>

    <div class="col"></div>
</div>
@endsection
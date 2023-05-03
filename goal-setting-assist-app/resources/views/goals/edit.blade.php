@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;<a href="{{ route('goals.show', compact('goal')) }}">Goal詳細</a></div>
    <p>&gt;Goal編集</p>
</div>

<div class="container">
    <div class="container bg-light mb-1">
        <div class="d-flex justify-content-end">
            <a href="{{ route('goals.show', compact('goal')) }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <div class="row">
        <div class="col"></div>

        <div class="col-9">
            <form action="{{ route('goals.update', compact('goal')) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <!-- 目的の分類を選択 -->
                    <label for="classification_edit" class="form-label">1. 実現したい目的の分類を選択してください。</label>
                    <select class="form-select" id="classification_edit" name="classification">
                        <option value=1>自分の成長</option>
                        <option value=2 @if($goal->classification==2) selected @endif>業務・試験</option>
                        <option value=3 @if($goal->classification==3) selected @endif>アイデア・改善</option>
                    </select>
                </div>
                <div>
                    <!-- 目的の詳細を記述 -->
                    <div class="mb-3">
                        <label for="goal_content_edit" class="form-label">2. 目的(Goal)を記述してください。</label>
                        <textarea name="goal_content" id="goal_content_edit" rows="3" class="form-control">{{ $goal->goal_content }}</textarea>
                    </div>
                    <!-- 目的のメリット -->
                    <div class="mb-3">
                        <label for="merit_edit" class="form-label">3. 目的を達成すると自分にどんなメリットがありますか？</label>
                        <textarea name="merit" id="merit_edit" rows="3" class="form-control">{{ $goal->merit }}</textarea>
                        <!-- メリット評価 -->
                        <label for="goal_eval_edit" class="form-label">メリットを5段階で評価してみましょう。</label>
                        <select class="form-select" id="goal_eval_edit" name="eval">
                            @for($i=5; $i>=1; $i-=1)
                                <option value="{{$i}}" @if($goal->eval == $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <!-- 現状(Start)把握 -->
                    <div class="mb-3">
                        <label for="start_content_edit" class="form-label">4. 目的に対して現在の状態(Start)を記述してください。</label>
                        <p>例）できていないこと、足りていないところ、問題点　など</p>
                        <textarea name="start_content" id="start_content_edit" rows="3" class="form-control">{{ $goal->start_content }}</textarea>
                    </div>
                    <!-- 登録ボタン -->
                    <div class="d-flex flex-row-reverse mt-1">
                        <button type="submit" class="btn btn-primary" name="update" value="update">更新</button>
                    </div>
            </form>
        </div>
    </div>

    <div class="col"></div>
</div>
@endsection
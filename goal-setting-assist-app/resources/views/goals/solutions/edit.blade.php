@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;<a href="{{ route('goals.show', compact('goal')) }}">Goal詳細</a></div>
    <div>&gt;<a href="{{ route('goals.solutions.show', compact('goal', 'solution')) }}">Solution詳細</a></div>
    <p>&gt;Solution編集</p>
</div>

<div class="container">

    <div class="container bg-light mb-1">
        <div class="d-flex justify-content-end">
            <a href="{{ route('goals.solutions.show', compact('goal', 'solution')) }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <div class="container">
        <form action="{{ route('goals.solutions.update', compact('goal', 'solution')) }}" method="post">
            @csrf
            @method('PUT')
            <!-- 解決策の入力 -->
            <label for="solution_content" class="form-label">解決策を編集してください。</label>
            <input type="text" class="form-control @error('content') is-invalid @enderror" id="solution_content" name="content" value="{{ old('content' ,$solution->content) }}">
            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>

            <!-- 解決策の評価 -->
            <label for="solution_eval" class="form-label">解決策を5段階で評価してみましょう。</label>
            <select class="form-select" id="solution_eval" name="eval">
                @for($i=5; $i>=1; $i-=1)
                <option value="{{ $i }}" @selected($solution->eval == $i)>{{ $i }}</option>
                @endfor
            </select>

            <div class="d-flex flex-row-reverse mt-3">
                <button type="submit" class="btn btn-primary" name="update" value="update">更新</button>
            </div>
        </form>
    </div>

</div>
@endsection
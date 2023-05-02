@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <p>&gt;Goal詳細</p>
</div>

<div class="container">
    <!-- Solution用Modal -->
    @include('modals.add_solution')

    <div class="container bg-light">
        <div class="d-flex justify-content-end">
            <a href="{{ route('goals.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <div class="container p-2">

        <h3 class="text-center fst-italic text-primary">Goal</h3>
        <div class="d-flex">
            <div class="flex-fill fs-3 text-center bg-secondary">{{ $goal->goal_content }}</div>

            <div class="mb-0 border">
                <div class="dropdown">
                    <a href="#" class="px-1 fs-3 link-dark text-decoration-none" id="dropdownGoalMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">︙</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownGoalMenuLink">
                        <li><a href="{{ route('goals.edit', compact('goal')) }}" class="dropdown-item">編集</a></li>
                        <li><a href="{{ route('goals.destroy', compact('goal')) }}" class="dropdown-item text-danger">削除</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border p-2">
            <div class="flex-fill fs-6 bg-light">メリット：{{ $goal->merit }}</div>
            <div class="flex-fill fs-6 bg-light">評価：{{ $goal->eval }}</div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-5">
                <p class="fs-1 d-flex justify-content-center">↑</p>
            </div>
            <div class="col">
                <!-- <a href="solutions/create.html" class="link-dark"> -->
                <a href="#" class="link-dark" data-bs-toggle="modal" data-bs-target="#addSolutionModal">
                    <div class="d-flex justify-content-end">
                        <p class="fs-6"><span class="fw-bold">+</span>&nbsp;解決策を追加</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="container border p-3">
            <div class="row">
                <!-- foreach -->
                <div class="col-4 border text-center pt-3 bg-light">
                    <a href="#">例）実践経験を積む</a>
                    <!-- 評価を変数にする -->
                    <p class="text-center">評価:例）5</p>
                </div>
                <!-- endforeach -->
            </div>
        </div>

        <p class="fs-1 d-flex justify-content-center">↑</p>

        <div class="fs-3 d-flex justify-content-center border bg-secondary">{{ $goal->start_content }}</div>
        <h3 class="text-center fst-italic text-primary">Start</h3>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <p>&gt;Goal詳細</p>
</div>
@if(session('flash_message'))
    <div class="flash_message bg-success text-center py-3 mb-1">
        {{ session('flash_message') }}
    </div>
@endif

<div class="container">
    <!-- add_solution用Modal -->
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
                        <form action="{{ route('goals.destroy', compact('goal')) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <li><button type="submit" class="dropdown-item text-danger" name="delete">削除</button></li>
                        </form>
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
                @foreach($goal->solutions as $solution)
                <div class="col-4 border text-center pt-3 bg-light">
                    <a href="{{ route('goals.solutions.show', compact('goal', 'solution')) }}">{{ $solution->content }}</a>
                    <p class="text-center">評価:{{ $solution->eval }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <p class="fs-1 d-flex justify-content-center">↑</p>

        <div class="fs-3 d-flex justify-content-center border bg-secondary">{{ $goal->start_content }}</div>
        <h3 class="text-center fst-italic text-primary">Start</h3>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;<a href="{{ route('goals.show', compact('goal')) }}">Goal詳細</a></div>
    <div>&gt;Solution詳細</div>
</div>
@if(session('flash_message'))
    <div class="flash_message bg-success text-center py-3 mb-1">
        {{ session('flash_message') }}
    </div>
@endif

<div class="container">
    <div class="container bg-light">
        <div class="d-flex justify-content-end">
            <a href="{{ route('goals.show', compact('goal')) }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <div class="container p-2">

        <h3 class="text-center fst-italic text-primary">Goal</h3>
        <div class="fs-3 text-center border bg-secondary">{{ $goal->goal_content }}</div>

        <p class="fs-1 text-center">↑</p>

        <h3 class="text-center fst-italic text-primary">Solution</h3>
        <div class="p-1 border">
            <div class="d-flex">
                <div class="flex-fill text-center bg-secondary">
                    <p class="fs-3 m-0">{{ $solution->content }}</p>
                </div>

                <div class="mb-0 align-self-center">
                    <div class="dropdown">
                        <a href="#" class="px-1 fs-3 fw-bold link-dark text-decoration-none" id="dropdownGoalMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">︙</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownGoalMenuLink">
                            @if($solution->measurable != NULL)
                            <li><a href="measureable.html" class="dropdown-item">定量化の編集</a></li>
                            @endif
                            <li><a href="{{ route('goals.solutions.edit', compact('goal','solution')) }}" class="dropdown-item">編集</a></li>
                            <li>
                                <form action="{{ route('goals.solutions.destroy', compact('goal', 'solution')) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">削除</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-2 row">
                <div class="col">
                    <p class="m-0"><span class="fw-bold">評価：</span>{{ $solution->eval }}</p>
                </div>

                <div class="col">
                    @if($solution->measurable != NULL)
                    <p class="m-0"><span class="fw-bold">目標：</span>{{$solution->measurable->progress_value}}{{$solution->measurable->progress_unit}}</p>
                    @endif
                </div>

                <div class="col">
                    @if($solution->milestone != NULL)
                    <!-- 納期はマイルストーンの合計 -->
                    <p class="m-0"><span class="fw-bold">残り期間：</span><span class="text-danger">数字</span>日</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- 解決策の定量化用Modal -->
        @include('modals.quantify_solution')
        
        <!-- マイルストーン追加用Modal -->
        @include('modals.add_milestone')

        <div class="col">
            @if($solution->measurable == NULL)
            <a href="#" class="link-dark" data-bs-toggle="modal" data-bs-target="#quantifySolutionModal">
                <div class="d-flex justify-content-end">
                    <p class="fs-6"><span class="fw-bold">+</span>&nbsp;解決策の定量化</p>
                </div>
            </a>
            @else
            <!-- マイルストーン追加 -->
            <a href="#" class="link-dark" data-bs-toggle="modal" data-bs-target="#addMilestoneModal">
                <div class="d-flex justify-content-end">
                    <p class="fs-6"><span class="fw-bold">+</span>&nbsp;マイルストーンの追加</p>
                </div>
            </a>
            <!-- マイルストーン並び替え -->
            <a href="#" class="link-dark" data-bs-toggle="modal" data-bs-target="#sortMilestoneModal">
                <div class="d-flex justify-content-end">
                    <p class="fs-6"><span class="fw-bold"><i class="fa-solid fa-sort"></i></span>&nbsp;マイルストーンの並び替え</p>
                </div>
            </a>
            @endif
        </div>

        <div class="container border p-3">
            <!-- 入れ換えできるようにしたい -->
            @if($solution->milestones != NULL)
            @foreach($solution->milestones as $milestone)
            <p class="fs-1 text-center">↑</p>
            <div class="d-flex">
                <div class="flex-fill border text-center pt-3 pb-3 bg-light">例）画面設計完了</div>

                <div class="mb-0 align-self-center">
                    <div class="dropdown">
                        <a href="#" class="px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownGoalMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">︙</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownGoalMenuLink">
                            <li>
                                <form action="" method="post">
                                    <!-- if($milestone->done == false) -->
                                    <input type="hidden" name="milestone_done" value="true">
                                    <button type="submit" class="dropdown-item btn btn-link">完了</button>
                                    <!-- endif -->
                                </form>
                            </li>
                            <li><a href="" class="dropdown-item">編集</a></li>
                            <li><a href="" class="dropdown-item text-danger">削除</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="m-0"><span class="fw-bold">残り期間：</span><span class="text-danger">5</span>日</p>
            @endforeach
            @endif
        </div>

        <p class="fs-1 text-center">↑</p>
        <h3 class="text-center fst-italic text-primary">Start</h3>
        <div class="fs-3 text-center bg-secondary">{{ $goal->start_content }}</div>
    </div>
</div>
@endsection
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

                <!-- 解決策の定量化用Modal -->
                @include('modals.edit_quantify_solution')
                
                <div class="mb-0 align-self-center">
                    <div class="dropdown">
                        <a href="#" class="px-1 fs-3 fw-bold link-dark text-decoration-none" id="dropdownGoalMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">︙</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownGoalMenuLink">
                            @if($solution->measurable != NULL)
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editQuantifySolutionModal">定量値の編集</a></li>
                            @endif
                            <li><a href="{{ route('goals.solutions.edit', compact('goal','solution')) }}" class="dropdown-item">編集</a></li>
                            <li>
                                <form action="{{ route('goals.solutions.destroy', compact('goal', 'solution')) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" name="delete">削除</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('goals.solutions.update', compact('goal', 'solution')) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="done" value="1">
                                    <button type="submit" class="dropdown-item" name="archive">アーカイブ</button>
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
                    <!-- 納期はマイルストーンの合計 -->
                    <p class="m-0"><span class="fw-bold">残り期間：</span><span class="text-danger">{{ $total_date }}</span>日</p>
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
            @if($milestones != NULL)
            @foreach($milestones as $milestone)
            @if($milestone->done != '1')
            <p class="fs-1 text-center">↑</p>
            <div class="d-flex">
                <div class="flex-fill border text-center pt-3 pb-3 bg-light">{{ $milestone->content }}</div>

                <!-- マイルストーン編集用モーダル -->
                @include('modals.edit_milestone')

                <div class="mb-0 align-self-center">
                    <div class="dropdown">
                        <a href="#" class="px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownGoalMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">︙</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownGoalMenuLink">
                            <li>
                                <form action="{{ route('milestones.update', [$goal, $solution, $milestone]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <!-- マイルストーン完了 -->
                                    <input type="hidden" name="done" value="1">
                                    <button type="submit" class="dropdown-item btn btn-link" name="milestone_done">完了</button>
                                </form>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editMilestoneModal{{ $milestone->id }}">編集</a>
                            </li>
                            <!-- マイルストーン削除 -->
                            <li>
                                <form action="{{ route('milestones.destroy', [$goal, $solution, $milestone]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" name="delete">削除</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="m-0"><span class="fw-bold">残り期間：</span><span class="text-danger">{{ $milestone->date }}</span>日</p>
            @endif
            @endforeach
            @endif
        </div>

        <p class="fs-1 text-center">↑</p>
        <h3 class="text-center fst-italic text-primary">Start</h3>
        <div class="fs-3 text-center bg-secondary">{{ $goal->start_content }}</div>
    </div>
</div>
@endsection
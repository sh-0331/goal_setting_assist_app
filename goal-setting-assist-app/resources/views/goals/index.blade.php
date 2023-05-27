@extends('layouts.app')

@section('content')
<div class="d-flex container">
    <a href="{{ route('goals.index') }}">ホーム</a>
</div>

@if(session('flash_message'))
    <div class="flash_message bg-success text-center py-3 mb-1">
        {{ session('flash_message') }}
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="container bg-light mb-1">
        <div class="d-flex justify-content-end">
            <a href="{{ route('goals.create') }}" class="btn btn-primary">新規登録</a>
        </div>
    </div>

    <div class="row">
        <div class="col-3 bg-light border">
            <h2>Goal一覧</h2>
            <ul class="list-grop">
                @foreach ($goals as $goal)
                @if($goal->done != '1')
                <li class="list-group-item"><a href="{{ route('goals.show', compact('goal')) }}">{{ $goal->goal_content }}</a></li>
                @endif
                @endforeach
            </ul>
        </div>

        <div class="col-9">
            <h2>Goalの達成率・残日数</h2>
            <hr>
            @foreach ($goals as $goal)
            @if($goal->done != '1')
            <div class="container border bg-light">
                <a href="{{ route('goals.show', compact('goal')) }}" class="fs-4">{{ $goal->goal_content }}</a>
                @foreach ($goal->solutions as $solution)
                @if($solution->done != '1')
                <div class="border mt-1 mb-1">
                    <p class="m-2 fst-italic fs-5">{{ $solution->content }}</p>
                    <div class="row m-0">
                        <div class="col-9 d-block mt-2">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $pers[$solution->id] }}%" aria-valuenow="{{ $pers[$solution->id] }}%" aria-valuemin="0" aria-valuemax="100">{{ $pers[$solution->id] }}%</div>
                            </div>
                        </div>
                        <div class="col-3 d-flex flex-row ps-2 mb-3">
                            <p class="mb-0 d-flex align-items-center">残日数</p>
                            <p class="btn btn-secondary ms-1 mb-0">{{ $total_dates[$solution->id] }}日</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
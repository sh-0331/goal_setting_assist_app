@extends('layouts.app')

@section('content')
<div class="d-block container bg-light">
    <a href="{{ route('goals.index') }}">ホーム</a>
</div>

<main>
    <div class="container">

        <div class="container bg-light mb-1">
            <div class="d-flex justify-content-end">
                <a href="{{ route('goals.create') }}" class="btn btn-primary">新規登録</a>
            </div>
        </div>

        <div class="row">

            <div class="col-3 bg-light border">
                <h2>Goal一覧</h2>
                @if (is_array($goals))
                <ul class="list-grop">
                    @foreach ($goals as $goal)
                    <li class="list-group-item"><a href="{{ $goal->id }}">{{ $goal->goal_content }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="col-9">
                <h2>Goalの達成率・残日数</h2>
                <hr>

                @if (is_array($goals))
                @foreach ($goals as $goal)
                <div class="container border bg-light">
                    <a href="show.html" class="fs-4">{{ $goal->goal_content }}</a>
                    <!-- @foreach ($goal->solutions as $solution) -->
                    <div class="border mt-1 mb-1">
                        <!-- <p class="m-2 fst-italic fs-5">{{ $solution->content }}</p> -->
                        <p class="m-2 fst-italic fs-5">Solution-1</p>
                        <div class="row m-0">
                            <div class="col-9 d-block mt-2">
                                <div class="progress" style="height: 20px;">
                                    <!-- <div class="progress-bar" role="progressbar" style="width: %;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">%</div> -->
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                </div>
                            </div>
                            <div class="col-3 d-flex flex-row ps-2 mb-3">
                                <p class="mb-0 d-flex align-items-center">残日数</p>
                                <!-- <p class="btn btn-secondary ms-1 mb-0">{{  }}日</p> -->
                                <p class="btn btn-secondary ms-1 mb-0">18日</p>
                            </div>
                        </div>
                    </div>
                    <!-- @endforeach -->
                </div>
                @endforeach
                @endif
            </div>

        </div>
    </div>
</main>

@endsection
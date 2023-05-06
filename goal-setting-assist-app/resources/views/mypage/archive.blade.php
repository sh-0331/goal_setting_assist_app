@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <a href="{{ route('goals.index') }}">ホーム</a>
    <div>&gt;<a href="{{ route('mypage.index') }}">My page</a></div>
    <div>&gt;アーカイブ</div>
</div>

<br>

<div class="container">
    <h4 class="text-success">アーカイブ一覧</h4>
    <div class="row border">
        <!-- アーカイブしたGoal一覧表示 -->
        <div class="col border-start border-end">
            <h5 class="fw-bold fst-italic">Goal</h5>
            <div class="d-flex flex-column">
                @foreach($done_goals as $goal)
                <div class="d-flex">
                    <div><span class="fw-bold">・</span>{{ $goal->updated_at }}</div>
                    <div><a class="ms-2 link-dark" href="{{$goal->goal_content}}">{{ $goal->goal_content }}</a></div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- アーカイブしたSolution一覧表示 -->
        <div class="col border-start border-end">
            <h5 class="fw-bold fst-italic">Solution</h5>
            <div class="d-flex flex-column">
                @foreach($done_solutions as $solution)
                <div class="d-flex">
                    <div><span class="fw-bold">・</span>{{ $solution->updated_at }}</div>
                    <div><a class="ms-2 link-dark" href="?solution={{$solution->id}}">{{ $solution->content }}</a></div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- アーカイブしたMilestond一覧表示 -->
        <div class="col border-start border-end">
            <h5 class="fw-bold fst-italic">Milestone</h5>
            <div class="d-flex flex-column">
                @foreach($done_milestones as $milestone)
                <div class="d-flex">
                    <div><span class="fw-bold">・</span>{{ $milestone->updated_at->format('Y.n.j') }}</div>
                    <div><a class="ms-2 link-dark" href="?milestone={{$milestone->id}}">{{ $milestone->content }}</a></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- もしゴールidをgetしたら -->
    <div class="container">
        <h2 class="mt-3 mb-3 text-center">詳細</h2>
        <hr>
        @if($_GET != NULL && isset($_GET['goal']))
        <div class="container border mb-1">
            <div class="d-flex">
                <p class="flex-fill fs-4 mb-0">{{ $done_goals->find($_GET['goal'])->content }}</p>
                <div class="dropdown">
                    <a href="#" class="fs-4 link-dark text-decoration-none" id="dropdownArchiveMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">≡</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownArchiveMenuLink">
                        <li><a href="" class="dropdown-item">アクティブ</a></li>
                        <li><a href="" class="dropdown-item text-danger">削除</a></li>
                    </ul>
                </div>
            </div>
            <p class="mb-0 d-flex align-items-center">完了日：<span class="fst-italic">{{ $done_goals->find($_GET['goal'])->updated_at->format('Y.n.j') }}</span></p>
        </div>
        @endif

        @if($_GET != NULL && isset($_GET['solution']))
        <div class="container border mb-1">
            <div class="d-flex">
                <p class="flex-fill fs-4 mb-0">{{ $done_solutions->find($_GET['solution'])->content }}</p>
                <div class="dropdown">
                    <a href="#" class="fs-4 link-dark text-decoration-none" id="dropdownArchiveMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">≡</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownArchiveMenuLink">
                        <li><a href="" class="dropdown-item">アクティブ</a></li>
                        <li><a href="" class="dropdown-item text-danger">削除</a></li>
                    </ul>
                </div>
            </div>
            <p class="mb-0 d-flex align-items-center">完了日：<span class="fst-italic">{{ $done_solutions->find($_GET['solution'])->updated_at->format('Y.n.j') }}</span></p>
            <p class="mb-0 d-flex align-items-center">goal：<span class="fst-italic">{{ $done_solutions->find($_GET['solution'])->goal->content }}</span></p>
            @foreach($done_milestones->where('solution_id', $_GET['solution']) as $milestone)
            <p class="mb-0 d-flex align-items-center">milestone：<span class="fst-italic">{{ $milestone->content }}</span></p>
            @endforeach
        </div>
        @endif

        @if($_GET != NULL && isset($_GET['milestone']))
        <div class="container border mb-1">
            <div class="d-flex">
                <p class="flex-fill fs-4 mb-0">{{ $done_milestones->find($_GET['milestone'])->content }}</p>
                <div class="dropdown">
                    <a href="#" class="fs-4 link-dark text-decoration-none" id="dropdownArchiveMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">≡</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownArchiveMenuLink">
                        <li><a href="" class="dropdown-item">アクティブ</a></li>
                        <li><a href="" class="dropdown-item text-danger">削除</a></li>
                    </ul>
                </div>
            </div>
            <p class="mb-0 d-flex align-items-center">完了日：<span class="fst-italic">{{ $done_milestones->find($_GET['milestone'])->updated_at->format('Y.n.j') }}</span></p>
            <p class="mb-0 d-flex align-items-center">solution：<span class="fst-italic">{{ $done_milestones->find($_GET['milestone'])->solution->content }}</span></p>
        </div>
        @endif
    </div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
@endsection
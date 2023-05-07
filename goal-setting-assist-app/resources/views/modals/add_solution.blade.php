<div class="modal fade" id="addSolutionModal" tabindex="-1" aria-labelledby="addSolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSolutionModalLabel">Solution追加</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('goals.solutions.store', compact('goal')) }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- 解決策の入力 -->
                    <label for="solution_content" class="form-label">解決策を入力してください。</label>
                    <input type="text" class="form-control" id="solution_content" name="content" required>
                    <!-- 解決策の評価 -->
                    <label for="solution_eval" class="form-label">解決策を5段階で評価してみましょう。</label>
                    <select class="form-select" id="solution_eval" name="eval">
                        @for($i=5; $i>=1; $i-=1)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="create">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
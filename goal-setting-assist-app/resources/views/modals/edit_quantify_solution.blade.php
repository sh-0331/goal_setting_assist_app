<div class="modal fade" id="editQuantifySolutionModal" tabindex="-1" aria-labelledby="editQuantifySolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuantifySolutionModalLabel">解決策の定量化</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('measurable.update', [$goal, $solution, $solution->measurable]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- 解決策の単位 -->
                    <label for="edit_progress_unit" class="form-label">
                        解決策を定量化してみましょう。<br>
                        解決策の進捗を数値で表すならば、単位は何ですか？
                    </label>
                    <input type="text" class="form-control" id="edit_progress_unit" name="progress_unit" placeholder="単位" value="{{ old('progress_unit', $solution->measurable->progress_unit) }}">
                    <br>
                    <!-- 解決策の数量 -->
                    <label for="edit_progress_value" class="form-label">その単位の目標数値を入力してください。</label>
                    <input type="number" class="form-control" id="edit_progress_value" name="progress_value" placeholder="数値" value="{{ old('progress_value', $solution->measurable->progress_value) }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="update">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
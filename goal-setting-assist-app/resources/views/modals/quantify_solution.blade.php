<div class="modal fade" id="quantifySolutionModal" tabindex="-1" aria-labelledby="quantifySolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantifySolutionModalLabel">解決策の定量化</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('measurable.store', compact('goal', 'solution')) }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- 解決策の単位 -->
                    <label for="progress_unit" class="form-label">
                        解決策を定量化してみましょう。<br>
                        解決策の進捗を数値で表すならば、単位は何ですか？
                    </label>
                    <input type="text" class="form-control" id="progress_unit" name="progress_unit" placeholder="単位">
                    <br>
                    <!-- 解決策の数量 -->
                    <label for="progress_value" class="form-label">その単位の目標数値を入力してください。</label>
                    <input type="text" class="form-control" id="progress_value" name="progress_value" placeholder="数値">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="create">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="quantifySolutionModal" tabindex="-1" aria-labelledby="quantifySolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantifySolutionModalLabel">解決策の定量化</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <!-- 解決策の単位 -->
                    <label for="progress_unit" class="form-label">
                        解決策を定量化してみましょう。<br>
                        解決策の進捗を数値で表すならば、単位は何ですか？
                    </label>
                    <input type="text" class="form-control" name="progress_unit">
                    <br>
                    <!-- 解決策の数量 -->
                    <label for="progress_value" class="form-label">その単位の目標数値を入力してください。</label>
                    <input type="text" class="form-control" name="progress_value">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
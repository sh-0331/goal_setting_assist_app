<div class="modal fade" id="addSolutionModal" tabindex="-1" aria-labelledby="addSolutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSolutionModalLabel">Solution追加</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <!-- 解決策の入力 -->
                    <label for="solution_content" class="form-label">解決策を入力してください。</label>
                    <input type="text" class="form-control" name="solution_content">
                    <!-- 解決策の評価 -->
                    <label for="solution_eval" class="form-label">解決策を5段階で評価してみましょう。</label>
                    <select class="form-select" name="goal_eval" name="solution_eval">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
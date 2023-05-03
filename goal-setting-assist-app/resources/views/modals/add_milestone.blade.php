<div class="modal fade" id="addMilestoneModal" tabindex="-1" aria-labelledby="addMilestoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMilestoneModalLabel">解決策の定量化</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <!-- マイルストーンを数値入力 -->
                    <label for="milestone_content" class="form-label">マイルストーンを入力してください。</label>
                    <input type="text" class="form-control" name="milestone_content">
                    <!-- マイルストーンの期日を設定する -->
                    <label for="solution_date" class="form-label">マイルストーンは何日で完了できますか。<br>
                        <span class="text-danger">※7日以内で入力してください</span></label>
                    <input type="text" class="form-control" name="milestone_date" placeholder="日">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
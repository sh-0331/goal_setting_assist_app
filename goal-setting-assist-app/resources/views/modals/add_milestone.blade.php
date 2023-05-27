<div class="modal fade" id="addMilestoneModal" tabindex="-1" aria-labelledby="addMilestoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMilestoneModalLabel">解決策の定量化</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('milestones.store', compact('goal','solution')) }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- マイルストーンを数値入力 -->
                    <label for="milestone_content" class="form-label">マイルストーンを入力してください。</label>
                    <input type="text" class="form-control" id="milestone_content" name="content" value="{{ old('content') }}">
                    <!-- マイルストーンの期日を設定する -->
                    <label for="milestone_date" class="form-label">マイルストーンは何日で完了できますか。</label>
                    <input type="number" class="form-control" id="milestone_date" name="date" placeholder="日" min="1" max="100" value="{{ old('date') }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="create">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
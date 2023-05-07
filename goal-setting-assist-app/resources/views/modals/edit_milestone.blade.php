<div class="modal fade" id="editMilestoneModal{{ $milestone->id }}" tabindex="-1" aria-labelledby="editMilestoneModalLabel{{ $milestone->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMilestoneModalLabel{{ $milestone->id }}">解決策の定量化</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('milestones.update', [$goal, $solution, $milestone]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- マイルストーンを数値入力 -->
                    <label for="edit_milestone_content" class="form-label">マイルストーンを入力してください。</label>
                    <input type="text" class="form-control" id="edit_milestone_content" name="content" value="{{$milestone->content}}" required>
                    <!-- マイルストーンの期日を設定する -->
                    <label for="edit_milestone_date" class="form-label">マイルストーンは何日で完了できますか。</label>
                    <input type="number" class="form-control" id="edit_milestone_date" name="date" placeholder="日" value="{{$milestone->date}}" min="1" max="100" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="update">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
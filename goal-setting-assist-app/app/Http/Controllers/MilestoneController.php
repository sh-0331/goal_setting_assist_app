<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    public function change(Request $request, Solution $solution)
    {
        $goal = $solution->goal;

        // 移動対象のidとランクを取得する
        $dragged_id = $request->input('draggedId');
        $dragged_rank = $request->input('draggedRank');

        // 移動先のidとランクを取得する
        $target_id = $request->input('targetId');
        $target_rank = $request->input('targetRank');

        // 移動対象と移動先の間のマイルストーンを全て取得する
        $milestones = $solution->milestones;

        // 上から下へドラッグする場合
        if($dragged_rank < $target_rank ) {
            $changed_milestones = $milestones->whereBetween('rank', [$dragged_rank+1, $target_rank]);
            // 取得した間のrankを全て-1する
            foreach($changed_milestones as $changed_milestone) {
                $changed_milestone->rank--;
                $changed_milestone->save();
            }
        // 下から上へドラッグする場合
        } else {
            $changed_milestones = $milestones->whereBetween('rank', [$target_rank, $dragged_rank-1]);
            // 取得した間のrankを全て+1する
            foreach($changed_milestones as $changed_milestone) {
                $changed_milestone->rank++;
                $changed_milestone->save();
            }
        }

        // 移動したい項目のrankを移動先のrankへ変更する
        $dragged_milestone = $milestones->find($dragged_id);
        $dragged_milestone->rank = $target_rank;
        $dragged_milestone->save();

        return to_route('solution.show', compact('goal', 'solution'));

    }
}

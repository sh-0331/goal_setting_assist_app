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
        // dd($milestones);
        if($dragged_rank < $target_rank ) {
            $dragged_milestones = $milestones->whereBetween('rank', [$dragged_rank+1, $target_rank]);
        } else {
            $dragged_milestones = $milestones->whereBetween('rank', [$target_rank+1, $dragged_rank]);
        }
        // dd($dragged_milestones);

        // 移動したい項目のrankを移動先のrankへ変更する
        $dragged_milestone = $milestones->find($dragged_id);
        $dragged_milestone->rank = $target_rank;
        $dragged_milestone->save();
        
        // 間のrankを全て-1する
        foreach($dragged_milestones as $target_milestone) {
            $target_milestone->rank--;
            $target_milestone->save();
        }

        return to_route('solution.show', compact('goal', 'solution'));

    }
}

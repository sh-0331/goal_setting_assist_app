<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Milestone;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }

    public function edit()
    {
        $user = Auth::user();

        return view('mypage.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // ユーザー情報更新

        return redirect()->route('mypgae.index');
    }

    public function show_archive()
    {
        $user = Auth::user();

        //Goalの中でdoneが1のものを取得する
        $goals = Goal::where('user_id', $user->id)->get();
        $done_goals = array();
        foreach($goals as $goal){
            if($goal->done == '1'){
                $done_goals[] = $goal;
            }
        }
        // Solutionの中でdoneが1のものを取得する
        $done_solutions = array();
        foreach($goals as $goal){
            foreach($goal->solutions as $solution){
                $solutions[] = $solution;
                if($solution->done == '1'){
                    $done_solutions[] = $solution;
                }
            }
        }
        // Milestoneの中でdoneが1のものを取得する
        $done_milestones = array();
        foreach($solutions as $solution){
            foreach($solution->milestones as $milestone){
                if($milestone->done == '1'){
                    $done_milestones[] = $milestone;
                }
            }
        }

        return view('mypage.archive', compact('done_goals', 'done_solutions', 'done_milestones'));
    }

    public function active(Request $request)
    {
        // アーカイブした項目をアクティブに戻す
        $flash_message = "";
        // Goalをアクティブにする
        if($request->input('active_item') == 'goal'){
            $goal_id = $request->input('goal_id');
            $archive_goal = Goal::find($goal_id);
            $archive_goal->done = '0';
            $archive_goal->save();
            $flash_message = "Goalをアクティブにしました。";
            // Solutionをアクティブにする
        } elseif($request->input('active_item') == 'solution'){
            $solution_id = $request->input('solution_id');
            $archive_solution = Solution::find($solution_id);
            $archive_solution->done = '0';
            $archive_solution->save();
            // 関連するGoalがアーカイブされていたらアクティブにする
            $rel_goal = $archive_solution->goal;
            if($rel_goal->done == '1'){
                $rel_goal->done = '0';
                $rel_goal->save();
            }
            $flash_message = "Solutionをアクティブにしました。";
            // Milestoneをアクティブにする
        } elseif($request->input('active_item') == 'milestone'){
            $milestone_id = $request->input('milestone_id');
            $archive_milestone = Milestone::find($milestone_id);
            $archive_milestone->done = '0';
            $archive_milestone->save();
            // 関連するSolutionがアーカイブされていたらアクティブにする
            $rel_solution = $archive_milestone->solution;
            if($rel_solution->done == '1'){
                $rel_solution->done = '0';
                $rel_solution->save();
            }
            // 関連するGoalがアーカイブされていたらアクティブにする
            $rel_goal = $rel_solution->goal;
            if($rel_goal->done == '1'){
                $rel_goal->done = '0';
                $rel_goal->save();
            }
            $flash_message = "Milestoneをアクティブにしました。";
        }
        return redirect()->route('mypage.show_archive')->with('flash_message', "{$flash_message}");
    }

    public function destroy(){
        // アーカイブした項目を完全に削除する
    }
}

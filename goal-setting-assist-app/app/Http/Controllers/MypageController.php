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
        $done_goals = $goals->where('done', '1');
        foreach($goals as $goal){
            // Solutionの中でdoneが1のものを取得する
            $solutions = Solution::where('goals_id', $goal->id)->get();
            $done_solutions = $solutions->where('done', '1');
            foreach($solutions as $solution){
                // milestoneの中でdoneが1のものを取得する
                $milestones = Milestone::where('solution_id', $solution->id)->get();
                $done_milestones = $milestones->where('done', '1');
            }
        }

        return view('mypage.archive', compact('done_goals', 'done_solutions', 'done_milestones'));
    }

    public function active(Request $request)
    {
        // アーカイブした項目をアクティブに戻す
        // doneを'0'にする
        // dd($request->input('active_item'));
        $flash_message = "";
        if($request->input('active_item') == 'goal' ){
            // dd(true);
            $goal_id = $request->input('goal_id');
            $archive_goal = Goal::find($goal_id);
            // dd($archive_goal);
            $archive_goal->done = '0';
            // dd($archive_goal->done);
            $archive_goal->save();
            $flash_message = "Goalをアクティブにしました。";
        }
        // dd(false);
        return redirect()->route('mypage.show_archive')->with('flash_message', "{$flash_message}");
    }

    public function destroy(){
        // アーカイブした項目を完全に削除する
    }
}

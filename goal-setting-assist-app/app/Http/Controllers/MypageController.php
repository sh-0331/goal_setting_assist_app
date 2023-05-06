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
}

<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Milestone;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoalSolutionMilestoneController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Goal $goal, Solution $solution)
    {
        $validated = $request->validate([
            'content' => 'required',
            'date' => 'required | numeric'
        ]);

        $milestone = new Milestone();
        $milestone->solution_id = $solution->id;
        $milestone->content = $request->input('content');
        $milestone->date = $request->input('date');
        
        // 作成順にマイルストーンの順番（rank）を取得する
        $solution_id = $solution->id;
        $milestones = DB::table('milestones')->where('solution_id', $solution_id)->get();
        // Milestoneの中で最も大きいrankを取得する
        if($milestones != []) {
            $max_rank = $milestones->max('rank');
            $rank = $max_rank + 1 ;
        } else {
            $rank = 1;
        }
        $milestone->rank = $rank;
        $milestone->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution', 'milestone'))->with('flash_message', "マイルストーンの登録が完了しました。");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal, Solution $solution, Milestone $milestone)
    {
        if($request->input('done') != NULL ){
            $milestone->done = $request->input('done');
            $active_milestones = $solution->milestones()->where('done', '0')->touch();
            $flash_message = "マイルストーンをアーカイブしました。";
        } else {
            $validated = $request->validate([
                'content' => 'required',
                'date' => 'required | numeric'
            ]);
            $milestone->content = $request->input('content');
            $milestone->date = $request->input('date');
            $flash_message = "マイルストーンの更新が完了しました。";
        }
        $milestone->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution'))->with('flash_message', "{$flash_message}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal, Solution $solution, Milestone $milestone)
    {
        $milestone->delete();

        return redirect()->route('goals.solutions.show', [$goal, $solution])->with('flash_message', "マイルストーンの削除が完了しました。");
    }
}

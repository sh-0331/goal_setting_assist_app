<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Measurable;
use App\Models\Milestone;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class GoalSolutionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $goal)
    {
        $solution = new Solution();
        // dd($goal);
        $solution->goals_id = $goal;
        $solution->content = $request->input('content');
        $solution->eval = $request->input('eval');
        $solution->save();

        return redirect()->route('goals.show', compact('goal'))->with('flash_message', "解決策の登録が完了しました。");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal, Solution $solution)
    {
        $total_date = 0;
        $solution_id = $solution->id;
        $milestones = Milestone::where('solution_id', $solution_id)->get();
        // マイルストーンが存在する場合
        if(isset($milestones[0])){
            // 未完了の中でrankが最大の更新日付を取得
            $max_rank = $milestones->where('done', 0)->max('rank');
            $latest = $milestones->where('rank', $max_rank)->first();
            $latest_date = new DateTime($latest->value('updated_at'));
            // 今日の日付を取得
            $today = new DateTime('now');
            // 今日と更新日付の日にち差を計算する
            $diff = $latest_date->diff($today);
            $diff_day = $diff->format('%a');
            // 日にちの差をdateから引き、保存する
            $latest->date = $latest->date - $diff_day;
            $latest->save();

            // 最終的なdateの合計値を返す
            $total_date = $milestones->pluck('date')->sum();
        }

        return view('goals.solutions.show', compact('goal', 'solution', 'milestones', 'total_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit($goal, Solution $solution)
    {
        return view('goals.solutions.edit', compact('goal', 'solution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal, Solution $solution)
    {
        $solution->content = $request->input('content');
        $solution->eval = $request->input('eval');
        $solution->save();

        return redirect()->route('goals.solutions.show', compact('goal','solution'))->with('flash_message', "解決策の編集が完了しました。");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal, Solution $solution)
    {
        $solution->delete();

        return redirect()->route('goals.show', compact('goal'))->with('flash_message', "解決策の削除が完了しました。");
    }

    public function measurable_store(Request $request, Goal $goal, Solution $solution)
    {
        $measurable = new Measurable();
        $measurable->solution_id = $solution->id;
        $measurable->progress_unit = $request->input('progress_unit');
        $measurable->progress_value = $request->input('progress_value');
        $measurable->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution'));
    }

    public function measurable_update(Request $request, Goal $goal, Solution $solution, Measurable $measurable)
    {
        $measurable->progress_unit = $request->input('progress_unit');
        $measurable->progress_value = $request->input('progress_value');
        $measurable->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution'));
    }
}

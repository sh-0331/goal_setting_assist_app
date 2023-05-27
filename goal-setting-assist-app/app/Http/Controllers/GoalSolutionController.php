<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Measurable;
use App\Models\Milestone;
use App\Models\Solution;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'content' => 'required',
        ]);

        $solution = new Solution();
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
        // rank順にソートする
        $milestones = Milestone::where('solution_id', $solution->id)->orderBy('rank')->get();
        $active_milestones = $milestones->where('done', '0');
        $total_date = $active_milestones->pluck('date')->sum();
        return view('goals.solutions.show', compact('goal', 'solution', 'active_milestones', 'total_date'));
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
        $validated = $request->validate([
            'content' => 'required',
        ]);

        if($request->input('done') != NULL ){
            $solution->done = $request->input('done');
            // Solutionに紐付くマイルストーンも完了させる
            foreach($solution->milestones as $milestone){
                if($milestone->done != '1'){
                    $milestone->done = '1';
                    $milestone->save();
                }
            }
            $flash_message = "解決策をアーカイブしました。";
        } elseif($request->input('content') != NULL){
            $solution->content = $request->input('content');
            $solution->eval = $request->input('eval');
            $flash_message = "解決策の更新が完了しました。";
        }
        $solution->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution'))->with('flash_message', "{$flash_message}");
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
        $validated = $request->validate([
            'progress_unit' => 'required',
            'progress_value' => 'required | numeric'
        ]);

        $measurable = new Measurable();
        $measurable->solution_id = $solution->id;
        $measurable->progress_unit = $request->input('progress_unit');
        $measurable->progress_value = $request->input('progress_value');
        $measurable->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution'));
    }

    public function measurable_update(Request $request, Goal $goal, Solution $solution, Measurable $measurable)
    {
        $validated = $request->validate([
            'progress_unit' => 'required',
            'progress_value' => 'required | numeric'
        ]);

        $measurable->progress_unit = $request->input('progress_unit');
        $measurable->progress_value = $request->input('progress_value');
        $measurable->save();

        return redirect()->route('goals.solutions.show', compact('goal', 'solution'));
    }
}

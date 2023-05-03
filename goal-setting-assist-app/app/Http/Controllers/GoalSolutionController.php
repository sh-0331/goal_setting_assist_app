<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Measurable;
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
        return view('goals.solutions.show', compact('goal', 'solution'));
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
}

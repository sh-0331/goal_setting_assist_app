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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Goal $goal, Solution $solution)
    {
        $milestone = new Milestone();
        $milestone->solution_id = $solution->id;
        $milestone->content = $request->input('content');
        $milestone->date = $request->input('date');
        // $milestone->done;
        
        $solution_id = $solution->id;
        $milestones = DB::table('milestones')->where('solution_id', $solution_id)->get();
        // 同じSolutionを持つMilestoneの中で、最も大きいrankを取得する
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
     * Display the specified resource.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function show(Milestone $milestone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function edit(Milestone $milestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Milestone $milestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Milestone $milestone)
    {
        //
    }
}

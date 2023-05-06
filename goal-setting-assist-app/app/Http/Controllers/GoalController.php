<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Auth::user()->goals;
        $total_dates = array();
        $pers = array();
        foreach($goals as $goal) {
            foreach ($goal->solutions as $solution) {
                $milestones = $solution->milestones;
                $solution_id = $solution->id;
                $total_date = $milestones->where('done', '0')->pluck('date')->sum();
                $total_dates[$solution_id] = $total_date;
                // マイルストーンの進捗
                $total_count = count($milestones);
                $done_count = count($milestones->where('done', '1'));
                if($total_count != 0) {
                    $per = round($done_count / $total_count * 100, 1);
                }else{
                    $per = 0;
                }
                $pers[$solution_id] = $per;
            }
        }
        return view('goals.index', compact("goals", "total_dates", "pers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goal = new Goal();
        $goal->user_id = Auth::id();
        $goal->classification = $request->input('classification');
        $goal->goal_content = $request->input('goal_content');
        $goal->merit = $request->input('merit');
        $goal->eval = $request->input('eval');
        // $goal->done;
        $goal->start_content = $request->input('start_content');
        $goal->save();

        return redirect()->route('goals.index')->with('flash_message', "登録が完了しました。");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        return view('goals.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        return view('goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        // dd($request->input('done'));
        if($request->input('done') != NULL ){
            $goal->done = $request->input('done');
            // Goalに紐付くSolutionも完了させる
            $solutions = $goal->solutions()->where('done', '0')->get();
            // dd($solutions);
            foreach($solutions as $solution){
                // dd($milestone);
                $solution->done = '1';
                $solution->save();
                // dd($milestone->done);
            }
            $flash_message = "Goalをアーカイブしました。";
        } elseif($request->input('goal_content') != NULL){
            $goal->classification = $request->input('classification');
            $goal->goal_content = $request->input('goal_content');
            $goal->merit = $request->input('merit');
            $goal->eval = $request->input('eval');
            $goal->start_content = $request->input('start_content');
            $flash_message = "Goalの更新が完了しました。";
        }
        $goal->save();
        // dd($solution);

        return redirect()->route('goals.index')->with('flash_message', "{$flash_message}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()->route('goals.index')->with('flash_message', "削除が完了しました。");
    }
}

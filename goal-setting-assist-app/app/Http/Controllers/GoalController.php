<?php

namespace App\Http\Controllers;

use App\Models\Goal;
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
        return view('goals.index', compact('goals'));
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
        // $goal->user_id = Auth::user();
        $goal->classification = $request->input('classification');
        $goal->goal_content = $request->input('goal_content');
        $goal->merit = $request->input('merit');
        $goal->eval = $request->input('eval');
        // $goal->done;
        $goal->start_content = $request->input('start_content');
        $goal->save();

        return redirect()->route('goals.show', compact('goal'))->with('flash_message', "編集が完了しました。");
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

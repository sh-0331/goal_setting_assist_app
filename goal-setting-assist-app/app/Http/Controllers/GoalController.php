<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;

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

        $milestone_progress = $this->cal_milestone_progress($goals);
        $total_dates = $milestone_progress['total_dates'];
        $pers = $milestone_progress['pers'];
        
        return view('goals.index', compact("goals", "total_dates", "pers"));
    }

    // マイルストーンの進捗を計算
    private function cal_milestone_progress($goals) {
        $total_dates = array();
        $pers = array();
        
        foreach($goals as $goal) {
            foreach ($goal->solutions as $solution) {
                $milestones = $solution->milestones;
                $solution_id = $solution->id;
                
                // マイルストーンの残日数を取得
                $total_date = $this->total_date($solution);
                $total_dates[$solution_id] = $total_date;

                // もしマイルストーンが存在すれば（完了数/合計数）で進捗を計算
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
        return ['pers' => $pers, 'total_dates' => $total_dates];
    }

    // マイルストーンの残日数を更新
    private function total_date($solution)
    {
        $milestones = $solution->milestones;
        $total_date = 0;

        // マイルストーンが存在する場合
        if(isset($milestones[0])){
            // 未完了のマイルストーンを取得する
            $active_milestones = $milestones->where('done', '0');

            if(isset($active_milestones[0])){
                // 未完了の中で最大rankを持つカラムの更新日付を取得
                $max_rank = $active_milestones->max('rank');
                $latest = $milestones->where('rank', $max_rank)->first();
                $latest_date = new DateTime($latest->updated_at);

                // 今日と更新日付の差を計算する
                $today = new DateTime('now');
                $diff = $latest_date->diff($today);
                $diff_day = $diff->format('%a');

                // 日にちの差をdateから引き、保存する
                $latest->date = $latest->date - $diff_day;
                $latest->save();
            }
            // 未完了の最終的なdateの合計値を返す
            $total_date = $active_milestones->pluck('date')->sum();
        }

        return $total_date;
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
        $validated = $request->validate([
            'goal_content' => 'required',
            'merit' => 'required',
            'start_content' => 'required'
        ]);

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
        if($request->input('done') != NULL ){
            $goal->done = $request->input('done');
            // Goalに紐付くSolutionも完了させる
            foreach($goal->solutions as $solution){
                if($solution->done != '1'){
                    $solution->done = '1';
                    $solution->save();
                }
                // Goal-Solutionに紐付くMilestoneも完了させる
                foreach($solution->milestones as $milestone){
                    if($milestone->done != '1'){
                        $milestone->done ='1';
                        $milestone->save();
                    }
                }
            }
            $flash_message = "Goalをアーカイブしました。";
        } else {
            $validated = $request->validate([
                'goal_content' => 'required',
                'merit' => 'required',
                'start_content' => 'required'
            ]);

            $goal->classification = $request->input('classification');
            $goal->goal_content = $request->input('goal_content');
            $goal->merit = $request->input('merit');
            $goal->eval = $request->input('eval');
            $goal->start_content = $request->input('start_content');
            $flash_message = "Goalの更新が完了しました。";
        }
        $goal->save();

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

// git push test for branch
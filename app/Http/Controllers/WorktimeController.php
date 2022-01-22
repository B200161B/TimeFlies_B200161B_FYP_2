<?php

namespace App\Http\Controllers;

use App\Models\TaskHistory;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorktimeController extends Controller
{
    public function index()
    {
//
//        $taskHistories = TaskHistory::query()
//            ->where('')


        $taskHistories = User::query()
//            ->with('tasks')
            ->with('taskHistories.task')

            ->find(Auth::id());


//        dd($taskHistories);

        foreach ($taskHistories->taskHistories as $history) {

            $start = Carbon::parse($history->start);
            $end = Carbon::parse($history->end);

            $history->duration = $start->diff($end)->format('%d days %H hours %i minutes');


        }

//        $taskHistories->taskHistories->sortByDesc('created_at');
//        $taskHistories->taskHistories->values()->all();

//        return response()->json($taskHistories);

        return view('Worktime.index',compact('taskHistories'));
    }
}

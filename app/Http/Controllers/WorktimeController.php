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


        if (auth()->guard('companyStaff')->check()) {


            $taskHistories = collect();
            $taskHistoriesQuery = User::query()
                //            ->with('tasks')
                ->with(['taskHistories.task.project','taskHistories.task.user'])
                ->get();


            foreach ($taskHistoriesQuery as $item) {

                if ($item->taskHistories->count() > 0){
                    $taskHistories->add($item->taskHistories);
                }

            }

            $taskHistories = $taskHistories[0];

            foreach ($taskHistories as $history) {


                $start = Carbon::parse($history->start);
                $end = Carbon::parse($history->end);
                $history->duration = $start->diff($end)->format('%d days %H hours %i minutes %s seconds');
            }

//            return response()->json($taskHistories);
        } else {
            $taskHistories = User::query()
                //            ->with('tasks')
                ->with(['taskHistories.task', 'taskHistories.task.project',])
                ->find(Auth::id());


            foreach ($taskHistories->taskHistories as $history) {
                $start = Carbon::parse($history->start);
                $end = Carbon::parse($history->end);
                $history->duration = $start->diff($end)->format('%d days %H hours %i minutes %s seconds');
            }

//            return response()->json($taskHistories);
        }


//        return response()->json($taskHistories);


//        $taskHistories->taskHistories->sortByDesc('created_at');
//        $taskHistories->taskHistories->values()->all();

//        return response()->json($taskHistories);

        return view('Worktime.index', compact('taskHistories'));
    }
}

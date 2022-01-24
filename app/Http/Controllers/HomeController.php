<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Reminders;
use App\Models\TaskHistory;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Workspaces;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $userId = auth()->id();
        $workspaces = Workspaces::all();
//        $projects = Projects::all();

        $projects = User::query()
            ->with('projects')
            ->find($userId)
        ->projects;


//        return response($projects);

        //Filter Tasks that belong to user
        $tasks = Tasks::query()
            ->where('users_id', $userId)
            ->get();

        $events = Events::query()
            ->where('users_id', $userId)->get();
        foreach ($events as $event) {

            $start = Carbon::parse($event->start_date);
            $end = now()->toDateString();
            $event->duration = $start->diff($end)->format('%d');;
        }

//        return response()->json($events);

        $reminders = Reminders::query()
        ->where('users_id',$userId)
        ->get();
        foreach ($reminders as $reminder){
            $start = Carbon::parse($reminder->date);
            $end = now()->toDateString();
            $reminder->duration = $start->diff($end)->format('%d');;
        }



        $doingTask = Tasks::query()
            ->withWhereHas('history', function ($query) {
                $query->where('end', null);
            })
            ->where('users_id', $userId)
            ->where('status', 'Doing')->first();

        if ($doingTask) {
            $doingTaskHistory = $doingTask->history[0];

            return view('home', [
                'workspaces' => $workspaces,
                'projects' => $projects,
                'tasks' => $tasks,
                'events' => $events,
                'reminders' => $reminders,
                'doingTaskHistory' => $doingTaskHistory,
//                'dateString' =>$dateString,

            ]);
        }

        return view('home', [
            'workspaces' => $workspaces,
            'projects' => $projects,
            'tasks' => $tasks,
            'events' => $events,
            'reminders' => $reminders,
//            'dateString' =>$dateString,
        ]);


    }
}

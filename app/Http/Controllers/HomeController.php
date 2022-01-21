<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Reminders;
use App\Models\TaskHistory;
use App\Models\Tasks;
use App\Models\Workspaces;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->id();


        $workspaces = Workspaces::all();
        $projects = Projects::all();

        //Filter Tasks that belong to user
        $tasks = Tasks::query()
            ->where('users_id', $userId)
            ->get();

        $events = Events::all();
        $reminders = Reminders::all();


        $doingTask = Tasks::query()
            ->withWhereHas('history', function ($query) {
                $query->where('end', null);
            })
            ->where('users_id', $userId)
            ->where('status', 'Doing')->get();


        //try whereHasAndWith

        return response()->json($doingTask);
        dd($doingTask->jsonSerialize());


        return view('home', [
            'workspaces' => $workspaces,
            'projects' => $projects,
            'tasks' => $tasks,
            'events' => $events,
            'reminders' => $reminders
        ]);
    }
}

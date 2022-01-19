<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Reminders;
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
        $workspaces =Workspaces::all();
        $projects = Projects::all();
        $tasks = Tasks::all();
        $events = Events::all();
        $reminders = Reminders::all();
        return view('home',[
            'workspaces'=>$workspaces,
            'projects'=>$projects,
            'tasks'=>$tasks,
            'events'=>$events,
            'reminders'=>$reminders
        ]);
    }
}

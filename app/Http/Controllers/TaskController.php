<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\TaskPriorities;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Workspaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workspaces = Workspaces::all();
        $projects = Projects::all();
        $tasks = Tasks::all();
        $events = Events::all();
        return view('home', [
            'workspaces' => $workspaces,
            'projects' => $projects,
            'tasks' => $tasks,
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        $project = Projects::all();
        return view('Task.create')->with('projects', $project);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //
        $task = Tasks::create([
            'task_name' => $request->input('task_name'),
            'due_date' => $request->input('due_date'),
            'details' => $request->input('details'),
            'users_id' => Auth::id(),
            'projects_id' => $request->input('projects_id'),
            'status' => $request->input('status'),
            'attachmentFiles' => $request->input('attachmentFiles')
        ]);
        return redirect('/home');
    }

    public function addPriority($id)
    {
        $task = Tasks::find($id);
        return view('Task.addPriority')->with('tasks', $task);
    }

    public function storePriority(Request $request, $id)
    {
        $task_id = DB::table('tasks')->where('id', $id)->value('id');
        $task_priority = TaskPriorities::create([
            'complexity_lvl' => $request->input('complexity_lvl'),
            'important_lvl' => $request->input('important_lvl'),
            'urgency_lvl' => $request->input('urgency_lvl'),
            'duration_h' => $request->input('duration_h'),
            'duration_m' => $request->input('duration_m'),
            'tasks_id' => $task_id
        ]);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    public function checkIn($id)
    {
        $tasks_id = DB::table('tasks')->where('id', $id)->value('id');
        $check_in = Tasks::create([
            'users_id' => Auth::id(),
            'tasks_id' => $task_id,

        ]);


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $project = Projects::all();
        $task = Tasks::find($id)
            ->where('id', $id)
            ->first();

        return view('Task.edit')->with('task', $task)->with('projects', $project);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        //
        $task = Tasks::where('id', $id)
            ->update([
                'task_name' => $request->input('task_name'),
                'due_date' => $request->input('due_date'),
                'details' => $request->input('details'),
                'users_id' => Auth::id(),
                'projects_id' => $request->input('projects_id'),
                'status' => $request->input('status'),
                'attachmentFiles' => $request->input('attachmentFiles')
            ]);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Tasks::find($id)->first();
        $task->delete();
        return redirect('/home');
    }
}

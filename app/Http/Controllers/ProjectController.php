<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\WorkspaceProject;
use App\Models\Workspaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workspaces =Workspaces::all();
        $projects = Projects::all();
        $tasks = Tasks::all();
        $events = Events::all();
        return view('home',[
            'workspaces'=>$workspaces,
            'projects'=>$projects,
            'tasks'=>$tasks,
            'events'=>$events,
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
        return view('Project.create');
    }
    public function addProject($id)
    {
        //
        $project=Projects::find($id);
        $workspace = Workspaces::all();
        return view('Project.addProject')->with('workspaces',$workspace)->with('project',$project);

    }
    public function storeProject(Request $request,$id)
    {

        $project_id =DB::table('projects')->where('id', $id)->value('id');
        $workspace_project = WorkspaceProject::create([
            'workspaces_id'=>$request->input('workspaces_id'),
            'projects_id'=>$project_id
        ]);

        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //
        $project = Projects::create([
            'project_name'=>$request->input('project_name'),
            'project_goal'=>$request->input('project_goal'),
            'due_date'=>$request->input('due_date')
        ]);
        return redirect('/home');
    }/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $project = Projects::find($id)
            ->where('id', $id)
            ->first();

        return view('Project.edit')->with('project',$project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        //
        $project = Projects::where('id',$id)
            ->update ([
            'project_name'=>$request->input('project_name'),
            'project_goal'=>$request->input('project_goal'),
            'due_date'=>$request->input('due_date')
        ]);


        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //
        $project=Projects::find($id)->first();
        $project->delete();
        return redirect('/home');

    }
}

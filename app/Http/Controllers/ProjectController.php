<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\WorkspaceProject;
use App\Models\Workspaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function editProjectWorkspace($id)
    {
        $project_id =$id;
        $project=Projects::find($id);
//
        $workspace_id = DB::table('workspace_projects')->where('projects_id',$id)->value('workspaces_id');
        $workspaces = Workspaces::all();
        return view('Project.changeWorkspace')
            ->with('project_id',$project_id)
            ->with('workspace_id',$workspace_id)
            ->with('workspaces',$workspaces)
            ->with('project',$project);
    }
    public function changeWorkspace(Request $request,$id)
    {

        $workspace_projects=WorkspaceProject::where('projects_id',$id)
            ->update([
            'workspaces_id'=>$request->input('workspaces_id'),
            'projects_id'=>$id
        ]);
        $workspace_project = DB::table('workspace_projects')
            ->join('workspaces','workspace_projects.workspaces_id','=','workspaces.id')
            ->join('projects','workspace_projects.projects_id','=','projects.id')
            ->join('users','workspaces.in_charged_by','=','users.id')
            ->select('workspaces.*','projects.*','projects.id as project_id','users.name')
            ->where('workspace_projects.projects_id',$id)
            ->get();


        return view('Company.viewProject')->with('workspace_project',$workspace_project);

    }
    public function storeProject(Request $request,$id)
    {

        $project_id =DB::table('projects')->where('id', $id)->value('id');
        $workspace_project = WorkspaceProject::create([
            'workspaces_id'=>$request->input('workspaces_id'),
            'projects_id'=>$project_id
        ]);
        if (Auth::guard('companyStaff')->check()){
            return redirect()->route('company.home');
        }

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
            'due_date'=>$request->input('due_date'),
            'users_id'=>Auth::id()
        ]);
        if (Auth::guard('companyStaff')->check()){
            return redirect()->route('company.home');
        }
        return redirect('/home');
    }/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $projects = Projects::query()
            ->with(['task','createdBy'])
            ->find($id);
//        $project_tasks = DB::table('workspace_projects')
//            ->join('tasks','workspace_projects.projects_id','=','tasks.projects_id')
//            ->join('projects','workspace_projects.projects_id','=','projects.id')
//            ->join('users','tasks.users_id','=','users.id')
//            ->select('tasks.*','tasks.id as task_id','projects.*','users.name','tasks.due_date as t_due')
//            ->where('workspace_projects.projects_id',$id)
//            ->get();
//        $project_info = DB::table('workspace_projects')
//            ->join('projects','workspace_projects.projects_id','=','projects.id')
//            ->join('users','projects.users_id','=','users.id')
//            ->select('projects.*','users.name')
//            ->where('workspace_projects.projects_id',$id)
//            ->first();

//            dd($workspace_project);
//        $workspaces_projects = Workspaces::find($id)->projects;
        return view('Project.viewProjectTasks')->with('projects',$projects);

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

        if (Auth::guard('companyStaff')->check()){
            return redirect()->route('company.home');
        }

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
        if (Auth::guard('companyStaff')->check()){
            return redirect()->route('company.home');
        }
        return redirect('/home');

    }
}

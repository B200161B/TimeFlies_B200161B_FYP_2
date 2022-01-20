<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Workspaces;
use App\Models\WorkspaceUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkspaceController extends Controller
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
        return view('Company.home',[
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
        return view('Workspace.create');
    }
    public function addUser($id)
    {
        $users=User::all();
        $workspace = Workspaces::find($id);
        return view('Workspace.addUser')->with('workspace',$workspace)->with('users',$users);
    }
    public function storeUser(Request $request,$id)
    {

        $workspace_id =DB::table('workspaces')->where('id', $id)->value('id');
        $workspace_user = WorkspaceUsers::create([
                'workspaces_id'=>$workspace_id,
                'users_id'=>$request->input('users_id')
            ]);
       return redirect('/workspace');
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
        if ($request->has('form_add_workspace'))
        {
            $workspace = Workspaces::create([
                'workspace_name'=>$request->input('workspace_name'),
                'in_charged_by'=>$request->input('in_charged_by')
            ]);
        }
//        $workspace_id =DB::table('workspaces')->where('workspace_name', $request->get('workspace_name'))->value('id');

        return redirect('/home');
    }

    /**
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
        $workspace = Workspaces::find($id)
            ->where('id', $id)
            ->first();

        return view('Workspace.edit')->with('workspace',$workspace);
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
        $workspace = Workspaces::where('id',$id)
            ->update([
            'workspace_name'=>$request->input('workspace_name'),
            'in_charged_by'=>$request->input('in_charged_by')
        ]);

        return redirect('/workspace');
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
        $workspace = Workspaces::find($id)->first();
        $workspace->delete();
        return redirect('/home');
    }
}

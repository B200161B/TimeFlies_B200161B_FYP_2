<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use App\Models\WorkspaceProject;
use App\Models\Workspaces;
use App\Models\WorkspaceUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkspaceController extends Controller
{

    public function index()
    {
        //
        $workspaces = Workspaces::all();
        $projects = Projects::all();
        $tasks = Tasks::all();
        $events = Events::all();
        $users = User::all();
        return view('Company.home', [
            'workspaces' => $workspaces,
            'projects' => $projects,
            'tasks' => $tasks,
            'events' => $events,
            'users' => $users,
        ]);
    }

    public function create()
    {
        $companyId = Auth::guard('companyStaff')->user()->companies_id;

        $company = Company::query()
            ->with('users')
            ->find($companyId);

        $users = $company->users;

        return view('Workspace.create', compact('users'));
    }

    public function addUser($id)
    {
        $companyId = Auth::guard('companyStaff')->user()->companies_id;

        $company = Company::query()
            ->with('companyUsers.user.workspace')
//            ->doesntHave('companyUsers.user.workspace')
            ->find($companyId);


        $users = User::query()
            ->whereDoesntHave('workspace')
            ->get();

        $users = $company->companyUsers;


        $workspace = Workspaces::query()
            ->with('workspaceusers.user')
            ->find($id);

        $currentWorkspaceUser = $workspace->workspaceusers;

        foreach ($users as $user) {


            foreach ($currentWorkspaceUser as $key => $currentUser) {

                if ($currentUser->users_id == $user->user_id) {
                    info($currentUser);
                    unset($users[$key]);
                    break;
                }


            }

        }

        return view('Workspace.addUser', compact( 'workspace', 'users', 'currentWorkspaceUser'));
    }

    public function storeUser(Request $request, $id)
    {

        $workspace_id = DB::table('workspaces')->where('id', $id)->value('id');
        $workspace_user = WorkspaceUsers::create([
            'workspaces_id' => $workspace_id,
            'users_id' => $request->input('users_id')
        ]);
        return redirect()->route('company.home');
    }

    public function store(Request $request)
    {
        //
        if ($request->has('form_add_workspace')) {
            $workspace = Workspaces::create([
                'workspace_name' => $request->input('workspace_name'),
                'in_charged_by' => $request->input('in_charged_by')
            ]);
        }
//        $workspace_id =DB::table('workspaces')->where('workspace_name', $request->get('workspace_name'))->value('id');

        return redirect()->route('company.home');
    }

    public function show($id)
    {


        $workspace = Workspaces::query()
            ->with(['projects.projectInfo', 'inChargePerson'])
            ->find($id);

//        dd($workspace->projects);
//        return response()->json($workspace);
//        $project_info = $workspace->projectInfo;
//        return response()->json($workspace);

//            $workspace_project = DB::table('workspace_projects')
//                ->join('workspaces','workspace_projects.workspaces_id','=','workspaces.id')
//                ->join('projects','workspace_projects.projects_id','=','projects.id')
//                ->join('users','workspaces.in_charged_by','=','users.id')
//                ->select('workspaces.*','projects.*','projects.id as project_id','users.name')
//                ->where('workspace_projects.workspaces_id',$id)
//                ->get();

//        $workspaces_projects = Workspaces::find($id)->projects;

        return view('Company.viewProject', compact('workspace'));

    }

    public function edit($id)
    {
        //
        $users = User::all();
        $workspace = Workspaces::find($id)
            ->with('inChargePerson')
            ->where('id', $id)
            ->first();

//        return response($workspace);

        return view('Workspace.edit')->with('workspace', $workspace)->with('users', $users);
    }


    public function update(Request $request, $id)
    {
        //
        $workspace = Workspaces::where('id', $id)
            ->update([
                'workspace_name' => $request->input('workspace_name'),
                'in_charged_by' => $request->input('in_charged_by')
            ]);

        return redirect()->route('company.home');
    }


    public function destroy($id)
    {
        //
        $workspace = Workspaces::find($id)->first();
        $workspace->delete();
        return redirect()->route('company.home');
    }
}

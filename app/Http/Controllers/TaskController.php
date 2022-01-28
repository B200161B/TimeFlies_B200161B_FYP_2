<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\TaskHistory;
use App\Models\TaskPriorities;
use App\Models\Tasks;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\Workspaces;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * @return \Illuminate\Contracts\Foundation\Application|RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $task = Tasks::create([
            'task_name' => $request->input('task_name'),
            'due_date' => $request->input('due_date'),
            'details' => $request->input('details'),
            'users_id' => Auth::id(),
            'projects_id' => $request->input('projects_id'),
            'status' => $request->input('status'),
        ]);

        if ($request->hasFile('attachmentFiles')) {
            $image = $request->file('attachmentFiles');
            $folderName = 'files/' . Auth::id();
            $uploadPath = public_path() . '/' . $folderName;
            $logoFileName = $image->getClientOriginalName();
            $image->move($uploadPath, $logoFileName);
            $path = $folderName;
            $task->attachmentFiles = $path;
        }

        if ($task->save()){
            return redirect('/home');

        }


    }

    public function addUsers($id)
    {
        $task = Tasks::find($id);
        $users = User::all();
        return view('Task.addUsers')->with('task',$task)->with('users',$users);
    }
    public function storeUsers(Request $request,$id)
    {
        $task_user = TaskUser::create([
            'tasks_id'=>$id,
            'users_id'=>$request->input('users_id')
        ]);
        if (Auth::guard('companyStaff')->check()){
            return redirect()->route('company.home');
        }

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        //
        $tasks = Tasks::query()
            ->with(['createdBy','taskUser.addedUsers'])
            ->find($id);
        return view('Task.show')->with('tasks',$tasks);

    }

    public function checkIn(Request $request): RedirectResponse
    {

        $task_id = $request->input('task_id');
        $note = $request->input('note');


        $history = TaskHistory::create([
            'tasks_id' => $task_id,
            'start' => now(),
            'note' => $note
        ]);


        return redirect()->route('home');

    }

    public function checkOut($taskHistoryId): RedirectResponse
    {

        try {
            $taskHistory = TaskHistory::query()->findOrFail($taskHistoryId);
            $taskHistory->update([
               'end'=>now(),
            ]);

            if ($taskHistory->save()){
                return redirect()->route('home');

            }

            return redirect()->route('home')->with('error', 'Problem occurs, try later');
        } catch
        (ModelNotFoundException $exception) {
            return redirect()->route('home')->with('error', 'Problem occurs, try later');
        }
    }


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
     * @return \Illuminate\Contracts\Foundation\Application|RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        //
//        dd($request->input('status'));
        $status = $request->input('status');
        if($status==null)
        {
            $status = Tasks::query()
                ->find($id)
                ->status;
        }

        $task = Tasks::where('id', $id)
            ->update([
                'task_name' => $request->input('task_name'),
                'due_date' => $request->input('due_date'),
                'details' => $request->input('details'),
                'users_id' => Auth::id(),
                'projects_id' => $request->input('projects_id'),
                'status' => $status,
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

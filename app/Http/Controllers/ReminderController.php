<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Reminders;
use App\Models\Tasks;
use App\Models\Workspaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
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
        $reminders = Reminders::all();
        return view('home',[
            'workspaces'=>$workspaces,
            'projects'=>$projects,
            'tasks'=>$tasks,
            'events'=>$events,
            'reminders'=>$reminders,
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
        return view('Reminder.create');
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
        $reminder = Reminders::create([
           'purpose'=>$request->input('purpose'),
            'date'=>$request->input('date'),
            'time'=>$request->input('time'),
            'users_id'=>Auth::id()
        ]);
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
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $reminder = Reminders::find($id)
        ->where('id',$id)
        ->first();
        return view('Reminder.edit')->with('reminder',$reminder);
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
        $reminder = Reminders::where('id',$id)
            ->update([
            'purpose'=>$request->input('purpose'),
            'date'=>$request->input('date'),
            'time'=>$request->input('time'),
            'users_id'=>Auth::id()
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
        $reminder =Reminders::find($id)->first();
        $reminder->delete();
        return redirect('/home');
    }
}

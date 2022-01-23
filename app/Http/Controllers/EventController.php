<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\Workspaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::id();
        $tasks =Tasks::all();
        $workspaces =Workspaces::all();
        $projects = Projects::all();
        $today = date('Y-m-d');
        $today = date_create($today);
        $date = Events::query()
            ->where('users_id',$user_id)
            ->select('event.start_date');
        $date = date_create($date);
        $diff = date_diff($date,$today);
        $events = Events::query()
        ->where('users_id',$user_id);

        return view('home',[
            'tasks'=>$tasks,
            'workspaces'=>$workspaces,
            'projects'=>$projects,
            'events'=>$events,
            'diff'=>$diff
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
        return view('Event.create');
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
        $event = Events::create([
            'event_name'=>$request->input('event_name'),
            'start_date'=>$request->input('start_date'),
            'start_time'=>$request->input('start_time'),
            'end_date'=>$request->input('end_date'),
            'end_time'=>$request->input('end_time'),
            'details'=>$request->input('details'),
            'users_id'=>Auth::id(),
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
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        //
        $event = Events::find($id)
            ->where('id', $id)
            ->first();
        return view('Event.edit')->with('event',$event);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $event = Events::where('id',$id)
            ->update([
            'event_name'=>$request->input('event_name'),
            'start_date'=>$request->input('start_date'),
            'start_time'=>$request->input('start_time'),
            'end_date'=>$request->input('end_date'),
            'end_time'=>$request->input('end_time'),
            'details'=>$request->input('details'),
            'users_id'=>Auth::id(),
        ]);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $event = Events::find($id)->first();
        $event->delete();
        return redirect('/home');
    }
}

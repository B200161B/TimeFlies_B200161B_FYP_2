@extends('layouts.app')
@push('css')
    <style>

    </style>
@endpush
@section('content')
<div class="container">

<div class="m-5">
    <div class="row col-10 ">
    <h2>Workspace</h2>
   <button class="btn btn-secondary"><a href="workspace/create">Create</a></button>
    </div>

    <div class="row col-10">
    @foreach($workspaces as $workspace)
        <h3>{{$workspace->workspace_name}}</h3>
        <button class="btn btn-secondary"><a href="workspace/{{$workspace->id}}/edit">Edit</a></button>
            <p>  </p>
        <button class="btn btn-secondary"><a href="workspace/{{$workspace->id}}/addUser">Add Employee</a></button>
            <p>  </p>
            <form action="/workspace/{{$workspace->id}}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
           <p>  </p>
    @endforeach
    </div>
    <div class="row col-10">
        <h2>Project</h2>
        <button class="btn btn-secondary"><a href="project/create">Create</a></button>
    @foreach($projects as $project)
            <p>  </p>
            <h3>{{$project->project_name}}</h3>
            <button class="btn btn-secondary"><a href="project/{{$project->id}}/edit">Edit</a></button>
            <p>  </p>
            <button class="btn btn-secondary"><a href="project/{{$project->id}}/addProject">Add Workspace</a></button>
            <p>  </p>
            <form action="/project/{{$project->id}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <p>  </p>
    @endforeach
    </div>
    <div class="row col-10">
        <h2>Task</h2>
        <button class="btn btn-secondary"><a href="task/create">Create</a></button>

{{--        <button class="btn btn-secondary"><a href="{{route('task.create')}}">Create</a></button>--}}
        @foreach($tasks as $task)
            <p>  </p>

            <h3>{{$task->task_name}}</h3>
            <button class="btn btn-secondary"><a href="task/{{$task->id}}/edit">Edit</a></button>
            <p>  </p>
        <form action="/task/{{$task->id}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary" id="checkIn">Check In</button>
            <p>  </p>
        </form>

            <button class="btn btn-secondary"><a href="task/{{$task->id}}/addPriority">Add Priority</a></button>
            <p>  </p>
            <form action="/task/{{$task->id}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <p>  </p>
        @endforeach
    </div>
    <div class="row col-10">
        <h2>Event</h2>
        <button class="btn btn-secondary"><a href="event/create">Create</a></button>
        @foreach($events as $event)
            <p>  </p>
            <h3>{{$event->event_name}}</h3>
            <button class="btn btn-secondary"><a href="event/{{$event->id}}/edit">Edit</a></button>
            <p>  </p>
            <form action="/event/{{$event->id}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <p>  </p>
        @endforeach
    </div>
    <div class="row col-10">
        <h2>Reminder</h2>
        <button class="btn btn-secondary"><a href="reminder/create">Create</a></button>
        @foreach($reminders as $reminder)
            <p>  </p>
            <h3>{{$reminder->purpose}}</h3>
            <button class="btn btn-secondary"><a href="reminder/{{$reminder->id}}/edit">Edit</a></button>
            <p>  </p>
            <form action="/reminder/{{$reminder->id}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <p>  </p>
        @endforeach
    </div>
</div>
</div>
@endsection

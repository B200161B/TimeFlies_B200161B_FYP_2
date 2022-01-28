@extends('layouts.app')
@push('css')
    <style>

    </style>
@endpush
@section('content')
    <section class="home-section">
        <div class="modal-body">
            <h1>Tasks In {{$projects->project_name}}</h1>
            <h3>Created By
                {{$projects->createdBy->name}}</h3>
            <div class="container-fluid">
                <div class="row">
            @foreach($projects->task as $task)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                        <a href="{{route('task.show',$task->id)}}">
                                    <h2>{{$task->task_name}}</h2> </a>
                                    <a class="btn btn-secondary" href="{{route('project.editProjectWorkspace',$task->projects_id)}}">Change Workspace</a>
                                    <a class="btn btn-secondary" href="{{route('task.add-users',$task->id)}}">Add Users</a>
                                    <br>
                                    Due Date:{{$task->due_date}}
                                </div>
                            </div>

                    </div>

            @endforeach
                </div>
        </div>
        </div>


    </section>
@endsection

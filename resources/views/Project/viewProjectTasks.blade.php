@extends('layouts.app')
@push('css')
    <style>
        .home-section {
            padding: 1%;
        }

        span {
            white-space: pre;

        }
        #allTasks {
            margin-left: 5%;
        }

        html {
            overflow-y: scroll;
        }
        .box {
            width: 100%;
            height: 100px;
            background-color: #272c4a;
            margin-left: 10px;
            margin-bottom: 2%;
            margin-right: 3%;
            padding: 10px;
            color: whitesmoke;
            border-radius: .30rem;
            text-align: center;
            box-sizing: content-box;
        }

        .box-content {
            text-align: left;
            font-size: small;
        }
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
                                    <button class="btn btn-secondary"><a href="{{route('project.editProjectWorkspace',$task->projects_id)}}">Change Workspace</a></button>
                                    <button class="btn btn-secondary"><a href="{{route('task.add-users',$task->id)}}">Add Users</a></button>
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

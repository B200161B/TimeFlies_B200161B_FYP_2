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
        <div class="row col-10 ">
            <h1>Tasks In {{$projects->project_name}}</h1>
            <div class="row col-10 ">
            <h3>Created By
                {{$projects->createdBy->name}}</h3>
            </div>
            @foreach($projects->task as $task)

                <div class="row" id="allTasks">
                    <div class="col-3">
                        <a href="{{route('task.show',$task->id)}}">
                            <div class="box">
                                <div class="box-content">
                                    <h2>{{$task->task_name}}</h2>
                                    <button class="btn btn-secondary"><a href="{{route('project.editProjectWorkspace',$task->projects_id)}}">Change Workspace</a></button>
                                    <br>
                                    Due Date:{{$task->due_date}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>



    </section>
@endsection

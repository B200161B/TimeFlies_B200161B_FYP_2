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
                <h1>Projects In {{$workspace->workspace_name}}</h1>
                <div class="row col-10 ">
                    <h3>In Charged By
                    {{$workspace->inChargePerson->name}}</h3>
                </div>

                @foreach($workspace->projects as $project)

                    <div class="row" id="allTasks">
                        <div class="col-3">

                            <a href="{{ route('project.show', $project->projectInfo->id) }}">
                                <div class="box">
                                    <div class="box-content">
                                        {{$project->projectInfo->project_name}}
                                        <button class="btn btn-secondary"><a href="{{route('project.editProjectWorkspace',$project->projectInfo->id)}}">Change Workspace</a></button>
                                        <br>
                                        Due Date:{{$project->projectInfo->due_date}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>



    </section>
@endsection

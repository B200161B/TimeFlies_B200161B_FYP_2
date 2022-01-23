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
                <h1>Projects In {{$workspace->workspace_name}}</h1>
                <h3>In Charged By
                    {{$workspace->inChargePerson->name}}</h3>
             <div class="container-fluid">
                 <div class="row">
                @foreach($workspace->projects as $project)
                         <div class="col-4">
                             <div class="card">
                                 <div class="card-body">
                            <a href="{{ route('project.show', $project->projectInfo->id) }}">
                                        {{$project->projectInfo->project_name}}</a>
                                     <p class="card-text"> Due Date:{{$project->projectInfo->due_date}}</p>
                                       <a class="btn btn-secondary" href="{{route('project.editProjectWorkspace',$project->projectInfo->id)}}">Change Workspace</a>
                                    </div>
                                </div>
                        </div>

                @endforeach
            </div>
             </div>
         </div>
    </section>
@endsection

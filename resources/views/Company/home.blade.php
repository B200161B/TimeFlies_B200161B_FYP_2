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
        <div class="m-5">
            <div class="row col-10 ">
                <h2>Workspace</h2>
                <button class="btn btn-secondary"><a href="{{route('workspace.create')}}">Create</a></button>
            </div>

            <div class="row" id="allTasks">

                @foreach($workspaces as $workspace)
                    <div class="col-3">
                            <div class="box">
                                <div class="box-content">
                                    <a href="{{route('workspace.show',$workspace->id)}}">{{$workspace->workspace_name}}</a>
                                    <button class="btn btn-secondary"><a href="{{route('workspace.edit',$workspace->id)}}">Edit</a></button>
                                    <button class="btn btn-secondary"><a href="{{route('workspace.addUser',$workspace->id)}}">Add Employee</a></button>
                                    <form action="{{route('workspace.destroy',$workspace->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form> <br>
                                    In Charge By:{{$workspace->inChargePerson->name}}
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection

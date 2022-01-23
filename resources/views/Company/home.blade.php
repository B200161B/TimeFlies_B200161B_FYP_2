@extends('layouts.app')
@push('css')
    <style>
        .btnCreate {
            background: #272c4a;
            color: whitesmoke;
            right: 77%;
            display: inline-block;
        }
    </style>
@endpush
@section('content')
    <section class="home-section">
        <div class="row">
            <div class="col">
                <div class="text">Workspace
                    <button class="btn btnCreate"><a href="{{route('workspace.create')}}">Create</a></button>
                </div>

            </div>

        </div>

        <div class="container-fluid">
            <div class="row">
                @foreach($workspaces as $workspace)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route('workspace.show',$workspace->id)}}">
                                    <h5 class="card-title">{{$workspace->workspace_name}}</h5></a>
                                <p class="card-text">In Charge By:{{$workspace->inChargePerson->name}}</p>

                                <a class="btn btn-secondary" href="{{route('workspace.edit',$workspace->id)}}">Edit</a>
                                <a class="btn btn-secondary"
                                   href="{{route('workspace.addUser',$workspace->id)}}">Add Employee
                                </a>
                                <form style="display:inline" action="{{route('workspace.destroy',$workspace->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


    </section>
@endsection

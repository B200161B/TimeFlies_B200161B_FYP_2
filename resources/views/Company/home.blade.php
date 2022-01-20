@extends('layouts.app')
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
        </div>
    </div>
@endsection

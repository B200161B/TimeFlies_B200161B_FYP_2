@extends('layouts.app')

@section('content')
    <section class="home-section">
    <form action="{{route('project.storeProject',$project->id)}}" method="POST">
        @csrf
        @method('GET')
        <div class="modal-body">
            <h1>Add Project to Workspace</h1>
            <div class="form-group">
                <label class="col  col-form-label" name="project_name">Project Name: {{$project->project_name}}</label>
                <label class="col  col-form-label">Workspace ID:</label>
                <input type="text" class="form-control" list="browsers" name="workspaces_id" id="workspaces" autocomplete="off">
                <datalist id="browsers">
                    @foreach($workspaces as $workspace)
                        <option value="{{$workspace->id}}">{{$workspace->workspace_name}}
                    @endforeach
                </datalist>
            </div>
            <button type="submit" class="btn float-right btn-primary" >Add</button>
        </div>
    </form>
    </section>
@endsection

@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/project/{{$project->id}}/storeProject" method="POST">
        @csrf
        @method('GET')
        <div class="modal-body">

            <div class="form-group">
                <label class="col  col-form-label" name="project_name">Project Name: {{$project->project_name}}</label>
                <label for="col  col-form-label">Workspace ID:</label>
                <input list="browsers" name="workspaces_id" id="workspaces" autocomplete="off">
                <datalist id="browsers">
                    @foreach($workspaces as $workspace)
                        <option value="{{$workspace->id}}">
                    @endforeach
                </datalist>

            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Add</button>
        </div>
    </form>
    </div>
@endsection

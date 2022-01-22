@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="{{route('workspace.update',$workspace->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <h1>Update Workspace</h1>
            <div class="form-group">
                <label class="col  col-form-label">Workspace Name</label>
                <input type="text" class="form-control" name="workspace_name" value="{{$workspace->workspace_name}}">
                <label class="col  col-form-label">In Charged By</label>
                <input list="browsers" name="in_charged_by" id="users" autocomplete="off"  value="{{$workspace->in_charged_by}}">
                <datalist id="browsers">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">
                    @endforeach
                </datalist>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" id="close" ><a href="{{ url()->previous() }}">Close</a></button>
        </div>
    </form>
    </div>
@endsection

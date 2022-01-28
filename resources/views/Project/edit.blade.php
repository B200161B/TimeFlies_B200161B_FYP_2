@extends('layouts.app')
@push('css')
    <style>
        .btn-secondary {
            background-color: #272c4a;
            color: whitesmoke;
        }
    </style>
@endpush
@section('content')
    <section class="home-section">
    <form action="/project/{{$project->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <h1>Update Project</h1>
            <div class="form-group">
                <label class="col  col-form-label">Project Name</label>
                <input type="text" class="form-control" name="project_name" value="{{$project->project_name}}">
                <label class="col  col-form-label">Project Goal</label>
                <textarea class="form-control" rows="4" cols="50" name="project_goal" >{{$project->project_goal}}</textarea>
                <label class="col col-form-label">Due Date</label>
                <input type="date" class="form-control" name="due_date" value="{{$project->due_date}}">
            </div>
            <button type="button" class="btn float-right btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
            <button type="submit" class="btn float-right btn-primary mr-1" >Add</button>
        </div>
    </form>
    </section>
@endsection

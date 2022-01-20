@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/task/{{$task->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <h1>Update Task</h1>
            <div class="form-group">
                <label class="col  col-form-label">Task Name</label>
                <input type="text" class="form-control" name="task_name" value="{{$task->task_name}}">
                <label class="col col-form-label">Due Date</label>
                <input type="date" class="form-control" name="due_date" value="{{$task->due_date}}">
                <label class="col  col-form-label">Details</label>
                <textarea class="form-control" rows="4" cols="50" name="details" placeholder="Write your details here...">{{$task->details}}</textarea>
                <label class="col-form-label">Status:</label>
                <select class="form-select" name="status" >
                    <option selected disabled hidden>{{$task->status}}</option>
                    <option value="Plan">Plan</option>
                    <option value="Doing">Doing</option>
                    <option value="Review">Review</option>
                    <option value="Done">Done</option>
                </select>
                <label class="col  col-form-label">Attachment Files:</label>
                <input type="file" name="attachmentFiles" id="attachmentFiles" class="form-control" value="{{$task->attachmentFiles}}">
                <label for="col  col-form-label">Is it under any projects?</label>
                <select class="form-control"  name="projects_id" id="project" autocomplete="off">
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->project_name }}</option>
                    @endforeach
                </select>


            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Update</button>
            <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
        </div>
    </form>
    </div>

@endsection

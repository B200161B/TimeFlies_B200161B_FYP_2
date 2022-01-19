@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/task" method="POST" id="addTaskForm">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label class="col  col-form-label">Task Name</label>
                <input type="text" class="form-control" name="task_name">
                <label class="col col-form-label">Due Date</label>
                <input type="date" class="form-control" name="due_date">
                <label class="col  col-form-label">Details</label>
                <textarea class="form-control" rows="4" cols="50" name="details" placeholder="Write your details here..."></textarea>
                <label class="col-form-label">Status:</label>
                <select class="form-select" name="status" >
                    <option value="Plan">Plan</option>
                    <option value="Doing">Doing</option>
                    <option value="Review">Review</option>
                    <option value="Done">Done</option>
                </select>
                <label class="col  col-form-label">Attachment Files:</label>
                <input type="file" name="attachmentFiles" id="attachmentFiles" class="form-control">
                <label for="col  col-form-label">Is it under any projects?</label>
                <input class="form-control" list="browsers" name="projects_id" id="project" autocomplete="off">
                <datalist id="browsers">
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">
                    @endforeach
                </datalist>

            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
        </div>
    </form>
    </div>

@endsection



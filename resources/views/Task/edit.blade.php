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
                <select class="form-select" name="status"  >
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
            <button type="button" class="btn float-right btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
            <button type="submit" class="btn float-right btn-primary mr-1  " >Update</button>
        </div>
    </form>
    </section>

@endsection

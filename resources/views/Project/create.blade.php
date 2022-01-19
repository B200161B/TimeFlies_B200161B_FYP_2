@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/project" method="POST">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label class="col  col-form-label">Project Name</label>
                <input type="text" class="form-control" name="project_name">
                <label class="col  col-form-label">Project Goal</label>
                <textarea class="form-control" rows="4" cols="50" name="project_goal" placeholder="Write your project goal here..."></textarea>
                <label class="col col-form-label">Due Date</label>
                <input type="date" class="form-control" name="due_date">

            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Add</button>
            <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
        </div>
    </form>
    </div>

@endsection

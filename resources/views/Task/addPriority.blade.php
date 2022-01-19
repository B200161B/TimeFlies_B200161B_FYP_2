@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/task/{{$tasks->id}}/storePriority" method="POST">
        @csrf
        @method('GET')
        <div class="modal-body">

            <div class="form-group">
                <label class="col-form-label">Complexity Level:</label>
                <select class="form-select" name="complexity_lvl" >
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="extreme">Extreme</option>
                </select>
                <label class="col-form-label">Important Level:</label>
                <select class="form-select" name="important_lvl" >
                    <option value="not important">Not Important</option>
                    <option value="somewhat important">Somewhat Important</option>
                    <option value="important">Important</option>
                    <option value="very important">Very Important</option>
                </select>
                <label class="col-form-label">Urgency Level:</label>
                <select class="form-select" name="urgency_lvl" >
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="extreme">Extreme</option>
                </select>
                <label class="col-form-label">How much time do you think it will take to complete?</label>
                <div class="row">
                    <div class="col-6 col-sm-3"><input type="text" class="form-control" name="duration_h"></div>Hours
                    <div class="col-6 col-sm-3"><input type="text" class="form-control col-6 col-sm-3" name="duration_m"></div>Minutes
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
    </div>
@endsection

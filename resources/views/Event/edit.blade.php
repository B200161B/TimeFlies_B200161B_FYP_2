@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/event/{{$event->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <h1>Update Event</h1>
            <div class="form-group">
                <label class="col  col-form-label">Event Name</label>
                <input type="text" class="form-control" name="event_name" value="{{$event->event_name}}">
                <label class="col col-form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="{{$event->start_date}}">
                <label class="col col-form-label">Start Time</label>
                <input type="time" class="form-control" name="start_time" value="{{$event->start_time}}">
                <label class="col col-form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" value="{{$event->end_date}}">
                <label class="col col-form-label">End Time</label>
                <input type="time" class="form-control" name="end_time" value="{{$event->end_time}}">
                <label class="col  col-form-label">Details</label>
                <textarea class="form-control" rows="4" cols="50" name="details" placeholder="Write your details here...">{{$event->details}}</textarea>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Update</button>
            <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
        </div>
    </form>
    </div>

@endsection

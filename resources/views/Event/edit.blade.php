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
            <button type="button" class="btn float-right btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
            <button type="submit" class="btn float-right btn-primary mr-1" >Update</button>
        </div>
    </form>
    </section>

@endsection

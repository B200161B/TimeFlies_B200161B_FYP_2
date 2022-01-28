@extends('layouts.app')

@section('content')
    <section class="home-section">
        <form action="{{route('event.store'}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="col  col-form-label">Event Name</label>
                    <input type="text" class="form-control" name="event_name">
                    <label class="col col-form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date">
                    <label class="col col-form-label">Start Time</label>
                    <input type="time" class="form-control" name="start_time">
                    <label class="col col-form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date">
                    <label class="col col-form-label">End Time</label>
                    <input type="time" class="form-control" name="end_time">
                    <label class="col  col-form-label">Details</label>
                    <textarea class="form-control" rows="4" cols="50" name="details" placeholder="Write your details here..."></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
            </div>
        </form>
    </section>>

@endsection



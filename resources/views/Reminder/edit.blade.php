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
        <form action="/reminder/{{$reminder->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <h1>Update Reminder</h1>
                <div class="form-group">
                    <label class="col  col-form-label">Remind Me To...</label>
                    <input type="text" class="form-control" name="purpose" value="{{$reminder->purpose}}">
                    <label class="col col-form-label">Date</label>
                    <input type="date" class="form-control" name="date" value="{{$reminder->date}}">
                    <label class="col col-form-label">Time</label>
                    <input type="time" class="form-control" name="time" value="{{$reminder->time}}">
                </div>
                <button type="button" class="btn float-right btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
                <button type="submit" class="btn float-right btn-primary mr-1">Update</button>
            </div>
        </form>
    </section>

@endsection



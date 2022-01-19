@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
        <form action="/reminder" method="POST">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label class="col  col-form-label">Remind Me To...</label>
                    <input type="text" class="form-control" name="purpose">
                    <label class="col col-form-label">Date</label>
                    <input type="date" class="form-control" name="date">
                    <label class="col col-form-label">Time</label>
                    <input type="time" class="form-control" name="time">
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
            </div>
        </form>
    </div>

@endsection



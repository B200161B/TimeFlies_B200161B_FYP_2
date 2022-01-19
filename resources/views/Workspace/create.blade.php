@extends('layouts.app')

@section('content')
    <div class="p-5 m-5">
    <form action="/workspace" method="POST">
        @csrf

        <div class="modal-body">

            <div class="form-group">
                <label class="col  col-form-label">Workspace Name</label>
                <input type="text" class="form-control" name="workspace_name">
                <label class="col  col-form-label">In Charged By</label>
                <input type="text" class="form-control" name="in_charged_by">



            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="form_add_workspace">Add</button>
            <button type="button" class="btn btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
        </div>
    </form>
    </div>

@endsection

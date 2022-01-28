@extends('layouts.app')
@push('css')
    <style>
        .btn-secondary{
            background-color: #0c1021;
        }
    </style>
@endpush
@section('content')
    <section class="home-section">
    <form action="{{ route('workspace.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <h1>Create Workspace</h1>
            <div class="form-group">
                <label class="col  col-form-label">Workspace Name</label>
                <input type="text" class="form-control" name="workspace_name">
                <label class="col  col-form-label">In Charged By</label>

                <input list="browsers" class="form-control" name="in_charged_by" id="users" autocomplete="off">
                <datalist id="browsers">
                    @foreach($users as $user)
                        <option value="{{$user->user_id}}">{{$user->user->name}}
                    @endforeach
                </datalist>
            </div>
            <button type="button" class="btn float-right btn-secondary" id="close"><a href="{{ url()->previous() }}">Close</a></button>
            <button type="submit" class="btn float-right btn-primary mr-1" name="form_add_workspace">Add</button>

        </div>
    </form>
    </section>

@endsection

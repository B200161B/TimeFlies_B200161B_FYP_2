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
    <form action="{{route('workspace.update',$workspace->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <h1>Update Workspace</h1>
            <div class="form-group">
                <label class="col  col-form-label">Workspace Name</label>
                <input type="text" class="form-control" name="workspace_name" value="{{$workspace->workspace_name}}">
                <label class="col  col-form-label">In Charged By</label>
                <input list="browsers" name="in_charged_by" id="users" autocomplete="off"  class="form-control"  value="{{$workspace->in_charged_by}}">
                <datalist id="browsers">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}
                    @endforeach
                </datalist>
            </div>
            <button type="button" class="btn float-right btn-secondary" id="close" ><a href="{{ url()->previous() }}">Close</a></button>
            <button type="submit" class="btn float-right btn-primary  mr-1">Update</button>
        </div>
    </form>
    </section>
@endsection

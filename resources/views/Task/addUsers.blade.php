@extends('layouts.app')

@section('content')
    <form action="{{route('task.',)}}" method="POST">
        @csrf
        @method('GET')
        <div class="modal-body">

            <div class="form-group">
                <label class="col  col-form-label" name="workspace_name">Workspace Name: {{$workspace->workspace_name}}</label>
                <label for="col  col-form-label">Employee ID:</label>
                {{--                <input list="browsers" name="users_id" id="users" autocomplete="off">--}}
                {{--                <datalist id="browsers">--}}
                {{--                    @foreach($users as $user)--}}
                {{--                        <option value="{{$user->id}}">{{$user->name }}</option>--}}
                {{--                    @endforeach--}}
                {{--                </datalist>--}}
                <select multiple data-select>
                    <input type="text" list="datalist" name="users_id" id="users" autocomplete="off">
                    <datalist id="datalist">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name }}</option>
                        @endforeach
                    </datalist>
                </select>

            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="form_add_user_to_space">Add</button>
        </div>

    </form>
@endsection

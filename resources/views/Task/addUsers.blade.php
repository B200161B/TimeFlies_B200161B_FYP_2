@extends('layouts.app')

@section('content')
    <section class="home-section">
    <form action="{{route('task.store-users',$task->id)}}" method="POST">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label class="col  col-form-label" name="task_name">Task Name: {{$task->task_name}}</label>
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
            <button type="submit" class="btn btn-primary">Add</button>
        </div>

    </form>
    </section>
@endsection

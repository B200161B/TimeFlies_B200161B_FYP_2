@extends('layouts.app')

@section('content')
    <section class="home-section">
    <form action="{{route('task.store-users',$task->id)}}" method="POST">
        @csrf
        <div class="modal-body">
            <h1>Add User In Task</h1>
            <div class="form-group">
                <label class="col  col-form-label" name="task_name">Task Name: {{$task->task_name}}</label>
                <label class="col  col-form-label">Employee ID:</label>
                <input type="text" class="form-control" list="datalist" name="users_id" id="users" autocomplete="off">
                    <datalist id="datalist">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name }}</option>
                        @endforeach
                    </datalist>


            </div>
            <button type="submit" class="btn float-right btn-primary">Add</button>
        </div>

    </form>
    </section>
@endsection

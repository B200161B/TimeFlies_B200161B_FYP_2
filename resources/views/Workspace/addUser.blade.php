@extends('layouts.app')
@push('css')
    <style>
        .thead{
            background-color: #272c4a;
            color: whitesmoke;
        }
    </style>
@endpush
@section('content')
    <section class="home-section">
                    <form action="{{route('workspace.storeUser',$workspace->id)}}" method="POST">
                        @csrf
                        @method('GET')
                        <div class="modal-body">
                            <h1>Create Workspace</h1>
                            <div class="form-group">
                                <label class="col col-form-label">Workspace Name: {{$workspace->workspace_name}}</label>
                                <label class="col col-form-label">Employee ID:</label>
                                    <input type="text" class="form-control" list="browsers" name="users_id" id="users" autocomplete="off">
                                    <datalist id="browsers">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name }}</option>
                                        @endforeach
                                    </datalist>
                            </div>
                            <button type="submit" class="btn float-right btn-primary" name="form_add_user_to_space">Add</button>
                        </div>

                    </form>

        <div class="modal-body">
                    <h1>Current Employee List</h1>
                    <table class="table">
                        <thead class="thead">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            {{--                            <th scope="col">Status</th>--}}
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($currentWorkspaceUser as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->user->name}}</td>
                                <td>{{$user->user->email}}</td>
                                {{--                                <td>{{$user->pivot->status}}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

    </section>
@endsection

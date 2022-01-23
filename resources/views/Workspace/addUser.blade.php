@extends('layouts.app')

@section('content')

    <section class="home-section">

        <div class="container-fluid">

            <div class="row">
                <div class="col">
                    <h1><b>Add User</b></h1>
                </div>

            </div>

            <div class="row pt-5">
                <div class="col">
                    <form action="{{route('workspace.storeUser',$workspace->id)}}" method="POST">
                        @csrf
                        @method('GET')
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="col col-form-label">Workspace Name: {{$workspace->workspace_name}}</label>
                                <label for="col col-form-label">Employee ID:</label>
                                {{--                <input list="browsers" name="users_id" id="users" autocomplete="off">--}}
                                {{--                <datalist id="browsers">--}}
                                {{--                    @foreach($users as $user)--}}
                                {{--                        <option value="{{$user->id}}">{{$user->name }}</option>--}}
                                {{--                    @endforeach--}}
                                {{--                </datalist>--}}
{{--                                <select multiple data-select>--}}
                                    <input type="text" class="form-control" list="datalist" name="users_id" id="users" autocomplete="off">
                                    <datalist id="datalist">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name }}</option>
                                        @endforeach
                                    </datalist>
{{--                                </select>--}}

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="form_add_user_to_space">Add</button>
                        </div>

                    </form>
                </div>

            </div>

            <div class="row pt-5">
                <div class="col">
                    <h1><b>Current Employee List</b></h1>
                </div>

            </div>

            <div class="row pt-5">
                <div class="col">

                    <table class="table">
                        <thead class="thead-dark">
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
            </div>


        </div>

    </section>
@endsection

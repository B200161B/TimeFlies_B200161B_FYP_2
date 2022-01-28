@extends('layouts.app')
@push('css')
    <style>
        thead{
            background-color: #272c4a;
            color: whitesmoke;
        }
    </style>
@endpush
@section('content')
    <section class="home-section">
        <div class="modal-body">
            <h1>{{$tasks->task_name}}</h1>
                <h3>Created By
                    {{$tasks->createdBy->name}}</h3>
        </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Group Users</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($tasks->taskUser as $user)
                        <tr><td>{{$user->addedUsers->name}}</td></tr>

                    @endforeach
                </tbody>
            </table>

    </section>
@endsection

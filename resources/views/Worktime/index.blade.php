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
                    <h1>Work Time Record</h1>
                    <table class="table table-striped">
                        @if(auth()->guard('companyStaff')->check())
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Task Name</th>
                                <th scope="col">In</th>
                                <th scope="col">Out</th>
                                <th scope="col">Duration</th>
                                <th scope="col">User</th>
                                <th scope="col">Note</th>
                            </tr>
                            </thead>
                        @else
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Task Name</th>
                            <th scope="col">In</th>
                            <th scope="col">Out</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Note</th>
                        </tr>
                        </thead>
                        @endif
                        <tbody>

                        @if(auth()->guard('companyStaff')->check())

                            @foreach($taskHistories as $taskHistory)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$taskHistory->task->project->project_name}}</td>
                                    <td>{{$taskHistory->task->task_name}}</td>
                                    <td>{{$taskHistory->start}}</td>
                                    <td>{{$taskHistory->end}}</td>
                                    <td>{{$taskHistory->duration}}</td>
                                    <td>{{$taskHistory->task->user->name}}</td>
                                    @if(isset($taskHistory->note))
                                        <td><textarea class="form-control" rows="3" readonly>{{ $taskHistory->note}}</textarea>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach

                        @else

                            @foreach($taskHistories->taskHistories as $taskHistory)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$taskHistory->task->project->project_name}}</td>
                                    <td>{{$taskHistory->task->task_name}}</td>
                                    <td>{{$taskHistory->start}}</td>
                                    <td>{{$taskHistory->end}}</td>
                                    <td>{{$taskHistory->duration}}</td>
                                    @if(isset($taskHistory->note))
                                        <td> <textarea class="form-control" rows="3" readonly>{{ $taskHistory->note  }}</textarea></td>
                                    @else
                                        <td></td>

                                    @endif
                                </tr>
                            @endforeach

                        @endif



                        </tbody>
                    </table>
        </div>
    </section>
@endsection

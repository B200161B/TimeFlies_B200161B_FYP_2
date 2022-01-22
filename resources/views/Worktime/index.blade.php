@extends('layouts.app')

@section('content')
    <section class="home-section">

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1><b>Work Time Record</b></h1>
                </div>

            </div>

            <div class="row pt-5">
                <div class="col">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Task Name</th>
                            <th scope="col">In</th>
                            <th scope="col">Out</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Note</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($taskHistories->taskHistories as $taskHistory)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$taskHistory->task->task_name}}</td>
                                <td>{{$taskHistory->start}}</td>
                                <td>{{$taskHistory->end}}</td>
                                <td>{{$taskHistory->duration}}</td>
                                @if(isset($taskHistory->note))
                                    <td> <textarea class="form-control" rows="3">{{ $taskHistory->note  }}</textarea></td>
                                @else
                                    <td></td>

                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </section>
@endsection

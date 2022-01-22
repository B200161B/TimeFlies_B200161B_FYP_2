@extends('layouts.app')

@section('content')
    <section class="home-section">
        <div class="row col-10 ">
            <h1>{{$tasks->task_name}}</h1>
            <div class="row col-10 ">`
                <h3>Created By
                    {{$tasks->createdBy->name}}</h3>
            </div>
            <div class="row col-10 ">
                <h3>In Charged By
                    {{$tasks->createdBy->name}}</h3>
            </div>

        </div>
    </section>
@endsection

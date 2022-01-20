@extends('layouts.app')
@push('css')
    <style>
        #plus {
            margin: -1% 0 0;
        }

        .fa {
            font-size: 20px;
            color: whitesmoke;

        }

        .fa:hover {
            color: brown;
        }

        #fa-remove {
            display: none;
        }

        .home-section {
            padding: 1%;
        }

        span {
            white-space: pre;

        }

        button {
            padding: 10px 20px;
            font-size: 15px;
            font-weight: 600;
            color: #222;
            background: #f5f5f5;
            border: none;
            outline: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btnCheckIn {
            background: #272c4a;
            color: whitesmoke;
            /*margin-left: 60%;*/
            right: 28%;
            position: absolute;
            display: inline-block;
        }

        .btnCheckIn:hover {
            color: #fcffa6;
        }

        .btnCreate {
            background: #272c4a;
            color: whitesmoke;
            margin-left: 60%;
            right: 16%;
            position: absolute;
            display: inline-block;
        }

        .btnCreate:hover {
            color: #fcffa6;
        }

        .btnRemove {
            background: #272c4a;
            color: whitesmoke;
            right: 4%;
            position: absolute;
        }

        .btnRemove:hover {
            color: #fcffa6;
        }


        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }
            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }
            to {
                top: 0;
                opacity: 1
            }
        }

        .modal-header {
            /*padding: 2px 16px;*/
            background-color: #272c4a;
            color: white;
        }

        .modal-button, #btnRemove {
            margin-top: 18px;
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;

        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-footer {
            /*padding: 2px 16px;*/
            background-color: #272c4a;
            color: white;
        }

        #allTasks {
            margin-left: 5%;
        }

        html {
            overflow-y: scroll;
        }

        .members {
            display: flex;
            margin-top: 14px;
        }

        .members img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 4px;
            object-fit: cover;
        }

        /*.right-bar {*/
        /*    width: 320px;*/
        /*    border-left: 1px solid #e3e7f7;*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*}*/

        .right-bar .header {
            font-size: 20px;
            color: gray;
            margin-left: 30px;
        }

        .top-part {
            padding: 30px;
            align-self: flex-end;
        }

        .top-part img {
            width: 14px;
            height: 14px;
            color: black;
            margin-right: 14px;
        }

        .top-part .count {
            font-size: 12px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            background-color: #623ce8;
            color: #fff;
            justify-content: center;
        }

        .right-content {
            padding: 10px 40px;
            overflow-y: auto;
            flex: 1;
        }

        .task-box {
            position: relative;
            border-radius: 12px;
            width: 100%;
            margin: 20px 0;
            padding: 16px;
            cursor: pointer;
            box-shadow: 2px 2px 4px 0px rgba(235, 235, 235, 1);
        }

        .task-box:hover {
            transform: scale(1.02);
        }

        .time {
            margin-bottom: 6px;
            opacity: 0.4;
            font-size: 10px;
        }

        .task-name {
            font-size: 14px;
            font-weight: 500;
            opacity: 0.6;
        }

        .yellow {
            background-color: lightgoldenrodyellow;
        }

        .blue {
            background-color: #e2f0fb;
        }

        .red {
            background-color: darksalmon;
        }

        .green {
            background-color: palegreen;
        }

        .more-button {
            position: absolute;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background-color: #8e92a4;
            box-shadow: 0 -4px 0 0 #8e92a4, 0 4px 0 0 #8e92a4;
            opacity: 0.4;
            right: 20px;
            top: 30px;
            cursor: pointer;
        }

        /*  */
        .box {
            width: 100%;
            height: 100px;
            background-color: #272c4a;
            margin-left: 10px;
            margin-bottom: 2%;
            margin-right: 3%;
            padding: 10px;
            color: whitesmoke;
            border-radius: .30rem;
            text-align: center;
            box-sizing: content-box;
        }

        .box-content {
            text-align: left;
            font-size: small;
        }

    </style>
@endpush
@section('content')
    <section class="home-section">
        <div class="row">
            <div class="col-8">
                <div class="text">Task</div>
                <button class="btn btnCheckIn modal-button" type="button" href="#checkInModal">Check In</button>
                <button class="btn btnCreate modal-button" type="button" href="#myModal1">Create</button>
                <button class="btn btnRemove" type="button" id="btnRemove">Remove</button>

                <!-- The Modal -->
                <div id="checkInModal" class="modal ">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Check In <b><i>In Progress </i></b>Task</h5>

                        </div>
                        <form method="POST" action="{{ route('task.store')}}">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                                <button type="button" class="btn btn-secondary" id="close" onclick="myClose()">Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- The Modal -->
                <div id="myModal1" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adding Task</h5>

                        </div>
                        <form method="POST" action="{{ route('task.store')}}">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col  col-form-label">Task Name:</label>
                                    <input type="text" class="form-control" name="task_name" id="taskName">
                                    <label class="col  col-form-label">Due Date:</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control">
                                    <label class="col  col-form-label">Details:</label>
                                    <textarea name="details" id="details" class="form-control"></textarea>
                                    <label class="col-form-label">Status:</label>
                                    <select class="form-control" name="status">
                                        <option value="Plan">Plan</option>
                                        <option value="Doing">Doing</option>
                                        <option value="Review">Review</option>
                                        <option value="Done">Done</option>
                                    </select>
                                    <label class="col  col-form-label">Attachment Files:</label>
                                    <input type="file" name="attachmentFiles" id="attachmentFiles" class="form-control">
                                    <label for="col  col-form-label">Is it under any projects?</label>
                                    <select class="form-control"  name="projects_id" id="project" autocomplete="off">
                                        <option value="0">No</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" id="close" onclick="myClose()">Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row" id="allTasks">

                    <div class="col-3">
                        <div class="box">
                            Planning
                            @foreach($tasks as $task)
                                @if($task->status == 'Plan')
                                    <div class="box-content">
                                        <a href="{{ route('task.edit',[$task->id]) }}">
                                            <div id="tName">{{$task->task_name}}</div>
                                        </a>
                                        <i class="fa fa-remove" id="fa-remove" onclick="delFunction()"></i>

                                    </div>
                                @endif
                            @endforeach
                        </div>


                    </div>
                    <div class="col-3">

                        <div class="box">
                            <span>In Progress</span>
                            @foreach($tasks as $task)
                                @if($task->status == 'Doing')
                                    <div class="box-content">
                                        <a href="{{ route('task.edit',[$task->id]) }}">{{$task->task_name}}</a>
                                        <i class="fa fa-remove" id="fa-remove"></i>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div class="col-3">

                        <div class="box">
                            Reviewing
                            @foreach($tasks as $task)
                                @if($task->status == 'Review')
                                    <div class="box-content"><a
                                            href="{{ route('task.edit',[$task->id]) }}">{{$task->task_name}}</a>
                                        <i class="fa fa-remove" id="fa-remove"></i>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div class="col-3">

                        <div class="box">
                            Done
                            @foreach($tasks as $task)
                                @if($task->status == 'Done')
                                    <div class="box-content">
                                        <a href="{{ route('task.edit',[$task->id]) }}">{{$task->task_name}}</a>
                                        <i class="fa fa-remove" id="fa-remove"></i>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>

                </div>

                <div class="text">Projects</div>
                <button class="btn btnCreate modal-button" href="#myModal2" type="button">Create</button>
                <button class="btn btnRemove modal-button" type="button">Remove</button>
                <div id="myModal2" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adding Project</h5>

                        </div>
                        <form method="POST" action="{{ route('project.store')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col  col-form-label">Project Name</label>
                                    <input type="text" class="form-control" name="project_name">
                                    <label class="col  col-form-label">Project Goal</label>
                                    <textarea class="form-control" rows="4" cols="50" name="project_goal"
                                              placeholder="Write your project goal here..."></textarea>
                                    <label class="col col-form-label">Due Date</label>
                                    <input type="date" class="form-control" name="due_date">

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" id="close" onclick="myClose()">Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" id="allTasks">

                    @foreach($projects as $project)
                        <div class="col-3">
                            <a href="{{ route('project.edit',[$project->id]) }}">
                                <div class="box">
                                    <div class="box-content">
                                        {{$project->project_name}}<br>
                                        Due Date:{{$project->due_date}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="right-bar col-4">
                <div class="header">Schedule
                    <button class="btn btnCreate modal-button " type="button" id="plus" href="#myModal4">&#43;</button>
                    <div id="myModal4" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adding</h5>
                            </div>
                            <button class="btn modal-button " type="button" href="#myModal3">Event</button>
                            <button class="btn modal-button " type="button" href="#myModal5">Reminder</button>
                        </div>
                    </div>
                    <div id="myModal3" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adding Event</h5>
                            </div>
                            <form method="POST" action="{{ route('event.store')}}">
                                @csrf
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label class="col  col-form-label">Event Name:</label>
                                        <input type="text" class="form-control" name="eventName" id="eventName">
                                        <label class="col  col-form-label">Start Date:</label>
                                        <input type="date" name="startDate" id="startDate" class="form-control">
                                        <label class="col  col-form-label">End Date:</label>
                                        <input type="date" name="endDate" id="endDate" class="form-control">
                                        <label class="col  col-form-label">Start Time:</label>
                                        <input type="time" name="startTime" id="startTime" class="form-control">
                                        <label class="col  col-form-label">End Time:</label>
                                        <input type="time" name="endTime" id="endTime" class="form-control">
                                        <label class="col  col-form-label">Remark:</label>
                                        <textarea name="remark" id="remark" class="form-control"></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-secondary" id="close" onclick="myClose()">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="myModal5" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adding Reminder</h5>
                            </div>
                            <form method="POST" action="{{ route('reminder.store')}}">
                                @csrf
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label class="col  col-form-label">Reminder Me to:</label>
                                        <input type="text" class="form-control" name="purpose" id="purpose">
                                        <label class="col  col-form-label">Start Date:</label>
                                        <input type="date" name="startDate" id="startDate" class="form-control">
                                        <label class="col  col-form-label">End Date:</label>
                                        <input type="date" name="endDate" id="endDate" class="form-control">
                                        <label class="col  col-form-label">Start Time:</label>
                                        <input type="time" name="startTime" id="startTime" class="form-control">
                                        <label class="col  col-form-label">End Time:</label>
                                        <input type="time" name="endTime" id="endTime" class="form-control">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-secondary" id="close" onclick="myClose()">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="right-content">
                    <p>Today</p>

                    @foreach($events as $event)
                        <a href="{{ route('event.edit',[$event->id]) }}">
                            @if($event->StartDate == date('Y-m-d') )
                                <div class="task-box yellow">
                                    <div class="description-task">
                                        <div class="time">{{$event->StartTime}} - {{$event->EndTime}}</div>
                                        <div class="task-name">{{$event->eventName}}</div>

                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    @foreach($reminders as $reminder)
                        <a href="{{ route('reminder.edit',[$reminder->id]) }}">
                            @if($reminder->StartDate == date('Y-m-d') )
                                <div class="task-box red">
                                    <div class="description-task">
                                        <div class="time">{{$reminder->StartTime}} - {{$reminder->EndTime}}</div>
                                        <div class="task-name">{{$reminder->purpose}}</div>
                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    <p>Tomorrow</p>

                    @foreach($events as $event)
                        <a href="{{ route('event.edit',[$event->id]) }}">
                            @if(now()->addDays()->toDateString() == \Carbon\Carbon::parse($event->StartDate)->toDateString())
                                <div class="task-box yellow">
                                    <div class="description-task">
                                        <div class="time">{{$event->StartTime}} - {{$event->EndTime}}</div>
                                        <div class="task-name">{{$event->eventName}}</div>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @endforeach
                    @foreach($reminders as $reminder)
                        <a href="{{ route('reminder.edit',[$reminder->id]) }}">
                            @if(now()->addDays()->toDateString() == \Carbon\Carbon::parse($reminder->StartDate)->toDateString())
                                <div class="task-box red">
                                    <div class="description-task">
                                        <div class="time">{{$reminder->StartTime}} - {{$reminder->EndTime}}</div>
                                        <div class="task-name">{{$reminder->purpose}}</div>
                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                </div>

            </div>
        </div>

    </section>
    <div class="container">

        <div class="m-5">
            <div class="row col-10 ">
                <h2>Workspace</h2>
                <button class="btn btn-secondary"><a href="workspace/create">Create</a></button>
            </div>

            <div class="row col-10">
                @foreach($workspaces as $workspace)
                    <h3>{{$workspace->workspace_name}}</h3>
                    <button class="btn btn-secondary"><a href="workspace/{{$workspace->id}}/edit">Edit</a></button>
                    <p></p>
                    <button class="btn btn-secondary"><a href="workspace/{{$workspace->id}}/addUser">Add Employee</a>
                    </button>
                    <p></p>
                    <form action="/workspace/{{$workspace->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <p></p>
                @endforeach
            </div>
            <div class="row col-10">
                <h2>Project</h2>
                <button class="btn btn-secondary"><a href="project/create">Create</a></button>
                @foreach($projects as $project)
                    <p></p>
                    <h3>{{$project->project_name}}</h3>
                    <button class="btn btn-secondary"><a href="project/{{$project->id}}/edit">Edit</a></button>
                    <p></p>
                    <button class="btn btn-secondary"><a href="project/{{$project->id}}/addProject">Add Workspace</a>
                    </button>
                    <p></p>
                    <form action="/project/{{$project->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <p></p>
                @endforeach
            </div>
            <div class="row col-10">
                <h2>Task</h2>
                <button class="btn btn-secondary"><a href="task/create">Create</a></button>

                <button class="btn btn-secondary"><a href="{{route('task.create')}}">Create</a></button>
                @foreach($tasks as $task)
                    <p></p>

                    <h3>{{$task->task_name}}</h3>
                    <button class="btn btn-secondary"><a href="task/{{$task->id}}/edit">Edit</a></button>
                    <p></p>
                    <form action="/task/{{$task->id}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary" id="checkIn">Check In</button>
                        <p></p>
                    </form>

                    <button class="btn btn-secondary"><a href="task/{{$task->id}}/addPriority">Add Priority</a></button>
                    <p></p>
                    <form action="/task/{{$task->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <p></p>
                @endforeach
            </div>
            <div class="row col-10">
                <h2>Event</h2>
                <button class="btn btn-secondary"><a href="event/create">Create</a></button>
                @foreach($events as $event)
                    <p></p>
                    <h3>{{$event->event_name}}</h3>
                    <button class="btn btn-secondary"><a href="event/{{$event->id}}/edit">Edit</a></button>
                    <p></p>
                    <form action="/event/{{$event->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <p></p>
                @endforeach
            </div>
            <div class="row col-10">
                <h2>Reminder</h2>
                <button class="btn btn-secondary"><a href="reminder/create">Create</a></button>
                @foreach($reminders as $reminder)
                    <p></p>
                    <h3>{{$reminder->purpose}}</h3>
                    <button class="btn btn-secondary"><a href="reminder/{{$reminder->id}}/edit">Edit</a></button>
                    <p></p>
                    <form action="/reminder/{{$reminder->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <p></p>
                @endforeach
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        // Get the button that opens the modal
        let btn = document.querySelectorAll("button.modal-button");

        // All page modals
        let modals = document.querySelectorAll('.modal');
        let box = document.getElementsByClassName("box-content");
        let remove = document.getElementById('btnRemove');
        let faRemove = document.getElementById('fa-remove');
        let removeFa = document.querySelectorAll('#fa-remove');
        let taskName = document.querySelectorAll('#tName');
        //  closes the modal
        // let spans = document.getElementById("close");
        function myClose() {

            for (let index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }

        }

        function delFunction() {

            // faRemove.style.display = "none"
            for (let i = 0; i < removeFa.length; i++) {
                removeFa[i].onclick = function () {
                    //taskName.style.display = "none";
                    removeFa[i].style.display = "none";
                }
            }
        }

        remove.onclick = function () {
            //faRemove.style.display = "inline";
            for (let i = 0; i < removeFa.length; i++) {
                removeFa[i].style.display = "inline";
            }
        }

        // When the user clicks the button, open the modal
        for (let i = 0; i < btn.length; i++) {
            btn[i].onclick = function (e) {
                e.preventDefault();
                modal = document.querySelector(e.target.getAttribute("href"));
                modal.style.display = "block";
            }
        }

        // When the user clicks on <span> (x), close the modal
        // for (let i = 0; i < spans.length; i++) {
        //     spans[i].onclick = function() {
        //         for (let index in modals) {
        //             if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
        //         }
        //     }
        // }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target.classList.contains('modal')) {
                for (let index in modals) {
                    if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
                }
            }
        }
    </script>
@endpush

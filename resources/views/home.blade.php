@extends('layouts.app')
@push('css')

@endpush
@section('content')
    <section class="home-section">
        <div class="row">
            <div class="col-8">
                <div class="text">Task</div>

                @if(isset($doingTaskHistory))
                    <button class="btn btnTimer modal-button values" type="button" href="#">00:00:00:00</button>
                    <a class="btn btnCheckIn modal-button" type="button"
                       href="{{route('task.check-out',$doingTaskHistory->id)}}">Check Out</a>
                @else
                    <button class="btn btnCheckIn modal-button" type="button" href="#checkInModal">Check In</button>
                @endif


                <button class="btn btnCreate modal-button" type="button" href="#myModal1">Create</button>
                <button class="btn btnRemove" type="button" id="btnRemove">Remove</button>

                <!-- The Modal -->
                <div id="checkInModal" class="modal ">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Check In <b><i>In Progress </i></b>Task</h5>


                        </div>
                        <form method="POST" action="{{ route('task.check-in')}}">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Note</label>
                                    <textarea class="form-control" name="note" id="exampleFormControlTextarea1"
                                              rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">Task Name</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Select</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($tasks as $key=>$task)
                                            @if($task->status == 'Doing')
                                                <tr>
                                                    <td>{{$task->task_name}}</td>
                                                    <td>{{$task->details}}</td>
                                                    <td>{{$task->due_date}}</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="task_id" id="exampleRadios1"
                                                                   value="{{$task->id}}">
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach


                                        </tbody>
                                    </table>
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

                <!-- The Task Modal -->
                <div id="myModal1" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adding Task</h5>

                        </div>
                        <form method="POST" action="{{ route('task.store')}}" enctype="multipart/form-data">
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
                                    <select class="form-control" name="projects_id" id="project" autocomplete="off">
                                        <option value="">No</option>
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

                                        @isset($doingTaskHistory)
                                            @if($task->id == $doingTaskHistory->tasks_id)
                                                <a href="{{ route('task.edit',[$task->id]) }}">{{$task->task_name}}
                                                    (Current Check In)</a>
                                            @else
                                                <a href="{{ route('task.edit',[$task->id]) }}">{{$task->task_name}}</a>
                                            @endif
                                        @else
                                            <a href="{{ route('task.edit',[$task->id]) }}">{{$task->task_name}}</a>
                                        @endisset


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

                <!-- The Project Modal -->
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
                                        {{$project->project_name}}
                                        @if($project->workspace)
                                            <button class="btn btn-secondary"><a href="{{route('project.addProject',$project->id)}}">{{$project->workspace->workspace_name}}</a></button>
                                        @else
                                            <button class="btn btn-secondary"><a href="{{route('project.addProject',$project->id)}}">Add Workspace</a></button>
                                        @endif
                                        <br>
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
                                        <input type="text" class="form-control" name="event_name" id="eventName">
                                        <label class="col  col-form-label">Start Date:</label>
                                        <input type="date" name="start_date" id="startDate" class="form-control">
                                        <label class="col  col-form-label">End Date:</label>
                                        <input type="date" name="end_date" id="endDate" class="form-control">
                                        <label class="col  col-form-label">Start Time:</label>
                                        <input type="time" name="start_time" id="startTime" class="form-control">
                                        <label class="col  col-form-label">End Time:</label>
                                        <input type="time" name="end_time" id="endTime" class="form-control">
                                        <label class="col  col-form-label">Remark:</label>
                                        <textarea name="details" id="remark" class="form-control"></textarea>
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
                                        <label class="col  col-form-label">Date:</label>
                                        <input type="date" name="date" id="startDate" class="form-control">
                                        <label class="col  col-form-label">Time:</label>
                                        <input type="time" name="time" id="startTime" class="form-control">

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
                            @if($event->duration==0)
                                <div class="task-box yellow">
                                    <div class="description-task">
                                        <div class="time">{{$event->start_time}} - {{$event->end_time}}</div>
                                        <div class="task-name">{{$event->event_name}}</div>

                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    @foreach($reminders as $reminder)
                        <a href="{{ route('reminder.edit',[$reminder->id]) }}">
                            @if($reminder->duration==0)
                                <div class="task-box red">
                                    <div class="description-task">
                                        <div class="time">{{$reminder->time}}</div>
                                        <div class="task-name">{{$reminder->purpose}}</div>
                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    <p>Tomorrow</p>
                    @foreach($events as $event)
                        <a href="{{ route('event.edit',[$event->id]) }}">
                            @if($event->duration==1)
                                <div class="task-box yellow">
                                    <div class="description-task">
                                        <div class="time">{{$event->start_time}} - {{$event->end_time}}</div>
                                        <div class="task-name">{{$event->event_name}}</div>

                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    @foreach($reminders as $reminder)
                        <a href="{{ route('reminder.edit',[$reminder->id]) }}">
                            @if($reminder->duration==1)
                                <div class="task-box red">
                                    <div class="description-task">
                                        <div class="time">{{$reminder->time}}</div>
                                        <div class="task-name">{{$reminder->purpose}}</div>
                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    <p>Following...</p>
                    @foreach($events as $event)
                        <a href="{{ route('event.edit',[$event->id]) }}">
                            @if($event->duration > 1)
                                <div class="task-box yellow">
                                    <div class="description-task">
                                        <div class="date">{{$event->start_date}} - {{$event->end_date}}</div>
                                        <div class="time">{{$event->start_time}} - {{$event->end_time}}</div>
                                        <div class="task-name">{{$event->event_name}}</div>

                                    </div>
                                </div>

                            @endif
                        </a>
                    @endforeach
                    @foreach($reminders as $reminder)
                        <a href="{{ route('reminder.edit',[$reminder->id]) }}">
                            @if($reminder->duration > 1)
                                <div class="task-box red">
                                    <div class="description-task">
                                        <div class="date">{{$reminder->date}}</div>
                                        <div class="time">{{$reminder->time}}</div>
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

    @if(isset($doingTaskHistory))
        <script>

            let m1 = moment('{{$doingTaskHistory->start}}');
            let m2 = moment();

            let periodInMinute = m2.diff(m1, 'minute');

            let timerInstance = new easytimer.Timer();

            timerInstance.start({startValues: {minutes: periodInMinute}});
            timerInstance.addEventListener('secondsUpdated', function (e) {
                $('.values').html(timerInstance.getTimeValues().toString(['days', 'hours', 'minutes', 'seconds']));
            });

        </script>

    @endif
@endpush

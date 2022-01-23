<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TimeFlies') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css"
          integrity="sha512-0/rEDduZGrqo4riUlwqyuHDQzp2D1ZCgH/gFIfjMIL5az8so6ZiXyhf1Rg8i6xsjv+z/Ubc4tt1thLigEcu6Ug=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
          integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous"/>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel=”stylesheet” href="{{asset('css/select.css')}}" />


    <style>
        .btn-secondary{
            background-color: whitesmoke;
            color: #0c1021;
        }
        .btn-secondary:hover{
            background-color: #0c1021;
        }
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

        .btnTimer {
            background: #272c4a;
            color: whitesmoke;
            /*margin-left: 60%;*/
            right: 40%;
            position: absolute;
            display: inline-block;
        }

        .btnTimer:hover {
            color: #fcffa6;
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
        a{
            color: whitesmoke;
        }
        a:hover{
            color: whitesmoke;
        }
        .card{
            background-color: #272c4a;
            color: whitesmoke;

        }


    </style>
    @stack('css')


</head>
<body>

@if(auth()->guard('companyStaff')->check())
    <div id="app">
        @include('layouts.sidebar')
        @yield('content')
    </div>
@elseif(auth()->guard('web')->check())
    <div id="app">
        @include('layouts.sidebar')
        @yield('content')
    </div>
@else
    <div id="app">
        @include('layouts.header-guest')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
@endif



<!-- Scripts -->
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/easytimer.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>


<script src="{{asset('js/select.js')}}" type=”module”></script>
@stack('js')

</body>
</html>

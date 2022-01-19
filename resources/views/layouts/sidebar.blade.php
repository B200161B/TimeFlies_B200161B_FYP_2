<div class="sidebar">
    <div class="logo-details">

        <div class="logo_name">TimeFlies</div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <i class='bx bx-search'></i>
            <input type="text" placeholder="Search...">
            <span class="tooltip">Search</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="links_name">Analytics</span>
            </a>
            <span class="tooltip">Analytics</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-user'></i>
                <span class="links_name">Users</span>
            </a>
            <span class="tooltip">Users</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-chat'></i>
                <span class="links_name">Work Time</span>
            </a>
            <span class="tooltip">Work Time</span>
        </li>


        <li>
            <a href="#">
                <i class='bx bx-folder'></i>
                <span class="links_name">File Manager</span>
            </a>
            <span class="tooltip">Files</span>
        </li>

        <li>
            <a href="#">
                <i class='bx bx-cog'></i>@php

                @endphp
                <span class="links_name">Setting</span>
            </a>
            <span class="tooltip">Setting</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="{{asset('images/profile.jpg')}}" alt="profileImg">
                <div class="name_job">
                    <div class="name">{{Auth::user()->username}}</div>
                    <div class="job">Web designer</div>
                </div>
            </div>
            <i class='bx bx-log-out' id="log_out" href="{{route('logout')}}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"></i>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>



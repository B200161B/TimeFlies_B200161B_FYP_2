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
        {{--        <li>--}}
        {{--            <a href="#">--}}
        {{--                <i class='bx bx-pie-chart-alt-2'></i>--}}
        {{--                <span class="links_name">Analytics</span>--}}
        {{--            </a>--}}
        {{--            <span class="tooltip">Analytics</span>--}}
        {{--        </li>--}}
        <li>
            @auth('companyStaff')
                <a href="{{url('Company/home')}}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            @endauth
            @auth()
                <a href="{{url('/home')}}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            @endauth

        </li>
        <li>

            @auth('companyStaff')
                <a href="{{route('company-user.index')}}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            @endauth
            @auth('web')
                <a href="{{route('profile.index')}}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            @endauth
        </li>

        @auth('companyStaff')
            <li>
                <a href="{{route('worktime.index')}}">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Work Time</span>
                </a>
                <span class="tooltip">Work Time</span>
            </li>
        @endauth
        @auth('web')
            <li>
                <a href="{{route('worktime.index')}}">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Work Time</span>
                </a>
                <span class="tooltip">Work Time</span>
            </li>
        @endauth
            @auth('web')
            <li>
                <a href="{{route('file-management.index',['leftDisk' => 'files'])}}">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">File Manager</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
        @endauth


        {{--        <li>--}}
        {{--            <a href="#">--}}
        {{--                <i class='bx bx-cog'></i>@php--}}

        {{--                    @endphp--}}
        {{--                <span class="links_name">Setting</span>--}}
        {{--            </a>--}}
        {{--            <span class="tooltip">Setting</span>--}}
        {{--        </li>--}}
        <li class="profile">
            <div class="profile-details">
                <img src="{{asset('images/profile.jpg')}}" alt="profileImg">
                <div class="name_job">
                    @if(auth()->guard('companyStaff')->check())
                        {{--                        <div class="name">{{Auth::id()}}</div>--}}

                    @else
                        {{--                        <div class="name">{{Auth::user()->username}}</div>--}}

                    @endif
                    <div class="job">Web designer</div>
                </div>
            </div>
            <i class='bx bx-log-out' id="log_out" href="#" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"></i>
        </li>
    </ul>

    @if(auth()->guard('companyStaff')->check())
        <form id="logout-form" action="{{ route('company.logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endif
</div>







<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">main</li>

                <li>
                    <a href="{{ route('dashboard-teacher') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('schedules-teacher') }}" class="waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Schedules</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('courses-teacher') }}" class="waves-effect">
                        <i class="ti-clipboard"></i>
                        <span>Courses</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('resume-teacher') }}" class="waves-effect">
                        <i class="ti-bookmark-alt"></i>
                        <span>Resume</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="{{ route('absent-schedule-teacher') }}" class="waves-effect">
                        <i class="ti-bookmark-alt"></i>
                        <span>Data Absent</span>
                    </a>
                </li> --}}

                {{-- <li>
                    <a href="{{ route('absents.index') }}" class="waves-effect">
                        <i class="ti-bookmark-alt"></i>
                        <span>Resume Absent</span>
                    </a>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    </div>
    <!-- Left Sidebar End -->

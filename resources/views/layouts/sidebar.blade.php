<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">main</li>

            <li>
                <a href="{{ route('dashboard') }}" class="waves-effect">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('classrooms.index') }}" class="waves-effect">
                    <i class="ti-layout-grid2"></i>
                    <span>Classrooms</span>
                </a>
            </li>

            <li>
                <a href="{{ route('rooms.index') }}" class="waves-effect">
                    <i class="ti-layout-placeholder"></i>
                    <span>Rooms</span>
                </a>
            </li>

            <li>
                <a href="{{ route('courses.index') }}" class="waves-effect">
                    <i class="ti-clipboard"></i>
                    <span>Courses</span>
                </a>
            </li>

            <li>
                <a href="{{ route('schedules.index') }}" class="waves-effect">
                    <i class="ti-calendar"></i>
                    <span>Schedules</span>
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('absents.index') }}" class="waves-effect">
                    <i class="ti-tag"></i>
                    <span>Absent</span>
                </a>
            </li> --}}

            <li class="menu-title">users</li>

            <li>
                <a href="{{ route('teachers.index') }}" class="waves-effect">
                    <i class="mdi mdi-account-box-outline"></i>
                    <span>Teacher</span>
                </a>
            </li>

            <li>
                <a href="{{ route('students.index') }}" class="waves-effect">
                    <i class="mdi mdi-account-box-multiple-outline"></i>
                    <span>Student</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->

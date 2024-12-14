<div class="left-sidenav">
    <ul class="metismenu left-sidenav-menu">
        @if(Auth::User()->role == 1)
            <li class="{{ (request()->is('admin/teachers*')) ? 'mm-active' : '' }}">
                <a href="{{ route('teachers.index') }}">
                    <i class="ti-user"></i>
                    <span>Quản lý Giáo viên</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/students*')) ? 'mm-active' : '' }}">
                <a href="{{ route('students.index') }}">
                    <i class="ti-user"></i>
                    <span>Quản lý Học sinh</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/classes*')) ? 'mm-active' : '' }}">
                <a href="{{ route('classes.index') }}">
                    <i class="ti-home"></i>
                    <span>Quản lý Lớp học</span>
                </a>
            </li>
        @elseif(Auth::User()->role == 2)
            <li class="{{ (request()->is('admin/classes*')) ? 'mm-active' : '' }}">
                <a href="{{ route('classes.index') }}">
                    <i class="ti-home"></i>
                    <span>Quản lý Lớp học</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/subjects*')) ? 'mm-active' : '' }}">
                <a href="{{ route('subjects.index') }}">
                    <i class="ti-view-list-alt"></i>
                    <span>Quản lý Môn học</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/chapters*')) ? 'mm-active' : '' }}">
                <a href="{{ route('chapters.index') }}">
                    <i class="ti-list-ol"></i>
                    <span>Quản lý Chương bài học</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/lessons*')) ? 'mm-active' : '' }}">
                <a href="{{ route('lessons.index') }}">
                    <i class="ti-book"></i>
                    <span>Quản lý Bài học</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/reviews*')) ? 'mm-active' : '' }}">
                <a href="{{ route('reviews.index') }}">
                    <i class="ti-pencil-alt"></i>
                    <span>Quản lý Bài ôn tập</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/tests*')) ? 'mm-active' : '' }}">
                <a href="{{ route('tests.index') }}">
                    <i class="ti-bookmark-alt"></i>
                    <span>Quản lý Bài kiểm tra</span>
                </a>
            </li>
        @else
            <li class="{{ (request()->is('admin/student-reviews*')) ? 'mm-active' : '' }}">
                <a href="{{ route('student-reviews.index') }}">
                    <i class="ti-book"></i>
                    <span>Bài ôn tập</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/student-tests*')) ? 'mm-active' : '' }}">
                <a href="{{ route('student-tests.index') }}">
                    <i class="ti-bookmark-alt"></i>
                    <span>Bài kiểm tra</span>
                </a>
            </li>
        @endif

    </ul>
</div>

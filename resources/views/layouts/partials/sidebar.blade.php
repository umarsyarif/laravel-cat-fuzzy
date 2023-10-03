@php
    use App\Enums\UserRoles;
    $currentUrl = url()->current();
    $user = Auth::user();
    $role = $user->role;
@endphp

<aside class="menu-sidebar2 d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('assets/images/logo-cat-white1.png') }}" alt="logo" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @switch($role)
                @case(UserRoles::Admin)
                    {{-- Admin Menu --}}
                    <li class="{{ $currentUrl == route('dashboard') ? 'active' : '' }} has-sub">
                        <a class="js-arrow" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="{{ $currentUrl == route('user.index') ? 'active' : '' }} has-sub">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-user"></i>Data Pengguna
                        </a>
                    </li>
                    <li class="{{ $currentUrl == route('student.index') ? 'active' : '' }} has-sub">
                        <a href="{{ route('student.index') }}">
                            <i class="fas fa-user"></i>Data Siswa
                        </a>
                    </li>
                    <li class="{{ $currentUrl == route('question.index') ? 'active' : '' }} has-sub">
                        <a href="{{ route('question.index') }}">
                            <i class="fas fa-table"></i>Bank Soal
                        </a>
                    </li>
                    <li class="{{ $currentUrl == route('exam.index') ? 'active' : '' }} has-sub">
                        <a href="{{ route('exam.index') }}">
                            <i class="fas fa-chart-bar"></i>Data Ujian
                        </a>
                    </li>
                    @break
                @case(UserRoles::Student)
                    <li class="{{ $currentUrl == route('dashboard') ? 'active' : '' }} has-sub">
                        <a class="js-arrow" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="{{ $currentUrl == route('exam.index') ? 'active' : '' }} has-sub">
                        <a href="{{ route('exam.index') }}">
                            <i class="fas fa-chart-bar"></i>Data Ujian
                        </a>
                    </li>
                @break
                @default

                @endswitch
            </ul>
        </nav>
    </div>
</aside>

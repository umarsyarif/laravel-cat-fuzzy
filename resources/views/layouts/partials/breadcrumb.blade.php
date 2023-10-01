@php
    $data = $breadcrumbs ?? [];
@endphp
<div class="au-breadcrumb-content">
    <div class="au-breadcrumb-left">
        <span class="au-breadcrumb-span">You are here:</span>
        <ul class="list-unstyled list-inline au-breadcrumb__list">
            <li class="list-inline-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @foreach ($data as $key => $breadcrumb)
                <li class="list-inline-item seprate">
                    <span>/</span>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route($key) }}">{{ $breadcrumb }}</a>
                </li>
            @endforeach
            <li class="list-inline-item seprate">
                <span>/</span>
            </li>
            <li class="list-inline-item active">@yield('title')</li>
        </ul>
    </div>
</div>

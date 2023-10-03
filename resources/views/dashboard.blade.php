@php
    use App\Enums\UserRoles;
    $title = 'Dashboard';
    $role = Auth::user()->role;
@endphp
@extends('layouts.admin_template')
@section('title', $title)
@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        @includeWhen($role == UserRoles::Admin, 'dashboard.admin-dashboard')
        @includeWhen($role == UserRoles::Student, 'dashboard.student-dashboard')
    </div>
</div>

@endsection

@push('scriptjs')

@endpush

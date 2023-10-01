@php
    $title = 'Dashboard';
@endphp
@extends('layouts.admin_template')
@section('title', $title)
@section('content')

<div class="mt-3">
    <p>Selamat datang <b>{{ Auth::user()->name }}</b>, anda adalah {{ Auth::user()->role }}.&ensp;Silahkan pilih menu yang tersedia untuk mengelola aplikasi ini</p>
</div>

<div class="row m-t-25">
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">10,368</h2>
            <span class="desc">Pengguna</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">388,688</h2>
            <span class="desc">Soal</span>
            <div class="icon">
                <i class="zmdi zmdi-chart"></i>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scriptjs')

@endpush

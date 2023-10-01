@php
    $title = 'Tambah Pengguna';
    $breadcrumbs = ['user.index' => 'Data Pengguna']
@endphp
@section('title', $title)
@extends('layouts.admin_template')
@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">@yield('title')</h2>
                    @include('layouts.partials.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row m-t-25">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h5 class="m-0 font-weight-bold">
                            <i class="fas fa-plus"></i>&ensp;Tambah Pengguna
                        </h5>
                        <a type="button" href="{{ route('user.index') }}" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- display erorr --}}
                        @if ($message = Session::get('success'))
                            <div class="alert alert-primary alert-missible">
                                {{ $message }}
                                <button class="close" type="button" data-dismiss="alert">x</button>
                            </div>
                        @elseif ($message = Session::get('failed'))
                            <div class="alert alert-danger alert-missible">
                                {{ $message }}
                                <button class="close" type="button" data-dismiss="alert">x</button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-missible">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body card-block">
                                <form action="{{ route('user.store') }}" method="POST" class="form-horizontal">
                                    @include('user.user-form')
                                    <div class="modal-footer">
                                        <a href="{{ route('user.index') }}" class="btn btn-danger">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scriptsjs')

@endpush

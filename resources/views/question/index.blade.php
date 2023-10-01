@php
    $title = 'Bank Soal';
@endphp
@extends('layouts.admin_template')
@section('title', $title)
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
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h5 class="m-0 font-weight-bold">
                            <i class="fas fa-table"></i>&ensp;{{ $title }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <a class='btn btn-light' href="{{ route('question.create') }}"><i class="fas fa-plus"></i>&ensp;Tambah</a>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-white" style="background-color: #365cad;">
                                    <tr>
                                        <th>No</th>
                                        <th>Soal</th>
                                        <th>Indeks Daya Beda</th>
                                        <th>Indeks Kesukaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->question }}</td>
                                            <td>{{ $row->value }}</td>
                                            <td>{{ $row->category }}</td>
                                            <td>
                                                <div class="au-btn-group text-center d-flex" role="group">
                                                    <a class="btn btn-info btn-sm" href="{{ route('question.edit', $row->id) }}" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                    <button type="button" data-target="#modal-delete-question-{{$row->id}}" class="btn btn-danger btn-sm ml-1" data-placement="top" title="Delete" data-toggle="modal" data-target="#hapususer"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($questions as $row)
<div class="modal fade" id="modal-delete-question-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">
                    <i class="fas fa-trash"></i>&emsp; Hapus Soal
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('question.destroy', $row->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    @method('DELETE')
                    <div class="row form-group">
                        <div class="col col-md justify-content">
                            <label>Apakah anda ingin menghapus Soal dengan kode <b style="color: red">123</b> ini ?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="reset" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')

@endpush

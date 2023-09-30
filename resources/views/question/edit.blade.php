@php
    $title = 'Bank Soal - Edit Soal'
@endphp
@extends('layouts.admin_template')
@section('title', $title)
@section('content')

            <div class="row m-t-25">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h5 class="m-0 font-weight-bold">
                                <i class="zmdi zmdi-edit"></i>&ensp;Edit Soal
                            </h5>
                            <a type="button" href="{{ route('question.index') }}" class="close" data-dismiss="modal" aria-label="Close">
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
                                        <form action="{{ route('question.update', $question->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            @method('PUT')
                                            @include('question.question-form')
                                            <div class="modal-footer">
                                                <input type="submit" name="save" class="btn btn-primary"value="Simpan">
                                                <input type="reset" name="reset" class="btn btn-danger" data-dismiss="modal" value="Batal">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir si data baru -->
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

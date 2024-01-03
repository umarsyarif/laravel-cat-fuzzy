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
                            <table class="table table-bordered" id="dataTable-pagination" data-url="{{ route('question..api') }}" width="100%" cellspacing="0">
                                <thead class="text-white" style="background-color: #365cad;">
                                    <tr>
                                        <th>Kode Soal</th>
                                        <th>Soal</th>
                                        <th>Indeks Kesukaran</th>
                                        <th>Indeks Daya Beda</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($questions as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->question }}</td>
                                            <td>{{ $row->difficulty_level }}</td>
                                            <td>{{ $row->different_power }}</td>
                                            <td>
                                                <div class="au-btn-group text-center d-flex" role="group">
                                                    <a class="btn btn-info btn-sm" href="{{ route('question.edit', $row->id) }}" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                    <button type="button" data-target="#modal-delete-question-{{$row->id}}" class="btn btn-danger btn-sm ml-1" data-placement="top" title="Delete" data-toggle="modal" data-target="#hapususer"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete-question" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
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
                <form id="modal-delete-form" action="{{ route('question.index') }}" method="POST" class="form-horizontal">
                    @csrf
                    @method('DELETE')
                    <div class="row form-group">
                        <div class="col col-md justify-content">
                            <label>Apakah anda ingin menghapus Soal <b style="color: red" id="modal-delete-question-code"></b> ?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Call the dataTables jQuery plugin
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const table = $('#dataTable-pagination');
    const dataUrlApi = table.data('url');
    const questionUrl = "{{ route('question.index') }}"

    const deleteQuestion = (id) => {
        // change url to specific row
        $('#modal-delete-form').attr('action', `${questionUrl}/${id}`);
    };

    $(document).ready(function() {
        $('#dataTable').DataTable();

        table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: dataUrlApi,
                type: "POST",
                data: function (data) {
                    data.search = $('input[type="search"]').val();
                }
            },
            order: ['0', 'DESC'],
            pageLength: 10,
            searching: true,
            aoColumns: [
                {
                    data: 'question_code',
                },
                {
                    data: 'question',
                },
                {
                    data: 'difficulty_level',
                },
                {
                    data: 'different_power',
                },
                {
                    data: 'id',
                    width: "20%",
                    render: function(data, type, row) {
                        return `<div class="au-btn-group text-center d-flex justify-content-center" role="group">
                                    <a class="btn btn-info btn-sm" href="{{ route('question.index') }}/edit/${data}" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                    <button type="button" onclick="deleteQuestion(${data})" data-toggle="modal" data-target="#modal-delete-question" class="btn btn-danger btn-sm ml-1" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                </div>`;
                    }
                }
            ]
        });
    });
</script>
@endpush

@extends('layouts.admin_template')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Detail Ujian
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td>Nama Ujian</td>
                                    <td>{{ $exam->name }}</td>
                                </tr>
                                <tr>
                                    <td>Timer</td>
                                    <td>{{ $exam->timer }} Menit</td>
                                </tr>
                                <tr>
                                    <td>Timer per soal</td>
                                    <td>{{ $exam->timer_per_question }} Detik</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Peserta</td>
                                    <td>{{ $students->count() }} Siswa</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Hasil Ujian
                    </div>
                    <div class="card-body">
                        <table class="w-100 table table-borderless table-striped text-center">
                            <tbody>
                                <tr>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jumlah Soal Terjawab</th>
                                    <th>Jumlah Jawaban Benar</th>
                                    <th>Nilai Akhir</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->nisn }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->result->questions->count() }}</td>
                                    <td>{{ $student->result->questions->where('is_correct', 1)->count() }}</td>
                                    <td>{{ round($student->result->final_score, 2) }}</td>
                                    <td>
                                        <button type="button" data-target="#modal-detail-ujian-{{$student->id}}" class="btn btn-warning btn-sm ml-1" data-placement="top" title="Detail" data-toggle="modal"><i class="fas fa-chart-bar"></i></button>
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

@foreach ($students as $row)
<div class="modal fade" id="modal-detail-ujian-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">
                    <i class="fas fa-chart-bar"></i>&emsp; Detail Hasil Ujian
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col col-md justify-content">
                        <div class="card">
                            <div class="card-body">
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td>NISN</td>
                                            <td>{{ $row->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Siswa</td>
                                            <td>{{ $row->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Soal Terjawab</td>
                                            <td>{{ $row->result->questions->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Jawaban Benar</td>
                                            <td>{{ $row->result->questions->where('is_correct', 1)->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nilai Akhir</td>
                                            <td>{{ round($row->result->final_score, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <table class="w-100 table table-borderless table-striped text-center mb-5">
                            <tbody>
                                <tr>
                                    <th>KODE SOAL</th>
                                    <th>Index Kesukaran</th>
                                    <th>Index Daya Beda</th>
                                    <th>Skor Jawaban</th>
                                    {{-- <th>Theta</th> --}}
                                </tr>
                                @foreach ($row->result->questions as $question)
                                <tr>
                                    <td>{{ $question->question->question_code }}</td>
                                    <td>{{ $question->question->difficulty_level }}</td>
                                    <td>{{ $question->question->different_power }}</td>
                                    <td>{{ $question->is_correct }}</td>
                                    {{-- <td>{{ number_format((float)$question->question->new_theta, 2, '.', '') }}</td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($row->result->questions as $question)
                            <div class="card">
                                <div class="card-header">
                                    <span>Index kesukaran : {{ $question->question->difficulty_level }}</span>
                                    <span class="float-right">Index daya beda : {{ $question->question->different_power }}</span>
                                </div>
                                <div class="card-body">
                                    <p><span>{{ $loop->iteration }}.</span> {!! $question->question->question !!}</p>
                                    <div class="form-check pl-0 d-flex align-items-center my-2">
                                        <label class="form-check-label" style="width: 15px">
                                            A
                                        </label>
                                        <input type="radio" class="mx-2" name="answer-{{ $question->id }}" value="A" {{ $question->answer == 'A' ? 'checked' : '' }} disabled>
                                        <span>{{ $question->question->multiple_choice->A }}</span>
                                    </div>
                                    <div class="form-check pl-0 d-flex align-items-center mb-2">
                                        <label class="form-check-label" style="width: 15px">
                                            B
                                        </label>
                                        <input type="radio" class="mx-2" name="answer-{{ $question->id }}" value="B" {{ $question->answer == 'B' ? 'checked' : '' }} disabled>
                                        <span>{{ $question->question->multiple_choice->B }}</span>
                                    </div>
                                    <div class="form-check pl-0 d-flex align-items-center mb-2">
                                        <label class="form-check-label" style="width: 15px">
                                            C
                                        </label>
                                        <input type="radio" class="mx-2" name="answer-{{ $question->id }}" value="C" {{ $question->answer == 'C' ? 'checked' : '' }} disabled>
                                        <span>{{ $question->question->multiple_choice->C }}</span>
                                    </div>
                                    <div class="form-check pl-0 d-flex align-items-center mb-2">
                                        <label class="form-check-label" style="width: 15px">
                                            D
                                        </label>
                                        <input type="radio" class="mx-2" name="answer-{{ $question->id }}" value="D" {{ $question->answer == 'D' ? 'checked' : '' }} disabled>
                                        <span>{{ $question->question->multiple_choice->D }}</span>
                                    </div>
                                    <div>
                                        <p>Jawaban <strong class="{{ $question->is_correct ? 'text-success' : 'text-danger' }}">{{ $question->is_correct ? 'Benar' : 'Salah' }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
@endpush

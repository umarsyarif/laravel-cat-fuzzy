@extends('layouts.admin_template')
@section('content')
@if ($examStudentQuestion)
    <div class="col-12 col-md-9">
        <div class="card">
            <div class="card-body">
                <p>{{ $question->question }}</p>
                <form action="{{ route('examstudentquestion.update', $examStudentQuestion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-check pl-0 d-flex align-items-center my-2">
                        <label class="form-check-label" for="answerA" style="width: 15px">
                            A
                        </label>
                        <input type="radio" class="mx-2" name="answer" id="answerA" value="A" required>
                        <label class="form-check-label" for="answerA">{{ $question->multiple_choice->A }}</label>
                    </div>
                    <div class="form-check pl-0 d-flex align-items-center mb-2">
                        <label class="form-check-label" for="answerB" style="width: 15px">
                            B
                        </label>
                        <input type="radio" class="mx-2" name="answer" id="answerB" value="B">
                        <label class="form-check-label" for="answerB">{{ $question->multiple_choice->B }}</label>
                    </div>
                    <div class="form-check pl-0 d-flex align-items-center mb-2">
                        <label class="form-check-label" for="answerC" style="width: 15px">
                            C
                        </label>
                        <input type="radio" class="mx-2" name="answer" id="answerC" value="C">
                        <label class="form-check-label" for="answerC">{{ $question->multiple_choice->C }}</label>
                    </div>
                    <div class="form-check pl-0 d-flex align-items-center mb-2">
                        <label class="form-check-label" for="answerD" style="width: 15px">
                            D
                        </label>
                        <input type="radio" class="mx-2" name="answer" id="answerD" value="D">
                        <label class="form-check-label" for="answerD">{{ $question->multiple_choice->D }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Jawab</button>
                </form>
            </div>
        </div>
    </div>
@else
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Hasil Ujian
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td>Nilai</td>
                                    <td>{{ $result->final_score }}</td>
                                </tr>
                                <tr>
                                    <td>Total Soal Terjawab</td>
                                    <td>{{ $result->questions->count() }} Soal</td>
                                </tr>
                                <tr>
                                    <td>Total Soal Terjawab Benar</td>
                                    <td>{{ $result->questions->where('is_correct', 1)->count() }} Soal</td>
                                </tr>
                                <tr>
                                    <td>Total Soal Terjawab Salah</td>
                                    <td>{{ $result->questions->where('is_correct', 0)->count() }} Soal</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @foreach ($result->questions as $question)
                    <div class="card">
                        <div class="card-body">
                            <p>{{ $question->question->question }}</p>
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
                                <p>Jawaban anda <strong class="{{ $question->is_correct ? 'text-success' : 'text-danger' }}">{{ $question->is_correct ? 'Benar' : 'Salah' }}</strong></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endsection

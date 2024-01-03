@extends('layouts.admin_template')
@section('content')
@if (!$result->ended_at)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="w-100">
                    <tbody>
                        <tr>
                            <td>
                                <span>{{$exam->name}}</span>
                            </td>
                            <td class="text-right">
                                <span id="cd-hours">00</span> :
                                <span id="cd-minutes">00</span> :
                                <span id="cd-seconds">00</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div style="height: 5px;" class="">
                <div id="timer-per-question" class="h-100 bg-success"></div>
            </div>
            <div class="card-header">
                {{-- <span>Index kesukaran : {{ $question->difficulty_level }}</span> --}}
                {{-- <span class="float-right">Index daya beda : {{ $question->different_power }}</span> --}}
            </div>
            <div class="card-body">
                <p><span>{{ $result->questions()->count() }}. </span>{!! $question->question !!}</p>
                <form id="form-question" action="{{ route('examstudentquestion.update', $examStudentQuestion->id) }}" method="POST">
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
                <div class="card">
                    <div class="card-header">
                        Perhitungan
                    </div>
                    <div class="card-body">
                        <table class="w-100 table table-borderless table-striped text-center">
                            <tbody>
                                <tr>
                                    <th>KODE SOAL</th>
                                    <th>Index Kesukaran</th>
                                    <th>Index Daya Beda</th>
                                    <th>Skor Jawaban</th>
                                    {{-- <th>Theta</th> --}}
                                </tr>
                                @foreach ($result->questions as $question)
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
                    </div>
                </div>
                @foreach ($result->questions as $question)
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

@push('scripts')
@if (!$result->ended_at)
    <script>
        let timerPerQuestion = {{$exam->timer_per_question}};
        const timerExam = {{$exam->timer}};
        const startedAt = `{{$result->started_at}}`;
        const form = $('#form-question');
        $(document).ready(function() {
            // timer per question
            setInterval(() => setRemaining(), 1000);
            setTimeout(() => console.log('habis'), {{$exam->timer_per_question * 1000}});
            // timer exam
            timer(startedAt);
        });

        function setTimer() {
            const diff = (new Date().getTime() - new Date(startedAt).getTime()) / 60000;
            const form = $('#form-question');
            diff > timerExam && form.submit();
        }

        function setRemaining() {
            timerPerQuestion = parseInt(timerPerQuestion - 1);
            $('#timer-per-question').width(`${timerPerQuestion / {{$exam->timer_per_question}} * 100}%`);
            console.log(timerPerQuestion);
            const form = $('#form-question');
            timerPerQuestion < 0 && form.submit();
        }

        const timer = function (date) {
            const timeUp = new Date(date);
            timeUp.setMinutes(timeUp.getMinutes() + timerExam);
            let timer = Math.round(timeUp.getTime()/1000) - Math.round(new Date().getTime()/1000);
            let minutes, seconds;
            setInterval(function () {
                if (--timer < 0) {
                    timer = 0;
                    form.submit();
                }
                hours = parseInt((timer / 60 / 60) % 24, 10);
                minutes = parseInt((timer / 60) % 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                document.getElementById('cd-hours').innerHTML = hours;
                document.getElementById('cd-minutes').innerHTML = minutes;
                document.getElementById('cd-seconds').innerHTML = seconds;
            }, 1000);
        }
    </script>
@endif
@endpush

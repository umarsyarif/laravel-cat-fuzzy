<div class="row">
    @foreach ($exams as $exam)

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ $exam->name }}
                        @if ($isFinished = $exam->students->first()?->result->ended_at)
                            <small>
                                <span class="badge badge-success float-right mt-1">Selesai</span>
                            </small>
                        @endif
                    </strong>
                </div>
                <div class="card-body">
                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td>Durasi</td>
                                <td>{{$exam->timer}} Menit</td>
                            </tr>
                            <tr>
                                <td>Durasi per Soal</td>
                                <td>{{$exam->timer_per_question}} Detik</td>
                            </tr>
                            <tr>
                                <td>Total Pertanyaan</td>
                                <td>{{$exam->total_question}} Soal</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('exam.show', $exam->id) }}" class="btn btn-primary float-right">{{ $isFinished ? 'Hasil' : 'Mulai' }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

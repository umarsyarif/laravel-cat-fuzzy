@csrf
{{-- <div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Kode Soal</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="kodesoal" placeholder="Masukan kode soal" class="form-control">
    </div>
</div> --}}
@if (isset($question))
    <input type="hidden" name="id" value="{{ $question->id }}">
@endif
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Kode Soal</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="question_code" placeholder="Masukan kode soal" class="form-control" value="{{ old('question_code', $question->question_code ?? '') }}" maxlength="6">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Soal</label>
    </div>
    <div class="col-12 col-md-9">
        <textarea type="textarea" name="question" placeholder="Masukan soal" class="form-control wysiwyg">{{ old('question', $question->question ?? '') }}</textarea>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Indeks Kesukaran</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="difficulty_level" placeholder="Masukan indeks kesukaran" class="form-control" value="{{ old('difficulty_level', $question->difficulty_level ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Indeks Daya Beda</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="different_power" placeholder="Masukan indeks daya beda" class="form-control" value="{{ old('different_power', $question->different_power ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Pilihan Ganda</label>
    </div>
    <div class="col-12 col-md-9">
        <div class="form-check pl-0 d-flex align-items-center mb-2">
            <label class="form-check-label" for="answerA" style="width: 15px">
                A
            </label>
            <input type="radio" class="mx-2" name="answer" id="answerA" value="A" {{ old('answer', $question->answer ?? '') == 'A' ? 'checked' : '' }} required>
            <input type="text" class="form-control" name="multiple_choice[A]" value="{{ old('multiple_choice.A', $question->multiple_choice->A ?? '') }}">
        </div>
        <div class="form-check pl-0 d-flex align-items-center mb-2">
            <label class="form-check-label" for="answerB" style="width: 15px">
                B
            </label>
            <input type="radio" class="mx-2" name="answer" id="answerB" value="B" {{ old('answer', $question->answer ?? '') == 'B' ? 'checked' : '' }}>
            <input type="text" class="form-control" name="multiple_choice[B]" value="{{ old('multiple_choice.B', $question->multiple_choice->B ?? '') }}">
        </div>
        <div class="form-check pl-0 d-flex align-items-center mb-2">
            <label class="form-check-label" for="answerC" style="width: 15px">
                C
            </label>
            <input type="radio" class="mx-2" name="answer" id="answerC" value="C" {{ old('answer', $question->answer ?? '') == 'C' ? 'checked' : '' }}>
            <input type="text" class="form-control" name="multiple_choice[C]" value="{{ old('multiple_choice.C', $question->multiple_choice->C ?? '') }}">
        </div>
        <div class="form-check pl-0 d-flex align-items-center mb-2">
            <label class="form-check-label" for="answerD" style="width: 15px">
                D
            </label>
            <input type="radio" class="mx-2" name="answer" id="answerD" value="D" {{ old('answer', $question->answer ?? '') == 'D' ? 'checked' : '' }}>
            <input type="text" class="form-control" name="multiple_choice[D]" value="{{ old('multiple_choice.D', $question->multiple_choice->D ?? '') }}">
        </div>
    </div>
</div>

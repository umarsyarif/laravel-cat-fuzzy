@csrf
@if (isset($exam))
    <input type="hidden" name="id" value="{{ $exam->id }}">
@endif
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Nama Ujian</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="name" class="form-control" value="{{ old('name', $exam->name ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Jumlah Soal</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="number" name="total_question" placeholder="" class="form-control" value="{{ old('total_question', $exam->total_question ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Timer (min)</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="number" name="timer" placeholder="" class="form-control" value="{{ old('timer', $exam->timer ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Timer per Pertanyaan (sec)</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="number" name="timer_per_question" placeholder="" class="form-control" value="{{ old('timer_per_question', $exam->timer_per_question ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Status</label>
    </div>
    <div class="col-12 col-md-9">
        <label class="switch switch-3d switch-primary mr-3">
            <input id="is-active" type="hidden" name="is_active" value="{{ old('is_active', $exam->is_active ?? '') ? 1 : 0 }}">
            <input id="is-active-switch" type="checkbox" class="switch-input" {{ old('is_active', $exam->is_active ?? 'checked') ? 'checked' : '' }}>
            <span class="switch-label"></span>
            <span class="switch-handle"></span>
        </label>
        <span id="is-active-text">Aktif</span>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            const isActive = document.getElementById('is-active-switch');
            _switch(isActive);
        });

        const isActive = document.getElementById('is-active-switch');
        isActive.addEventListener("change", (evt) => {
            _switch(evt.target);
        });

        // change switch value
        function _switch (val) {
            const isActiveText = document.getElementById('is-active-text');
            isActiveText.innerHTML = val.checked ? 'Aktif' : 'Tidak Aktif';
            const isActiveInput = document.getElementById('is-active');
            isActiveInput.value = val.checked ? 1 : 0;
        }
    </script>
@endpush

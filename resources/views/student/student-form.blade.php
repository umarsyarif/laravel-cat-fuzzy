@csrf
@if (isset($student))
    <input type="hidden" name="id" value="{{ $student->id }}">
@endif
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">NISN</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="nisn" placeholder="Masukan NISN" class="form-control" value="{{ old('nisn', $student->nisn ?? '') }}" {{ isset($student) ? 'disabled' : '' }}>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Nama Siswa</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="name" placeholder="Masukan nama lengkap" class="form-control" value="{{ old('name', $student->name ?? '') }}">
    </div>
</div>
{{-- <div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Kelas</label>
    </div>
    <div class="col-12 col-md-9">
        <select required  name="kelas" id="select" class="form-control">
            <option selected="selected">Masukan pilihan</option>
            <option value="VII">VII</option>
            <option value="VIII">VIII</option>
            <option value="IX">IX</option>
        </select>
    </div>
</div> --}}
{{-- <div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Foto</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="foto" placeholder="Masukan foto" class="form-control">
    </div>
</div> --}}
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Jenis Kelamin</label>
    </div>
    <div class="col-12 col-md-9">
        <select required name="gender" class="form-control" value="{{ old('gender', $student->gender ?? '') }}">
            <option selected="selected">-- Pilih jenis kelamin --</option>
            <option value="Laki-Laki" {{ old('gender', $student->gender ?? '') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="Perempuan" {{ old('gender', $student->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Alamat</label>
    </div>
    <div class="col-12 col-md-9">
        <textarea required type="textarea" name="address" placeholder="Masukan alamat" class="form-control">{{ old('address', $student->address ?? '') }}</textarea>
    </div>
</div>

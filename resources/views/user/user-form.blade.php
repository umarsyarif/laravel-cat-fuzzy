@php
    use App\Enums\UserRoles;
@endphp

@csrf
@if (isset($user))
    <input type="hidden" name="id" value="{{ $user->id }}">
@endif
<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class="form-control-label">Nama</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="name" placeholder="Masukan nama" class="form-control" value="{{ old('name', $user->name ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Username</label>
    </div>
    <div class="col-12 col-md-9">
        <input required type="text" name="username" placeholder="Masukan username" class="form-control" value="{{ old('username', $user->username ?? '') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label" value="{{ old('role', $user->role ?? '') }}">Role</label>
    </div>
    <div class="col-12 col-md-9">
        <select required name="role" class="form-control">
            <option selected="selected">-- Select role --</option>
            @foreach(UserRoles::create_user_dropdown() as $role)
                <option value="{{ $role->value }}" {{ old('role', $user->role->value ?? '') == $role->value ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class="form-control-label">Kata Sandi</label>
    </div>
    <div class="col-12 col-md-9">
        <input {{ !isset($user) ? 'required' : ''}} type="password" name="password" placeholder="6 Karakter" class="form-control">
    </div>
</div>

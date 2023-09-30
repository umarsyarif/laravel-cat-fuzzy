@extends('layouts.admin_template')
@section('content')

            <div class="row m-t-25">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h5 class="m-0 font-weight-bold">
                                <i class="fas fa-plus"></i>&ensp;Tambah Pengguna
                            </h5>
                            <a type="button" href="{{ route('user.index') }}" class="close" data-dismiss="modal" aria-label="Close">
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
                                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input required type="text" name="name" placeholder="Masukan nama" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Username</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input required type="text" name="email" placeholder="Masukan username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Status</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select required  name="status" id="select" class="form-control">
                                                        <option selected="selected">Masukan pilihan</option>
                                                        <option value="Murid Kelas VII">Murid Kelas VII</option>
                                                        <option value="Murid Kelas VIII">Murid Kelas VIII</option>
                                                        <option value="Murid Kelas IX">Murid Kelas IX</option>
                                                        <option value="Wali Kelas VII">Wali Kelas VII</option>
                                                        <option value="Wali Kelas VIII">Wali Kelas VIII</option>
                                                        <option value="Wali Kelas IX">Wali Kelas IX</option>
                                                        <option value="Guru Bahasa Inggris">Guru Bahasa Inggris</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="username-input" class=" form-control-label">Kata Sandi</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input required type="password" name="password" placeholder="6 Karakter" class="form-control">
                                                </div>
                                            </div>
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
